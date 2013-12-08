<?php
	$_BASE_PATH="../../";
	include_once '../../sys/core/init.inc.php';

	$operation=$_POST["operation"];
	if ($operation=="CHOOSEDEPARTMENTQUESTIONNAIRE")
	{
		if (!isset($_SESSION["USERID"]))
			echo "登陆信息已失效，请重新登陆";
		else
		{
			$questionnaire=new Questionnaire();
			echo $questionnaire->fetch_department_questionnaire($_SESSION["USERID"],$_POST["quiz_id"]);
		}			
	}

?>