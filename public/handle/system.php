<?php
	$_BASE_PATH="../../";
	include_once '../../sys/core/init.inc.php';
	$operation=$_POST["operation"];
	if ($operation=="FETCHPROVINCE")
	{
		$system=new System();
		echo $system->fetch_province();
	}


?>