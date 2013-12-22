<?php
	$_BASE_PATH="../../";
	include_once '../../sys/core/init.inc.php';
	
	$operation=$_POST["operation"];
	if ($operation=="FETCHEFFECTFIELDLIST")//获取作用域列表
	{
		if ($_SESSION["PERMISSION"]!=1)
		{
			echo "权限不够";
		}else
		{
			$admin=new Admin();
			echo $admin->fetch_effect_field_list();
		}
		
	}
	if ($operation=="DELETEEFFECTFIELD")//删除一个作用域
	{
		
		if ($_SESSION["PERMISSION"]!=1)
		{
			echo "权限不够";
		}else
		{
			$effect_field_id=$_POST["effect_field_id"];
			$admin=new Admin();
			echo $admin->delete_effect_field($effect_field_id);
		}
	}
	if ($operation=="MODIFYEFFECTFIELD")//修改或增加一个作用域
	{
		if ($_SESSION["PERMISSION"]!=1)
		{
			echo "权限不够";
		}else
		{
			$add=$_POST["add"];
			$effect_field_id=$_POST["effect_field_id"];
			$name=$_POST["name"];
			$admin=new Admin();
			echo $admin->modify_effect_field($add,$effect_field_id,$name);
		}

	}
	if ($operation=="SHOWORHIDEEFFECTFIELD")//显示或隐藏一个作用域
	{
		if ($_SESSION["PERMISSION"]!=1)
		{
			echo "权限不够";
		}else
		{
			$effect_field_id=$_POST["effect_field_id"];
			$available=$_POST["available"];	
			$admin=new Admin();
			echo $admin->show_or_hide_effect_field($effect_field_id,$available);
		}

	}
	if ($operation=="FETCHEFFECTFIELDSELECTLIST")//获取作用域选择列表
	{
		if ($_SESSION["PERMISSION"]!=1)
		{
			echo "权限不够";
		}else
		{
			$admin=new Admin();
			echo $admin->fetch_effect_field_select_list();
		}
	}
	if ($operation=="FETCHKEYFIELDLIST")//获取关键域列表
	{
		if ($_SESSION["PERMISSION"]!=1)
		{
			echo "权限不够";
		}else
		{
			$effect_field_id=$_POST["effect_field_id"];
			$admin=new Admin();
			echo $admin->fetch_key_field_list($effect_field_id);
		}
	}
	if ($operation=="DELETEKEYFIELD")//删除一个关键域
	{
		if ($_SESSION["PERMISSION"]!=1)
		{
			echo "权限不够";
		}else
		{
			$key_field_id=$_POST["key_field_id"];
			$admin=new Admin();
			echo $admin->delete_key_field($key_field_id);
		}
		
	}
	if ($operation=="MODIFYKEYFIELD")//增加或修改一个关键域
	{
		if ($_SESSION["PERMISSION"]!=1)
		{
			echo "权限不够";
		}else
		{
			$add=$_POST["add"];
			$key_field_id=$_POST["key_field_id"];
			$name=$_POST["name"];	
			$effect_field_id=$_POST["effect_field_id"];
			$admin=new Admin();
			echo $admin->modify_key_field($add,$key_field_id,$name,$effect_field_id);
		}

	}	
	if ($operation=="SHOWORHIDEKEYFIELD")//显示或隐藏关键域
	{
		if ($_SESSION["PERMISSION"]!=1)
		{
			echo "权限不够";
		}else
		{
			$key_field_id=$_POST["key_field_id"];
			$available=$_POST["available"];	
			$admin=new Admin();
			echo $admin->show_or_hide_key_field($key_field_id,$available);
		}

	}	
	if ($operation=="FETCHKEYFIELDSELECTLIST")//显示关键域选择列表
	{
		if ($_SESSION["PERMISSION"]!=1)
		{
			echo "权限不够";
		}else
		{
			$effect_field_id=$_POST["effect_field_id"];
			$admin=new Admin();
			echo $admin->fetch_key_field_select_list($effect_field_id);
		}
		
		
	}	
	if ($operation=="FETCHKEYVARIABLELIST")//显示关键变量列表
	{
		if ($_SESSION["PERMISSION"]!=1)
		{
			echo "权限不够";
		}else
		{
			$key_field_id=$_POST["key_field_id"];
			$admin=new Admin();
			echo $admin->fetch_key_variable_list($key_field_id);
		}
		
		
	}	
	if ($operation=="DELETEKEYVARIABLE")//删除一个关键变量
	{
		if ($_SESSION["PERMISSION"]!=1)
		{
			echo "权限不够";
		}else
		{
			$key_variable_id=$_POST["key_variable_id"];
			$admin=new Admin();
			echo $admin->delete_key_variable($key_variable_id);
		}
		
		
	}	
	if ($operation=="MODIFYKEYVARIABLE")//修改一个关键变量
	{
		if ($_SESSION["PERMISSION"]!=1)
		{
			echo "权限不够";
		}else
		{
			$add=$_POST["add"];
			$key_variable_id=$_POST["key_variable_id"];
			$question=$_POST["question"];
			$answer_a=$_POST["answer_a"];
			$answer_b=$_POST["answer_b"];
			$answer_c=$_POST["answer_c"];
			$answer_d=$_POST["answer_d"];
			$answer_e=$_POST["answer_e"];
			$key_field_id=$_POST["key_field_id"];
			$admin=new Admin();
			echo $admin->modify_key_variable($add,$key_variable_id,$key_field_id,$question,$answer_a,$answer_b,$answer_c,$answer_d,$answer_e);
		}

		
	}	
	if ($operation=="SHOWORHIDEKEYVARIABLE")//显示或隐藏一个关键变量
	{
		if ($_SESSION["PERMISSION"]!=1)
		{
			echo "权限不够";
		}else
		{
			$key_variable_id=$_POST["key_variable_id"];
			$available=$_POST["available"];
			$admin=new Admin();
			echo $admin->show_or_hide_key_variable($key_variable_id,$available);
		}

	}		
	if ($operation=="FETCHKEYVARIABLEDETAIL")
	{
		if ($_SESSION["PERMISSION"]!=1)
		{
			echo "权限不够";
		}else
		{
			$key_variable_id=$_POST["key_variable_id"];
			$admin=new Admin();
			echo $admin->fetch_key_variable_detail($key_variable_id);
		}		
	}
	if ($operation=="FETCHGOALTABLE")
	{
		if ($_SESSION["PERMISSION"]!=1)
		{
			echo "权限不够";
		}else
		{
			$admin=new Admin();
			echo $admin->fetch_goal_table();
		}				
	}
	if ($operation=="MODIFYGOAL")
	{
		if ($_SESSION["PERMISSION"]!=1)
		{
			echo "权限不够";
		}else
		{
			$key_field_id=$_POST["key_field_id"];
			$mature_level=$_POST["mature_level"];
			$mature_value=$_POST["mature_value"];
			$admin=new Admin();
			echo $admin->set_goal($key_field_id,$mature_level,$mature_value);
		}				
	}
	if ($operation=="SEARCHQUESTIONNAIRE")
	{
		if ($_SESSION["PERMISSION"]!=1)
		{
			echo "权限不够";
		}else
		{
			$province=$_POST["province"];
			$city=$_POST["city"];
			$department=$_POST["department"];
			$quiz_type=$_POST["quiz_type"];
			$quiz_state=$_POST["quiz_state"];
			$start_time=$_POST["start_time"];
			$end_time=$_POST["end_time"];
			$admin=new Admin();
			echo $admin->search_quiz($province,$city,$department,$start_time,$end_time,$quiz_type,$quiz_state);
		}
	}
	if ($operation=="SEARCHUSER")
	{
		if ($_SESSION["PERMISSION"]!=1)
		{
			echo "权限不够";
		}else
		{
			$province=$_POST["province"];
			$city=$_POST["city"];
			$department=$_POST["department"];
			$title=$_POST["title"];
			$admin=new Admin();
			echo $admin->search_user($province,$city,$department,$title);
		}
	}
	if ($operation=="FETCHUSERINFO")
	{
		if ($_SESSION["PERMISSION"]!=1)
			echo "权限不够";
		else
		{
			$admin=new Admin();
			echo $admin->fetch_user_detail_info($_POST["user_id"]);	
		}
	}
	if ($operation=="FETCHNEWSLIST")
	{
		if ($_SESSION["PERMISSION"]!=1)
		{
			echo "权限不够";
		}else
		{
			$admin=new Admin();
			echo $admin->fetch_news_list();
		}
		
	}
	if ($operation=="FETCHNEWSDETAIL")
	{
		if ($_SESSION["PERMISSION"]!=1)
		{
			echo "权限不够";
		}else
		{
			$id=$_POST["id"];
			$admin=new Admin();
			echo $admin->fetch_news_info($id);
		}		
	}
	if ($operation=="ADDNEWS")
	{
		if ($_SESSION["PERMISSION"]!=1)
		{
			echo "权限不够";
		}else
		{
			$title=$_POST["title"];
			$content=$_POST["content"];
			$img_url=$_POST["img_url"];
			$time=date("Y-m-d H:i:s",time());
			$admin=new Admin();
			echo $admin->add_news($title,$content,$time,$img_url);
		}				
	}
	if ($operation=="MODIFYNEWS")
	{
		if ($_SESSION["PERMISSION"]!=1)
		{
			echo "权限不够";
		}else
		{
			$id=$_POST["id"];
			$title=$_POST["title"];
			$content=$_POST["content"];
			$img_url=$_POST["img_url"];
			$time=date("Y-m-d H:i:s",time());
			$admin=new Admin();
			echo $admin->modify_news($title,$content,$time,$img_url);
		}			
	}
	if ($operation=="DELETENEWS")
	{
		if ($_SESSION["PERMISSION"]!=1)
		{
			echo "权限不够";
		}else
		{
			$id=$_POST["id"];
			$admin=new Admin();
			echo $admin->delete_news($id);
		}			
	}
	if ($operation=="CHANGENEWSSORT")
	{
		if ($_SESSION["PERMISSION"]!=1)
		{
			echo "权限不够";
		}else
		{
			$id1=$_POST["id1"];
			$id2=$_POST["id2"];
			$admin=new Admin();
			echo $admin->change_news_sort($id1,$id2);
		}			
	}
	if ($operation=="UPBANGNEWS")
	{
		if ($_SESSION["PERMISSION"]!=1)
		{
			echo "权限不够";
		}else
		{
			$id=$_POST["id"];
			$admin=new Admin();
			echo $admin->upbang_news($id);
		}			
	}

?>