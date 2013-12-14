<?php

class Questionnaire extends DB_Connect {


	public function __construct(){
		parent::__construct();
	}
	public function fecth_pale_questionnaire()//获取空白问卷，供用户选择关键域
	{
		$return_value="";
		$EFFECTFORMAT='<a class="list-group-item active"><input type="checkbox" id="%s" value="%s">%s</a>';
	    $KEYFORMAT='<a class="list-group-item"><input type="checkbox" id="%s" value="%s" > %s</a>';
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
	public function check_if_still_have_my_business($user_id,$quiz_id)//查看单位问卷是不是还有我的事情
	{
		//先看看有没有我没答完的问卷
		$sql="SELECT * FROM questionnaire_content WHERE questionnaire_id='".$quiz_id."' AND user_id='".$user_id."' AND state!='2'";
		$select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
		$num=mysql_num_rows($select);
		if ($num>0)
			return 0;
		else
		{
			//再检查下有没有尚未被人选择过的问卷
			$sql="SELECT * FROM questionnaire_content WHERE questionnaire_id='".$quiz_id."' AND user_id='DEFAULTNULL'";
			$select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
			$num=mysql_num_rows($select);		
			if ($num==0)
				return 1;
			else return 0;	
		}
	}
	public function user_submit_key_field($user_id,$quiz_id,$key_field_list)//用户提交所选的单位评测的关键域
	{
		$sql="UPDATE questionnaire_content SET user_id='DEFAULTNULL' WHERE questionnaire_id='".$quiz_id."' AND user_id='".$user_id."' AND state='0'";
		if (!mysql_query($sql,$this->root_conn))
		{
		  die('Error: ' . mysql_error());
		}			
		foreach($key_field_list as $key_field_id)
		{
			$sql="UPDATE questionnaire_content SET user_id='".$user_id."' WHERE questionnaire_id='".$quiz_id."' AND key_field_id='".$key_field_id."'";
			if (!mysql_query($sql,$this->root_conn))
			{
			  die('Error: ' . mysql_error());
			}			
		}
		return 1;
	}
	public function fetch_department_questionnaire($user_id,$quiz_id)//获取单位评测的问卷
	{
		$return_value="";
		$EFFECTFORMAT='<a class="list-group-item active"><input type="checkbox" id="%s" value="%s">%s</a>';
	    $KEYFORMAT='<a class="list-group-item"><input type="checkbox" id="%s" value="%s" > %s</a>';
		$KEYUNDOFORMAT='<a class="list-group-item"><input type="checkbox" id="%s" value="%s" checked> %s</a>';
		$KEYDONEFORMAT='<a class="list-group-item key_field_done" title="您已经作答过的关键域"><input type="checkbox" id="%s" value="%s" checked> %s</a>';
		$KEYOTHERDONEFORMAT='<a class="list-group-item" title="别人已经选择的关键域"><input type="checkbox" id="%s" value="%s" checked disabled> %s</a>';
		//获取所有的作用域
		$sql="SELECT * FROM effect_field";
		$effect_select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
		$effect_index=1;
		while ($effect_result=mysql_fetch_assoc($effect_select))
		{
			$return_value=$return_value.sprintf($EFFECTFORMAT,"box".$effect_index,$effect_result["id"],$effect_result["name"]);
			$key_index=1;
			//选取该作用域下所有的关键域
			$sql="SELECT * FROM key_field WHERE effect_field_id='".$effect_result["id"]."' AND available='1'";
			$key_select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
			while ($key_result=mysql_fetch_assoc($key_select))
			{
				//对于每个关键域，获取在问卷中的信息
				$sql="SELECT * FROM questionnaire_content WHERE questionnaire_id='".$quiz_id."' AND key_field_id='".$key_result["id"]."'";
				$questionnaire_content_select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
				$questionnaire_content_info=mysql_fetch_assoc($questionnaire_content_select);
				if ($questionnaire_content_info["user_id"]=="DEFAULTNULL")//该关键域尚未作答
				{
					$return_value=$return_value.sprintf($KEYFORMAT,"box".$effect_index.$key_index,$key_result["id"],$key_result["name"]);//可选
				}else
				{
					if (strcmp($questionnaire_content_info["user_id"],$user_id)==0)//是我自己已选的关键域
					{
						if($questionnaire_content_info["state"]==0)//尚未作答
						{
							$return_value=$return_value.sprintf($KEYUNDOFORMAT,"box".$effect_index.$key_index,$key_result["id"],$key_result["name"]);
						}else//已经作答或者已经提交的
						{
							$return_value=$return_value.sprintf($KEYDONEFORMAT,"box".$effect_index.$key_index,$key_result["id"],$key_result["name"]);
						}
					}else//被别人选掉的关键域
					{
						$return_value=$return_value.sprintf($KEYOTHERDONEFORMAT,"box".$effect_index.$key_index,$key_result["id"],$key_result["name"]);
					}
				}
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
					key_field_id,questionnaire_id,state,user_id
				)
				VALUES
				(
					'".$result["id"]."','".$id."','0','DEFAULTNULL'
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
	public function check_department_questionnaire($user_id)//检测同单位是否已经有问卷了
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
				q.state!='2'
		";
		$select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
		$num=mysql_num_rows($select);
		if ($num>0)
			return 1;
		else
		{
			return 0;
		}
		 	
	}
	public function fetch_user_questionnaire_list($user_id,$state)//获取用户的测评列表
	{
		$NCFORMAT='<a class="list-group-item" id="%s"><span class="badge" onclick="deleteitem(this,2)">删除</span><span class="badge" onclick="u_continue(this)">继续填写</span>%s</a>';
		$HCFORMAT='<a class="list-group-item" id="%s"><span class="badge" onclick="deleteitem(this,1)">删除</span><span class="badge" onclick="checkresult(this)">查看结果</span>%s</a>';
		$return_value="";
		if ($state==0)
			$sql="SELECT * FROM questionnaire WHERE user_id='".$user_id."' AND state!='2' AND is_public='0'  ";
		else
			$sql="SELECT * FROM questionnaire WHERE user_id='".$user_id."' AND state='2' AND is_public='0'";
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
	public function delete_questionnaire($user_id,$quiz_id)//删除个人问卷
	{
		$sql="SELECT * FROM questionnaire WHERE id='".$quiz_id."' AND user_id='".$user_id."'";
		$select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
		if (mysql_num_rows($select)>0)
		{
			$sql="DELETE FROM questionnaire_answer WHERE questionnaire_id='".$quiz_id."'";//首先删除答案
			if (!mysql_query($sql,$this->root_conn))
			{
			  die('Error: ' . mysql_error());
			}
			$sql="DELETE FROM questionnaire_content WHERE questionnaire_id='".$quiz_id."'";//删除问卷内容
			if (!mysql_query($sql,$this->root_conn))
			{
			  die('Error: ' . mysql_error());
			}
			$sql="DELETE FROM questionnaire WHERE id='".$quiz_id."' AND user_id='".$user_id."'";//删除问卷本身
			if (!mysql_query($sql,$this->root_conn))
			{
			  die('Error: ' . mysql_error());
			}			


			return 1;
		}else
		{
			return "该问卷不是您创建的，您不能删除";
		}	
	}
	public function fetch_department_questionnaire_list($user_id)//获取单位评测的列表
	{
		$DPNCFORMAT='<a class="list-group-item" id="%s"><span class="badge" onclick="deleteitem(this,3)">删除</span><span class="badge" onclick="d_continue(this)">继续填写</span>%s</a>';
		$DPHCFORMAT='<a class="list-group-item" id="%s"><span class="badge" onclick="deleteitem(this,3)">删除</span><span class="badge" onclick="checkresult(this)">查看结果</span>%s</a>';	
		$return_value="";
		//首先获取用户的个人信息
		$sql="SELECT * FROM user WHERE id='".$user_id."'";
		$select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
		$user_info=mysql_fetch_assoc($select);	
		//查找单位的问卷
		$sql="SELECT q.* FROM questionnaire q, user u WHERE
			u.province='".$user_info["province"]."' AND
			u.city='".$user_info["city"]."' AND
			u.department='".$user_info["department"]."' AND
			q.user_id=u.id AND
			q.is_public='1'
		";
		$select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
		while ($result=mysql_fetch_assoc($select))
		{
			if ($result["state"]!='2')
			{
				$return_value=$return_value.sprintf($DPNCFORMAT,$result["id"],$result["create_time"]." ".$result["remark"]);
			}else
			{
				$return_value=$return_value.sprintf($DPHCFORMAT,$result["id"],$result["create_time"]." ".$result["remark"]);
			}
		}
		return $return_value;
	}
	public function fetch_quiz_process($user_id,$quiz_id)//获取用户测评的进度，问卷页面左半边
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
		$KEYFIELDDONEFORMAT='<a href="#" id="%s" class="list-group-item text-center over-done"><span class="remove-circle glyphicon glyphicon-remove-circle" style="float:right"></span><span class="select-field">%s</span>></a>';
		$KEYFIELDDOINGFORMAT='<a href="#" id="%s" class="list-group-item text-center over-doing"><span class="remove-circle glyphicon glyphicon-remove-circle" style="float:right"></span><span class="select-field">%s</span></a>';
		$KEYFIELDUNDOFORMAT='<a href="#" id="%s" class="list-group-item text-center"><span class="remove-circle glyphicon glyphicon-remove-circle" style="float:right"></span><span class="select-field">%s</span></a>';
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
		if ($num==0) //不用再答了
		{
			$sql="UPDATE questionnaire SET state='1' WHERE id='".$quiz_id."' AND state='0'";//修改问卷的状态,从未答完到已答完
			if (!mysql_query($sql,$this->root_conn))
			{
			  die('Error: ' . mysql_error());
			}
			return 0;
		}
		
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
	public function fetch_my_key_variable($quiz_id,$key_field_id)
	{
		$return_value="";
		$KEYFIELDFORMAT='<a class="list-group-item active">%s.%s %s</a>';
		$KEYVARIABLEFORMAT='<a class="list-group-item">
					<p class="">%s %s </p>
						<label ><input type="radio" name="radio%s" value="1" >
						%s</label><br>
						<label ><input type="radio" name="radio%s" value="2">
						%s</label><br>
						<label ><input type="radio" name="radio%s" value="3" >
						%s</label><br>
						<label ><input type="radio" name="radio%s" value="4">
						%s</label><br>
						<label ><input type="radio" name="radio%s" value="5">
						%s</label><br>
						<label ><input type="radio" name="radio%s" value="0">
						%s</label><br>
				  </a>';
		$SCRIPTFORMAT='
					<script>
						$(function(){
							set_checked("radio%s",%s);	
						});					
					</script>
						';
		//首先获取关键域的信息
		$sql="SELECT * FROM key_field WHERE id='".$key_field_id."'";
		$select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
		$key_field_info=mysql_fetch_assoc($select);
		$return_value=$return_value.sprintf($KEYFIELDFORMAT,$key_field_info["effect_field_id"],$key_field_info["id"],$key_field_info["name"]);
		//再获取这个关键域在问卷中的状态，即查看是否有答案存在
		$sql="SELECT * FROM questionnaire_content WHERE questionnaire_id='".$quiz_id."' AND key_field_id='".$key_field_id."'";
		$select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
		$my_field_info=mysql_fetch_assoc($select);		
		//然后获取该关键域下的所有关键变量
		$sql="SELECT * FROM key_variable WHERE key_field_id='".$key_field_id."' AND available='1'";
		$select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
		while ($key_variable=mysql_fetch_assoc($select))
		{
			
			$return_value=$return_value.sprintf($KEYVARIABLEFORMAT,$key_variable["id"],$key_variable["question"],$key_variable["id"],$key_variable["answer_a"],$key_variable["id"],$key_variable["answer_b"],$key_variable["id"],$key_variable["answer_c"],$key_variable["id"],$key_variable["answer_d"],$key_variable["id"],$key_variable["answer_e"],$key_variable["id"],"不了解");
			if ($key_field_info['state']!=0)
			{
				$sql="SELECT * FROM questionnaire_answer WHERE questionnaire_id='".$quiz_id."' AND key_variable_id='".$key_variable["id"]."'";
				$my_variable_select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
				$my_variable_info=mysql_fetch_assoc($my_variable_select);
				$return_value=$return_value.sprintf($SCRIPTFORMAT,$key_variable["id"],$my_variable_info["answer"]);
			}
			
		}
		return $return_value;		
		
	}
	public function fetch_key_variable($key_field_id)//根据关键域获取关键变量的问卷
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
					<p class="">%s %s </p>
						<label ><input type="radio" name="radio%s" value="1" >
						%s</label><br>
						<label ><input type="radio" name="radio%s" value="2">
						%s</label><br>
						<label ><input type="radio" name="radio%s" value="3" >
						%s</label><br>
						<label ><input type="radio" name="radio%s" value="4">
						%s</label><br>
						<label ><input type="radio" name="radio%s" value="5">
						%s</label><br>
						<label ><input type="radio" name="radio%s" value="0">
						%s</label><br>
				  </a>';
		$SCRIPTFORMAT='
					<script>
						$(function(){
							set_checked("radio%s",%s);	
						});					
					</script>
						';
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
	public function delete_key_field($quiz_id,$key_field_id,$user_id)//删除不想做的关键域
	{
		//首先删掉问卷答案部分的内容
		$sql="DELETE qa.* FROM questionnaire_answer qa,key_variable kv WHERE qa.questionnaire_id='".$quiz_id."' AND qa.key_variable_id=kv.id AND kv.key_field_id='".$key_field_id."'";
		if (!mysql_query($sql,$this->root_conn))
		{
		  die('Error: ' . mysql_error());
		}		
		//然后删除问卷关键域
		$sql="DELETE FROM questionnaire_content WHERE questionnaire_id='".$quiz_id."' AND key_field_id='".$key_field_id."'";
		if (!mysql_query($sql,$this->root_conn))
		{
		  die('Error: ' . mysql_error());
		}	
		return 1;		
	}
	public function answer_questionnaire_by_key_field($quiz_id,$answer_list)//回答问卷
	{
		//首先插入答案
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
		//标记该关键域已经作答
		//首先找到答案所属的关键域
		$sql="SELECT * FROM key_variable WHERE id='".$answer["key_variable_id"]."' ";
		$select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
		$result=mysql_fetch_assoc($select);
		
		$sql="UPDATE questionnaire_content SET state='1' WHERE questionnaire_id='".$quiz_id."' AND key_field_id='".$result["key_field_id"]."' ";
		if (!mysql_query($sql,$this->root_conn))
		{
		  die('Error: ' . mysql_error());
		}
		
		return 1;
	}
	public function fetch_set_goal($user_id,$quiz_id)//获取设置问卷目标的页面
	{
		/*
		<a href="#" class="list-group-item active">%s</a>
			  <a class="panel-group" id="accordion">
				  <div class="panel panel-default" style="margin-bottom:0px;">
					<div class="panel-heading">
					  <h4 class="panel-title">
						<a data-toggle="collapse" data-toggle="collapse" data-parent="#accordion" href="#collapse%s">
						 %s
						</a>
						<select style="float:right" id="%s">
						  <option value="1">1</option>
						  <option value="2">2</option>
						  <option value="3">3</option>
						  <option value="4" selected>4</option>
						  <option value="5">5</option>
						</select>
					  </h4>
					</div>
					<div id="collapse%s" class="panel-collapse collapse in">
					  <div class="panel-body">
						Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus <br>terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
					  </div>
					</div>
				  </div>
			  </a>
		*/
		$return_value="";
		$EFFECTFIELDFORMAT='<a href="#" class="list-group-item active">%s</a>';
		$KEYFIELDUNDOFORMATHEAD='
			<a class="panel-group" id="accordion">
				  <div class="panel panel-default" style="margin-bottom:0px;">
					<div class="panel-heading">
					  <h4 class="panel-title">
						<a data-toggle="collapse" data-toggle="collapse" data-parent="#accordion" href="#collapse%s">
						 %s
						</a>
						<select style="float:right" id="%s">';
		$KEYFIELDUNDOFORMATOPTION='<option value="%s">%s</option>';
		$KEYFIELDUNDOFORMATOPTIONSELECTED='<option value="%s" selected>%s</option>';
		$KEYFIELDUNDOFORMATTAIL='
						</select>
					  </h4>
					</div>
					<div id="collapse%s" class="panel-collapse collapse in">
					  <div class="panel-body">
							%s
					  </div>
					</div>
				  </div>
			  </a>';
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
					$return_value=$return_value.sprintf($KEYFIELDUNDOFORMATHEAD,$key_field_info["id"],$key_field_info["name"],$key_field_info["id"]);
					for ($i=1;$i<=5;$i++)
					{
						if ($i==$key_field_info["goal"])
						{
							$return_value=$return_value.sprintf($KEYFIELDUNDOFORMATOPTIONSELECTED,$i,$i);
						}else
						{
							$return_value=$return_value.sprintf($KEYFIELDUNDOFORMATOPTION,$i,$i);
						}
					}
					$sql="SELECT * FROM key_variable WHERE key_field_id='".$key_field_info["id"]."' AND available='1'";
					$key_variable_select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
					$key_variable_list="";
					while($key_variable=mysql_fetch_assoc($key_variable_select))
					{
						$temp=explode('（',$key_variable["question"]);
						$key_variable["question"]=$temp[0];
						$key_variable_list=$key_variable_list.$key_variable["question"].'<br>';
					}
					$return_value=$return_value.sprintf($KEYFIELDUNDOFORMATTAIL,$key_field_info["id"],$key_variable_list);
				}
			}
		}
		return $return_value;
		
	}
	public function set_goal($quiz_id,$goal_list)//设置目标域
	{
		foreach($goal_list as $goal)
		{
			if ($goal!="")
			{
				$temp=explode(':',$goal);
				$key_field_id=$temp[0];
				$key_field_goal=$temp[1];
				$sql="UPDATE questionnaire_content SET goal='".$key_field_goal."',state='2' WHERE questionnaire_id='".$quiz_id."' AND key_field_id='".$key_field_id."' ";
				if (!mysql_query($sql,$this->root_conn))
				{
				  die('Error: ' . mysql_error());
				}
			}
		}
		return 1;
	}
	public function fetch_preview_questionnaire($user_id,$quiz_id)
	{
		$return_value="";
		$KEYFIELDFORMAT='<a class="list-group-item active">%s.%s %s<div style="float:right"></div></a> ';
		$KEYVARIABLEFORMAT='<a class="list-group-item">
					<p class="">%s %s<button class="button-modify">修改</button></p>
						<label ><input type="radio" name="radio%s" value="1" >
						%s</label><br>
						<label ><input type="radio" name="radio%s" value="2">
						%s</label><br>
						<label ><input type="radio" name="radio%s" value="3" >
						%s</label><br>
						<label ><input type="radio" name="radio%s" value="4">
						%s</label><br>
						<label ><input type="radio" name="radio%s" value="5">
						%s</label><br>
						<label ><input type="radio" name="radio%s" value="0">
						%s</label><br>
						<script>
							$(function(){
								set_checked("radio%s",%s);	
							});					
						</script>
	
				  </a>';
		//首先获取属于该用户的所有关键域
		$sql="SELECT * FROM questionnaire_content WHERE user_id='".$user_id."' && questionnaire_id='".$quiz_id."'";
		$key_field_select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
		while ($key_field=mysql_fetch_assoc($key_field_select))
		{
			$key_field_id=$key_field["key_field_id"];
			//首先获取关键域的信息
			$sql="SELECT * FROM key_field WHERE id='".$key_field_id."'";
			$select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
			$key_field_info=mysql_fetch_assoc($select);
			$return_value=$return_value.sprintf($KEYFIELDFORMAT,$key_field_info["effect_field_id"],$key_field_info["id"],$key_field_info["name"],$key_field_info["id"]);
			
			//然后获取该关键域下的所有关键变量
			$sql="SELECT * FROM key_variable WHERE key_field_id='".$key_field_id."' AND available='1'";
			$select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
			while ($key_variable=mysql_fetch_assoc($select))
			{
				//获取关键变量的值
				$sql="SELECT * FROM questionnaire_answer WHERE questionnaire_id='".$quiz_id."' AND key_variable_id='".$key_variable["id"]."'";
				$answer_select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
				$answer=mysql_fetch_assoc($answer_select);
				$return_value=$return_value.sprintf($KEYVARIABLEFORMAT,$key_variable["id"],$key_variable["question"],$key_variable["id"],$key_variable["answer_a"],$key_variable["id"],$key_variable["answer_b"],$key_variable["id"],$key_variable["answer_c"],$key_variable["id"],$key_variable["answer_d"],$key_variable["id"],$key_variable["answer_e"],$key_variable["id"],"不了解",$key_variable["id"],$answer["answer"]);
			}
		}
		return $return_value;		
	}
	public function user_final_submit($user_id,$quiz_id,$goal_list,$answer_list,$is_public=0)
	{
		//首先修改预览后的答案
		$currentdate=date("Y-m-d H:i:s",time());;
		foreach($answer_list as $answer_item)
		{
			if ($answer_item!="")
			{
				$temp=explode(':',$answer_item);
				$key_variable_id=$temp[0];
				$answer=$temp[1];
				$sql="UPDATE questionnaire_answer SET answer='".$answer."',answer_time='".$currentdate."' WHERE questionnaire_id='".$quiz_id."' AND key_variable_id='".$key_variable_id."'";
				if (!mysql_query($sql,$this->root_conn))
				{
				  die('Error: ' . mysql_error());
				}		
			}
		} 
		//然后修改目标得分
		foreach($goal_list as $goal_item)
		{
			if ($goal_item!="")
			{
				$temp=explode(':',$goal_item);
				$key_field_id=$temp[0];
				$goal=$temp[1];		
				$sql="UPDATE questionnaire_content SET goal='".$goal."' WHERE questionnaire_id='".$quiz_id."' AND key_field_id='".$key_field_id."'";
				if (!mysql_query($sql,$this->root_conn))
				{
				  die('Error: ' . mysql_error());
				}
			}
		}
		//最后修改问卷的状态为2，表示已经提交了
		if ($is_public==0)//如果是个人问卷
		{
			$sql="UPDATE questionnaire SET state='2' WHERE id='".$quiz_id."'";
			if (!mysql_query($sql,$this->root_conn))
			{
			  die('Error: ' . mysql_error());
			}
			return 1;		
		}else
		{
			$sql="SELECT * FROM questionnaire_content WHERE questionnaire_id='".$quiz_id."' AND state!='2'";
			$select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
			$num=mysql_num_rows($select);
			if ($num==0)//全部填完了
			{
				$sql="UPDATE questionnaire SET state='2' WHERE id='".$quiz_id."'";
				if (!mysql_query($sql,$this->root_conn))
				{
				  die('Error: ' . mysql_error());
				}
				return 1;					
			}
			
		}
		return 0;
		
	}
	
	public function check_goal_set($user_id,$quiz_id)
	{
		$sql="SELECT * FROM questionnaire_content WHERE user_id='".$user_id."' AND questionnaire_id='".$quiz_id."' AND state='1'";
		$select=mysql_query($sql,$this->root_conn) or trigger_error(mysql_error(),E_USER_ERROR);
		$num=mysql_num_rows($select);
		if ($num>0)
			return 0;
		else
			return 1;
	}
	
}

?>