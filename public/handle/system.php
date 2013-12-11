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
	if ($operation=="FETCHDEPARTMENT")
	{
		echo $system->fetch_department();	
	}
	if ($operation=="FETCHTITLE")
	{
		echo $system->fetch_title();
	}
	if ($operation=="FETCHSPECIALITY")
	{
		echo $system->fetch_speciality();
	}
	if ($operation=="FETCHONCHARGE")
	{
		echo $system->fetch_oncharge();
	}

?>