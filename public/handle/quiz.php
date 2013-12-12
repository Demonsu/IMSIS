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
	if ($operation=="FETCHQUIZPROCESS")//获取问卷进度
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
	
	if ($operation=="FETCHKEYVARIABLE")//获取一个关键域下的所有题目
	{
		$questionnaire=new Questionnaire();
		echo $questionnaire->fetch_key_variable($_POST["key_field_id"]);
	}
	if ($operation=="ANSERQUESTIONNAIRE")//回答一个关键域
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
	if ($operation=="CHECKGOALSET")//检查是否已经设置过目标
	{
		if (!isset($_SESSION["USERID"]))
			echo "登陆信息已失效，请重新登陆";
		else
		{
			$questionnaire=new Questionnaire();
			echo $questionnaire->check_goal_set($_SESSION["USERID"],$_POST["quiz_id"]);
		}			
	}
	if($operation=="FETCHTARGETQUESTIONNAIRE")//获取设置目标的界面
	{
		if (!isset($_SESSION["USERID"]))
			echo "登陆信息已失效，请重新登陆";
		else
		{
			$questionnaire=new Questionnaire();
			echo $questionnaire->fetch_set_goal($_SESSION["USERID"],$_POST["quiz_id"]);
		}		
	}
	if ($operation=="USERSETGOAL")//设置目标
	{
		$goal_list=$_POST["goal_list"];
		if (!isset($_SESSION["USERID"]))
			echo "登陆信息已失效，请重新登陆";
		else
		{
			$questionnaire=new Questionnaire();
			echo $questionnaire->set_goal($_POST["quiz_id"],explode(';',$goal_list));
		}			
	}
	if ($operation=="FETCHPREVIEWQUESTIONNAIRE")//获取预览问卷的页面
	{
		if (!isset($_SESSION["USERID"]))
			echo "登陆信息已失效，请重新登陆";
		else
		{
			$questionnaire=new Questionnaire();
			echo $questionnaire->fetch_preview_questionnaire($_SESSION["USERID"],$_POST["quiz_id"]);
		}	
		
	}
	if($operation=="USERFINALSUBMIT")//提交
	{
		if (!isset($_SESSION["USERID"]))
			echo "登陆信息已失效，请重新登陆";
		else
		{
			$quiz_id=$_POST["quiz_id"];
			$goal_list=$_POST["goal_list"];
			$answer_list=$_POST["answer_list"];
			$questionnaire=new Questionnaire();
			if (isset($_POST["is_public"]))
				$result= $questionnaire->user_final_submit($_SESSION["USERID"],$quiz_id,explode(';',$goal_list),explode(';',$answer_list),1);
			else
				$result= $questionnaire->user_final_submit($_SESSION["USERID"],$quiz_id,explode(';',$goal_list),explode(';',$answer_list));	
				
			if ($result==1)
			{
				$statistics=new Statistics();
				//$quiz_id=$_POST["quiz_id"];
				//$statistics->init_key_goal_list($quiz_id,$config_id=1);
				//$statistics->table1_CVs($quiz_id);
				//$statistics->table2_KVs($quiz_id);
				//$statistics->table3_KDs($quiz_id);	
				//$statistics->table4_KDs($quiz_id);	
				//$statistics->table5_LDs($quiz_id);		
 				//$statistics->table6_KTs($quiz_id);
				$statistics->table_all($quiz_id);
				echo 1;
			}		
		}		
	}
	

?>