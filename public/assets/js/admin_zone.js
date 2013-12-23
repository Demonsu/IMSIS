var effect_field_change = true;
var key_field_change = true;
var key_variable_change = true;

var effect_field1;
var key_field2;

$(document).ready(function(){
	//管理动态新闻
	$('#manage-news').click(function(){
		hide();
		$.ajax({
			type:'POST',
			url:'./handle/admin_zone.php',
			data:{
				operation:'FETCHNEWSLIST'
			},
			success:function(data){
				//alert(data);
				$('#news-list').html(data);
				hide();
				$('#change-news').show();
			}
		});
	});
	$('#manage-share').click(function(){
		hide();
		$.ajax({
			type:'POST',
			url:'./handle/admin_zone.php',
			data:{
				operation:'FETCHDISCOVERYLIST'
			},
			success:function(data){
				//alert(data);
				$('#share-list').html(data);
				hide();
				$('#change-share').show();
			}
		});
	});
	//
	$('#manage-effect-field').click(function(){
		hide();
		$.ajax({
			type:'POST',
			url:'handle/admin_zone.php',
			data:{
				operation:'FETCHEFFECTFIELDLIST'
			},
			success:function(data){
				//alert(data.substr(1000,data.length));
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
				$('#key-field-list').html('');
			}
		});
		$('#change-key-field').show();
	});
	$('#fetch-effect-field-list').change(function(){
		effect_field1 = $('#fetch-effect-field-list').val()
		if(effect_field1 != 0)
			fetch_key_field_list(effect_field1);
		else
			$('#key-field-list').html('');
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
				$('#key-variable-list').html('');
			}
		});
		$('#change-key-variable').show();
	});
	$('#fetch-effect-field-list2').change(function(){
		$.ajax({
			type:'POST',
			url:'handle/admin_zone.php',
			data:{
				operation:'FETCHKEYFIELDSELECTLIST',
				effect_field_id:$('#fetch-effect-field-list2').val()
			},
			success:function(data){
				//alert(data);
				$('#fetch-key-field-list2').html('<option value=0>请选择关键域</option>'+data);
			}
		});
	});
	$('#fetch-key-field-list2').change(function(){
		key_field2 = $('#fetch-key-field-list2').val()
		if(key_field2 != 0)
			fetch_key_variable_list(key_field2);
		else
			$('#key-variable-list').html('');
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
						$('#effect-field-cover').hide();
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
						$('#effect-field-cover').hide();
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
		if(key_field_change){
			$.ajax({
				type:'POST',
				url:'handle/admin_zone.php',
				data:{
					operation:'MODIFYKEYFIELD',
					add:0,
					effect_field_id:$('#fetch-effect-field-list').val(),
					key_field_id:$('#key-field-id').val(),
					name:$('#key-field-input').val()
				},
				success:function(data){
					if(data == 1){
						fetch_key_field_list(effect_field1);
						$('#key-field-cover').hide();
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
					effect_field_id:$('#fetch-effect-field-list').val(),
					key_field_id:'',
					name:$('#key-field-input').val()
				},
				success:function(data){
					if(data == 1){
						fetch_key_field_list(effect_field1);
						$('#key-field-cover').hide();
					}
					else
						alert(data);
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
		if(key_variable_change){
			$.ajax({
				type:'POST',
				url:'handle/admin_zone.php',
				data:{
					operation:'MODIFYKEYVARIABLE',
					add:0,
					key_field_id:$('#fetch-key-field-list2').val(),
					key_variable_id:$('#key-variable-id').val(),
					question:$('#key_variable_question').val(),
					answer_a:$('#key_variable_a').val(),
					answer_b:$('#key_variable_b').val(),
					answer_c:$('#key_variable_c').val(),
					answer_d:$('#key_variable_d').val(),
					answer_e:$('#key_variable_e').val()
				},
				success:function(data){
					if(data == 1){
						fetch_key_variable_list(key_field2);
						$('#key-variable-cover').hide();
					}
					else 
						alert(data);
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
					key_field_id:$('#fetch-key-field-list2').val(),
					key_variable_id:'0',
					question:$('#key_variable_question').val(),
					answer_a:$('#key_variable_a').val(),
					answer_b:$('#key_variable_b').val(),
					answer_c:$('#key_variable_c').val(),
					answer_d:$('#key_variable_d').val(),
					answer_e:$('#key_variable_e').val()
				},
				success:function(data){
					if(data == 1){
						fetch_key_variable_list(key_field2);
						$('#key-variable-cover').hide();
					}
					else 
						alert(data);
				}
			});
		}
	});
	$('#cancel-key-variable').click(function(){
		$('#key-variable-input').val('');
		$('#key-variable-cover').hide();
	});
	
	
	
	$('#manage-target').click(function(){
		hide();
		fetch_target_form();
		$('#target-change').show();
	});
	
	$('#newPasswd').blur(function(){
		var passwd = $('#newPasswd').val();
		var pattern = new RegExp(/^[a-zA-Z0-9_]{6,20}$/);
		if(passwd.length >20 || passwd.length < 6){
			$('#errorPassword').text('密码长度限制为6~20个字符');
			$('.hasPasswd').addClass('has-error');
			check_passwd = false;
		}
		else if(!pattern.test(passwd)){
			$('#errorPassword').text('密码要求:字母大小写、数字、下划线(_)');
			$('.hasPasswd').addClass('has-error');
			check_passwd = false;
		}
		else{
			$('#errorPassword').text('密码可用');
			$('.hasPasswd').removeClass('has-error');
			check_passwd = true;
		}
	});
	$('#confirmPasswd').blur(function(){
		var passwd1 = $('#newPasswd').val();
		var passwd2 = $('#confirmPasswd').val();
		if(passwd1 != passwd2){
			$('#errorConfirmPassword').text('两次输入密码不相符');
			$('.hasConfirm').addClass('has-error');
			confirm_passwd = false;
		}
		else{
			$('#errorConfirmPassword').text('');
			$('.hasConfirm').removeClass('has-error');
			confirm_passwd = true;
		}
	});
	$('#change-passwd').click(function(){
		hide();
		$('#passwd-reset').show();
	});
	$('#btn-change-passwd').click(function(){
		$.ajax({
			type:'POST',
			url:'handle/admin_zone.php',
			data:{
				operation:'CHANGEPASSWORD',
				old_pass:$('#originPasswd').val(),
				new_pass:$('#newPasswd').val()
			},
			success:function(data){
				if(data == 1){
					alert('修改成功');
					window.location.reload();
				}
				else if(data == 0){
					alert('原密码不正确！');
					$('#originPasswd').val('');
				}
			}
		});
	});
	
	//条件查找
	$('#search-quiz').click(function(){
		hide();
		$('#quiz-result-search').show();
	});
	
	$('#select1').change(function(){
		var select1 = $('#select1').val();
		if (select1=='710000' || select1=='810000' || select1=='820000' || select1=='100000')
		{
			$('#select2').html('<option value="0">请选择城市</option>');
			$('#select2').attr('disabled',true);
		}
		else if(select1 != 0){
			
			$.ajax({
				type:'POST',
				url:'handle/system.php',
				data:{
					operation:'FETCHCITY',
					province:select1
				},
				success:function(data){
					//alert(data);
					$('#select2').attr('disabled',false);
					$('#select2').html('<option value="0">请选择城市</option>'+data);
				}
			});
		}
	});
	$('#area-check').change(function(){
		if(this.checked){
			$('#select1').html('<option value="0">请选择省份</option>');
			$('#select2').html('<option value="0">请选择城市</option>');
			$('#select3').html('<option value="0">请选择单位</option>');
			$('#select1').attr('disabled',true);
			$('#select2').attr('disabled',true);
			$('#select3').attr('disabled',true);
		}
		else{
			$.ajax({
				type:'POST',
				url:'handle/system.php',
				data:{
					operation:'FETCHPROVINCE'
				},
				success:function(data){
					//alert(data);
					$('#select1').html('<option value="0">请选择省份</option>'+data);
				}
			});
			$.ajax({
				type:'POST',
				url:'handle/system.php',
				data:{
					operation:'FETCHDEPARTMENT'
				},
				success:function(data){
					$('#select3').html('<option value="0">请选择单位</option>'+data);
				}
			});
			$('#select1').attr('disabled',false);
			$('#select2').attr('disabled',false);
			$('#select3').attr('disabled',false);
		}
	});
	$('#timespan-check').change(function(){
		if(this.checked){
			$('#time-start').val('');
			$('#time-end').val('');
			$('#time-start').attr('disabled',true);
			$('#time-end').attr('disabled',true);
		}
		else{
			$('#time-start').val('01/01/2013');
			$('#time-end').val('01/01/2013');
			$('#time-start').attr('disabled',false);
			$('#time-end').attr('disabled',false);
		}
	});
	
	$('#search-btn').click(function(){
		var province = '0';
		var city = '0';
		var department = '0';
		
		var start_time = '1000-01-01';
		var end_time = '3000-01-01';
		
		if(!document.getElementById('timespan-check').checked){
			var time;
			time = $('#time-start').val().split('/');
			start_time = time[2]+'-'+time[0]+'-'+time[1];
			time = $('#time-end').val().split('/');
			end_time = time[2]+'-'+time[0]+'-'+time[1];
		}
		if(!document.getElementById('area-check').checked){
			province = $('#select1').val();
			city = $('#select2').val();
			department = $('#select3').val();
		}
		//alert(start_time+end_time);
		//alert(province +' '+ city+' ' + department);
		var quiz_type = $(':radio[name="radio-settype"]:checked').val();
		var quiz_state = $(':radio[name="radio-setstate"]:checked').val();
		
		$('#search-result-list').html('');
		$.ajax({
			type:'POST',
			url:'handle/admin_zone.php',
			data:{
				operation:'SEARCHQUESTIONNAIRE',
				province:province,
				city:city,
				department:department,
				start_time:start_time,
				end_time:end_time,
				quiz_type:quiz_type,
				quiz_state:quiz_state
			},
			success:function(data){
				$('#search-result-list').html(data);
			}
		});
	});
	$('#time-start').datepicker();
	$('#time-end').datepicker();
	
	//用户数据
	$('#check-user').click(function(){
		hide();
		$.ajax({
			type:'POST',
			url:'handle/system.php',
			data:{
				operation:'FETCHPROVINCE'
			},
			success:function(data){
				//alert(data);
				$('#select-province').html('<option value="0">请选择省份</option>'+data);
			}
		});
		$.ajax({
			type:'POST',
			url:'handle/system.php',
			data:{
				operation:'FETCHDEPARTMENT'
			},
			success:function(data){
				$('#select-department').html('<option value="0">请选择单位</option>'+data);
			}
		});
		$.ajax({
			type:'POST',
			url:'handle/system.php',
			data:{
				operation:'FETCHTITLE'
			},
			success:function(data){
				//alert(data);
				$('#select-title').html('<option vlaue="0">请选择职称</option>'+data);
			}
		});
		$('#check-user-data').show();
	});
	$('#select-province').change(function(){
		var select1 = $('#select-province').val();
		if (select1=='710000' || select1=='810000' || select1=='820000' || select1=='100000')
		{
			$('#select-city').html('<option value="0">请选择城市</option>');
			$('#select-city').attr('disabled',true);
		}
		else if(select1 != 0){
			
			$.ajax({
				type:'POST',
				url:'handle/system.php',
				data:{
					operation:'FETCHCITY',
					province:select1
				},
				success:function(data){
					//alert(data);
					$('#select-city').attr('disabled',false);
					$('#select-city').html('<option value="0">请选择城市</option>'+data);
				}
			});
		}
	});
	$('#user-search-btn').click(function(){
		var province = $('#select-province').val();
		var city = $('#select-city').val();
		var department = $('#select-department').val();
		var title = $('#select-title').val();
		
		$.ajax({
			type:'POST',
			url:'handle/admin_zone.php',
			data:{
				operation:'SEARCHUSER',
				province:province,
				city:city,
				department:department,
				title:title
			},
			success:function(data){
				$('#user-info-list').html(data);
			}
		});
	});
	$('#user-info-cover').click(function(){
		$('#user-info-cover').hide();
	});
	
	
	hide();
});
function user_data(t){
	var id = t.parentNode.parentNode.parentNode.id;
	var token = id.split('-');
	$.ajax({
		type:'POST',
		url:'handle/admin_zone.php',
		data:{
			operation:'FETCHUSERINFO',
			user_id:token[1]
		},
		success:function(str){
			var data = jQuery.parseJSON(str);
			$('#user-info1').html(data.id);
			$('#user-info2').html(data.department);
			$('#user-info3').html(data.position);
			$('#user-info4').html(data.oncharge);
			$('#user-info5').html(data.spaciality);
			$('#user-info6').html(data.age);
			$('#user-info7').html(data.gender);
			$('#user-info8').html(data.edu);
			$('#user-info9').html(data.title);
			$('#user-info10').html(data.time);
			$('#user-info11').html(data.email);
			$('#user-info-cover').show();
		}
	});
}
function user_quiz(t){
	id = t.parentNode.parentNode.parentNode.id;
	var token = id.split('-');
	$('#quiz-list-'+token[1]).toggle();
}
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
	//alert(t);
	$.ajax({
		type:'POST',
		url:'handle/admin_zone.php',
		data:{
			operation:'FETCHKEYVARIABLELIST',
			key_field_id:t
		},
		success:function(data){
			//alert(data);
			$('#key-variable-list').html(data);
		}
	});
}
//这里是作用域的操作
function delete_effect_field(t){
	alert('警告！此操作不可逆！');
	alert('删除后你将再也看不到与该关键域相关的东西');
	var returnType = window.confirm('确认删除吗？')
	if(returnType){
		$.ajax({
			type:'POST',
			url:'handle/admin_zone.php',
			data:{
				operation:'DELETEEFFECTFIELD',
				effect_field_id:t.parentNode.id
			},
			success:function(data){
				if(data == 1){
					alert('删除成功');
					$('#manage-effect-field').click();
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
	
	$('#effect-field-input').val($(t.parentNode).text().substr(0,$(t.parentNode).text().length-25));
	$('#effect-field-cover').show();
}
function add_effect_field(){
	effect_field_change = false;
	$('#effect-field-input').val('');
	$('#effect-field-title').text('新的作用域名称');
	$('#effect-field-cover').show();
}
function show_hide_effect_field(t){
	var temp;
	if($(t).text() == '显示'){
		temp = 1;
	}
	else
		temp = 0;
	$.ajax({
		type:'POST',
		url:'handle/admin_zone.php',
		data:{
			operation:'SHOWORHIDEEFFECTFIELD',
			effect_field_id:t.parentNode.id,
			available:temp
		},
		success:function(data){
			if(data == 1){
				if(temp == 1)
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
			url:'handle/admin_zone.php',
			data:{
				operation:'DELETEKEYFIELD',
				key_field_id:t.parentNode.id
			},
			success:function(data){
				if(data == 1){
					fetch_key_field_list(effect_field1);
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
	$('#key-field-input').val($(t.parentNode).text().substr(0,$(t.parentNode).text().length-25));
	$('#key-field-cover').show();
}
function add_key_field(){
	key_field_change = false;
	$('#key-field-input').val('');
	$('#key-field-title').text('新的关键域名称');
	$('#key-field-cover').show();
}
function show_hide_key_field(t){
	var temp;
	if($(t).text() == '显示'){
		temp = 1;
	}
	else
		temp = 0;
	
	$.ajax({
		type:'POST',
		url:'handle/admin_zone.php',
		data:{
			operation:'SHOWORHIDEKEYFIELD',
			key_field_id:t.parentNode.id,
			available:temp
		},
		success:function(data){
			if(data == 1){
				if(temp == 1)
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
			url:'handle/admin_zone.php',
			data:{
				operation:'DELETEKEYVARIABLE',
				key_variable_id:t.parentNode.id
			},
			success:function(data){
				if(data == 1){
					fetch_key_variable_list(key_field2);
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
			//alert(str);
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
	$('#key_variable_question').val('');
	$('#key_variable_a').val('');
	$('#key_variable_b').val('');
	$('#key_variable_c').val('');
	$('#key_variable_d').val('');
	$('#key_variable_e').val('');
	$('#key-variable-cover').show();
}
function show_hide_key_variable(t){
	var temp;
	if($(t).text() == '显示'){
		temp = 1;
	}
	else
		temp = 0;
	
	$.ajax({
		type:'POST',
		url:'handle/admin_zone.php',
		data:{
			operation:'SHOWORHIDEKEYVARIABLE',
			key_variable_id:t.parentNode.id,
			available:temp
		},
		success:function(data){
			if(data == 1){
				if(temp == 1)
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

function fetch_target_form(){
	$.ajax({
		type:'POST',
		url:'handle/admin_zone.php',
		data:{
			operation:'FETCHGOALTABLE'
		},
		success:function(str){
			//$('#target-table').html(str);
			var data = jQuery.parseJSON(str);
			var table = '';
			table += '<tr style="text-align:center">';
			table += '<th>作用域(一级指标)</th><th>关键域(二级指标)</th><th colspan=5 style="text-align:center">组织的成熟度水平</th>';
			table += '</tr>';
			table += '<tr>';
			table += '<td></td><td></td>';
			table += '<td>成熟度1级</td><td>成熟度2级</td><td>成熟度3级</td><td>成熟度4级</td><td>成熟度5级</td>';
			table += '</tr>';
			
			var i;
			for(i=0;i<data.content.length;i++){
				var j;
				for(j=0;j<data.content[i].content.length;j++){
					table += '<tr>';
					if(j == 0)
						table += '<td>'+data.content[i].title+'</td>';
					else
						table += '<td></td>';
					table += '<td>'+data.content[i].content[j].title+'</td>';
					table += '<td><input class="level" type="text" id="id-'+data.content[i].content[j].id+'-1" value="'+data.content[i].content[j].content[0]+'" /></td>';
					table += '<td style="background:rgb(253,253,217)"><input class="level" type="text" id="id-'+data.content[i].content[j].id+'-2" value="'+data.content[i].content[j].content[1]+'" /></td>';
					table += '<td style="background:rgb(235,241,222)"><input class="level" type="text" id="id-'+data.content[i].content[j].id+'-3" value="'+data.content[i].content[j].content[2]+'" /></td>';
					table += '<td style="background:rgb(242,220,219)"><input class="level" type="text" id="id-'+data.content[i].content[j].id+'-4" value="'+data.content[i].content[j].content[3]+'" /></td>';
					table += '<td style="background:rgb(220,230,241)"><input class="level" type="text" id="id-'+data.content[i].content[j].id+'-5" value="'+data.content[i].content[j].content[4]+'" /></td>';
					table += '</tr>';
				}
			}
			$('#target-table').html(table);

			$(':text').each(function(){
				var id = this.id.split('-');
				if(id[0] == 'id'){
					$(this).blur(function(){
						var val = $(this).val();
						if(val == '-1' || val == '' || (!isNaN(val) && parseFloat(val) >= 1 && parseFloat(val) <= 5)){
							$.ajax({
								type:'POST',
								url:'handle/admin_zone.php',
								data:{
									operation:'MODIFYGOAL',
									key_field_id:parseInt(id[1]),
									mature_level:parseInt(id[2]),
									mature_value:(val == '')?-1:parseFloat(val)
								},
								success:function(data){
									//alert(id[1]+'-'+id[2]);
									//alert(data);
								}
							});
						}
						else{
							alert('"'+val+'"不符合要求，范围1~5');
						}
					});
				}
			});
		}
	});
}

function deleteitem(t,no){
	var returnVal = window.confirm('执行操作后不可恢复，是否确定删除？','你确定要删除吗');
	if(returnVal){
		$('#loading-cover').show();
		$.ajax({
			type:'POST',
			url:'handle/user_zone.php',
			data:{
				operation:'DELETEQUESTIONNAIRE',
				quiz_id:t.parentNode.id
			},
			success:function(data){
				if(data == 1){
					$('#loading-cover').hide();
					alert('删除成功');
					//t.parentNode.hide();
					if(no == 1)
						c_list();
					if(no == 2)
						nc_list();
					if(no == 3)
						d_list();
				}
				else{
					alert(data);
				}
			}
		});
	}
}
function checkresult(t){
	window.location = 'statistics.php?quiz_id=' + t.parentNode.id;

}
function reformresult(t){
	$.ajax({
		type:'POST',
		url:'handle/quiz.php',
		data:{
			operation:'REFORMSTATISTICS',
			quiz_id:t.parentNode.id
		},
		success:function(data){
			//alert(data);
			window.location = "statistics.php?quiz_id="+t.parentNode.id;
		}
	});
}

//管理动态新闻
function news_delete(t){
	$.ajax({
		type:'POST',
		url:'./handle/admin_zone.php',
		data:{
			operation:'DELETENEWS',
			id:t.parentNode.id
		},
		success:function(data){
			if(data == 1)
				$('#manage-news').click();
			else
				alert(data);
		}
	});
}
function news_edit(t){
	window.open('./include/newsedit.php?newsid='+t.parentNode.id,'newwindow');
}
function news_moveup(t){
	$.ajax({
		type:'POST',
		url:'./handle/admin_zone.php',
		data:{
			operation:'CHANGENEWSSORT',
			id:t.parentNode.id,
			up:0
		},
		success:function(data){
			if(data == 1)
				$('#manage-news').click();
			else
				alert(data);
		}
	});
}
function news_movedown(t){
	$.ajax({
		type:'POST',
		url:'./handle/admin_zone.php',
		data:{
			operation:'CHANGENEWSSORT',
			id:t.parentNode.id,
			up:1
		},
		success:function(data){
			if(data == 1)
				$('#manage-news').click();
			else
				alert(data);
		}
	});
}
function news_settop(t){
	$.ajax({
		type:'POST',
		url:'./handle/admin_zone.php',
		data:{
			operation:'UPBANGNEWS',
			id:t.parentNode.id
		},
		success:function(data){
			if(data == 1)
				$('#manage-news').click();
			else
				alert(data);
		}
	});
}

function news_add(){
	window.open('./include/newsedit.php?newsid=-1','newwindow');
}

//下面是分享的操作
function share_delete(t){
	$.ajax({
		type:'POST',
		url:'./handle/admin_zone.php',
		data:{
			operation:'DELETEDISCOVERY',
			id:t.parentNode.id
		},
		success:function(data){
			if(data == 1)
				$('#manage-share').click();
			else
				alert(data);
		}
	});
}
function share_edit(t){
	window.open('./include/shareedit.php?shareid='+t.parentNode.id,'newwindow');
}
function share_moveup(t){
	$.ajax({
		type:'POST',
		url:'./handle/admin_zone.php',
		data:{
			operation:'CHANGEDISCOVERYSORT',
			id:t.parentNode.id,
			up:0
		},
		success:function(data){
			if(data == 1)
				$('#manage-share').click();
			else
				alert(data);
		}
	});
}
function share_movedown(t){
	//alert(t.parentNode.id);
	$.ajax({
		type:'POST',
		url:'./handle/admin_zone.php',
		data:{
			operation:'CHANGEDISCOVERYSORT',
			id:t.parentNode.id,
			up:1
		},
		success:function(data){
			if(data == 1)
				$('#manage-share').click();
			else
				alert(data);
		}
	});
}
function share_settop(t){
	$.ajax({
		type:'POST',
		url:'./handle/admin_zone.php',
		data:{
			operation:'UPBANGDISCOVERY',
			id:t.parentNode.id
		},
		success:function(data){
			if(data == 1)
				$('#manage-share').click();
			else
				alert(data);
		}
	});
}

function share_add(){
	window.open('./include/shareedit.php?shareid=-1','newwindow');
}
function hide(){
	$('#change-news').hide();
	$('#change-share').hide();
	$('#check-user-data').hide();
	$('#quiz-result-search').hide();
	$('#passwd-reset').hide();
	$('#target-change').hide();
	$('#change-effect-field').hide();
	$('#change-key-field').hide();
	$('#change-key-variable').hide();
}