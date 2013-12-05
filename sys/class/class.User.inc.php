<?php

class User extends DB_Connect {


	public function __construct(){
		parent::__construct();
	}
	public function test()
	{
		echo "test";
		$sql="SELECT * from key_variable";
		$select=mysql_query($sql, $this->root_conn) or trigger_error(mysql_error(),E_USER_ERROR);
		$results=mysql_fetch_assoc($select);
		echo $results['question'];
		$num=mysql_num_rows($select);
		echo $num;
	}
	public function login($user_id,$password)
	{
		$sql="SELECT * FROM user WHERE id='".$user_id."' AND password='".$password."'";
		$select=mysql_query($sql,$this->root_conn) or trigger_error(mysql_error(),E_USER_ERROR);
		$num=mysql_num_rows($select);
		$result=mysql_fetch_assoc($select);
		if ($num>0)
		{
			$_SESSION["USERID"]=$user;
			$_SESSION["PERMISSION"]=$result["permisson"];
			return $result["permisson"];
		}else
		{
			return -1;
		}
	}
	public function check_exsit($user_id)//1 exsit 
	{
		$sql="SELECT * FROM user WHERE id='".$user_id."' ";
		$select=mysql_query($sql,$this->root_conn) or trigger_error(mysql_error(),E_USER_ERROR);
		$num=mysql_num_rows($select);
		return $num;
	}
	public function register($user_id,$password,$permission,$gender,$age,$province,$city,$area,$department,$title,$speciality,$position,$seniority,$education,$email,$register_time)
	{
		if (check_exsit($user_id)==1)
		{
			return 0;
		}
		$sql="INSER INTO user 
		(
			id,password,permission,gender,age,
			province,city,area,department,title,speciality,position,
			seniority,education,email,register_time
		)VALUES
		{
			'".$user_id."','".$password."','".$permission."','".$gender."','".$age."',
			'".$province."','".$city."','".$area."','".$department."','".$title."','".$speciality."','".$position."',
			'".$seniority."','".$education."','".$email."','".$register_time."'
		}";
		if (!mysql_query($insert,$this->root_conn))
		{
		  die('Error: ' . mysql_error());
		}
		return 1;//注册成功
		
	}
}

?>