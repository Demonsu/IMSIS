<?php

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
					<img src="./assets/upload/pics/%s" width="277px" height="139px"/>
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
			<a title="点击预览" href="./assets/upload/files/%s" target="_blank">%s</a></li>
		';		
		$sql="SELECT * FROM discovery_share ORDER BY sort_value DESC LIMIT 4";
		$select=mysql_query($sql,$this->root_conn) or trigger_error(mysql_error(),E_USER_ERROR);
		$first=mysql_fetch_assoc($select);
		$first_item=sprintf($FIRSTSHARE,$first["url"],$first["title"],$first["img_url"]);
		$share_body="";
		while ($share=mysql_fetch_assoc($select))
		{
			$share_body=$share_body.sprintf($SHAREITEMFORMAT,$share["type"],$share["url"],$share["title"]);
		}
		return $first_item.sprintf($SHAREFORMAT,$share_body);
	}
	
	public function fetch_news_list()
	{
		$FIRSTNESFORMAT='
		<div style="border:1px solid #aaaaaa;padding:3px;margin-top:10px;">
		<a id="news_%s" onclick="opennews(this)">
			<img src="./assets/upload/pics/%s" title="%s" width="277px" height="139px"/></a>
		</div>';
		$NEWSITEM='
			<li class="list-group-item list-group-item-success">
			<img src="./assets/img/index/list.png" width="28px" />
			<a title="点击下载"  id="news_%s" onclick="opennews(this)">%s</a></li>
		';
		$NEWS='
			<ul class="list-group" style="margin-left:-7px;margin-top:10px;" >
			%s
			</ul>
		';
		$sql="SELECT * FROM news ORDER BY sort_value DESC LIMIT 4";
		$select=mysql_query($sql,$this->root_conn) or trigger_error(mysql_error(),E_USER_ERROR);
		$first=mysql_fetch_assoc($select);
		$first_item=sprintf($FIRSTNESFORMAT,$first["id"],$first["img_url"],$first["title"]);
		$news_body="";
		while ($news=mysql_fetch_assoc($select))
		{
			$news_body=$news_body.sprintf($NEWSITEM,$news["id"],$news["title"]);
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
				<h4 class="media-heading"><a href="../assets/upload/files/%s">%s</a></h4>
				aa%s
			  </div>
		</div>
		';
		$sql="SELECT * FROM discovery_share ORDER BY sort_value DESC";
		$select=mysql_query($sql,$this->root_conn) or trigger_error(mysql_error(),E_USER_ERROR);
		$return_value="";
		while ($share=mysql_fetch_assoc($select))
		{
			$return_value=$return_value.sprintf($SHAREFORMAT,$share["type"],$share["url"],$share["title"],$share["content"]);
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
		return htmlspecialchars_decode($news["content"],ENT_QUOTES);
	}
	
	
	
	
	
	
	
	
	
}

?>