<?php
	$_BASE_PATH="../../";
	include_once '../../sys/core/init.inc.php';
	
		/*
		$record_list[] = array(
			"user_id"=> $part_list[$i*6+0],
			"base_time"=> $part_list[$i*6+1],
			"performance_level"=> $part_list[$i*6+2],
			"honor_leader"=> $part_list[$i*6+3],
			"honor_excellent"=> $part_list[$i*6+4],
			"comment"=> $part_list[$i*6+5],
		);
		*/
	$operation=$_POST["operation"];
	
	if ($operation=="FETCHPALEQUESTIONNAIRE")//获取空白问卷供个人评测时候选关键域
	{
		$questionnaire=new Questionnaire();
		echo $questionnaire->fecth_pale_questionnaire();		
	}
	if ($operation=="CREATEUSERQUESTIONNAIRE")//创建个人评测
	{
		$key_field_list=explode(';', $_POST["key_field_list"]);// ‘;’隔开的关键域id 
		$remark=$_POST["remark"];
		$questionnaire=new Questionnaire();
		echo $questionnaire->create_questionnaire($_SESSION["USERID"],0,$remark,$key_field_list);
	}
	if ($operation=="CREATEDEPARTMENTQUESTIONNAIRE")//创建单位测评
	{
		$questionnaire=new Questionnaire();
		echo $questionnaire->create_questionnaire($_SESSION["USERID"],1,$remark,"");
	}



?>

			

