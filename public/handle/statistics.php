<?php
	$_BASE_PATH="../../";
	include_once '../../sys/core/init.inc.php';
	$operation=$_POST["operation"];;
	if ($operation=="TABLE1")
	{
		$statistics=new Statistics();
		echo $statistics->table1_CVs($_POST["quiz_id"]);		
	}
	if ($operation=="TABLE2")
	{
		$statistics=new Statistics();
		echo $statistics->table2_KVs($_POST["$quiz_id"]);		
	}

?>