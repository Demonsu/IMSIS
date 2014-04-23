<?php
function strlen_utf8($str) 
{  
	$i = 0;  
	$count = 0;  
	$len = strlen ($str);  
	while ($i < $len) 
	{  
		$chr = ord ($str[$i]);  
		$count++;  
		$i++;  
		if($i >= $len) break;  
		if($chr & 0x80) 
		{  
			$chr <<= 1;  
			while ($chr & 0x80) 
			{  
				$i++;  
				$chr <<= 1;  
			}  
		}  
	}  
	return $count;  
} 
class System extends DB_Connect {


	public function __construct(){
		parent::__construct();
	}
	public function add()//添加省政府
	{
		$sql="SELECT * FROM province";
		$select=mysql_query($sql,$this->root_conn) or trigger_error(mysql_error(),E_USER_ERROR);
		while ($result=mysql_fetch_assoc($select))
		{
			$city_code=$result["code"]+1;
			$sql="INSERT INTO city
			(
				code,name,province_code
			)
			VALUES
			(
				'".$city_code."','省政府','".$result["code"]."'
			)
			";
			if (!mysql_query($sql,$this->root_conn))
			{
			  die('Error: ' . mysql_error());
			}
		}
	}
	public function fetch_province()//获取省列表
	{
		$return_value="";
		$format='<option value="%u">%s</option>';
		$sql="SELECT * FROM province";
		$select=mysql_query($sql,$this->root_conn) or trigger_error(mysql_error(),E_USER_ERROR);
		while ($result=mysql_fetch_assoc($select))
		{
			$return_value=$return_value.sprintf($format,$result['code'],$result['name']);
		}
		return $return_value;
	}
	public function fetch_city($province)//获取市列表
	{
		$return_value="";
		$format='<option value="%u">%s</option>';
		$sql="SELECT * FROM city WHERE province_code='".$province."' ORDER BY code";
		$select=mysql_query($sql,$this->root_conn) or trigger_error(mysql_error(),E_USER_ERROR);
		while ($result=mysql_fetch_assoc($select))
		{
			$return_value=$return_value.sprintf($format,$result['code'],$result['name']);
		}
		return $return_value;
	}
	public function fetch_department()//获取部门列表	
	{
		$return_value="";
		$format='<option value="%s">%s</option>';
		$sql="SELECT * FROM department";
		$select=mysql_query($sql,$this->root_conn) or trigger_error(mysql_error(),E_USER_ERROR);
		while ($result=mysql_fetch_assoc($select))
		{
			$return_value=$return_value.sprintf($format,$result['name'],$result['name']);
		}
		return $return_value;		
	}
	public function fetch_title()//获取职称	
	{
		$return_value="";
		$format='<option value="%s">%s</option>';
		$sql="SELECT * FROM title";
		$select=mysql_query($sql,$this->root_conn) or trigger_error(mysql_error(),E_USER_ERROR);
		while ($result=mysql_fetch_assoc($select))
		{
			$return_value=$return_value.sprintf($format,$result['name'],$result['name']);
		}
		return $return_value;		
	}
	public function fetch_speciality()//获取专长	
	{
		$return_value="";
		$format='<option value="%s">%s</option>';
		$sql="SELECT * FROM speciality";
		$select=mysql_query($sql,$this->root_conn) or trigger_error(mysql_error(),E_USER_ERROR);
		while ($result=mysql_fetch_assoc($select))
		{
			$return_value=$return_value.sprintf($format,$result['name'],$result['name']);
		}
		return $return_value;		
	}
	public function fetch_oncharge()//获取负责工作	
	{
		$return_value="";
		$format='<option value="%s">%s</option>';
		$sql="SELECT * FROM oncharge";
		$select=mysql_query($sql,$this->root_conn) or trigger_error(mysql_error(),E_USER_ERROR);
		while ($result=mysql_fetch_assoc($select))
		{
			$return_value=$return_value.sprintf($format,$result['name'],$result['name']);
		}
		return $return_value;		
	}

	public function fetch_discovery_share_list()
	{
		$FIRSTSHARE='			
			<div style="border:1px solid #aaaaaa;padding:3px;margin-top:10px;">
				<a href="./assets/upload/files/%s" target="_blank" title="%s">
					<img src="./assets/upload/pics/%s" width="277px" height="90px"/>
				</a>
			</div>
			';
		$SHAREFORMAT='				
			<ul class="list-group" style="margin-left:-7px;margin-top:10px;" >
				%s
			
			</ul>
		';
		$SHAREITEMFORMAT='
			<li class="list-group-item list-group-item-success">
			<img src="./assets/img/index/icon/%s.png" style="width:24px;margin:2px"/>
			<a title="点击下载" href="./assets/upload/files/%s" target="_blank">%s</a>
			<span style="float:right;margin-top:6px;font-size:10px">%s</span></li>
			
		';		
		$sql="SELECT * FROM discovery_share ORDER BY sort_value DESC LIMIT 7";
		$select=mysql_query($sql,$this->root_conn) or trigger_error(mysql_error(),E_USER_ERROR);
		$first=mysql_fetch_assoc($select);
		$first_item=sprintf($FIRSTSHARE,$first["url"],$first["title"],$first["img_url"]);
		$share_body="";
		while ($share=mysql_fetch_assoc($select))
		{
			$temp_time=explode(" ",$share["time"]);
			if (strlen_utf8($share["title"])>13)
				$share["title"]=mb_substr($share["title"],0,13,'utf-8')."...";
			$share_body=$share_body.sprintf($SHAREITEMFORMAT,$share["type"],$share["url"],$share["title"],$temp_time[0]);
		}
		return $first_item.sprintf($SHAREFORMAT,$share_body);
	}
	
	public function fetch_news_list()
	{
		$FIRSTNESFORMAT='
		<div style="border:1px solid #aaaaaa;padding:3px;margin-top:10px;">
		<a id="news_%s" onclick="opennews(this)">
			<img src="./assets/upload/pics/%s" title="%s" width="277px" height="90px"/></a>
		</div>';
		$NEWSITEM='
			<li class="list-group-item list-group-item-success">
			<img src="./assets/img/index/list.png" width="28px" />
			<a title="点击预览"  id="news_%s" onclick="opennews(this)">%s</a>
			<span style="float:right;margin-top:6px;font-size:10px">%s</span></li>
		';
		$NEWS='
			<ul class="list-group" style="margin-left:-7px;margin-top:10px;" >
			%s
			
			</ul>
		';
		$sql="SELECT * FROM news ORDER BY sort_value DESC LIMIT 7";
		$select=mysql_query($sql,$this->root_conn) or trigger_error(mysql_error(),E_USER_ERROR);
		$first=mysql_fetch_assoc($select);
		$first_item=sprintf($FIRSTNESFORMAT,$first["id"],$first["img_url"],$first["title"]);
		$news_body="";
		while ($news=mysql_fetch_assoc($select))
		{
			$temp_time=explode(" ",$news["time"]);
			if (strlen_utf8($news["title"])>14)
				$news["title"]=mb_substr($news["title"],0,14,'utf-8')."...";
			$news_body=$news_body.sprintf($NEWSITEM,$news["id"],$news["title"],$temp_time[0]);
		}
		return $first_item.sprintf($NEWS,$news_body);		
	}
	public function fetch_share_list_2()
	{
		$SHAREFORMAT='			
		<div class="media">
			  <a class="pull-left">
				<img class="media-object" src="../assets/img/index/icon/%s.png" width="64px">
			  </a>
			  <div class="media-body">
				<h4 class="media-heading"><a href="../assets/upload/files/%s">%s</a><span style="float:right">%s</span></h4>
				%s
			  </div>
		</div>
		';
		$sql="SELECT * FROM discovery_share ORDER BY sort_value DESC";
		$select=mysql_query($sql,$this->root_conn) or trigger_error(mysql_error(),E_USER_ERROR);
		$return_value="";
		while ($share=mysql_fetch_assoc($select))
		{

			$return_value=$return_value.sprintf($SHAREFORMAT,$share["type"],$share["url"],$share["title"],$share["time"],$share["content"]);
		}
		return $return_value;
		
	}
	public function fetch_news_list_2()
	{
		$NEWSFORMAT='
		<tr>
			<td><a id="news_%s" onclick="opennews(this)">%s</a></td>
			<td>%s</td>	
		</tr>';
		$sql="SELECT * FROM news ORDER BY sort_value DESC";
		$select=mysql_query($sql,$this->root_conn) or trigger_error(mysql_error(),E_USER_ERROR);
		$return_value="";
		while ($news=mysql_fetch_assoc($select))
		{
			$return_value=$return_value.sprintf($NEWSFORMAT,$news["id"],$news["title"],$news["time"]);
		}
		return $return_value;
	}
	public function fetch_news_detail($id)
	{
		//htmlspecialchars_decode($comment_row['comment'],ENT_QUOTES)));
		$sql="SELECT * FROM news WHERE id='".$id."'";
		$select=mysql_query($sql,$this->root_conn) or trigger_error(mysql_error(),E_USER_ERROR);
		$news=mysql_fetch_assoc($select);	
		return $news["content"];
	}
	public function search_website($key_word)
	{
		$ITEMFORMAT='
			{
				"title":"%s",
				"time":"%s",
				"type":"%s",
				"id":"%s"
			}';	
		$return_value="";
		$sql="SELECT * FROM news WHERE title like '%".$key_word."%' or content like '%".$key_word."%' or time like '%".$key_word."%'";
		$select=mysql_query($sql,$this->root_conn) or trigger_error(mysql_error(),E_USER_ERROR);
		while($news=mysql_fetch_assoc($select))
		{
			if ($return_value!="")
			{
				$return_value=$return_value.",";
			}
			$return_value=$return_value.sprintf($ITEMFORMAT,$news["title"],$news["time"],"news",$news["id"]);
		}
		$sql="SELECT * FROM discovery_share WHERE title like '%".$key_word."%' or content like '%".$key_word."%' or time like '%".$key_word."%'";
		$select=mysql_query($sql,$this->root_conn) or trigger_error(mysql_error(),E_USER_ERROR);
		while($share=mysql_fetch_assoc($select))
		{
			if ($return_value!="")
			{
				$return_value=$return_value.",";
			}
			$return_value=$return_value.sprintf($ITEMFORMAT,$share["title"],$share["time"],"share",$share["url"]);
		}		
		
		return "[".$return_value."]";
			
	}
	
	public function answer_gov_quiz($answer_list,$question_suggestion,$quiz_suggestion)//第二份问卷
	{
		foreach($answer_list as $answer_item)
		{
			if ($answer_item!="")
			{
				$temp=explode(":",$answer_item);
				$answer_id=$temp[0];
				$answer=$temp[1];
				$sql="UPDATE gov_quiz_answer_statistic SET answer_".$answer."=answer_".$answer."+1 WHERE id='".$answer_id."'";
				if (!mysql_query($sql,$this->root_conn))
				{
				  die('Error: ' . mysql_error());
				}	
			}
		}
		
		$sql="INSERT INTO gov_quiz_question_suggestion
		(
			answer
		)VALUES
		(
			'".$question_suggestion."'
		)";
		if (!mysql_query($sql,$this->root_conn))
		{
		  die('Error: ' . mysql_error());
		}
		
		$sql="INSERT INTO gov_quiz_suggestion
		(
			answer
		)VALUES
		(
			'".$quiz_suggestion."'
		)";
		if (!mysql_query($sql,$this->root_conn))
		{
		  die('Error: ' . mysql_error());
		}
		return 1;
	}
	public function answer_pub_quiz($answer_list,$quiz_suggestion)
	{
		$index=1;
		foreach($answer_list as $answer_item)
		{
			if ($answer_item!="")
			{
				$temp=explode(":",$answer_item);
				$answer_id=$temp[0];
				$answer=$temp[1];
				$sql="";
				if ($index==2)
				{
					$sql="UPDATE pub_quiz_answer_statistic SET answer_1=answer_1+'".$answer."' WHERE id='".$answer_id."'";
				}else
				if ($index==6)
				{
					$sql="UPDATE pub_quiz_answer_statistic SET answer_1=answer_1+'".$answer."' WHERE id='".$answer_id."'";
				}
				else
				$sql="UPDATE pub_quiz_answer_statistic SET answer_".$answer."=answer_".$answer."+1 WHERE id='".$answer_id."'";
				if (!mysql_query($sql,$this->root_conn))
				{
				  die('Error: ' . mysql_error());
				}
				$index++;	
			}
		}
		
		$sql="INSERT INTO pub_quiz_suggestion
		(
			suggestion
		)VALUES
		(
			'".$quiz_suggestion."'
		)";
		if (!mysql_query($sql,$this->root_conn))
		{
		  die('Error: ' . mysql_error());
		}	
		return 1;
	}
	public function fetch_gov_quiz_statistic()
	{
		$statistic_list="";
		$sql="SELECT * FROM gov_quiz_answer_statistic";
		$select=mysql_query($sql,$this->root_conn) or trigger_error(mysql_error(),E_USER_ERROR);
		while($result=mysql_fetch_assoc($select))		
		{
			//echo $statistic_list;
			if ($statistic_list!="")
				$statistic_list=$statistic_list.",";	
			$statistic_list=$statistic_list.sprintf("[%s,%s,%s,%s,%s]",$result["answer_1"],$result["answer_2"],$result["answer_3"],$result["answer_4"],$result["answer_5"]);
			//echo $statistic_list."<br>";
		}
		return "[".$statistic_list."]";
	}
	public function fetch_gov_quiz_question_suggestion()
	{
		$suggestion_list="";
		$sql="SELECT * FROM gov_quiz_question_suggestion";
		$select=mysql_query($sql,$this->root_conn) or trigger_error(mysql_error(),E_USER_ERROR);
		while($result=mysql_fetch_assoc($select))		
		{
			//echo $statistic_list;
			if ($suggestion_list!="")
				$suggestion_list=$suggestion_list.",";	
			$suggestion_list=$suggestion_list.'"'.$result["answer"].'"';
			//echo $statistic_list."<br>";
		}		
		return "[".$suggestion_list."]";
	}
	public function fetch_gov_quiz_suggestion()
	{
		$suggestion_list="";
		$sql="SELECT * FROM gov_quiz_suggestion";
		$select=mysql_query($sql,$this->root_conn) or trigger_error(mysql_error(),E_USER_ERROR);
		while($result=mysql_fetch_assoc($select))		
		{
			//echo $statistic_list;
			if ($suggestion_list!="")
				$suggestion_list=$suggestion_list.",";	
			$suggestion_list=$suggestion_list.'"'.$result["answer"].'"';
			//echo $statistic_list."<br>";
		}		
		return "[".$suggestion_list."]";	
	}
	public function fetch_pub_quiz_statistics()
	{
		$statistic_list="";
		$sql="SELECT * FROM pub_quiz_answer_statistic";
		$select=mysql_query($sql,$this->root_conn) or trigger_error(mysql_error(),E_USER_ERROR);
		while($result=mysql_fetch_assoc($select))		
		{
			//echo $statistic_list;
			if ($statistic_list!="")
				$statistic_list=$statistic_list.",";	
			$statistic_list=$statistic_list.sprintf("[%s,%s,%s,%s,%s,%s,%s,%s]",$result["answer_1"],$result["answer_2"],$result["answer_3"],$result["answer_4"],$result["answer_5"],$result["answer_6"],$result["answer_7"],$result["answer_8"]);
			//echo $statistic_list."<br>";
		}
		return "[".$statistic_list."]";		
	}
	public function fetch_pub_quiz_suggestion()
	{
		$suggestion_list="";
		$sql="SELECT * FROM pub_quiz_suggestion";
		$select=mysql_query($sql,$this->root_conn) or trigger_error(mysql_error(),E_USER_ERROR);
		while($result=mysql_fetch_assoc($select))		
		{
			//echo $statistic_list;
			if ($suggestion_list!="")
				$suggestion_list=$suggestion_list.",";	
			$suggestion_list=$suggestion_list.'"'.$result["suggestion"].'"';
			//echo $statistic_list."<br>";
		}		
		return "[".$suggestion_list."]";		
	}
	
	
	
	
	
}

?>