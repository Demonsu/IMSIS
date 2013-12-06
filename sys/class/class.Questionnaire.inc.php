<?php

class Questionnaire extends DB_Connect {


	public function __construct(){
		parent::__construct();
	}
	public function fecth_pale_questionnaire()//获取空白问卷，供用户选择关键域
	{
		$return_value="";
		$EFFECTFORMAT='<a class="list-group-item active"><input type="checkbox" id="%s" value="%s">%s</a>';
	    $KEYFORMAT='<a class="list-group-item"><input type="checkbox" id="%s" value="%s"> %s</a>';
		//获取所有的作用域
		$sql="SELECT * FROM effect_field";
		$effect_select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
		$effect_index=1;
		while ($effect_result=mysql_fetch_assoc($effect_select))
		{
			$return_value=$return_value.sprintf($EFFECTFORMAT,"box".$effect_index,$effect_result["id"],$effect_result["name"]);
			$key_index=1;
			$sql="SELECT * FROM key_field WHERE effect_field_id='".$effect_result["id"]."' AND available='1'";
			$key_select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
			while ($key_result=mysql_fetch_assoc($key_select))
			{
				$return_value=$return_value.sprintf($KEYFORMAT,"box".$effect_index.$key_index,$key_result["id"],$key_result["name"]);
				$key_index++;
			}
			$effect_index++;
		}
		return $return_value;
	}
	public function create_questionnaire($user_id,$is_public,$remark,$key_field_list)
	{
		//首先创建一个问卷
		$currentdate=date("Y-m-d H:i:s",time());
		$hash=rand(1,1000);
		$sql="INSERT INTO questionnaire
		(
			user_id,state,is_public,remark,create_time,hash
		)VALUES
		(
			'".$user_id."','0','".$is_public."','".$remark."','".$currentdate."','".$hash."'
		)
		";
		if (!mysql_query($sql,$this->root_conn))
		{
		  die('Error: ' . mysql_error());
		}
		//获取这个问卷的id
		$sql="SELECT id FROM questionnaire WHERE hash='".$hash."' and create_time='".$currentdate."'";
		$select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
		$result=mysql_fetch_assoc($select);
		$id=$result["id"];
		
		//echo $id;
		//添加问卷内容
		if ($is_public==0)//个人评测
		{
			foreach($key_field_list as $key_field)
			{
				if ($key_field!="")
				{
					$sql="INSERT INTO questionnaire_content
					(
						key_field_id,questionnaire_id,state,user_id
					)
					VALUES
					(
						'".$key_field."','".$id."','0','".$user_id."'
					)
					";
					if (!mysql_query($sql,$this->root_conn))
					{
					  die('Error: ' . mysql_error());
					}
				}
			} 
		}else if ($is_public==1)//单位评测
		{
			//首先获得所有可用的关键域
			$sql="SELECT * FROM key_field WHERE available='1'";
			$select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
			//生成单位问卷的内容
			while ($result=mysql_fetch_assoc($select))
			{
				$sql="INSERT INTO questionnaire_content
				(
					key_field_id,questionnaire_id,state
				)
				VALUES
				(
					'".$result["id"]."','".$id."','0'
				)
				";
				if (!mysql_query($sql,$this->root_conn))
				{
				  die('Error: ' . mysql_error());
				}
			}
			
		}
		return $id;//创建成功
		
	}
	public function check_department_questionnaire($user_id)
	{
		
		$sql="SELECT * FROM user WHERE id='".$user_id."'";
		$select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
		$result=mysql_fetch_assoc($select);
		$sql="SELECT * FROM questionnaire q, user u WHERE 
				u.province='".$result["province"]."'  AND
				u.city='".$result["city"]."' AND
				u.department='".$result["department"]."' AND
				u.id=q.user_id AND
				q.is_public='1' AND
				q.state='0'
		";
		$select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
		$num=mysql_num_rows($select);
		if ($num>0)
			return 1;
		else
		 	return 0;
	}
	public function fetch_user_questionnaire_list($user_id,$state)//获取用户的测评列表
	{
		$NCFORMAT='<a class="list-group-item" id="%s"><span class="badge" onclick="deleteitem()">删除</span><span class="badge" onclick="continue(this)">继续填写</span>%s</a>';
		$HCFORMAT='<a class="list-group-item" id="%s"><span class="badge" onclick="deleteitem()">删除</span><span class="badge" onclick="checkresult(this)">查看结果</span>%s</a>';
		$return_value="";
		$sql="SELECT * FROM questionnaire WHERE user_id='".$user_id."' AND state='".$state."' ";
		$select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
		while ($result=mysql_fetch_assoc($select))
		{
			if ($state==0)
			{
				$return_value=$return_value.sprintf($NCFORMAT,$result["id"],$result["create_time"]." ".$result["remark"]);
			}else
			{
				$return_value=$return_value.sprintf($HCFORMAT,$result["id"],$result["create_time"]." ".$result["remark"]);
			}
		}
		return $return_value;
	}
	public function fetch_department_questionnaire_list($user_id)
	{
		$DPNCFORMAT='<a class="list-group-item" id="%s"><span class="badge" onclick="d_continue(this)">继续填写</span>%s</a>';
		$DPHCFORMAT='<a class="list-group-item" id="%s"><span class="badge" onclick="checkresult(this)">查看结果</span>%s</a>';	
		$return_value="";
		//首先获取用户的个人信息
		$sql="SELECT * FROM user WHERE id='".$user_id."'";
		$select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
		$user_info=mysql_fetch_assoc($select);	
		//查找单位的问卷
		$sql="SELECT * FROM questionnaire q, user u WHERE
			u.province='".$user_info["province"]."' AND
			u.city='".$user_info["city"]."' AND
			u.department='".$user_info["department"]."' AND
			q.user_id=u.id AND
			q.is_public='1'
		";
		$select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
		while ($result=mysql_fetch_assoc($select))
		{
			if ($result["state"]==0)
			{
				$return_value=$return_value.sprintf($DPNCFORMAT,$result["id"],$result["create_time"]." ".$result["remark"]);
			}else
			{
				$return_value=$return_value.sprintf($DPHCFORMAT,$result["id"],$result["create_time"]." ".$result["remark"]);
			}
		}
		return $return_value;
	}
	public function fetch_quiz_process($user_id,$quiz_id)
	{
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
		
		$return_value='<div class="list-group">';
		$EFFECTFIELDFORMAT='<a class="list-group-item active">%s</a>';
		$KEYFIELDDONEFORMAT='<a href="#" id="%s" class="list-group-item text-center over-done">%s</a>';
		$KEYFIELDDOINGFORMAT='<a href="#" id="%s" class="list-group-item text-center over-doing">%s</a>';
		$KEYFIELDUNDOFORMAT='<a href="javascript:get_key_field(this)" id="%s" class="list-group-item text-center">%s</a>';
		//首先获取问卷的基本信息
		$sql="SELECT * FROM questionnaire WHERE id='".$quiz_id."'";
		$select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
		$quiz_info=mysql_fetch_assoc($select);		
		$num=mysql_num_rows($select);
		if ($num==0) return "非法操作：该问卷不存在";
		//获取系统内的作用域
		$sql="SELECT * FROM effect_field";
		$effect_field_list=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
		//接着获取属于该用户的关键域
		$sql="SELECT * FROM questionnaire_content WHERE questionnaire_id='".$quiz_id."' AND user_id='".$user_id."' ";
		$select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
		while($quiz_content=mysql_fetch_assoc($select))
		{
			$quiz_content_list[]= array(
			"id"=> $quiz_content["id"],
			"key_field_id"=> $quiz_content["key_field_id"],
			"questionnaire_id"=>  $quiz_content["questionnaire_id"],
			"state"=> $quiz_content["state"],
			"user_id"=> $quiz_content["user_id"]
			);
		}
		//反馈进度
		//首先判断是否答完问卷
		$sql="SELECT * FROM questionnaire_content WHERE questionnaire_id='".$quiz_id."' AND user_id='".$user_id."' AND state='0'";
		$select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
		$num=mysql_num_rows($select);
		if ($num==0) return 0;//不用再答了
		
		//未答完，反馈进度
		$flag=0;//是否找到第一个未答的关键域
		while ($effect_field=mysql_fetch_assoc($effect_field_list))
		{
			$return_value=$return_value.'<div class="list-group">';
			$return_value=$return_value.sprintf($EFFECTFIELDFORMAT,$effect_field["name"]);			
			foreach($quiz_content_list as $quiz_content)
			{
				//获得key_field的详细信息
				$sql="SELECT * FROM key_field WHERE id='".$quiz_content["key_field_id"]."'";
				$select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
				$key_field_info=mysql_fetch_assoc($select);
				//判断是否属于该作用域
				if ($key_field_info["effect_field_id"]==$effect_field["id"])
				{
					$temp=explode('（',$key_field_info["name"]);
					$key_field_info["name"]=$temp[0];
					if ($quiz_content["state"]==1)//该关键域已经作答
					{
						$return_value=$return_value.sprintf($KEYFIELDDONEFORMAT,$key_field_info["id"],$key_field_info["name"]);
					}
					if ($quiz_content["state"]==0)//该关键域尚未作答
					{
						if ($flag==0)//第一个未作答的关键域，填充为正在作答
						{
							$flag=1;
							$return_value=$return_value.sprintf($KEYFIELDDOINGFORMAT,$key_field_info["id"],$key_field_info["name"]);
						}else
						{
							$return_value=$return_value.sprintf($KEYFIELDUNDOFORMAT,$key_field_info["id"],$key_field_info["name"]);
						}
					}
				}
			}
			$return_value=$return_value.'</div>';
		}

		return $return_value;	
	
	}
	
	public function fetch_key_variable($key_field_id)
	{
		/*
		<a class="list-group-item active">
					关键域:1.1 中长期规划（战略规划，Strategy Planning）
		</a>
				  <a class="list-group-item">
			        <p class="">关键变量：中长期规划（E：电子政务战略（eGov Strategy）eGov战略及应用的长期计划。）</p>
					<label ><input type="radio" name="radio11" id="id11" value="option11">
					Dapibus ac facilisis in</label><br>
					<label ><input type="radio" name="radio11" id="id11" value="option11">
					组织是否意识到eGov战略的重要性（在管理层展开讨论）？</label><br>
					<label ><input type="radio" name="radio11" id="id11" value="option11">
					Dapibus ac facilisis in</label><br>
					<label ><input type="radio" name="radio11" id="id11" value="option11">
					Dapibus ac facilisis in</label><br>
					<label ><input type="radio" name="radio11" id="id11" value="option11">
					Dapibus ac facilisis in</label><br>
					<label ><input type="radio" name="radio11" id="id11" value="option11">
					Dapibus ac facilisis in</label><br>
				  </a>
		*/
		$return_value="";
		$KEYFIELDFORMAT='<a class="list-group-item active">%s.%s %s</a>';
		$KEYVARIABLEFORMAT='<a class="list-group-item">
					<p class="">%s %s</p>
						<label ><input type="radio" name="radio%s" value="1" >
						%s</label><br>
						<label ><input type="radio" name="radio%s" value="2">
						%s</label><br>
						<label ><input type="radio" name="radio%s "value="3" >
						%s</label><br>
						<label ><input type="radio" name="radio%s" value="4">
						%s</label><br>
						<label ><input type="radio" name="radio%s" value="5">
						%s</label><br>
						<label ><input type="radio" name="radio%s" value="0">
						%s</label><br>
				  </a>';
		//首先获取关键域的信息
		$sql="SELECT * FROM key_field WHERE id='".$key_field_id."'";
		$select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
		$key_field_info=mysql_fetch_assoc($select);
		$return_value=$return_value.sprintf($KEYFIELDFORMAT,$key_field_info["effect_field_id"],$key_field_info["id"],$key_field_info["name"]);
		
		//然后获取该关键域下的所有关键变量
		$sql="SELECT * FROM key_variable WHERE key_field_id='".$key_field_id."' AND available='1'";
		$select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
		while ($key_variable=mysql_fetch_assoc($select))
		{
			$return_value=$return_value.sprintf($KEYVARIABLEFORMAT,$key_variable["id"],$key_variable["question"],$key_variable["id"],$key_variable["answer_a"],$key_variable["id"],$key_variable["answer_b"],$key_variable["id"],$key_variable["answer_c"],$key_variable["id"],$key_variable["answer_d"],$key_variable["id"],$key_variable["answer_e"],$key_variable["id"],"不了解");
		}
		return $return_value;
	}
	
	public function answer_questionnaire_by_key_field($quiz_id,$answer_list)
	{
		$currenttime=date("Y-m-d H:i:s",time());
		foreach($answer_list as $answer)
		{
			$sql="INSERT INTO questionnaire_answer
			(
				questionnaire_id,key_variable_id,answer,answer_time
			)VALUES
			(
				'".$quiz_id."','".$answer["key_variable_id"]."','".$answer["answer"]."','".$currenttime."'
			)";
			if (!mysql_query($sql,$this->root_conn))
			{
			  die('Error: ' . mysql_error());
			}
		}
		return 1;
	}
}

?>