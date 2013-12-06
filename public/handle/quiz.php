<?php
/*
			<div class="list-group">
			  <a class="list-group-item active">作用域1</a>
			  <a href="#" class="list-group-item text-center over-done">关键域1</a>
			  <a href="#" class="list-group-item text-center over-doing">关键域2</a>
			  <a href="#" class="list-group-item text-center">关键域3</a>
			  <a href="#" class="list-group-item text-center">关键域4</a>
			</div>
*/
	$_BASE_PATH="../../";
	include_once '../../sys/core/init.inc.php';
	$operation=$_POST["operation"];
	if ($operation=="FETCHQUIZPROCESS")
	{
		if (!isset($_SESSION["USERID"]))
			echo "登陆信息已失效，请重新登陆";
		else
		{
			$questionnaire=new Questionnaire();
			echo $questionnaire->fetch_quiz_process($_SESSION["USERID"],$_POST["quiz_id"]);
		}
	}


?>