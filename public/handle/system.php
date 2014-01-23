<?php
	$_BASE_PATH="../../";
	include_once '../../sys/core/init.inc.php';
	$operation=$_POST["operation"];
	$system=new System();
	if ($operation=="FETCHPROVINCE")
	{
		
		echo $system->fetch_province();
	}
	if ($operation=="FETCHCITY")
	{
		$province=$_POST["province"];
	
		echo $system->fetch_city($province);
	}
	if ($operation=="FETCHDEPARTMENT")
	{
		echo $system->fetch_department();	
	}
	if ($operation=="FETCHTITLE")
	{
		echo $system->fetch_title();
	}
	if ($operation=="FETCHSPECIALITY")
	{
		echo $system->fetch_speciality();
	}
	if ($operation=="FETCHONCHARGE")
	{
		echo $system->fetch_oncharge();
	}
	if ($operation=="FETCHSHARELIST")
	{
		echo $system->fetch_discovery_share_list();
	}
	if ($operation=="FETCHNEWSLIST")
	{
		echo $system->fetch_news_list();
	}
	if ($operation=="FETCHSHARELIST2")
	{
		echo $system->fetch_share_list_2();
	}
	if ($operation=="FETCHNEWSLIST2")
	{
		echo $system->fetch_news_list_2();
	}
	if ($operation=="FETCHNEWSDETAIL")
	{
		$id=$_POST["id"];
		echo $system->fetch_news_detail($id);
	}
	if ($operation=="SEARCHWEBSITE")
	{
		$key_word=$_POST["key_word"];
		echo $system->search_website($key_word);
	}
	if ($operation=="ANSWERGOVQUIZ")//回答政府问卷
	{
		//answer_list:"1:2;2:3;3:5….."
		//question_suggestion:"string"(htmlspecialchars) 对应45题
		//quiz_suggestion: "string"(htmlspecialchars)    对应46题
		$answer_list=$_POST["answer_list"];
		$question_suggestion=$_POST["question_suggestion"];
		$quiz_suggestion=$_POST["quiz_suggestion"];
		echo $syetem->answer_gov_quiz(explode(';',$answer_list),$question_suggestion,$quiz_suggestion);
	}
	if ($operation=="ANSWERPUBQUIZ")//回答公众问卷
	{
		$answer_list=$_POST["answer_list"];
		$quiz_suggestion=$_POST["quiz_suggestion"];		
		echo $syetem->answer_pub_quiz(explode(';',$answer_list),$quiz_suggestion);
	}
	if ($operation=="FETCHGOVQUIZSTATISTICS")//获取政府问卷统计数据
	{
		echo $system->fetch_gov_quiz_statistic();
	}
	if ($operation=="FETCHGOVQUIZQUESTIONSUGGESTIONLIST")//获取政府问卷问题建议
	{
		echo $system->fetch_gov_quiz_question_suggestion();
	}
	if ($operation=="FETCHGOVQUIZSUGGESTION")//获取政府问卷建议
	{
		echo $system->fetch_gov_quiz_suggestion();
	}
	if ($operation=="FETCHPUBQUIZSTATISTICS")//获取公众问卷统计数据
	{
		echo $system->fetch_pub_quiz_statistics();
	}
	if ($operation=="FETCHPUBQUIZSUGGESTION")//获取公众问卷建议
	{
		echo $system->fetch_pub_quiz_suggestion();
	}

?>