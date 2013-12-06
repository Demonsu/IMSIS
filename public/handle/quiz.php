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
			//echo $_SESSION["USERID"];
			//echo $_POST["quiz_id"]."!!";
			$questionnaire=new Questionnaire();
			echo $questionnaire->fetch_quiz_process($_SESSION["USERID"],$_POST["quiz_id"]);
		}
	}
	
	if ($operation=="FETCHKEYVARIABLE")
	{
		$questionnaire=new Questionnaire();
		echo $questionnaire->fetch_key_variable($_POST["key_field_id"]);
	}
	if ($operation=="ANSERQUESTIONNAIRE")
	{	
		if (!isset($_SESSION["USERID"]))
			echo "登陆信息已失效，请重新登陆";
		else
		{
			$quiz_id=$_POST["quiz_id"];
			$answer=$_POST["answer"];
			$temp=explode(';',$answer);
			foreach($temp as $answer_item)
			{
				if ($answer_item!="")
				{
					$answer_temp=explode(':',$answer_item);
					$answer_list[]=array(
						"key_variable_id"=>$answer_temp[0],
						"answer"=>$answer_temp[1]
					);
				}
			}
			$questionnaire=new Questionnaire();
			echo $questionnaire->answer_questionnaire_by_key_field($quiz_id,$answer_list);
		}		
	}
	if($operation=="FETCHTARGETQUESTIONNAIRE")
	{
		if (!isset($_SESSION["USERID"]))
			echo "登陆信息已失效，请重新登陆";
		else
		{
			$questionnaire=new Questionnaire();
			echo $questionnaire->fetch_set_goal($_POST["quiz_id"]);
		}		
	}


?>