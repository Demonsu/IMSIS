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
			return 1;//创建成功
		}
		
	}
}

?>