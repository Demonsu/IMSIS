<?php
class KeyField
{
	public $id;
	public $name;
	public $score;
	public $key_variable_list=array();
	public $effect_field_id;
}
$a=2;
$b=3;
$key=new KeyField();
$key->score=$a/$b;
echo $key->score;



?>