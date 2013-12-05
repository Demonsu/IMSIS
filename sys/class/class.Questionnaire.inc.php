<?php

class Questionnaire extends DB_Connect {


	public function __construct(){
		parent::__construct();
	}
	public function fecth_pale_questionnaire()//获取空白问卷，供用户选择关键域
	{
		$return_value="";
		$EFFECTFORMAT='<a class="list-group-item active"><input type="checkbox" id="%s" value="%s">%s</a>';
	    $KEYFORMAT='<a class="list-group-item"><input type="checkbox" id="%s" value="%s"> %s</a>';
		//获取所有的作用域
		$sql="SELECT * FROM effect_field";
		$effect_select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
		$effect_index=1;
		while ($effect_result=mysql_fetch_assoc($effect_select))
		{
			$return_value=$return_value.sprintf($EFFECTFORMAT,"box".$effect_index,$effect_result["id"],$effect_result["name"]);
			$key_index=1;
			$sql="SELECT * FROM key_field WHERE effect_field_id='".$effect_result["id"]."' AND available='1'";
			$key_select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
			while ($key_result=mysql_fetch_assoc($key_select))
			{
				$return_value=$return_value.sprintf($KEYFORMAT,"box".$effect_index.$key_index,$key_result["id"],$key_result["name"]);
				$key_index++;
			}
			$effect_index++;
		}
		return $return_value;
	}
	public function create_questionnaire($user_id,$is_public,$remark,$key_field_list)
	{
		//首先创建一个问卷
		$currentdate=date("Y-m-d H:i:s",time());
		$hash=rand(1,1000);
		$sql="INSERT INTO questionnaire
		(
			user_id,state,is_public,remark,create_time,hash
		)VALUES
		(
			'".$user_id."','0','".$is_public."','".$remark."','".$currentdate."','".$hash."'
		)
		";
		if (!mysql_query($sql,$this->root_conn))
		{
		  die('Error: ' . mysql_error());
		}
		//获取这个问卷的id
		$sql="SELECT id FROM questionnaire WHERE hash='".$hash."' and create_time='".$currentdate."'";
		$select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
		$result=mysql_fetch_assoc($select);
		$id=$result["id"];
		//添加问卷内容
		if ($is_public==0)//个人评测
		{
			foreach($key_field_list as $key_field)
			{
				if ($key_field!="")
				{
					$sql="INSERT INTO questionnaire_content
					(
						key_field_id,questionnaire_id,state,user_id
					)
					VALUES
					(
						'".$key_field."','".$id."','0','".$user_id."'
					)
					";
					if (!mysql_query($sql,$this->root_conn))
					{
					  die('Error: ' . mysql_error());
					}
				}
			} 
		}else if ($is_public==1)//单位评测
		{
			//首先获得所有可用的关键域
			$sql="SELECT * FROM key_field WHERE available='1'";
			$select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
			//生成单位问卷的内容
			while ($result=mysql_fetch_assoc($select))
			{
				$sql="INSERT INTO questionnaire_content
				(
					key_field_id,questionnaire_id,state
				)
				VALUES
				(
					'".$result["id"]."','".$id."','0'
				)
				";
				if (!mysql_query($sql,$this->root_conn))
				{
				  die('Error: ' . mysql_error());
				}
			}
			
		}
		return $id;//创建成功
		
	}
	public function check_department_questionnaire($user_id)
	{
		
		$sql="SELECT * FROM user WHERE id='".$user_id."'";
		$select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
		$result=mysql_fetch_assoc($select);
		$sql="SELECT * FROM questionnaire q, user u WHERE 
				u.province='".$result["province"]."'  AND
				u.city='".$result["city"]."' AND
				u.department='".$result["department"]."' AND
				u.id=q.user_id AND
				q.is_public='1' AND
				q.state='0'
		";
		$select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
		$num=mysql_num_rows($select);
		if ($num>0)
			return 1;
		else
		 	return 0;
	}
	public function fetch_user_questionnaire_list($user_id,$state)//获取用户的测评列表
	{
		$NCFORMAT='<a class="list-group-item" id="%s"><span class="badge" onclick="deleteitem()">删除</span><span class="badge" onclick="continue(this)">继续填写</span>%s</a>';
		$HCFORMAT='<a class="list-group-item" id="%s"><span class="badge" onclick="deleteitem()">删除</span><span class="badge" onclick="checkresult(this)">查看结果</span>%s</a>';
		$return_value="";
		$sql="SELECT * FROM questionnaire WHERE user_id='".$user_id."' AND state='".$state."' ";
		$select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
		while ($result=mysql_fetch_assoc($select))
		{
			if ($state==0)
			{
				$return_value=$return_value.sprintf($NCFORMAT,$result["id"],$result["create_time"]." ".$result["remark"]);
			}else
			{
				$return_value=$return_value.sprintf($HCFORMAT,$result["id"],$result["create_time"]." ".$result["remark"]);
			}
		}
		return $return_value;
	}
	public function fetch_department_questionnaire_list($user_id)
	{
		$DPNCFORMAT='<a class="list-group-item" id="%s"><span class="badge" onclick="d_continue(this)">继续填写</span>%s</a>';
		$DPHCFORMAT='<a class="list-group-item" id="%s"><span class="badge" onclick="checkresult(this)">查看结果</span>%s</a>';	
		$return_value="";
		//首先获取用户的个人信息
		$sql="SELECT * FROM user WHERE id='".$user_id."'";
		$select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
		$user_info=mysql_fetch_assoc($select);	
		//查找单位的问卷
		$sql="SELECT * FROM questionnaire q, user u WHERE
			u.province='".$user_info["province"]."' AND
			u.city='".$user_info["city"]."' AND
			u.department='".$user_info["department"]."' AND
			q.user_id=u.id AND
			q.is_public='1'
		";
		$select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
		while ($result=mysql_fetch_assoc($select))
		{
			if ($result["state"]==0)
			{
				$return_value=$return_value.sprintf($DPNCFORMAT,$result["id"],$result["create_time"]." ".$result["remark"]);
			}else
			{
				$return_value=$return_value.sprintf($DPHCFORMAT,$result["id"],$result["create_time"]." ".$result["remark"]);
			}
		}
		return $return_value;
	}
}

?>