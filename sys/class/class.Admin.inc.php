<?php

class Admin extends DB_Connect {


	public function __construct(){
		parent::__construct();
	}
	public function fetch_effect_field_list()
	{
		$return_value="";
		$EFFECTFIELDFORMAT='	
			<li class="list-group-item" id="%s">%s
				<label class="label label-danger" onclick="delete_effect_field(this)">删除</label>
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
				<label class="label label-danger" onclick="delete_key_field(this)">删除</label>
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
				<label class="label label-danger" onclick="delete_key_variable(this)">删除</label>
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
				  <span class="input-group-addon">$s</span>
				  <span class="input-group-addon">%s</span>
				  <span class="input-group-addon">%s</span>
				</div>
				%s
			</li>';
		$QUIZFORMAT='
			<div class="list-group" id="quiz-list-%s" style="margin-bottom:0">
				%s
			</div>		 
		';
		$QUIZITEMFORMAT='
			<a href="#" class="list-group-item" id="quiz-%s"><span class="badge" onclick="deleteitem(this,3)">删除</span>%s</a>
		';
		$SQLADDFORMAT="%s%s";
		$sql="SELECT * FROM user WHERE 1=1 ";
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
		$user_select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
		while ($user_info=mysql_fetch_assoc($user_select))
		{
			$sql="SELECT * FROM questionnaire WHERE user_id='".$user_info["id"]."' AND is_public='0' ";
			$quiz_select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
			while ($qui)
		}
		
	}
}

?>