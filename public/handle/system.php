<?php
	$_BASE_PATH="../../";
	include_once '../../sys/core/init.inc.php';
	$operation=$_POST["operation"];
	if ($operation=="FETCHPROVINCE")
	{
		$system=new System();
		echo $system->fetch_province();
	}
	if ($operation=="FETCHCITY")
	{
		$province=$_POST["province"];
		$system=new System();
		echo $system->fetch_city($province);
	}


?>