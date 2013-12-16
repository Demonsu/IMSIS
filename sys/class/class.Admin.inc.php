<?php

class Admin extends DB_Connect {


	public function __construct(){
		parent::__construct();
	}
	public function fetch_effect_field_list()
	{
		$return_value="";
		$EFFECTFIELDFORMAT='	
			<li class="list-group-item" id="%s">%s
				<label class="label label-danger" onclick="delete_effect_field(this)">删除</label>
				<label class="label label-info" onclick="show_hide_effect_field(this)">%s</label>
				<label class="label label-warning" onclick="modify_effect_field(this)">修改</label>
			</li>	
		';
		$ADDEFFECTFIELDFORMAT='
			<li class="list-group-item text-center" onclick="add_effect_field()"><span class="glyphicon glyphicon-plus"></span></li>
		';
		$sql="SELECT * FROM effect_field";
		$select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
		while($effect_field_info=mysql_fetch_assoc($select))
		{
			$available="隐藏";
			if ($effect_field_info["available"]==0)
				$available="显示";
			$return_value=$return_value.sprintf($EFFECTFIELDFORMAT,$effect_field_info["id"],$effect_field_info["name"],$available);
		}
		$return_value=$return_value.$ADDEFFECTFIELDFORMAT;
		return $return_value;		

	}
	public function delete_effect_field($effect_field_id)
	{
		$sql="DELETE FROM effect_field WHERE id='".$effect_field_id."'";
		if (!mysql_query($sql,$this->root_conn))
		{
		  die('Error: ' . mysql_error());
		}	
		return 1;
	}
	public function modify_effect_field($add,$effect_field_id,$name)
	{
		
		$sql="UPDATE effect_field SET name='".$name."' WHERE id='".$effect_field_id."'";
		if ($add==1)
			$sql="INSERT INTO effect_field
			(name,available)
			VALUES
			('".$name."','1')
			";
		
		if (!mysql_query($sql,$this->root_conn))
		{
		  die('Error: ' . mysql_error());
		}	
		return 1;		
	}
	public function show_or_hide_effect_field($effect_field_id,$available)
	{
		$sql="UPDATE effect_field SET available='".$available."' WHERE id='".$effect_field_id."'";
		if (!mysql_query($sql,$this->root_conn))
		{
		  die('Error: ' . mysql_error());
		}	
		return 1;	
	}
	public function fetch_key_field_list($effect_field_id)
	{
		$return_value="";
		$EFFECTFIELDFORMAT='	
			<li class="list-group-item" id="%s">%s
				<label class="label label-danger" onclick="delete_key_field(this)">删除</label>
				<label class="label label-info" onclick="show_hide_key_field(this)">%s</label>
				<label class="label label-warning" onclick="modify_key_field(this)">修改</label>
			</li>	
		';
		$ADDEFFECTFIELDFORMAT='
			<li class="list-group-item text-center" onclick="add_key_field()"><span class="glyphicon glyphicon-plus"></span></li>
		';
		$sql="SELECT * FROM key_field WHERE effect_field_id='".$effect_field_id."'";
		$select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
		while($key_field_info=mysql_fetch_assoc($select))
		{
			$available="隐藏";
			if ($key_field_info["available"]==0)
				$available="显示";
			$return_value=$return_value.sprintf($EFFECTFIELDFORMAT,$key_field_info["id"],$key_field_info["name"],$available);
		}
		$return_value=$return_value.$ADDEFFECTFIELDFORMAT;
		return $return_value;			
	}
	public function delete_key_field($key_field_id)
	{
		$sql="DELETE FROM key_field WHERE id='".$key_field_id."'";
		if (!mysql_query($sql,$this->root_conn))
		{
		  die('Error: ' . mysql_error());
		}	
		return 1;		
	}
	public function modify_key_field($add,$key_field_id,$name,$effect_field_id)
	{
		$sql="UPDATE key_field SET name='".$name."' WHERE id='".$key_field_id."'";
		if ($add==1)
			$sql="INSERT INTO key_field (name,available,effect_field_id)
			VALUES
			('".$name."','1','".$effect_field_id."')
			";
		if (!mysql_query($sql,$this->root_conn))
		{
		  die('Error: ' . mysql_error());
		}	
		return 1;				
	}
	public function show_or_hide_key_field($key_field_id,$available)
	{
		$sql="UPDATE key_field SET available='".$available."' WHERE id='".$key_field_id."'";
		if (!mysql_query($sql,$this->root_conn))
		{
		  die('Error: ' . mysql_error());
		}	
		return 1;	
	}
	public function fetch_key_variable_list($key_field_id)
	{
		$return_value="";
		$EFFECTFIELDFORMAT='	
			<li class="list-group-item" id="%s">%s
				<label class="label label-danger" onclick="delete_key_variable(this)">删除</label>
				<label class="label label-info" onclick="show_hide_key_variable(this)">%s</label>
				<label class="label label-warning" onclick="modify_key_variable(this)">修改</label>
			</li>	
		';
		$ADDEFFECTFIELDFORMAT='
			<li class="list-group-item text-center" onclick="add_key_variable()"><span class="glyphicon glyphicon-plus"></span></li>
		';
		$sql="SELECT * FROM key_variable WHERE key_field_id='".$key_field_id."'";
		$select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
		while($key_variable_info=mysql_fetch_assoc($select))
		{
			$available="隐藏";
			if ($key_variable_info["available"]==0)
				$available="显示";
			$return_value=$return_value.sprintf($EFFECTFIELDFORMAT,$key_variable_info["id"],$key_variable_info["question"],$available);
		}
		$return_value=$return_value.$ADDEFFECTFIELDFORMAT;
		return $return_value;			
	}
	public function delete_key_variable($key_variable_id)
	{
		$sql="DELETE FROM key_variable WHERE id='".$key_variable_id."'";
		if (!mysql_query($sql,$this->root_conn))
		{
		  die('Error: ' . mysql_error());
		}	
		return 1;			
	}
	public function fetch_key_variable_detail($key_variable_id)
	{
		$RESULTFORMAT='
		{
			"question":"%s",
			"answer_a":"%s",
			"answer_b":"%s",
			"answer_c":"%s",
			"answer_d":"%s",
			"answer_e":"%s"
		}';
		$sql="SELECT * FROM key_variable WHERE id='".$key_variable_id."'";
		$select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);	
		$key_variable_info=mysql_fetch_assoc($select);
		$result=sprintf($RESULTFORMAT,$key_variable_info["question"],$key_variable_info["answer_a"],$key_variable_info["answer_b"],$key_variable_info["answer_c"],$key_variable_info["answer_d"],$key_variable_info["answer_e"]);
		return $result;
	}
	public function modify_key_variable($add,$key_variable_id,$key_field_id,$question,$answer_a,$answer_b,$answer_c,$answer_d,$answer_e)
	{
		$sql="UPDATE key_variable SET question='".$question."',answer_a='".$answer_a."',answer_b='".$answer_b."',answer_c='".$answer_c."',answer_d='".$answer_d."',answer_e='".$answer_e."' WHERE id='".$key_variable_id."'";
		if ($add==1)
		{
			$sql="INSERT INTO key_variable
			(question,answer_a,answer_b,answer_c,answer_d,answer_e,available,key_field_id)
			VALUES
			('".$question."','".$answer_a."','".$answer_b."','".$answer_c."','".$answer_d."','".$answer_e."','1','".$key_field_id."')
			";
		}
		if (!mysql_query($sql,$this->root_conn))
		{
		  die('Error: ' . mysql_error());
		}	
		return 1;
	}
	public function show_or_hide_key_variable($key_variable_id,$available)
	{
		$sql="UPDATE key_variable SET available='".$available."' WHERE id='".$key_variable_id."'";
		if (!mysql_query($sql,$this->root_conn))
		{
		  die('Error: ' . mysql_error());
		}	
		return 1;	
	}
	public function fetch_effect_field_select_list()
	{
		$return_value="";
		$EFFECTLISTFORMAT='<option value="%s">%s</option>';
		$sql="SELECT * FROM effect_field";
		$select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
		while($effect_field_info=mysql_fetch_assoc($select))
		{
			$return_value=$return_value.sprintf($EFFECTLISTFORMAT,$effect_field_info["id"],$effect_field_info["name"]);
		}		
		return $return_value;
	}	
	public function fetch_key_field_select_list($effect_field_id)
	{
		$return_value="";
		$EFFECTLISTFORMAT='<option value="%s">%s</option>';
		$sql="SELECT * FROM key_field WHERE effect_field_id='".$effect_field_id."'";
		$select=mysql_query($sql,$this->root_conn)or trigger_error(mysql_error(),E_USER_ERROR);
		while($key_field_info=mysql_fetch_assoc($select))
		{
			$return_value=$return_value.sprintf($EFFECTLISTFORMAT,$key_field_info["id"],$key_field_info["name"]);
		}		
		return $return_value;
	}
}

?>