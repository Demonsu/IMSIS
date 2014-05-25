<?php
function strlen_utf8($str) 
{  
	$i = 0;  
	$count = 0;  
	$len = strlen ($str);  
	while ($i < $len) 
	{  
		$chr = ord ($str[$i]); 
		$count++;
		//echo $count."</br>";
		$i++;  
		if($i >= $len) break;  
		if($chr & 0x80) 
		{  
			$chr <<= 1;  
			while ($chr & 0x80) 
			{  
				$i++;  
				$chr <<= 1;  
			}  
		}  
	}  
	return $count;  
} 
function titlelen_utf8($str) 
{  
	$i = 0;  
	$len_str=0;
	$count = 0;  
	$len = strlen ($str);  
	while ($i < $len) 
	{  
		$chr = ord ($str[$i]); 
		if (ctype_alnum($chr))
		{
			$len_str++;
		} else
		{
			$len_str=$len_str+2;
		}
		//if ($len_str<26)
		//echo $count."</br>";
		$i++;  
		if($i >= $len) break;  
		if($chr & 0x80) 
		{  
			$chr <<= 1;  
			while ($chr & 0x80) 
			{  
				$i++;  
				$chr <<= 1;  
			}  
		}  
	}  
	//echo $len_str."</br>";
	return $len_str;  
} 
function cutlen_utf8($str) 
{  
	$i = 0;  
	$len_str=0;
	$count = 0;  
	$len = strlen ($str);  
	while ($i < $len) 
	{  
		$chr = ord ($str[$i]); 
		if (ctype_alnum($chr))
		{
			$len_str++;
		} else
		{
			$len_str=$len_str+2;
		}
		if ($len_str<50)
			$count++;
		//echo $count."</br>";
		$i++;  
		if($i >= $len) break;  
		if($chr & 0x80) 
		{  
			$chr <<= 1;  
			while ($chr & 0x80) 
			{  
				$i++;  
				$chr <<= 1;  
			}  
		}  
	}  
	//echo $count."</br>";
	return $count;  
} 
class Admin extends DB_Connect {


	public function __construct(){
		parent::__construct();
	}
	public function fetch_effect_field_list()
	{
		$return_value="";
		$EFFECTFIELDFORMAT='	
			<li class="list-group-item" id="%s">%s
				<label class="label label-warning" onclick="delete_effect_field(this)">删除</label>
				<label class="label label-info" onclick="show_hide_effect_field(this)">%s</label>
				<label class="label label-warning" onclick="modify_effect_field(this)">修改</label>
			</li>	
		';
		$ADDEFFECTFIELDFORMAT='
			<li class="list-group-item text-center" onclick="add_effect_field()"><span class="glyphicon glyphicon-plus"></span></li>
		';
		$sql="SELECT * FROM effect_field";
		$select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
		while($effect_field_info=mysql_fetch_assoc($select))
		{
			$available="隐藏";
			if ($effect_field_info["available"]==0)
				$available="显示";
			$return_value=$return_value.sprintf($EFFECTFIELDFORMAT,$effect_field_info["id"],$effect_field_info["name"],$available);
		}
		$return_value=$return_value.$ADDEFFECTFIELDFORMAT;
		return $return_value;		

	}
	public function delete_effect_field($effect_field_id)
	{
		$sql="DELETE FROM effect_field WHERE id='".$effect_field_id."'";
		if (!mysql_query($sql,$this->root_conn))
		{
		  die('Error: ' . mysql_error());
		}	
		$sql="SELECT * FROM key_field WHERE effect_field_id='".$effect_field_id."'";
		$select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
		while ($key_field=mysql_fetch_assoc($select))
		{
			$sql="DELETE FROM key_variable WHERE key_field_id='".$key_field["id"]."'";
			if (!mysql_query($sql,$this->root_conn))
			{
			  die('Error: ' . mysql_error());
			}	
			$sql="DELETE FROM key_field WHERE id='".$key_field["id"]."'";
			if (!mysql_query($sql,$this->root_conn))
			{
			  die('Error: ' . mysql_error());
			}
		}
		return 1;
	}
	public function modify_effect_field($add,$effect_field_id,$name)
	{
		
		$sql="UPDATE effect_field SET name='".$name."' WHERE id='".$effect_field_id."'";
		//首先判断添加作用键域是否已经存在了
		if ($add==1)
		{
			$sql="SELECT * FROM effect_field WHERE name='".$name."'";
			$select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
			$num=mysql_num_rows($select);
			if ($num>0)
				return "该作用域已经存在";
		}		
		if ($add==1)
			$sql="INSERT INTO effect_field
			(name,available)
			VALUES
			('".$name."','1')
			";
		
		if (!mysql_query($sql,$this->root_conn))
		{
		  die('Error: ' . mysql_error());
		}	
		return 1;		
	}
	public function show_or_hide_effect_field($effect_field_id,$available)
	{
		$sql="UPDATE effect_field SET available='".$available."' WHERE id='".$effect_field_id."'";
		if (!mysql_query($sql,$this->root_conn))
		{
		  die('Error: ' . mysql_error());
		}	
		return 1;	
	}
	public function fetch_key_field_list($effect_field_id)
	{
		$return_value="";
		$EFFECTFIELDFORMAT='	
			<li class="list-group-item" id="%s">%s
				<label class="label label-warning" onclick="delete_key_field(this)">删除</label>
				<label class="label label-info" onclick="show_hide_key_field(this)">%s</label>
				<label class="label label-warning" onclick="modify_key_field(this)">修改</label>
			</li>	
		';
		$ADDEFFECTFIELDFORMAT='
			<li class="list-group-item text-center" onclick="add_key_field()"><span class="glyphicon glyphicon-plus"></span></li>
		';
		$sql="SELECT * FROM key_field WHERE effect_field_id='".$effect_field_id."'";
		$select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
		while($key_field_info=mysql_fetch_assoc($select))
		{
			$available="隐藏";
			if ($key_field_info["available"]==0)
				$available="显示";
			$return_value=$return_value.sprintf($EFFECTFIELDFORMAT,$key_field_info["id"],$key_field_info["name"],$available);
		}
		$return_value=$return_value.$ADDEFFECTFIELDFORMAT;
		return $return_value;			
	}
	public function delete_key_field($key_field_id)
	{
		$sql="DELETE FROM key_field WHERE id='".$key_field_id."'";
		if (!mysql_query($sql,$this->root_conn))
		{
		  die('Error: ' . mysql_error());
		}	
		$sql="DELETE FROM key_field_goal WHERE key_field_id='".$key_field_id."'";
		if (!mysql_query($sql,$this->root_conn))
		{
		  die('Error: ' . mysql_error());
		}
		$sql="DELETE FROM key_variable WHERE key_field_id='".$key_field_id."'";
		if (!mysql_query($sql,$this->root_conn))
		{
		  die('Error: ' . mysql_error());
		}
		return 1;		
	}
	public function modify_key_field($add,$key_field_id,$name,$effect_field_id)
	{
		$sql="UPDATE key_field SET name='".$name."' WHERE id='".$key_field_id."'";
		//首先判断添加的关键域是否已经存在了
		if ($add==1)
		{
			$sql="SELECT * FROM key_field WHERE name='".$name."'";
			$select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
			$num=mysql_num_rows($select);
			if ($num>0)
				return "该关键域已经存在";
		}
		//添加关键域
		if ($add==1)
			$sql="INSERT INTO key_field (name,available,effect_field_id)
			VALUES
			('".$name."','1','".$effect_field_id."')
			";
		if (!mysql_query($sql,$this->root_conn))
		{
		  die('Error: ' . mysql_error());
		}	
		//设置关键域的目标
		if ($add==1)
		{
			$sql="SELECT * FROM key_field WHERE name='".$name."'";
			$select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
			$key_field=mysql_fetch_assoc($select);
			$sql="INSERT INTO key_field_goal(key_field_id)VALUES('".$key_field["id"]."')";
			if (!mysql_query($sql,$this->root_conn))
			{
			  die('Error: ' . mysql_error());
			}
		}
		return 1;				
	}
	public function show_or_hide_key_field($key_field_id,$available)
	{
		$sql="UPDATE key_field SET available='".$available."' WHERE id='".$key_field_id."'";
		if (!mysql_query($sql,$this->root_conn))
		{
		  die('Error: ' . mysql_error());
		}	
		return 1;	
	}
	public function fetch_key_variable_list($key_field_id)
	{
		$return_value="";
		$EFFECTFIELDFORMAT='	
			<li class="list-group-item" id="%s">%s
				<label class="label label-warning" onclick="delete_key_variable(this)">删除</label>
				<label class="label label-info" onclick="show_hide_key_variable(this)">%s</label>
				<label class="label label-warning" onclick="modify_key_variable(this)">修改</label>
			</li>	
		';
		$ADDEFFECTFIELDFORMAT='
			<li class="list-group-item text-center" onclick="add_key_variable()"><span class="glyphicon glyphicon-plus"></span></li>
		';
		$sql="SELECT * FROM key_variable WHERE key_field_id='".$key_field_id."'";
		$select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
		while($key_variable_info=mysql_fetch_assoc($select))
		{
			$available="隐藏";
			if ($key_variable_info["available"]==0)
				$available="显示";
			$temp=explode('（',$key_variable_info["question"]);
			$key_variable_info["question"]=$temp[0];
			$return_value=$return_value.sprintf($EFFECTFIELDFORMAT,$key_variable_info["id"],$key_variable_info["question"],$available);
		}
		$return_value=$return_value.$ADDEFFECTFIELDFORMAT;
		return $return_value;			
	}
	public function delete_key_variable($key_variable_id)
	{
		$sql="DELETE FROM key_variable WHERE id='".$key_variable_id."'";
		if (!mysql_query($sql,$this->root_conn))
		{
		  die('Error: ' . mysql_error());
		}	
		return 1;			
	}
	public function fetch_key_variable_detail($key_variable_id)
	{
		$RESULTFORMAT='
		{
			"question":"%s",
			"answer_a":"%s",
			"answer_b":"%s",
			"answer_c":"%s",
			"answer_d":"%s",
			"answer_e":"%s"
		}';
		$sql="SELECT * FROM key_variable WHERE id='".$key_variable_id."'";
		$select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);	
		$key_variable_info=mysql_fetch_assoc($select);
		$result=sprintf($RESULTFORMAT,$key_variable_info["question"],$key_variable_info["answer_a"],$key_variable_info["answer_b"],$key_variable_info["answer_c"],$key_variable_info["answer_d"],$key_variable_info["answer_e"]);
		return $result;
	}
	public function modify_key_variable($add,$key_variable_id,$key_field_id,$question,$answer_a,$answer_b,$answer_c,$answer_d,$answer_e)
	{
		$sql="UPDATE key_variable SET question='".$question."',answer_a='".$answer_a."',answer_b='".$answer_b."',answer_c='".$answer_c."',answer_d='".$answer_d."',answer_e='".$answer_e."' WHERE id='".$key_variable_id."'";
		if ($add==1)
		{
			$sql="INSERT INTO key_variable
			(question,answer_a,answer_b,answer_c,answer_d,answer_e,available,key_field_id)
			VALUES
			('".$question."','".$answer_a."','".$answer_b."','".$answer_c."','".$answer_d."','".$answer_e."','1','".$key_field_id."')
			";
		}
		if (!mysql_query($sql,$this->root_conn))
		{
		  die('Error: ' . mysql_error());
		}	
		return 1;
	}
	public function show_or_hide_key_variable($key_variable_id,$available)
	{
		$sql="UPDATE key_variable SET available='".$available."' WHERE id='".$key_variable_id."'";
		if (!mysql_query($sql,$this->root_conn))
		{
		  die('Error: ' . mysql_error());
		}	
		return 1;	
	}
	public function fetch_effect_field_select_list()
	{
		$return_value="";
		$EFFECTLISTFORMAT='<option value="%s">%s</option>';
		$sql="SELECT * FROM effect_field";
		$select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
		while($effect_field_info=mysql_fetch_assoc($select))
		{
			$return_value=$return_value.sprintf($EFFECTLISTFORMAT,$effect_field_info["id"],$effect_field_info["name"]);
		}		
		return $return_value;
	}	
	public function fetch_key_field_select_list($effect_field_id)
	{
		$return_value="";
		$EFFECTLISTFORMAT='<option value="%s">%s</option>';
		$sql="SELECT * FROM key_field WHERE effect_field_id='".$effect_field_id."'";
		$select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
		while($key_field_info=mysql_fetch_assoc($select))
		{
			$return_value=$return_value.sprintf($EFFECTLISTFORMAT,$key_field_info["id"],$key_field_info["name"]);
		}		
		return $return_value;
	}
	public function fetch_goal_table()
	{
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
		$sql="SELECT * FROM effect_field";
		$effect_select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
		$all_effect_field="";
		while ($effect_field=mysql_fetch_assoc($effect_select))
		{
			$sql="SELECT * FROM key_field WHERE effect_field_id='".$effect_field["id"]."'";
			$key_select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
			$all_key_field="";
			while ($key_field=mysql_fetch_assoc($key_select))
			{	
				$sql="SELECT * FROM key_field_goal WHERE key_field_id='".$key_field["id"]."' AND config_id='1'";
				$select=mysql_query($sql,$this->root_conn) or trigger_error(mysql_error(),E_USER_ERROR);
				$result=mysql_fetch_assoc($select);
				if ($all_key_field!="")
					$all_key_field=$all_key_field.",";
				$temp=explode("（",$key_field["name"]);
				$key_field["name"]=$temp[0];
				$all_key_field=$all_key_field.sprintf($KEYFIELDFORMAT,$key_field["name"],$key_field["id"],$result["goal_1"],$result["goal_2"],$result["goal_3"],$result["goal_4"],$result["goal_5"]);	
			}
			if ($all_effect_field!="")
				$all_effect_field=$all_effect_field.",";
			$all_effect_field=$all_effect_field.sprintf($EFFECTFIELDFORMAT,$effect_field["name"],$all_key_field);
		}	
		$result=sprintf($RESULTFORMAT,$all_effect_field);
		return $result;
	}
	public function set_goal($key_field_id,$mature_level,$mature_value)
	{
		$sql="UPDATE key_field_goal SET goal_".$mature_level."='".$mature_value."' WHERE key_field_id='".$key_field_id."' AND config_id='1'";
		if (!mysql_query($sql,$this->root_conn))
		{
		  die('Error: ' . mysql_error());
		}
		return 1;	
		
	}
	public function search_quiz($province,$city,$department,$start_time,$end_time,$quiz_type,$quiz_state)
	{
		$SQLADDFORMAT="%s%s";
		$sql="SELECT q.* FROM questionnaire q, user u WHERE q.user_id=u.id ";
		if ($province!=0)
		{
			$sql=sprintf($SQLADDFORMAT,$sql,"AND u.province='".$province."' ");
		}
		if ($city!=0)
		{
			$sql=sprintf($SQLADDFORMAT,$sql,"AND u.city='".$city."' ");
		}
		if ($department!=0)
		{
			$sql=sprintf($SQLADDFORMAT,$sql,"AND u.department='".$department."' ");
		}
		if ($quiz_type!=0)
		{
			$is_public=0;
			if ($quiz_type==1)
				$is_public=1;
			$sql=sprintf($SQLADDFORMAT,$sql,"AND q.is_public='".$is_public."'");
		}
		if ($quiz_state!=0)
		{
			$state=0;
			if ($quiz_state==1)
				$sql=sprintf($SQLADDFORMAT,$sql,"AND q.state!='2' ");
			else
				$sql=sprintf($SQLADDFORMAT,$sql,"AND q.state='2' ");
		}
		$sql=sprintf($SQLADDFORMAT,$sql,"AND q.create_time>='".$start_time."' AND q.create_time<='".$end_time."' ");
		//echo $sql."<br>";
		$DPNCFORMAT='<a class="list-group-item" id="%s"><span class="badge" onclick="deleteitem(this,3)">删除</span>%s</a>';
		$DPHCFORMAT='<a class="list-group-item" id="%s"><span class="badge" onclick="deleteitem(this,3)">删除</span><span class="badge" onclick="checkresult(this)">查看结果</span><span class="badge" onclick="reformresult(this)">重新生成结果</span>%s</a>';	
		$select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
		$return_value="";
		while ($result=mysql_fetch_assoc($select))
		{
			if ($result["state"]!='2')
			{
				$return_value=$return_value.sprintf($DPNCFORMAT,$result["id"],$result["create_time"]." ".$result["remark"]." ".$result["user_id"]);
			}else
			{
				$return_value=$return_value.sprintf($DPHCFORMAT,$result["id"],$result["create_time"]." ".$result["remark"]." ".$result["user_id"]);
			}
		}
		return $return_value;		
	}
	public function search_user($province,$city,$department,$title)
	{
		$USERFORMAT='
			<li href="#" class="list-group-item" id="user-%s">
				<div class="input-group">
				  <span class="input-group-addon">%s</span>
				  <span class="input-group-addon">%s</span>
				  <span class="input-group-addon">%s</span>
				  <span class="input-group-addon">%s</span>
				  <span class="input-group-addon">
					<button class="btn btn-default" type="button" onclick="user_data(this)">更多信息...</button>
					<button class="btn btn-default" type="button" id="quiz-list%s">问卷列表</button>
				  </span>
				</div>

				%s
			</li>';
		$QUIZFORMAT='
			<div class="list-group" id="quiz-list-%s" style="margin-bottom:0">
				%s
			</div>		
			<script>
				$(function(){
					if($("#quiz-list-%s").html().length < 10)
					{
						$("#quiz-list%s").attr("disabled",true);
					}
					else{
						$("#quiz-list%s").click(function(){
							
								$("#quiz-list-%s").toggle();
						});
						$("#quiz-list-%s").hide();
					}
				});
			</script> 
		';
		$QUIZUNDOFORMAT='
			<a href="#" class="list-group-item" id="%s"><span class="badge" onclick="deleteitem(this,3)">删除</span>%s</a>
		';
		$QUIZDONEFORMAT='
			<a href="#" class="list-group-item" id="%s"><span class="badge" onclick="deleteitem(this,3)">删除</span><span class="badge" onclick="checkresult(this)">查看结果</span><span class="badge" onclick="reformresult(this)">重新生成结果</span>%s</a>
		';
		$SQLADDFORMAT="%s%s";
		$sql="SELECT * FROM user WHERE permission='0' ";
		if ($province!=0)
		{
			$sql=sprintf($SQLADDFORMAT,$sql,"AND province='".$province."' ");
		}
		if ($city!=0)
		{
			$sql=sprintf($SQLADDFORMAT,$sql,"AND city='".$city."' ");
		}
		if ($department!=0)
		{
			$sql=sprintf($SQLADDFORMAT,$sql,"AND department='".$department."' ");
		}
		if ($title!=0)
		{
			$sql=sprintf($SQLADDFORMAT,$sql,"AND title='".$title."' ");
		}
		//echo $sql."<br>";
		$user_select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
		$user_list="";
		while ($user_info=mysql_fetch_assoc($user_select))
		{
			$sql="SELECT * FROM questionnaire WHERE user_id='".$user_info["id"]."' AND is_public='0' ";
			$quiz_select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
			$all_quiz="";
			while ($quiz_info=mysql_fetch_assoc($quiz_select))
			{
				if ($quiz_info["state"]==2)
				{
					$all_quiz=$all_quiz.sprintf($QUIZDONEFORMAT,$quiz_info["id"],$quiz_info["create_time"]." ".$quiz_info["remark"]." ".$quiz_info["user_id"]);
				}else
					$all_quiz=$all_quiz.sprintf($QUIZUNDOFORMAT,$quiz_info["id"],$quiz_info["create_time"]." ".$quiz_info["remark"]." ".$quiz_info["user_id"]);
			}
			$all_quiz=sprintf($QUIZFORMAT,$user_info["id"],$all_quiz,$user_info["id"],$user_info["id"],$user_info["id"],$user_info["id"],$user_info["id"]);
			$user_list=$user_list.sprintf($USERFORMAT,$user_info["id"],$user_info["id"],$user_info["password"],$user_info["oncharge"],$user_info["speciality"],$user_info["id"],$all_quiz);
		}
		return $user_list;
		
		
	}
	public function fetch_user_detail_info($user_id)
	{
		$RESULTFORMAT='
		{
			"id":"%s",
			"department":"%s",
			"title":"%s",
			"oncharge":"%s",
			"spaciality":"%s",
			"age":"%s",
			"gender":"%s",
			"edu":"%s",
			"position":"%s",
			"time":"%s",
			"email":"%s"
		}';
		//首先获取个人信息
		$sql="SELECT * FROM user WHERE id='".$user_id."'";
		$user_select=mysql_query($sql, $this->root_conn) or trigger_error(mysql_error(),E_USER_ERROR);
		$user_info=mysql_fetch_assoc($user_select);
		//根据个人信息中的省份，城市码获取所在省市,部门
		$department="";
		if ($user_info["province"]!=0)
		{
			$sql="SELECT * FROM province WHERE code='".$user_info["province"]."'";	
			$province_select=mysql_query($sql, $this->root_conn) or trigger_error(mysql_error(),E_USER_ERROR);
			$province_info=mysql_fetch_assoc($province_select);
			$department=$province_info["name"];
		}
		if ($user_info["city"]!=0)
		{
			$sql="SELECT * FROM city WHERE code='".$user_info["city"]."'";	
			$city_select=mysql_query($sql, $this->root_conn) or trigger_error(mysql_error(),E_USER_ERROR);
			$city_info=mysql_fetch_assoc($city_select);
			$department=$department." ".$city_info["name"];			
		}
		$department=$department." ".$user_info["department"];
		return sprintf($RESULTFORMAT,$user_id,$department,$user_info["title"],$user_info["oncharge"],$user_info["speciality"],$user_info["age"],$user_info["gender"],$user_info["education"],$user_info["position"],$user_info["seniority"],$user_info["email"]);
					
	}
	public function fetch_discovery_list()//获取分享的管理列表
	{
		$DISCOVERYFORMAT='
				<li class="list-group-item" id="%s">%s
				<label class="label label-primary" onclick="share_settop(this)">置顶</label>
				<label class="label label-info" onclick="share_moveup(this)"><span class="glyphicon glyphicon-chevron-up"></span></label>
				<label class="label label-info" onclick="share_movedown(this)"><span class="glyphicon glyphicon-chevron-down"></span></label>
				<label class="label label-warning" onclick="share_delete(this)">删除</label>
				<label class="label label-warning" onclick="share_edit(this)">修改</label>
			 	</li>
			 	
			  ';
		$return_value="";
		$sql="SELECT * FROM discovery_share ORDER BY sort_value DESC";
		$select=mysql_query($sql,$this->root_conn) or trigger_error(mysql_error(),E_USER_ERROR);
		while ($discovery_info=mysql_fetch_assoc($select))
		{
			if (titlelen_utf8($discovery_info["title"])>50)
			{
				$discovery_info["title"]=mb_substr($discovery_info["title"],0,cutlen_utf8($discovery_info["title"]),'utf-8')."...";
			}
			$return_value=$return_value.sprintf($DISCOVERYFORMAT,$discovery_info["id"],$discovery_info["title"]);
		}
		return $return_value.'<li class="list-group-item text-center" onclick="share_add()"><span class="glyphicon glyphicon-plus"></span></li>';
	}
	public function fetch_discovery_info($id)//获取分享的详细信息
	{
		//return "fuck";
		$DISCOVERYDETAIL='		
		{
			"title":"%s",
			"content":"%s",
			"type":"%s",
			"url":"%s",
			"img_url":"%s"
		}';
		$return_value="";
		$sql="SELECT * FROM discovery_share WHERE id='".$id."'";
		$select=mysql_query($sql,$this->root_conn) or trigger_error(mysql_error(),E_USER_ERROR);
		$discovery_info=mysql_fetch_assoc($select);
		//htmlspecialchars_decode($comment_row['comment'],ENT_QUOTES)
		$return_value=sprintf($DISCOVERYDETAIL,$discovery_info["title"],$discovery_info["content"],$discovery_info["type"],$discovery_info["url"],$discovery_info["img_url"]);
		return $return_value;
	}
	public function add_discovery_share($title,$type,$content,$time,$url,$img_url)//添加一个分享
	{
		$sort_value=0;
		$sql="SELECT MAX(sort_value) AS cur_value FROM discovery_share";
		$select=mysql_query($sql,$this->root_conn) or trigger_error(mysql_error(),E_USER_ERROR);
		$num=mysql_num_rows($select);
		if ($num!=0)
		{
			$result=mysql_fetch_assoc($select);
			$sort_value=$result["cur_value"]+1;
		}
		$sql="INSERT INTO discovery_share
		(
			title,type,content,time,url,sort_value,img_url
		)
		VALUES
		(
			'".$title."','".$type."','".$content."','".$time."','".$url."','".$sort_value."','".$img_url."'
		)";
		if (!mysql_query($sql,$this->root_conn))
		{
		  die('Error: ' . mysql_error());
		}
		return 1;
	}
	public function modify_discovery_share($id,$title,$type,$content,$time,$url,$img_url)//修改一个分享
	{
		$sql="UPDATE discovery_share SET title='".$title."',type='".$type."',content='".$content."',time='".$time."',url='".$url."',img_url='".$img_url."' WHERE id='".$id."'";
		if (!mysql_query($sql,$this->root_conn))
		{
		  die('Error: ' . mysql_error());
		}
		return 1;		
	}
	public function delete_discovery_share($id)//删除一个分享
	{
		$sql="DELETE FROM discovery_share WHERE id='".$id."'";
		if (!mysql_query($sql,$this->root_conn))
		{
		  die('Error: ' . mysql_error());
		}		
		return 1;
	}
	public function change_discovery_sort($id,$up)//改变分享的位置
	{
		//首先获取两个分享的sortvalue
		$sql="SELECT * FROM discovery_share WHERE id='".$id."'";
		$select=mysql_query($sql,$this->root_conn) or trigger_error(mysql_error(),E_USER_ERROR);
		$discovery_info1=mysql_fetch_assoc($select);
		$sort_value1=$discovery_info1 ["sort_value"];
		if ($up==0)
		{
			$sql="SELECT * FROM discovery_share WHERE sort_value>'".$sort_value1."' ORDER BY sort_value ASC LIMIT 1";
		}else
		{
			$sql="SELECT * FROM discovery_share WHERE sort_value<'".$sort_value1."' ORDER BY sort_value DESC LIMIT 1";
		}
		//$sql="SELECT * FROM discovery_share WHERE id='".$id2."'";
		$select=mysql_query($sql,$this->root_conn) or trigger_error(mysql_error(),E_USER_ERROR);
		$num=mysql_num_rows($select);
		if ($num==0)
			return 1;
		$discovery_info2=mysql_fetch_assoc($select);	
		$sort_value2=$discovery_info2["sort_value"];	
		//接着互换下
		$sql="UPDATE discovery_share SET sort_value='".$sort_value2."' WHERE id='".$id."'";
		if (!mysql_query($sql,$this->root_conn))
		{
		  die('Error: ' . mysql_error());
		}	
		$sql="UPDATE discovery_share SET sort_value='".$sort_value1."' WHERE id='".$discovery_info2["id"]."'";
		if (!mysql_query($sql,$this->root_conn))
		{
		  die('Error: ' . mysql_error());
		}		
		return 1;
	}
	public function upbang_discovery_share($id)//置顶
	{
		$sort_value=0;
		$sql="SELECT MAX(sort_value) AS cur_value FROM discovery_share";
		$select=mysql_query($sql,$this->root_conn) or trigger_error(mysql_error(),E_USER_ERROR);
		$num=mysql_num_rows($select);
		if ($num!=0)
		{
			$result=mysql_fetch_assoc($select);
			$sort_value=$result["cur_value"]+1;
		}
		$sql="UPDATE discovery_share SET sort_value='".$sort_value."' WHERE id='".$id."'";
		//echo $sql;
		if (!mysql_query($sql,$this->root_conn))
		{
		  die('Error: ' . mysql_error());
		}		
		return 1;	
	}	
	public function fetch_news_list()//获取新闻的管理列表
	{
		$NEWSFORMAT='
			<li class="list-group-item" id="%s">%s
			<label class="label label-primary" onclick="news_settop(this)">置顶</label>
			<label class="label label-info" onclick="news_moveup(this)"><span class="glyphicon glyphicon-chevron-up"></span></label>
			<label class="label label-info" onclick="news_movedown(this)"><span class="glyphicon glyphicon-chevron-down"></span></label>
			<label class="label label-warning" onclick="news_delete(this)">删除</label>
			<label class="label label-warning" onclick="news_edit(this)">修改</label>
			</li>
			
	  	';
		$return_value="";
		$sql="SELECT * FROM news ORDER BY sort_value DESC";
		$select=mysql_query($sql,$this->root_conn) or trigger_error(mysql_error(),E_USER_ERROR);
		while ($news_info=mysql_fetch_assoc($select))
		{
			if (titlelen_utf8($news_info["title"])>50)
			{
				$news_info["title"]=mb_substr($news_info["title"],0,cutlen_utf8($news_info["title"]),'utf-8')."...";
			}
			$return_value=$return_value.sprintf($NEWSFORMAT,$news_info["id"],$news_info["title"]);
		}
		return $return_value.'<li class="list-group-item text-center" onclick="news_add()"><span class="glyphicon glyphicon-plus"></span></li>';
	}
	public function fetch_news_info($id)//获取新闻的详细信息
	{
		$NEWSDETAIL='
		{
			"title":"%s",
			"content":"%s",
			"img_url":"%s"
		}';
		$return_value="";
		$sql="SELECT * FROM news WHERE id='".$id."'";
		$select=mysql_query($sql,$this->root_conn) or trigger_error(mysql_error(),E_USER_ERROR);
		$news_info=mysql_fetch_assoc($select);
		//htmlspecialchars_decode($comment_row['comment'],ENT_QUOTES)
		$return_value=sprintf($NEWSDETAIL,$news_info["title"],$news_info["content"],$news_info["img_url"]);
		return $return_value;
	}	
	public function add_news($title,$content,$time,$img_url)//添加一个新闻
	{
		$sort_value=0;
		$sql="SELECT MAX(sort_value) AS cur_value FROM news";
		$select=mysql_query($sql,$this->root_conn) or trigger_error(mysql_error(),E_USER_ERROR);
		$num=mysql_num_rows($select);
		if ($num!=0)
		{
			$result=mysql_fetch_assoc($select);
			$sort_value=$result["cur_value"]+1;
		}		
		$sql="INSERT INTO news 
		(
			title,content,time,img_url,sort_value
		)VALUES
		(
			'".$title."','".$content."','".$time."','".$img_url."','".$sort_value."'
		)";
		if (!mysql_query($sql,$this->root_conn))
		{
		  die('Error: ' . mysql_error());
		}
		return 1;		
	}
	public function modify_news($id,$title,$content,$time,$img_url)//修改一条新闻
	{
		$sql="UPDATE news SET title='".$title."',content='".$content."',time='".$time."',img_url='".$img_url."' WHERE id='".$id."'";
		if (!mysql_query($sql,$this->root_conn))
		{
		  die('Error: ' . mysql_error());
		}
		return 1;			
	}
	public function delete_news($id)//删除一个新闻
	{
		$sql="DELETE FROM news WHERE id='".$id."'";
		if (!mysql_query($sql,$this->root_conn))
		{
		  die('Error: ' . mysql_error());
		}		
		return 1;
	}
	public function change_news_sort($id,$up)//改变新闻的位置
	{
		//首先获取两个新闻的sortvalue
		$sql="SELECT * FROM news WHERE id='".$id."'";
		$select=mysql_query($sql,$this->root_conn) or trigger_error(mysql_error(),E_USER_ERROR);
		$news_info1=mysql_fetch_assoc($select);
		$sort_value1=$news_info1["sort_value"];
		if ($up==0)
		{
			$sql="SELECT * FROM news WHERE sort_value>'".$sort_value1."' ORDER BY sort_value ASC LIMIT 1";	
		}else
		{
			$sql="SELECT * FROM news WHERE sort_value<'".$sort_value1."' ORDER BY sort_value DESC LIMIT 1";
		}
		//$sql="SELECT * FROM news WHERE id='".$id2."'";
		$select=mysql_query($sql,$this->root_conn) or trigger_error(mysql_error(),E_USER_ERROR);
		$num=mysql_num_rows($select);
		if ($num==0)
			return 1;
		$news_info2=mysql_fetch_assoc($select);	
		$sort_value2=$news_info2["sort_value"];	
		$sql="UPDATE news SET sort_value='".$sort_value2."' WHERE id='".$id."'";
		if (!mysql_query($sql,$this->root_conn))
		{
		  die('Error: ' . mysql_error());
		}	
		$sql="UPDATE news SET sort_value='".$sort_value1."' WHERE id='".$news_info2["id"]."'";
		if (!mysql_query($sql,$this->root_conn))
		{
		  die('Error: ' . mysql_error());
		}		
		return 1;
	}
	public function upbang_news($id)//置顶
	{
		$sort_value=0;
		$sql="SELECT MAX(sort_value) AS cur_value FROM news";
		$select=mysql_query($sql,$this->root_conn) or trigger_error(mysql_error(),E_USER_ERROR);
		$num=mysql_num_rows($select);
		if ($num!=0)
		{
			$result=mysql_fetch_assoc($select);
			$sort_value=$result["cur_value"]+1;
		}
		$sql="UPDATE news SET sort_value='".$sort_value."' WHERE  id='".$id."'";		
		if (!mysql_query($sql,$this->root_conn))
		{
		  die('Error: ' . mysql_error());
		}		
		return 1;		
	}	
}

?>