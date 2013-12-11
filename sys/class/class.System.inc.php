<?php

class System extends DB_Connect {


	public function __construct(){
		parent::__construct();
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
		$sql="SELECT * FROM city WHERE province_code='".$province."'";
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
		$format='<option value="%u">%s</option>';
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
		$format='<option value="%u">%s</option>';
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
		$format='<option value="%u">%s</option>';
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
		$format='<option value="%u">%s</option>';
		$sql="SELECT * FROM oncharge";
		$select=mysql_query($sql,$this->root_conn) or trigger_error(mysql_error(),E_USER_ERROR);
		while ($result=mysql_fetch_assoc($select))
		{
			$return_value=$return_value.sprintf($format,$result['name'],$result['name']);
		}
		return $return_value;		
	}
}

?>