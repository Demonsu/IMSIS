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
		if (!isset($_SESSION["USERID"]))
			echo "登陆信息已失效，请重新登陆";
		else
		{
			$key_field_list=explode(';', $_POST["key_field_list"]);// ‘;’隔开的关键域id 
			$remark=$_POST["remark"];
			$questionnaire=new Questionnaire();
			echo $questionnaire->create_questionnaire($_SESSION["USERID"],0,$remark,$key_field_list);
		}
	}
	if ($operation=="CREATEDEPARTMENTQUESTIONNAIRE")//创建单位测评
	{
		if (!isset($_SESSION["USERID"]))
			echo "登陆信息已失效，请重新登陆";
		else
		{
			$remark=$_POST["remark"];
			$questionnaire=new Questionnaire();
			echo $questionnaire->create_questionnaire($_SESSION["USERID"],1,$remark,"");
		}
	}
	if ($operation=="CHECKDEPARTMENTQUESTIONNAIRE")//检测是否存在未完成的单位测评
	{
		if (!isset($_SESSION["USERID"]))
			echo "登陆信息已失效，请重新登陆";
		else
		{
			$questionnaire=new Questionnaire();
			echo $questionnaire->check_department_questionnaire($_SESSION["USERID"]);
		}
	}
	if ($operation=="FETCHUSERQUESTIONNAIRELIST")//获取用户测评列表
	{
		if (!isset($_SESSION["USERID"]))
			echo "登陆信息已失效，请重新登陆";
		else
		{			
			$questionnaire=new Questionnaire();
			echo $questionnaire->fetch_user_questionnaire_list($_SESSION["USERID"],$_POST["state"]);
		}		
	}
	if ($operation=="FETCHDEPARTMENTQUESTIONNAIRE")//
	{		
		if (!isset($_SESSION["USERID"]))
			echo "登陆信息已失效，请重新登陆";
		else
		{	
			$questionnaire=new Questionnaire();
			echo $questionnaire->fetch_department_questionnaire_list($_SESSION["USERID"]);
		}
	}
	if ($operation=="DELETEQUESTIONNAIRE")
	{
		if (!isset($_SESSION["USERID"]))
			echo "登陆信息已失效，请重新登陆";
		else
		{	
			$questionnaire=new Questionnaire();
			echo $questionnaire->delete_questionnaire($_SESSION["USERID"],$_POST["quiz_id"]);
		}		
	}
	if ($operation=="IFDEPARTMENTQUESTIONNAIREDONE")//检查问卷是否还有我的事情
	{
		if (!isset($_SESSION["USERID"]))
			echo "登陆信息已失效，请重新登陆";
		else
		{
			$questionnaire=new Questionnaire();
			echo $questionnaire->check_if_still_have_my_business($_SESSION["USERID"],$_POST["quiz_id"]);	
		}		
	}
	if ($operation=="FETCHCHOOSEDEPARTMENTQUESTIONNAIRE")//获取单位选择关键域的页面
	{
		if (!isset($_SESSION["USERID"]))
			echo "登陆信息已失效，请重新登陆";
		else
		{		
			$questionnaire=new Questionnaire();
			echo $questionnaire->fetch_department_questionnaire($_SESSION["USERID"],$_POST["quiz_id"]);
		}		
	}
	if ($operation=="USERSUBMITDEPARTMENTREQUEST")//用户提交选择的关键域
	{
		$key_field_list=explode(';',$_POST["key_field_list"]);
		
		if (!isset($_SESSION["USERID"]))
			echo "登陆信息已失效，请重新登陆";
		else
		{		
			$questionnaire=new Questionnaire();
			echo $questionnaire->user_submit_key_field($_SESSION["USERID"],$_POST["quiz_id"],$key_field_list);
		}			
	}
	
?>

			

