<?php
	$_BASE_PATH="../../";
	include_once '../../sys/core/init.inc.php';
	//$system=new System();
	//echo $system->add();
	$quiz_id=84;
	$statistics=new Statistics();
	$statistics->table1_CVs($quiz_id);
	$statistics->table2_KVs($quiz_id);
	$statistics->table3_KDs($quiz_id);	
	$statistics->table4_KDs($quiz_id);	
	$statistics->table5_LDs($quiz_id);	
?>