<?php

	$_BASE_PATH="../../";
	include_once '../../sys/core/init.inc.php';
	if (isset($_POST["user_id"]) && isset($_POST["password"]))
	{
		$user_id=$_POST["user_id"];
		$password=$_POST["password"];
		$user=new User();
		$permission=$user->login($user_id,$password);
		if ($permission!=-1)
		{
			if ($_POST["remember"]==1)
			{
				//echo "坑爹啊";
				setcookie("username",$user_id,time()+30*24*3600,'/');
				setcookie("password",$password,time()+30*24*3600,'/');
			}
		}
		echo $permission;
	}
?>