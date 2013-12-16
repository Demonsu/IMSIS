var check_passwd = false;
var confirm_passwd = false;

$(document).ready(function(){
	$('#readit').click(function(){//个人测评阅读承诺书
		user_test();
	});
	
	$('#create').click(function(){//个人测评创建问卷，成功则转到个人问卷回答页面
		var list = "";
		$(':checkbox').each(function(){
			if(this.checked && this.id.length > 4){
				list += this.value + ";";
			}
		});
		$('#loading-cover').show();
		$.ajax({
			type:'POST',
			url:'handle/user_zone.php',
			data:{
				operation:"CREATEUSERQUESTIONNAIRE",
				key_field_list:list,
				remark:$('#user-remark').val()
			},
			success:function(data){
				$('#loading-cover').hide();
				if (!isNaN(data))
				{
					//alert("创建成功");
					window.location = 'quiz.php?quiz_id='+data;
				}else
				{
					
					alert("创建失败"+data);
				}
			}
		});
	});
	
	$('#d-create').click(function(){//单位测评问卷创建
		depart_test();
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
	
	$('#btn-change-passwd').click(function(){
		$('#loading-cover').show();
		$.ajax({
			type:'POST',
			url:'handle/user_zone.php',
			data:{
				operation:'CHANGEPASSWORD',
				old_pass:$('#originPasswd').val(),
				new_pass:$('#newPasswd').val()
			},
			success:function(data){
				$('#loading-cover').hide();
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
	
	$('#btn-change-data').click(function(){
		$('#loading-cover').show();
		$.ajax({
			type:'POST',
			url:'handle/user_zone.php',
			data:{
				operation:'CHANGEUSERINFO',
				age:$('#selectAge').val(),
				gender:$('#selectGender').val(),
				edu:$('#selectEdu').val(),
				position:$('#inputPosition').val(),
				time:$('#inputTime').val(),
				email:$('#inputEmail').val()
			},
			success:function(data){
				if(data == 1){
					$('#loading-cover').hide();
					alert('修改成功');
				}	else
				alert(data);
			}
		});
	});
	$('#all-select').click(function(){
		//alert(1);
		$(':checkbox').each(function(){
			this.checked = true;
		});
	});
	$('#cancel-select').click(function(){
		$(':checkbox').each(function(){
			this.checked = false;
		});
	});
	fetch_userdata();
});

function readpromise(){//显示承诺书
	hide();
	$('#user-promise').show();
}
function user_test(){
	$('#loading-cover').show();
	$.ajax({
		type:'POST',
		url:'handle/user_zone.php',
		data:{
			operation:'FETCHPALEQUESTIONNAIRE',
		},
		success:function(data){
			hide();
			$('#field-select').html(data);
			$('#select-quiz').show();
			$(":checkbox").change(function(){//联合checkbox的改动
				if(this.id.length == 4 && this.checked){
					var id = this.id;
					$(':checkbox').each(function(){
						var id2 = this.id;
						if(id2.substr(0,4) == id){
							this.checked = true;
						}
					});
				}
				else if(this.id.length == 4 && !this.checked){
					var id = this.id;
					$(':checkbox').each(function(){
						var id2 = this.id;
						if(id2.substr(0,4) == id){
							this.checked = false;
						}
					});
				}
				else if(this.id.length == 5 && !this.checked){
					var id = this.id;
					$(':checkbox').each(function(){
						var id2 = this.id;
						if(id2 == id.substr(0,4)){
							this.checked = false;
						}
					});
				}
			});
			$('#loading-cover').hide();
		}
	});
}
function doremark(){//单位测评创建时提示
	$('#loading-cover').show();
	$.ajax({
		type:'POST',
		url:'handle/user_zone.php',
		data:{
			operation:'CHECKDEPARTMENTQUESTIONNAIRE',
		},
		success:function(data){
			if(data == 1){
				var returnVal = window.confirm('已经存在未填完的单位问卷，确定要再创建一份单位问卷吗？','是否创建？');
				if(returnVal){
					hide();
					$('#enter-remark').show();
					$('#loading-cover').hide();
				}
				else{
					d_list();
				}
			}
			else if(data == 0){
				hide();
				$('#enter-remark').show();
				$('#loading-cover').hide();
			}		
		}
	});
}
function depart_test(){
	//alert($('#d-remark').val());
	$('#loading-cover').show();
	$.ajax({
		type:'POST',
		url:'handle/user_zone.php',
		data:{
			operation:'CREATEDEPARTMENTQUESTIONNAIRE',
			remark:$('#d-remark').val()
		},
		success:function(data){
			if(!isNaN(data)){
				alert('创建成功，请到我的测评中的单位测评中进行测评');
				$('#loading-cover').hide();
				d_list();
			}
			else{
				alert(data);
			}
		}
	});
}
function nc_list(){//未完成列表
	$('#loading-cover').show();
	$.ajax({
		type:'POST',
		url:'handle/user_zone.php',
		data:{
			operation:'FETCHUSERQUESTIONNAIRELIST',
			state:0
		},
		success:function(data){
			hide();
			$('#nc-list-items').html(data);
			$('#nc-list').show();
			$('#loading-cover').hide();
		}
	});
}
function c_list(){//已完成列表
	$('#loading-cover').show();
	$.ajax({
		type:'POST',
		url:'handle/user_zone.php',
		data:{
			operation:'FETCHUSERQUESTIONNAIRELIST',
			state:1
		},
		success:function(data){
			hide();
			$('#c-list-items').html(data);
			$('#c-list').show();
			$('#loading-cover').hide();
		}
	});
}
function d_list(){//单位测评列表
	$('#loading-cover').show();
	$.ajax({
		type:'POST',
		url:'handle/user_zone.php',
		data:{
			operation:'FETCHDEPARTMENTQUESTIONNAIRE',
		},
		success:function(data){
			hide();
			$('#d-list-items').html(data);
			$('#d-list').show();
			$('#loading-cover').hide();
		}
	});
}
function change_passwd(){//修改密码
	hide();
	$('#change-passwd').show();
}
function change_data(){//修改用户资料
	hide();
	fetch_userdata();
	$('#change-data').show();
}
function fetch_userdata(){
	$('#loading-cover').show();
	$.ajax({
		type:'POST',
		url:'handle/user_zone.php',
		data:{
			operation:'FETCHUSERINFO'
		},
		success:function(str){
			//alert(str);
			var data = jQuery.parseJSON(str);
			$('#user_id').val(data.id);
			$('#user_department').val(data.department);
			$('#user_title').val(data.title);
			$('#user_oncharge').val(data.oncharge);
			$('#user_spaciality').val(data.spaciality);
			$('#selectAge option[value='+data.age+']').attr('selected','true');
			$('#selectGender option[value='+data.gender+']').attr('selected','true');
			$('#selectEdu option[value='+data.edu+']').attr('selected','true');
			$('#inputPosition').val(data.position);
			$('#inputTime').val(data.time);
			$('#inputEmail').val(data.email);
			$('#loading-cover').hide();
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
function u_continue(t){
	window.location = 'quiz.php?quiz_id='+t.parentNode.id;
}
function d_continue(t){
	window.location = 'd_quiz.php?quiz_id='+t.parentNode.id;
}

function hide(){//隐藏函数
	$('#change-data').hide();
	$('#enter-remark').hide();
	$('#nc-list').hide();
	$('#c-list').hide();
	$('#d-list').hide();
	$('#user-promise').hide();
	$('#select-quiz').hide();
	$('#change-passwd').hide();
}