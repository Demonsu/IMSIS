var effect_field_change = true;
var key_field_change = true;
var key_variable_change = true;
$(document).ready(function(){
	$('#manage-effect-field').click(function(){
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
		hide();
		$('#change-effect-field').show();
	});
	$('#manage-key-field').click(function(){
		hide();
		$('#change-key-field').show();
	});
	$('#manage-key-variable').click(function(){
		hide();
		$('#change-key-variable').show();
	});
	
	$('#confirm-effect-field').click(function(){
		if(effect_field_change){
			$.ajax({
				type:'POST',
				url:'handle/admin_zone.php',
				data:{
					operation:'MODIFYEFFECTFIELD',
					add:0,
					effect_field_id:t.parentNode.id,
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
					effect_field_id:t.parentNode.id,
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
});

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
function hide(){
	$('#change-effect-field').hide();
	$('#change-key-field').hide();
	$('#change-key-variable').hide();
}