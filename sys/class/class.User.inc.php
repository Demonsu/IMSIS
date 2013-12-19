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
			$_SESSION["USERID"]=$user_id;
			$_SESSION["PERMISSION"]=$result["permission"];
			return $result["permission"];
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
	public function register($user_id,$password,$permission,$gender,$age,$province,$city,$area,$department,$title,$speciality,$position,$seniority,$education,$email,$register_time,$oncharge)
	{
		$sql="SELECT * FROM user WHERE id='".$user_id."' ";
		$select=mysql_query($sql,$this->root_conn) or trigger_error(mysql_error(),E_USER_ERROR);
		$num=mysql_num_rows($select);
		if ($num==1)
			return 0;
		if($seniority=="")
			$seniority=0;
		$sql="INSERT INTO user 
		(
			id,password,permission,gender,age,
			province,city,area,department,title,speciality,position,
			seniority,education,email,register_time,oncharge
		)VALUES
		(
			'".$user_id."','".$password."','".$permission."','".$gender."','".$age."',
			'".$province."','".$city."','".$area."','".$department."','".$title."','".$speciality."','".$position."',
			'".$seniority."','".$education."','".$email."','".$register_time."','".$oncharge."'
		)";
		//echo $sql;
		if (!mysql_query($sql,$this->root_conn))
		{
		  die('Error: ' . mysql_error());
		}
		return 1;//注册成功
		
	}
	public function fetch_info($user_id)
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
		$age_array=array(
		"0"=>"0",
		"25"=>"1",
		"35"=>"2",
		"45"=>"3",
		"55"=>"4",
		"56"=>"5"
		);
		$edu_array=array(
		"大专"=>"1",
		"大学本科"=>"2",
		"硕士"=>"3",
		"博士"=>"4"
		);
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
		$age_select=$age_array[$user_info["age"]];
		$gender_select=1;
		if ($user_info["gender"]!="")
		if ($user_info["gender"]=="女")
			$gender_select=2;
		if ($user_info["education"]!=0)
			$edu_select=$edu_array[$user_info["education"]];
		else $edu_select=0;
		return sprintf($RESULTFORMAT,$user_id,$department,$user_info["title"],$user_info["oncharge"],$user_info["speciality"],$age_select,$gender_select,$edu_select,$user_info["position"],$user_info["seniority"],$user_info["email"]);
			
	}
	public function change_info($user_id,$age,$gender,$edu,$position,$time,$email)//修改用户信息
	{
		if ($time=="")
			$time=0;
		$sql="UPDATE user SET
		age='".$age."',
		gender='".$gender."',
		education='".$edu."',
		position='".$position."',
		seniority='".$time."',
		email='".$email."'
		WHERE id='".$user_id."'
		";
		if (!mysql_query($sql,$this->root_conn))
		{
		  die('Error: ' . mysql_error());
		}
		return 1;//修改成功
	}
	public function change_password($user_id,$old_pass,$new_pass)
	{
		$sql="SELECT * FROM user WHERE id='".$user_id."' AND password='".$old_pass."'";
		$select=mysql_query($sql, $this->root_conn) or trigger_error(mysql_error(),E_USER_ERROR);
		$num=mysql_num_rows($select);
		if ($num==0)
			return 0;
		$sql="UPDATE user SET password='".$new_pass."' WHERE id='".$user_id."'";
		if (!mysql_query($sql,$this->root_conn))
		{
		  die('Error: ' . mysql_error());
		}
		return 1;		
	}
	public function fetch_user_state($user_id,$is_public)
	{
		//$sql="SELECT * FROM questionnaire WHERE is_public='".$is_public."' and user_id='".$user_id."'";
		
	}
}

?>