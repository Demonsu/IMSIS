var effect_field_change = true;
var key_field_change = true;
var key_variable_change = true;

var effect_field1;
var key_field2;
$(document).ready(function(){
	$('#manage-effect-field').click(function(){
		hide();
		$.ajax({
			type:'POST',
			url:'handle/admin_zone.php',
			data:{
				operation:'FETCHEFFECTFIELDLIST'
			},
			success:function(data){
				$('#effect-field-list').html(data);
			}
		});
		$('#change-effect-field').show();
	});
	$('#manage-key-field').click(function(){
		hide();
		$.ajax({
			type:'POST',
			url:'handle/admin_zone.php',
			data:{
				operation:'FETCHEFFECTFIELDSELECTLIST'
			},
			success:function(data){
				$('#fetch-effect-field-list').html('<option value=0>请选择作用域</option>'+data);
			}
		});
		$('#change-key-field').show();
	});
	$('#fetch-effect-field-list').change(function(){
		effect_field1 = $('#fetch-effect-field-list').val()
		fetch_key_field_list(effect_field1);
	});
	$('#manage-key-variable').click(function(){
		hide();
		$.ajax({
			type:'POST',
			url:'handle/admin_zone.php',
			data:{
				operation:'FETCHEFFECTFIELDSELECTLIST'
			},
			success:function(data){
				$('#fetch-effect-field-list2').html('<option value=0>请选择作用域</option>'+data);
			}
		});
		$('#change-key-variable').show();
	});
	$('#fetch-effect-field-list2').change(function(){
		$.ajax({
			type:'POST',
			url:'handle/admin_zone.php',
			data:{
				operation:'FETCHKEYFIELDSELECTLIST'
			},
			success:function(data){
				$('#fetch-key-field-list2').html('<option value=0>请选择关键域</option>'+data);
			}
		});
	});
	$('#fetch-key-field-list2').change(function(){
		key_field2 = $('#fetch-key-field-list2').val()
		fetch_key_field_list(key_field2);
	});
	//作用域
	$('#confirm-effect-field').click(function(){
		if(effect_field_change){
			$.ajax({
				type:'POST',
				url:'handle/admin_zone.php',
				data:{
					operation:'MODIFYEFFECTFIELD',
					add:0,
					effect_field_id:$('#effect-field-id').val(),
					name:$('#effect-field-input').val()
				},
				success:function(data){
					if(data == 1){
						$('#manage-effect-field').click();
					}
				}
			});
		}
		else{
			$.ajax({
				type:'POST',
				url:'handle/admin_zone.php',
				data:{
					operation:'MODIFYEFFECTFIELD',
					add:1,
					effect_field_id:'',
					name:$('#effect-field-input').val()
				},
				success:function(data){
					if(data == 1){
						$('#manage-effect-field').click();
					}
				}
			});
		}
	});
	$('#cancel-effect-field').click(function(){
		$('#effect-field-input').val('');
		$('#effect-field-cover').hide();
	});
	//关键域
	$('#confirm-key-field').click(function(){
		if(effect_field_change){
			$.ajax({
				type:'POST',
				url:'handle/admin_zone.php',
				data:{
					operation:'MODIFYKEYFIELD',
					add:0,
					key_field_id:$('#effect-field-id').val(),
					name:$('#key-field-input').val()
				},
				success:function(data){
					if(data == 1){
						fetch_key_field_list(effect_field1);
					}
				}
			});
		}
		else{
			$.ajax({
				type:'POST',
				url:'handle/admin_zone.php',
				data:{
					operation:'MODIFYKEYFIELD',
					add:1,
					key_field_id:'',
					name:$('#key-field-input').val()
				},
				success:function(data){
					if(data == 1){
						fetch_key_field_list(effect_field1);
					}
				}
			});
		}
	});
	$('#cancel-key-field').click(function(){
		$('#key-field-input').val('');
		$('#key-field-cover').hide();
	});
	//关键域
	$('#confirm-key-variable').click(function(){
		if(effect_field_change){
			$.ajax({
				type:'POST',
				url:'handle/admin_zone.php',
				data:{
					operation:'MODIFYKEYVARIABLE',
					add:0,
					key_variable_id:$('#effect-variable-id').val(),
					name:$('#key-variable-input').val()
				},
				success:function(data){
					if(data == 1){
						fetch_key_variable_list(key_field2);
					}
				}
			});
		}
		else{
			$.ajax({
				type:'POST',
				url:'handle/admin_zone.php',
				data:{
					operation:'MODIFYKEYVARIABLE',
					add:1,
					key_variable_id:'',
					name:$('#key-variable-input').val()
				},
				success:function(data){
					if(data == 1){
						fetch_key_variable_list(key_field2);
					}
				}
			});
		}
	});
	$('#cancel-key-variable').click(function(){
		$('#key-variable-input').val('');
		$('#key-variable-cover').hide();
	});
});
function fetch_key_field_list(t){
	$.ajax({
		type:'POST',
		url:'handle/admin_zone.php',
		data:{
			operation:'FETCHKEYFIELDLIST',
			effect_field_id:t
		},
		success:function(data){
			$('#key-field-list').html(data);
		}
	});
}
function fetch_key_variable_list(t){

}
//这里是作用域的操作
function delete_effect_field(t){
	alert('警告！此操作不可逆！');
	alert('删除后你将再也看不到与该关键域相关的东西');
	var returnType = window.confirm('确认删除吗？')
	if(returnType){
		$.ajax({
			type:'POST',
			url:'handle/admin_zone',
			data:{
				operation:'DELETEEFFECTFIELD',
				effect_field_id:t.parentNode.id
			},
			success:function(data){
				if(data == 1){
					alert('删除成功');
				}
				else
					alert(data);
			}
		});
	} 
}
function modify_effect_field(t){
	//alert($(t.parentNode).text().substr(0,$(t.parentNode).text().length-22));
	effect_field_change = true;
	$('#effect-field-title').text('修改作用域名称');
	$('#effect-field-id').val(t.parentNode.id);
	$('#effect-field-input').val($(t.parentNode).text().substr(0,$(t.parentNode).text().length-27));
	$('#effect-field-cover').show();
}
function add_effect_field(){
	effect_field_change = false;
	$('#effect-field-title').text('新的作用域名称');
	$('#effect-field-cover').show();
}
function show_hide_effect_field(t){
	var temp;
	if($(t).text() == '显示'){
		temp = 0;
	}
	else
		temp = 1;
	
	$.ajax({
		type:'POST',
		url:'handle/admin_zone.php',
		data:{
			operation:'SHOWORHIDEEFFECTFIELD',
			available:temp
		},
		success:function(data){
			if(data == 1){
				if(temp == 0)
					$(t).text('隐藏');
				else
					$(t).text('显示');
			}
			else{
				alert(data);
			}
		}
	});
}
//这里是关键域的操作
function delete_key_field(t){
	alert('警告！此操作不可逆！');
	alert('删除后你将再也看不到与该关键域相关的东西');
	var returnType = window.confirm('确认删除吗？')
	if(returnType){
		$.ajax({
			type:'POST',
			url:'handle/admin_zone',
			data:{
				operation:'DELETEKEYFIELD',
				key_field_id:t.parentNode.id
			},
			success:function(data){
				if(data == 1){
					alert('删除成功');
				}
				else
					alert(data);
			}
		});
	} 
}
function modify_key_field(t){
	//alert($(t.parentNode).text().substr(0,$(t.parentNode).text().length-22));
	key_field_change = true;
	$('#key-field-title').text('修改关键域名称');
	$('#key-field-id').val(t.parentNode.id);
	$('#key-field-input').val($(t.parentNode).text().substr(0,$(t.parentNode).text().length-27));
	$('#key-field-cover').show();
}
function add_key_field(){
	key_field_change = false;
	$('#key-field-title').text('新的关键域名称');
	$('#key-field-cover').show();
}
function show_hide_key_field(t){
	var temp;
	if($(t).text() == '显示'){
		temp = 0;
	}
	else
		temp = 1;
	
	$.ajax({
		type:'POST',
		url:'handle/admin_zone.php',
		data:{
			operation:'SHOWORHIDEKEYFIELD',
			available:temp
		},
		success:function(data){
			if(data == 1){
				if(temp == 0)
					$(t).text('隐藏');
				else
					$(t).text('显示');
			}
			else{
				alert(data);
			}
		}
	});
}
//关键变量
function delete_key_variable(t){
	alert('警告！此操作不可逆！');
	alert('删除后你将再也看不到与该关键域相关的东西');
	var returnType = window.confirm('确认删除吗？')
	if(returnType){
		$.ajax({
			type:'POST',
			url:'handle/admin_zone',
			data:{
				operation:'DELETEKEYVARIABLE',
				key_variable_id:t.parentNode.id
			},
			success:function(data){
				if(data == 1){
					alert('删除成功');
				}
				else
					alert(data);
			}
		});
	} 
}
function modify_key_variable(t){
	//alert($(t.parentNode).text().substr(0,$(t.parentNode).text().length-22));
	key_variable_change = true;
	$('#key-variable-title').text('修改关键域名称');
	$('#key-variable-id').val(t.parentNode.id);
	$.ajax({
		type:'POST',
		url:'handle/admin_zone.php',
		data:{
			operation:'FETCHKEYVARIABLEDETAIL',
			key_variable_id:t.parentNode.id
		},
		success:function(str){
			var data = jQuery.parseJSON(str);
			$('#key_variable_question').val(data.question);
			$('#key_variable_a').val(data.answer_a);
			$('#key_variable_b').val(data.answer_b);
			$('#key_variable_c').val(data.answer_c);
			$('#key_variable_d').val(data.answer_d);
			$('#key_variable_e').val(data.answer_e);
		}
	});
	$('#key-variable-cover').show();
}
function add_key_variable(){
	key_variable_change = false;
	$('#key-variable-title').text('新的关键域名称');
	$('#key-variable-cover').show();
}
function show_hide_key_variable(t){
	var temp;
	if($(t).text() == '显示'){
		temp = 0;
	}
	else
		temp = 1;
	
	$.ajax({
		type:'POST',
		url:'handle/admin_zone.php',
		data:{
			operation:'SHOWORHIDEKEYVARIABLE',
			available:temp
		},
		success:function(data){
			if(data == 1){
				if(temp == 0)
					$(t).text('隐藏');
				else
					$(t).text('显示');
			}
			else{
				alert(data);
			}
		}
	});
}
function hide(){
	$('#change-effect-field').hide();
	$('#change-key-field').hide();
	$('#change-key-variable').hide();
}