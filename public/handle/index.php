<?php
	$_BASE_PATH="../../";
	include_once '../../sys/core/init.inc.php';
	//$system=new System();
	//echo $system->add();
	//$quiz_id=87;
	//$statistics=new Statistics();
	//$statistics->table_all($quiz_id);
	$system=new System();
	echo $system->search_website("医疗");
?>