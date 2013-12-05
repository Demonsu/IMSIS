<?php

class System extends DB_Connect {


	public function __construct(){
		parent::__construct();
	}
	public function fetch_province()
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
	public function fetch_city($province)
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
}

?>