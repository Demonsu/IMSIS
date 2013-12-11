<?php

class KeyVariable
{
	public $id;
	public $question;
	public $score=-1;
	public $key_field_id;
}
class KeyField
{
	public $id;
	public $name;
	public $score=-1;
	public $round_score=-1;//尾化处理过的分数
	public $key_variable_list=array();
	public $effect_field_id;
}
class EffectField
{
	public $id;
	public $name;
	public $score=-1;
	public $key_field_list=array();
}
class Quiz extends DB_Connect
{
	public $effect_field_list=array();
	public $id;
	public $user_id;
	public function __construct(){
		parent::__construct();
	}
	public function init_quiz($quiz_id)
	{
		//完成问卷参数的构造
		$sql="SELECT * FROM questionnaire WHERE id='".$quiz_id."'";
		$select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
		$result=mysql_fetch_assoc($select);
		$this->id=$result["id"];
		$this->user_id=$result["user_id"];
		//echo $this->id;
		//$this->effect_field_list=array();
		//获取作用域
		$sql="SELECT * FROM effect_field";
		$effect_field_select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
		while($effect_field_info=mysql_fetch_assoc($effect_field_select))
		{
			//$effect_field=NULL;
			$effect_field=new EffectField();
			$effect_field->id=$effect_field_info["id"];
			$temp=explode('（',$effect_field_info["name"]);
			$effect_field_info["name"]=$temp[0];
			$effect_field->name=$effect_field_info["name"];
			//$effect_field->key_field_list=array();
			//获取关键域
			$sql="SELECT * FROM key_field WHERE available='1' AND effect_field_id='".$effect_field->id."'";
			$key_field_select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);	
			$key_field_num=0;
			$key_field_total_score=0;
			while($key_field_info=mysql_fetch_assoc($key_field_select))		
			{
				
				$key_field=new KeyField();
				$key_field->id=$key_field_info["id"];
				$temp=explode('（',$key_field_info["name"]);
				$key_field_info["name"]=$temp[0];
				$key_field->name=$key_field_info["name"];
				//$key_field->key_variable_list=array();
				//获取关键变量
				$sql="SELECT kv.id,kv.question,qa.answer,kv.key_field_id FROM questionnaire_answer qa, key_variable kv WHERE qa.questionnaire_id='".$quiz_id."' AND qa.key_variable_id=kv.id AND kv.key_field_id='".$key_field->id."'";
				$key_variable_select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
				//echo mysql_num_rows($key_variable_select);					
				//echo $sql."<br>";
				$key_variable_num=0;
				$key_variable_total_score=0;
				while ($key_variable_info=mysql_fetch_assoc($key_variable_select))
				{
					
					$key_variable=new KeyVariable();
					$key_variable->id=$key_variable_info["id"];
					$temp=explode('（',$key_variable_info["question"]);
					$key_variable_info["question"]=$temp[0];
					$key_variable->question=$key_variable_info["question"];
					$key_variable->score=$key_variable_info["answer"];
					$key_variable->key_field_id=$key_variable_info["key_field_id"];
					$key_field->key_variable_list[]=$key_variable;
					$key_variable_num++;
					$key_variable_total_score=$key_variable_total_score+$key_variable->score;
				}
				
				if ($key_variable_num!=0)
				{
					$key_field->score=$key_variable_total_score/$key_variable_num;
					$score=$key_field->score-floor($key_field->score);
					if ($score>=0 && $score<0.3)
						$score=0;
					else if ($score>=0.3 && $score<0.8)
						$score=0.5;
					else if ($socre>=0.8 && $score<=1)
						$score=1;
					$key_field->round_score=floor($key_field->score)+$score;					
					$key_field_num++;
					$key_field_total_score=$key_field_total_score+$key_field->score;
				}
				$effect_field->key_field_list[]=$key_field;	
			}
			if ($key_field_num!=0)
				$effect_field->score=$key_field_total_score/$key_field_num;
			$this->effect_field_list[]=$effect_field;
			
		}
		
		
	}
	
}
function create_folders($dir){ 
	   return is_dir($dir) or (create_folders(dirname($dir)) and mkdir($dir, 0777)); 
}
class Statistics extends DB_Connect {
	
	public function __construct(){
		parent::__construct();
	}
	public function test()
	{
		$quiz=new Quiz();
		$quiz->init_quiz(40);
		//return $quiz->id;
		
		foreach($quiz->effect_field_list as $effect_field)
		{
			echo "作用域：".$effect_field->name."<br>";
			foreach($effect_field->key_field_list as $key_field)
			{
				echo "关键域：".$key_field->name.":".$key_field->score."<br>";
				foreach($key_field->key_variable_list as $key_avriable)
				{
					echo "关键变量".$key_avriable->question.":".$key_avriable->score."<br>";
				}
			}
		}
	}

	public function table1_CVs($quiz_id)
	{
		$quiz=new Quiz();
		$quiz->init_quiz($quiz_id);
		$KEYVARIABLEFORMAT='
		{
			"title_variable":"%s",
			"score":"%s"
		}';
		$KEYFIELDFORMAT='
		{
			"id":"%s.%s",
			"title_field":"%s",
			"field_content":[
				%s
			],
			"field_score":"%.1f"
		}';
		$EFFECTFIELDFORMAT='
		{ 
			"title_effect":"%s",
			"effect_content":
			[ 
				%s
			],
			"effect_field_score":"%.1f"
		
		}';
		$RETURNFORMAT='
		{ 
			"content":
			[ 
				%s
			] 
		}';
		$all_effect_field="";
		foreach($quiz->effect_field_list as $effect_field)
		{
			$all_key_field="";
			foreach($effect_field->key_field_list as $key_field)
			{
				$all_key_variable="";
				foreach($key_field->key_variable_list as $key_variable)
				{
					if ($all_key_variable!="")
						$all_key_variable=$all_key_variable.",";
					$all_key_variable=$all_key_variable.sprintf($KEYVARIABLEFORMAT,$key_variable->question,$key_variable->score);
				}
				if ($all_key_field!="")
					$all_key_field=$all_key_field.",";
				$all_key_field=$all_key_field.sprintf($KEYFIELDFORMAT,$effect_field->id,$key_field->id,$key_field->name,$all_key_variable,$key_field->score);
			}
			if ($all_effect_field!="")
				$all_effect_field=$all_effect_field.",";
			$all_effect_field=$all_effect_field.sprintf($EFFECTFIELDFORMAT,$effect_field->name,$all_key_field,$effect_field->score);
			
		}
		$jsondata= sprintf($RETURNFORMAT,$all_effect_field);
		$dir='../statistics/'.$quiz_id;
		$result=create_folders($dir); 
		$handle = fopen($dir.'/table1.json', "w");
		fwrite($handle,$jsondata);
		fclose($handle);
		
	}
	
	public function table2_KVs($quiz_id)
	{
		$quiz=new Quiz();
		$quiz->init_quiz($quiz_id);
		$TABLE2FORMAT='
		{
			"content":
			[
				{
					"title":"成熟度特征",
					"content":["0","1","2","3","4","5"]
				},
				{
					"title":"发生项数",
					"content":["%s","%s","%s","%s","%s","%s"]
				},
				{
					"title":"百分比率",
					"content":["%.1f","%.1f","%.1f","%.1f","%.1f","%.1f"]
				}
			]
		}';
		$sql="SELECT * FROM questionnaire_answer WHERE questionnaire_id='".$quiz_id."'";
		$select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);	
		$total_num=mysql_num_rows($select);
		$num=array();
		for ($i=0;$i<=5;$i++)
		{
			$sql="SELECT * FROM questionnaire_answer WHERE questionnaire_id='".$quiz_id."' AND answer='".$i."'";
			$select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);	
			$num[]=mysql_num_rows($select);
		}
		$result=sprintf($TABLE2FORMAT,$num[0],$num[1],$num[2],$num[3],$num[4],$num[5],$num[0]/$total_num*100,$num[1]/$total_num*100,$num[2]/$total_num*100,$num[3]/$total_num*100,$num[4]/$total_num*100,$num[5]/$total_num*100);
		
		$dir='../statistics/'.$quiz_id;
		$flag=create_folders($dir); 
		$handle = fopen($dir.'/table2.json', "w");
		fwrite($handle,$result);
		fclose($handle);
		
	}
	public function table3_KDs($quiz_id)
	{
		$quiz=new Quiz();
		$quiz->init_quiz($quiz_id);
		$KEYFIELDFORMAT='
		{
			"title":"%s",
			"content":"%s"
		}';	
		$EFFECTFIELDFORMAT='
		{
			"title":"%s",
			"content":[
				%s
			]
		}';
		$QUIZFORMAT='
		{
		"content":[
			%s
		]
		}';
		$all_effect_field="";
		foreach($quiz->effect_field_list as $effect_field)
		{
			$all_key_field="";
			foreach($effect_field->key_field_list as $key_field)
			{
				if ($key_field->score!=-1)
				{
					if ($all_key_field!="")
						$all_key_field=$all_key_field.",";
					$all_key_field=$all_key_field.sprintf($KEYFIELDFORMAT,$key_field->name,$key_field->round_score);
				}
			}
			if ($effect_field->score!=-1)
			{
				if ($all_effect_field!="")
					$all_effect_field=$all_effect_field.",";
				$all_effect_field=$all_effect_field.sprintf($EFFECTFIELDFORMAT,$effect_field->name,$all_key_field);
			}
		}
		$result=sprintf($QUIZFORMAT,$all_effect_field);
		$dir='../statistics/'.$quiz_id;
		$flag=create_folders($dir); 
		$handle = fopen($dir.'/table3.json', "w");
		fwrite($handle,$result);
		fclose($handle);		
	}
	public function table4_KDs($quiz_id)
	{
		$quiz=new Quiz();
		$quiz->init_quiz($quiz_id);
		$RESULTFORMAT='
			{
				"content":[
					{
						"title":"成熟度特征",
						"content":["0","0.5","1","1.5","2","2.5","3","3.5","4","4.5","5"]
					},
					{
						"title":"发生项数",
						"content":["%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s"]
					},
					{
						"title":"百分比",
						"content":["%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s"]
					}
				],
				"total":["%s","100"]
			}
		';
		$mature_level=0;
		$total_num=0;
		$num=array();
		while ($mature_level<=5)
		{
			$key_field_num=0;
			foreach($quiz->effect_field_list as $effect_field)
			{
				foreach($effect_field->key_field_list as $key_field)
				{
					if ($key_field->round_score!=-1 && $key_field->round_score==$mature_level)
					{
						$key_field_num++;
					}			
				}
			}
			$num[]=$key_field_num;
			$mature_level=$mature_level+0.5;
		}
		foreach($quiz->effect_field_list as $effect_field)
		{
			foreach($effect_field->key_field_list as $key_field)
			{
				if ($key_field->round_score!=-1)
				{
					$total_num++;
				}			
			}
		}
		
		$result=sprintf($RESULTFORMAT,$num[0],$num[1],$num[2],$num[3],$num[4],$num[5],$num[6],$num[7],$num[8],$num[9],$num[10],$num[11],
									  $num[0]/$total_num*100,$num[1]/$total_num*100,$num[2]/$total_num*100,$num[3]/$total_num*100,$num[4]/$total_num*100,
									  $num[5]/$total_num*100,$num[6]/$total_num*100,$num[7]/$total_num*100,$num[8]/$total_num*100,$num[9]/$total_num*100,
									  $num[10]/$total_num*100,$num[11]/$total_num*100,$total_num);	
		$dir='../statistics/'.$quiz_id;
		$flag=create_folders($dir); 
		$handle = fopen($dir.'/table4.json', "w");
		fwrite($handle,$result);
		fclose($handle);		
	}
	public function table5_LDs($quiz_id)
	{
		/*
		{
			"content":[
				{
					"title":"业务管理",
					"score":"2.8",
					"proportion":"28"
				},
				{
					"title":"信息技术",
					"score":"2.5",
					"proportion":"25"
				},
				{
					"title":"组织与运营",
					"score":"2.4",
					"proportion":"24"
				},
				{
					"title":"电子政务规划",
					"score":"2.3",
					"proportion":"23"
				}
			]
		}
		*/
		$quiz=new Quiz();
		$quiz->init_quiz($quiz_id);
		$EFFECTFIELDFORMAT='
				{
					"title":"%s",
					"score":"%s",
					"proportion":"%.2f%%"
				}';
		$RESULTFORMAT='
				{
					"content":[
						%s
				]}';
		$all_effect_field="";
		$total_score=0;
		foreach($quiz->effect_field_list as $effect_field)
		{
			if ($effect_field!=-1)
				$total_score+=$effect_field->score;
		}
		foreach($quiz->effect_field_list as $effect_field)
		{
			if ($all_effect_field!="")
				$all_effect_field=$all_effect_field.",";
			if ($effect_field->score!=-1)
				$all_effect_field=$all_effect_field.sprintf($EFFECTFIELDFORMAT,$effect_field->name,$effect_field->score,$effect_field->score/$total_score*100);
			else
				$all_effect_field=$all_effect_field.sprintf($EFFECTFIELDFORMAT,$effect_field->name,0,0.00);
		}
		$result=sprintf($RESULTFORMAT,$all_effect_field);
		$dir='../statistics/'.$quiz_id;
		$flag=create_folders($dir); 
		$handle = fopen($dir.'/table5.json', "w");
		fwrite($handle,$result);
		fclose($handle);	
	}
}


?>