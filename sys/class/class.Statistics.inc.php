<?php

class KeyVariable
{
	public $id;
	public $question;
	public $score=-1;
	public $need_promote;//特别弱项或者特别优秀
	public $promote_space;//提升空间
	public $good_rate;//优秀指数
	public $contribution;//贡献率
	public $key_field_id;
}
class KeyField
{
	public $id;
	public $name;
	public $score=-1;
	public $round_score=-1;//尾化处理过的分数
	public $is_short=0;//是否为短缺项
	public $is_good=0;
	public $total_variable;//关键变量的数量
	public $total_promote_space=0;
	public $key_variable_list=array();
	public $effect_field_id;
}
class EffectField
{
	public $id;
	public $name;
	public $score=-1;
	public $total_variable;//关键变量的数量
	public $key_field_list=array();
}
class Quiz extends DB_Connect
{
	public $effect_field_list=array();
	public $id;
	public $user_id;
	public $quiz_id;
	public $total_variable=0;//关键变量总数
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
			$effect_field_variable_num=0;
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
				$key_field_variable_num=0;
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
					$key_field_variable_num++;
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
				$key_field->total_variable=$key_field_variable_num;
				$effect_field_variable_num+=$key_field_variable_num;
				$effect_field->key_field_list[]=$key_field;	
			}
			if ($key_field_num!=0)
				$effect_field->score=$key_field_total_score/$key_field_num;
			$effect_field->total_variable=$effect_field_variable_num;
			$this->effect_field_list[]=$effect_field;
			$this->total_variable+=$effect_field->total_variable;
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
	public $key_field_goal_list=array();//目标值表格
	public $mature_level;//该问卷未达到的成熟度
	public $quiz;
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
	public function init_key_goal_list($quiz_id,$config_id=1)
	{
		//$quiz=new Quiz();
		//$quiz->init_quiz($quiz_id);
		foreach($this->quiz->effect_field_list as $effect_field)
		{
			foreach($effect_field->key_field_list as $key_field)
			{	
				$sql="SELECT * FROM key_field_goal WHERE key_field_id='".$key_field->id."' AND config_id='".$config_id."'";
				$select=mysql_query($sql,$this->root_conn) or trigger_error(mysql_error(),E_USER_ERROR);
				$result=mysql_fetch_assoc($select);
				$this->key_field_goal_list[$key_field->id]=array('1'=>$result["goal_1"],'2'=>$result["goal_2"],'3'=>$result["goal_3"],'4'=>$result["goal_4"],'5'=>$result["goal_5"]);
			}
		}	
	}
	public function table1_CVs()
	{
		//$quiz=new Quiz();
		//$quiz->init_quiz($quiz_id);
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
		foreach($this->quiz->effect_field_list as $effect_field)
		{
			$all_key_field="";
			if ($effect_field->score!=-1)
			{
				foreach($effect_field->key_field_list as $key_field)
				{
					$all_key_variable="";
					if ($key_field->score!=-1)
					{
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
				}
				if ($all_effect_field!="")
					$all_effect_field=$all_effect_field.",";
				$all_effect_field=$all_effect_field.sprintf($EFFECTFIELDFORMAT,$effect_field->name,$all_key_field,$effect_field->score);
			}
			
		}
		$jsondata= sprintf($RETURNFORMAT,$all_effect_field);
		$dir='../statistics/'.$this->quiz_id;
		$result=create_folders($dir); 
		$handle = fopen($dir.'/table1.json', "w");
		fwrite($handle,$jsondata);
		fclose($handle);
		
	}
	
	public function table2_KVs()
	{
		//$quiz=new Quiz();
		//$quiz->init_quiz($quiz_id);
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
		$sql="SELECT * FROM questionnaire_answer WHERE questionnaire_id='".$this->quiz_id."'";
		$select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);	
		$total_num=mysql_num_rows($select);
		$num=array();
		for ($i=0;$i<=5;$i++)
		{
			$sql="SELECT * FROM questionnaire_answer WHERE questionnaire_id='".$this->quiz_id."' AND answer='".$i."'";
			$select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);	
			$num[]=mysql_num_rows($select);
		}
		$result=sprintf($TABLE2FORMAT,$num[0],$num[1],$num[2],$num[3],$num[4],$num[5],$num[0]/$total_num*100,$num[1]/$total_num*100,$num[2]/$total_num*100,$num[3]/$total_num*100,$num[4]/$total_num*100,$num[5]/$total_num*100);
		
		$dir='../statistics/'.$this->quiz_id;
		$flag=create_folders($dir); 
		$handle = fopen($dir.'/table2.json', "w");
		fwrite($handle,$result);
		fclose($handle);
		
	}
	public function table3_KDs()
	{
		//$quiz=new Quiz();
		//$quiz->init_quiz($quiz_id);
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
		foreach($this->quiz->effect_field_list as $effect_field)
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
		$dir='../statistics/'.$this->quiz_id;
		$flag=create_folders($dir); 
		$handle = fopen($dir.'/table3.json', "w");
		fwrite($handle,$result);
		fclose($handle);		
	}
	public function table4_KDs()
	{
		//$quiz=new Quiz();
		//$quiz->init_quiz($quiz_id);
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
						"content":["%.2f","%.2f","%.2f","%.2f","%.2f","%.2f","%.2f","%.2f","%.2f","%.2f","%.2f"]
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
			foreach($this->quiz->effect_field_list as $effect_field)
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
		foreach($this->quiz->effect_field_list as $effect_field)
		{
			foreach($effect_field->key_field_list as $key_field)
			{
				if ($key_field->round_score!=-1)
				{
					$total_num++;
				}			
			}
		}
		
		$result=sprintf($RESULTFORMAT,$num[0],$num[1],$num[2],$num[3],$num[4],$num[5],$num[6],$num[7],$num[8],$num[9],$num[10],
									  $num[0]/$total_num*100,$num[1]/$total_num*100,$num[2]/$total_num*100,$num[3]/$total_num*100,$num[4]/$total_num*100,
									  $num[5]/$total_num*100,$num[6]/$total_num*100,$num[7]/$total_num*100,$num[8]/$total_num*100,$num[9]/$total_num*100,
									  $num[10]/$total_num*100,$total_num);	
		$dir='../statistics/'.$this->quiz_id;
		$flag=create_folders($dir); 
		$handle = fopen($dir.'/table4.json', "w");
		fwrite($handle,$result);
		fclose($handle);		
	}
	public function table5_LDs()
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
		//$quiz=new Quiz();
		//$quiz->init_quiz($quiz_id);
		$EFFECTFIELDFORMAT='
				{
					"title":"%s",
					"score":"%.1f",
					"proportion":"%.2f"
				}';
		$RESULTFORMAT='
				{
					"content":[
						%s
				]}';
		$all_effect_field="";
		$total_score=0;
		foreach($this->quiz->effect_field_list as $effect_field)
		{
			if ($effect_field->score!=-1)
				$total_score+=$effect_field->score;
		}
		foreach($this->quiz->effect_field_list as $effect_field)
		{
			if ($all_effect_field!="")
				$all_effect_field=$all_effect_field.",";
			if ($effect_field->score!=-1)
				$all_effect_field=$all_effect_field.sprintf($EFFECTFIELDFORMAT,$effect_field->name,$effect_field->score,$effect_field->score/$total_score*100);
			else
				$all_effect_field=$all_effect_field.sprintf($EFFECTFIELDFORMAT,$effect_field->name,0,0.00);
		}
		$result=sprintf($RESULTFORMAT,$all_effect_field);
		$dir='../statistics/'.$this->quiz_id;
		$flag=create_folders($dir); 
		$handle = fopen($dir.'/table5.json', "w");
		fwrite($handle,$result);
		fclose($handle);	
	}
	
	public function table6_KTs()
	{
		//$quiz=new Quiz();
		//$quiz->init_quiz($quiz_id);
		$KEYFIELDFORMAT='
		{
			"title":"%s",
			"content":["%s","%s","%s","%s","%s"]
		}';		
		$EFFECTFIELDFORMAT='
		{
			"title":"%s",
			"content":[%s]
		}';
		$RESULTFORMAT='
		{
			"content":[
				%s
			]
		}';
		$all_effect_field="";
		foreach($this->quiz->effect_field_list as $effect_field)
		{
			$all_key_field="";
			foreach($effect_field->key_field_list as $key_field)
			{
				//if ($key_field->score!=-1)
				{
					if ($all_key_field!="")
						$all_key_field=$all_key_field.",";
					//$sql="SELECT * FROM key_field_goal WHERE key_field_id='".$key_field->id."' AND config_id='".$config_id."'";
					//$select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
					//$result=mysql_fetch_assoc($select);
					$result=$this->key_field_goal_list[$key_field->id];
					if ($result[1]==-1)
						$result[1]="";
					if ($result[2]==-1)
						$result[2]="";
					if ($result[3]==-1)
						$result[3]="";
					if ($result[4]==-1)
						$result[4]="";
					if ($result[5]==-1)
						$result[5]="";
					$all_key_field=$all_key_field.sprintf($KEYFIELDFORMAT,$key_field->name,$result[1],$result[2],$result[3],$result[4],$result[5]);
				}
			}
			//if ($effect_field->score!=-1)
			{
				if ($all_effect_field!="")
					$all_effect_field=$all_effect_field.",";
				$all_effect_field=$all_effect_field.sprintf($EFFECTFIELDFORMAT,$effect_field->name,$all_key_field);
			}
		}	
		$result=sprintf($RESULTFORMAT,$all_effect_field);	
		$dir='../statistics/'.$this->quiz_id;
		$flag=create_folders($dir); 
		$handle = fopen($dir.'/table6.json', "w");
		fwrite($handle,$result);
		fclose($handle);		
	}
	public function fetch_goal_table_admin()
	{
		//$quiz=new Quiz();
		//$quiz->init_quiz($quiz_id);
		$KEYFIELDFORMAT='
		{
			"title":"%s",
			"id":"%s",
			"content":["%s","%s","%s","%s","%s"]
		}';		
		$EFFECTFIELDFORMAT='
		{
			"title":"%s",
			"content":[%s]
		}';
		$RESULTFORMAT='
		{
			"content":[
				%s
			]
		}';
		$all_effect_field="";
		foreach($this->quiz->effect_field_list as $effect_field)
		{
			$all_key_field="";
			foreach($effect_field->key_field_list as $key_field)
			{
				if ($all_key_field!="")
					$all_key_field=$all_key_field.",";
				$result=$this->key_field_goal_list[$key_field->id];
				if ($result[1]==-1)
					$result[1]="";
				if ($result[2]==-1)
					$result[2]="";
				if ($result[3]==-1)
					$result[3]="";
				if ($result[4]==-1)
					$result[4]="";
				if ($result[5]==-1)
					$result[5]="";
				$all_key_field=$all_key_field.sprintf($KEYFIELDFORMAT,$key_field->name,$key_field->id,$result[1],$result[2],$result[3],$result[4],$result[5]);
			}
			if ($all_effect_field!="")
				$all_effect_field=$all_effect_field.",";
			$all_effect_field=$all_effect_field.sprintf($EFFECTFIELDFORMAT,$effect_field->name,$all_key_field);
		}	
		$result=sprintf($RESULTFORMAT,$all_effect_field);	
		return $result;	
	}
	public function table7_ACs()
	{
		//$quiz=new Quiz();
		//$quiz->init_quiz($quiz_id);
		$KEYFIELDFORMAT='
		{
			"title":"%s",
			"content":["%.1f","%s","%.2f","%s","%.2f"]
		}';		
		$EFFECTFIELDFORMAT='
		{
			"title":"%s",
			"content":[
				%s
			]
		}';
		$RESULTFORMAT='
		{
			"first":"%s",
			"second":"%s",
			"content":[
				%s
			]
		}';	
		$mature_level=2;
		//首先找到我的成熟度等级
		while ($mature_level<=5)
		{
			$flag=1;//表示满足该等级要求
			//echo "mature_level:".$mature_level."<br>";
			foreach($this->quiz->effect_field_list as $effect_field)
			{
				if($effect_field->score!=-1) 
				foreach($effect_field->key_field_list as $key_field)
				{
					if ($key_field->score!=-1)
					{	
						if ($key_field->round_score<$this->key_field_goal_list[$key_field->id][$mature_level])
						{
							//echo $key_field->name.":".$key_field->round_score;
							$flag=0;
						}
					}
				}
			}
			if ($flag==0) break;
			$mature_level++;
		}
		$this->mature_level=$mature_level;
		if ($mature_level>5)
		{
			$this->mature_level=5;
			$mature_level_first=5;
			$mature_level_second=5;
		}
		else
		{
			$mature_level_first=$mature_level-1;
			$mature_level_second=$mature_level;
		}

		$all_effect_field="";
		foreach($this->quiz->effect_field_list as $effect_field)
		{
			$all_key_field="";
			if($effect_field->score!=-1) 
			{
				$key_fied_index=0;
				foreach($effect_field->key_field_list as $key_field)
				{
					if ($key_field->score!=-1)
					{
						if ($all_key_field!="")
							$all_key_field=$all_key_field.",";
						if ($this->key_field_goal_list[$key_field->id][$mature_level_first]==-1)
						{
							$first_goal="";
							$first_goal_complete="";
						}else
						{
							$first_goal=$this->key_field_goal_list[$key_field->id][$mature_level_first];
							$first_goal_complete=$key_field->round_score/$this->key_field_goal_list[$key_field->id][$mature_level_first]*100;							
						}
						if ($this->key_field_goal_list[$key_field->id][$mature_level_second]==-1)
						{
							$second_goal="";
							$second_goal_complete="";
						}else
						{
							$second_goal=$this->key_field_goal_list[$key_field->id][$mature_level_second];
							$second_goal_complete=$key_field->round_score/$this->key_field_goal_list[$key_field->id][$mature_level_second]*100;	
							if ($second_goal_complete<100)//该项为短缺项
							{
								$effect_field->key_field_list[$key_fied_index]->is_short=1;
								//echo $effect_field->key_field_list[$key_fied_index]->name."<br>".$key_field->name;
							}else if ($second_goal_complete>100)//该项为优势项
							{
								$effect_field->key_field_list[$key_fied_index]->is_good=1;
							}					
						}					
						$all_key_field=$all_key_field.sprintf($KEYFIELDFORMAT,$key_field->name,$key_field->round_score,$first_goal,$first_goal_complete,$second_goal,$second_goal_complete);
					}
					$key_fied_index++;
				}
				if ($all_effect_field!="")
						$all_effect_field=$all_effect_field.",";
				$all_effect_field=$all_effect_field.sprintf($EFFECTFIELDFORMAT,$effect_field->name,$all_key_field);
				
			}
		}
		$result=sprintf($RESULTFORMAT,$mature_level_first,$mature_level_second,$all_effect_field);
		$dir='../statistics/'.$this->quiz_id;
		$flag=create_folders($dir); 
		$handle = fopen($dir.'/table7.json', "w");
		fwrite($handle,$result);
		fclose($handle);	
	}
	public function table8_SEs()
	{
		//$quiz=new Quiz();
		//$quiz->init_quiz($quiz_id);
		$KEYVARIABLEFORMAT='
		{
			"title":"%s",
			"vari_score":"%s",
			"contribution":"%.2f",
			"space":"%.2f",
			"need_promote":"%s"
		}';
		$KEYFIELDFORMAT='
		{
			"title":"%s",
			"content":[
				%s
			],
			"compre":"%s",
			"third":"%s",
			"com_rate":"%.2f",
			"promote_rate":"%.2f"
		}';
		$EFFECTFIELDFORMAT='
		{
			"title":"%s",
			"content":[
				%s
			]
		}';
		$RESULTFORMAT='
		{
			"level":"%s",
			"content":[
				%s
			 ]
		}';
		$all_effect_field="";
		foreach($this->quiz->effect_field_list as $effect_field)
		{
			$flag=0;//该作用域下无短缺关键域
			$all_key_field="";
			$key_field_index=0;
			foreach($effect_field->key_field_list as $key_field)
			{
				if ($key_field->is_short==1)
				{
					//echo "table8<br>".$key_field->name;
					$flag=1;
					$all_key_variable="";
					$target_score=$this->key_field_goal_list[$key_field->id][$this->mature_level];
					$key_variable_index=0;
					foreach($key_field->key_variable_list as $key_variable)
					{
						if ($all_key_variable!="")
							$all_key_variable=$all_key_variable.",";
						if ($key_variable->score<$target_score)
							$need_promote="true";
						else
							$need_promote="false";
						$key_field->key_variable_list[$key_variable_index]->need_promote=$need_promote;
						$all_key_variable=$all_key_variable.sprintf($KEYVARIABLEFORMAT,$key_variable->question,$key_variable->score,($key_variable->score-$key_field->round_score)/$key_field->round_score*100,($target_score-$key_variable->score)/$key_variable->score*100,$need_promote);
						$key_field->key_variable_list[$key_variable_index]->promote_space=($target_score-$key_variable->score)/$key_variable->score*100;
						$key_field->key_variable_list[$key_variable_index]->contribution=($key_variable->score-$key_field->round_score)/$key_field->round_score;
						$key_field->total_promote_space+=$key_field->key_variable_list[$key_variable_index]->promote_space;
						$key_variable_index++;
					}
					if ($all_key_field!="")
						$all_key_field=$all_key_field.",";
					$all_key_field=$all_key_field.sprintf($KEYFIELDFORMAT,$key_field->name,$all_key_variable,$key_field->round_score,$target_score,$key_field->round_score/$target_score*100,100-$key_field->round_score/$target_score*100);
					$effect_field->key_field_list[$key_field_index]->total_promote_space=$key_field->total_promote_space;
				}
				$key_field_index++;
			}

			if ($flag==1)
			{
				if ($all_effect_field!="")
					$all_effect_field=$all_effect_field.",";
				$all_effect_field=$all_effect_field.sprintf($EFFECTFIELDFORMAT,$effect_field->name,$all_key_field);
			}
		}
		$result=sprintf($RESULTFORMAT,$this->mature_level,$all_effect_field);		
		$dir='../statistics/'.$this->quiz_id;
		$flag=create_folders($dir); 
		$handle = fopen($dir.'/table8.json', "w");
		fwrite($handle,$result);
		fclose($handle);	
	}
	public function table9_SAs()
	{
		$EFFECTFIELDFORMAT='
		{
			"title":"%s",
			"content":["%s","%s","%.2f","%.2f"]
		}';
		$RESULTFORMAT='
		{
			"content":[
					%s
			],
			"total":["%s","%s","%.2f"]
		}';
		$total_test_items=0;
		$total_short_items=0.00000001;
		foreach($this->quiz->effect_field_list as $effect_field)
		{
			foreach($effect_field->key_field_list as $key_field)
			{
				if ($key_field->score!=-1)
				{
					$total_test_items++;
					if ($key_field->is_short==1)
					{
						$total_short_items++;
					}
				}
			}
		}
		$all_effect_field="";
		foreach($this->quiz->effect_field_list as $effect_field)
		{
			if ($effect_field->score!=-1)
			{
				$effect_field_test_items=0;
				$effect_field_short_items=0.0000001;
				foreach($effect_field->key_field_list as $key_field)
				{
					if ($key_field->score!=-1)
					{
						$effect_field_test_items++;
						if ($key_field->is_short==1)
						{
							$effect_field_short_items++;
						}
					}
				}
				if ($all_effect_field!="")
					$all_effect_field=$all_effect_field.",";
				$all_effect_field=$all_effect_field.sprintf($EFFECTFIELDFORMAT,$effect_field->name,$effect_field_short_items,$effect_field_test_items,$effect_field_short_items/$effect_field_test_items*100,$effect_field_short_items/$total_short_items*100);	
			}
		}	
		$result=sprintf($RESULTFORMAT,$all_effect_field,$total_short_items,$total_test_items,$total_short_items/$total_test_items*100);		
		$dir='../statistics/'.$this->quiz_id;
		$flag=create_folders($dir); 
		$handle = fopen($dir.'/table9.json', "w");
		fwrite($handle,$result);
		fclose($handle);		
	}
	public function table10_APs()
	{
		$KEYVARIABLEFORMAT='
		{
			"title":"%s",
			"content":["%s","%.2f","%.2f","%s"]
		}';
		$EFFECTFIELDFORMAT='
		{
			"title":"%s",
			"T56":"%s",
			"rate":"%.2f",
			"content":[
				%s
			]
		}';
		$RESULTFORMAT='
		{
			"table1":[
				%s
			],
			"table1_total":["%s","%.2f"],
			"table2":[
				%s
			]
		}';
		$KEYVARIABLELISTFORMAT='
		{
			"title":"%s",
			"content":["%s","%.2f"]
		}';
		//table1的内容
		$all_effect_field="";
		$total_need_promote_variable=0;
		foreach($this->quiz->effect_field_list as $effect_field)
		{
			$all_variable_field="";
			$need_promote_variable_num=0;//作用域下需要提升的能力数
			if ($effect_field->score!=-1)
			{
				foreach($effect_field->key_field_list as $key_field)
				{
					if ($key_field->score!=-1 && $key_field->is_short==1)
					foreach($key_field->key_variable_list as $key_variable)
					{
						if ($key_variable->promote_space>0)
						{
							if ($all_variable_field!="")
								$all_variable_field=$all_variable_field.",";
							if ($key_variable->contribution<0)
								$all_variable_field=$all_variable_field.sprintf($KEYVARIABLEFORMAT,$key_variable->question,$key_variable->score,$key_variable->promote_space,$key_variable->promote_space/$key_field->total_promote_space,"true");
							else
								$all_variable_field=$all_variable_field.sprintf($KEYVARIABLEFORMAT,$key_variable->question,$key_variable->score,$key_variable->promote_space,$key_variable->promote_space/$key_field->total_promote_space,"false");
							$need_promote_variable_num++;
							$total_need_promote_variable++;
						}
					}
				}
				if($all_effect_field!="")
					$all_effect_field=$all_effect_field.",";
				$all_effect_field=$all_effect_field.sprintf($EFFECTFIELDFORMAT,$effect_field->name,$need_promote_variable_num,$need_promote_variable_num/$effect_field->total_variable*100,$all_variable_field);
			}
		}
		//table2的内容
		$all_variable_list_field="";
		foreach($this->quiz->effect_field_list as $effect_field)
		{
			if ($effect_field->score!=-1)
			{				
				foreach($effect_field->key_field_list as $key_field)
				{
					if ($key_field->score!=-1 && $key_field->is_short==1)
					foreach($key_field->key_variable_list as $key_variable)
					{
						if ($key_variable->promote_space>0)
						{
							if ($all_variable_list_field!="")
								$all_variable_list_field=$all_variable_list_field.",";
							$all_variable_list_field=$all_variable_list_field.sprintf($KEYVARIABLELISTFORMAT,$key_variable->question,$key_variable->score,$key_variable->promote_space);
						}
					}
				}
			}
		}
		$result=sprintf($RESULTFORMAT,$all_effect_field,$total_need_promote_variable,$total_need_promote_variable/$this->quiz->total_variable*100,$all_variable_list_field);
		$dir='../statistics/'.$this->quiz_id;
		$flag=create_folders($dir); 
		$handle = fopen($dir.'/table10.json', "w");
		fwrite($handle,$result);
		fclose($handle);			
		
	}
	public function table11_GAs()
	{
		$KEYVARIABLEFORMAT='
		{
			"title":"%s",
			"vari_score":"%s",
			"contribution":"%.2f",
			"space":"%.2f"
		}';
		$KEYFIELDFORMAT='
		{
			"title":"%s",
			"content":[
				%s
			],
			"compre":"%s",
			"third":"%s",
			"com_rate":"%.2f",
			"promote_rate":"%.2f"
		}';
		$EFFECTFIELDFORMAT='
		{
			"title":"%s",
			"content":[
				%s
			]
		}';
		$RESULTFORMAT='
		{
			"level":"%s",
			"content":[
				%s
			 ]
		}';
		$all_effect_field="";
		foreach($this->quiz->effect_field_list as $effect_field)
		{
			$flag=0;//该作用域下无优势关键域
			$all_key_field="";
			$key_field_index=0;
			foreach($effect_field->key_field_list as $key_field)
			{
				if ($key_field->is_good==1)
				{
					//echo "table8<br>".$key_field->name;
					$flag=1;
					$all_key_variable="";
					$target_score=$this->key_field_goal_list[$key_field->id][$this->mature_level];
					$key_variable_index=0;
					foreach($key_field->key_variable_list as $key_variable)
					{
						if ($all_key_variable!="")
							$all_key_variable=$all_key_variable.",";
						if ($key_variable->score>$target_score)
							$need_promote="true";//特别优势
						else
							$need_promote="false";
						$key_field->key_variable_list[$key_variable_index]->need_promote=$need_promote;
						$all_key_variable=$all_key_variable.sprintf($KEYVARIABLEFORMAT,$key_variable->question,$key_variable->score,($key_variable->score-$key_field->round_score)/$key_field->round_score*100,($key_variable->score-$target_score)/$target_score);
						//$key_field->key_variable_list[$key_variable_index]->promote_space=($target_score-$key_variable->score)/$key_variable->score*100;
						$key_field->key_variable_list[$key_variable_index]->contribution=($key_variable->score-$key_field->round_score)/$key_field->round_score*100;
						$key_field->key_variable_list[$key_variable_index]->good_rate=($key_variable->score-$target_score)/$target_score;
						//$key_field->total_promote_space+=$key_field->key_variable_list[$key_variable_index]->promote_space;
						$key_variable_index++;
					}
					if ($all_key_field!="")
						$all_key_field=$all_key_field.",";
					$all_key_field=$all_key_field.sprintf($KEYFIELDFORMAT,$key_field->name,$all_key_variable,$key_field->round_score,$target_score,$key_field->round_score/$target_score*100,$key_field->round_score/$target_score*100-100);
					//$effect_field->key_field_list[$key_field_index]->total_promote_space=$key_field->total_promote_space;
				}
				$key_field_index++;
			}

			if ($flag==1)
			{
				if ($all_effect_field!="")
					$all_effect_field=$all_effect_field.",";
				$all_effect_field=$all_effect_field.sprintf($EFFECTFIELDFORMAT,$effect_field->name,$all_key_field);
			}
		}
		$result=sprintf($RESULTFORMAT,$this->mature_level,$all_effect_field);		
		$dir='../statistics/'.$this->quiz_id;
		$flag=create_folders($dir); 
		$handle = fopen($dir.'/table11.json', "w");
		fwrite($handle,$result);
		fclose($handle);	
	}
	public function table12_GAEs()
	{
		$EFFECTFIELDFORMAT='
		{
			"title":"%s",
			"content":["%s","%s","%.2f","%.2f"]
		}';
		$RESULTFORMAT='
		{
			"content":[
					%s
			],
			"total":["%s","%s","%.2f"]
		}';
		$total_test_items=0;
		$total_good_items=0;
		foreach($this->quiz->effect_field_list as $effect_field)
		{
			foreach($effect_field->key_field_list as $key_field)
			{
				if ($key_field->score!=-1)
				{
					$total_test_items++;
					if ($key_field->is_good==1)
					{
						$total_good_items++;
					}
				}
			}
		}
		if ($total_good_items==0)
			$total_good_items=0.00000001;
		$all_effect_field="";
		foreach($this->quiz->effect_field_list as $effect_field)
		{
			if ($effect_field->score!=-1)
			{
				$effect_field_test_items=0;
				$effect_field_good_items=0;
				foreach($effect_field->key_field_list as $key_field)
				{
					if ($key_field->score!=-1)
					{
						$effect_field_test_items++;
						if ($key_field->is_good==1)
						{
							$effect_field_good_items++;
						}
					}
				}
				if ($all_effect_field!="")
					$all_effect_field=$all_effect_field.",";
				$all_effect_field=$all_effect_field.sprintf($EFFECTFIELDFORMAT,$effect_field->name,$effect_field_good_items,$effect_field_test_items,$effect_field_good_items/$effect_field_test_items*100,$effect_field_good_items/$total_good_items*100);	
			}
		} 
		$result=sprintf($RESULTFORMAT,$all_effect_field,$total_good_items,$total_test_items,$total_good_items/$total_test_items*100);		
		$dir='../statistics/'.$this->quiz_id;
		$flag=create_folders($dir); 
		$handle = fopen($dir.'/table12.json', "w");
		fwrite($handle,$result);
		fclose($handle);		
	}
	public function table13_GANs()
	{
		$KEYVARIABLEFORMAT='
		{
			"title":"%s",
			"content":["%s","%.2f","%s"]
		}';
		$EFFECTFIELDFORMAT='
		{
			"title":"%s",
			"T56":"%s",
			"rate":"%.2f",
			"content":[
				%s
			]
		}';
		$RESULTFORMAT='
		{
			"table1":[
				%s
			],
			"table1_total":["%s","%.2f"],
			"table2":[
				%s
			]
		}';
		$KEYVARIABLELISTFORMAT='
		{
			"title":"%s",
			"content":["%s","%.2f"]
		}';
		//table1的内容
		$all_effect_field="";
		$total_good_variable=0;
		foreach($this->quiz->effect_field_list as $effect_field)
		{
			$all_variable_field="";
			$effect_good_variable=0;//作用域下优秀的能力数
			if ($effect_field->score!=-1)
			{
				foreach($effect_field->key_field_list as $key_field)
				{
					if ($key_field->score!=-1 && $key_field->is_good==1)
					foreach($key_field->key_variable_list as $key_variable)
					{
						if ($key_variable->good_rate>0)//优秀的关键变量
						{
							if ($all_variable_field!="")
								$all_variable_field=$all_variable_field.",";
							if ($key_variable->contribution>0)
								$all_variable_field=$all_variable_field.sprintf($KEYVARIABLEFORMAT,$key_variable->question,$key_variable->score,$key_variable->good_rate,"true");
							else
								$all_variable_field=$all_variable_field.sprintf($KEYVARIABLEFORMAT,$key_variable->question,$key_variable->score,$key_variable->good_rate,"false");
	
							$effect_good_variable++;
							$total_good_variable++;
						}
					}
				}
				if($all_effect_field!="")
					$all_effect_field=$all_effect_field.",";
				$all_effect_field=$all_effect_field.sprintf($EFFECTFIELDFORMAT,$effect_field->name,$effect_good_variable,$effect_good_variable/$effect_field->total_variable*100,$all_variable_field);
			}
		}
		//table2的内容
		$all_variable_list_field="";
		foreach($this->quiz->effect_field_list as $effect_field)
		{
			if ($effect_field->score!=-1)
			{				
				foreach($effect_field->key_field_list as $key_field)
				{
					if ($key_field->score!=-1 && $key_field->is_good==1)
					foreach($key_field->key_variable_list as $key_variable)
					{
						if($key_variable->good_rate>0)
						{
							if ($all_variable_list_field!="")
								$all_variable_list_field=$all_variable_list_field.",";
							$all_variable_list_field=$all_variable_list_field.sprintf($KEYVARIABLELISTFORMAT,$key_variable->question,$key_variable->score,$key_variable->good_rate);
						}
					}
				}
			}
		}
		$result=sprintf($RESULTFORMAT,$all_effect_field,$total_good_variable,$total_good_variable/$this->quiz->total_variable*100,$all_variable_list_field);
		$dir='../statistics/'.$this->quiz_id;
		$flag=create_folders($dir); 
		$handle = fopen($dir.'/table13.json', "w");
		fwrite($handle,$result);
		fclose($handle);			

	}
	public function table14_CONCLUDE()
	{
		$RESULTFORMAT='
		{
			"content":[
				{
					"title":"领域",
					"content":["%s","%s","%s"]
				},
				{
					"title":"关键域",
					"content":["%s","%s","%s"]
				},
				{
					"title":"关键变量",
					"content":["%s","%s","%s"]
				}
			],
			"level":"%s"
		}';
		$total_effect_field=0;
		$total_key_field=0;
		$total_key_variable=0;
		$total_good_effect_field=0;
		$total_good_key_field=0;
		$total_good_key_variable=0;
		$total_short_effect_field=0;
		$total_short_key_field=0;
		$total_short_key_variable=0;
		foreach($this->quiz->effect_field_list as $effect_field)
		{
			if ($effect_field->score!=-1)
			{				
				$total_effect_field++;
				$good_flag=0;
				$short_flag=0;
				foreach($effect_field->key_field_list as $key_field)
				{
					if ($key_field->score!=-1)
					{
						$total_key_field++;
						if ($key_field->is_short==1)
						{
							$total_short_key_field++;
							$short_flag=1;
						}
						if ($key_field->is_good==1)
						{
							$total_good_key_field++;
							$good_flag=1;
						}
						foreach($key_field->key_variable_list as $key_variable)
						{
							if ($key_variable->score!=-1)
							{
								$total_key_variable++;
								if($key_variable->good_rate>0)
								{
									$total_good_key_variable++;
								}
								if ($key_variable->promote_space>0)
								{
									$total_short_key_variable++;
								}
							}
						}
					}
				}
				if ($good_flag==1) $total_good_effect_field++;
				if ($short_flag==1) $total_short_effect_field++;
			}
		}
		$result=sprintf($RESULTFORMAT,$total_effect_field,$total_short_effect_field,$total_good_effect_field,$total_key_field,$total_short_key_field,$total_good_key_field,$total_key_variable,$total_short_key_variable,$total_good_key_variable,$this->mature_level-1);
		$dir='../statistics/'.$this->quiz_id;
		$flag=create_folders($dir); 
		$handle = fopen($dir.'/table14.json', "w");
		fwrite($handle,$result);
		fclose($handle);	
	}
	public function table_all($quiz_id,$config_id=1)
	{
		$this->quiz=new Quiz();
		$this->quiz->init_quiz($quiz_id);
		$this->quiz_id=$quiz_id;
		$this->init_key_goal_list($quiz_id,$config_id);
		$this->table1_CVs();
		$this->table2_KVs();
		$this->table3_KDs();	
		$this->table4_KDs();	
		$this->table5_LDs();	
		$this->table6_KTs();
		$this->table7_ACs();
		$this->table8_SEs();
		$this->table9_SAs();	
		$this->table10_APs();	
		$this->table11_GAs();
		$this->table12_GAEs();
		$this->table13_GANs();
		$this->table14_CONCLUDE();
		
	}
}


?>