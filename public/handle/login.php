<?php
	$_BASE_PATH="../../";
	include_once '../../sys/core/init.inc.php';
	if (isset($_POST["user_id"]) && isset($_POST["password"]))
	{
		$user_id=$_POST["user_id"];
		$password=$_POST["password"];
		$user=new User();
		echo $user->login($user_id,$password);
	}
?>