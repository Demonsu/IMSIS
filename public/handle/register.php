<?php
	$_BASE_PATH="../../";
	include_once '../../sys/core/init.inc.php';
	$operation=$_POST["operation"];
	if ($operation=="CHECKEXIST")//查询用户是否已经存在
	{
		$user_id=$_POST["user_id"];
		$user=new User();
		echo $user->check_exsit($user_id);//1为存在，0为不存在
	}
	if ($operation=="REGISTER")//注册
	{
		$user_id=$_POST["user_id"];
		$password=$_POST["password"];//明文
		$permission=0;//普通用户
		$gender=$_POST["gender"];//男 女
		$age=$_POST["age"];//数字，20-30则填30
		$province=$_POST["province"];//文字
		$city=$_POST["city"];//文字
		$area=$_POST["area"];//文字
		$department=$_POST["department"];//文字
		$title=$_POST["title"];//文字
		$speciality=$_POST["speciality"];//文字
		$position=$_POST["position"];//文字
		$oncharge=$_POST["oncharge"];//负责工作
		$seniority=$_POST["seniority"];//整数
		$education=$_POST["education"];//文字
		$email=$_POST["email"];//email
		$register_time=date("Y-m-d H:i:s",time());
		$user=new User();
		$result=$user->register($user_id,$password,$permission,$gender,$age,$province,$city,$area,$department,$title,$speciality,$position,$seniority,$education,$email,$register_time,$oncharge);
		echo $result;//1为成功，0为失败
	}
?>