var check_id = false;
var check_passwd = false;
var check_passwd2 = false;
var check_department = false;
var check_education = false;
var	check_speciality = false;
var check_position = false;
var check_work = false;

$(document).ready(function(){
	$.ajax({
		type:'POST',
		url:'handle/system.php',
		data:{
			operation:'FETCHPROVINCE'
		},
		success:function(data){
			//alert(data);
			$('#select1').append(data);
		}
	});
	$.ajax({
		type:'POST',
		url:'handle/system.php',
		data:{
			operation:'FETCHTITLE'
		},
		success:function(data){
			$('#selectTitle').append(data);
		}
	});
	$.ajax({
		type:'POST',
		url:'handle/system.php',
		data:{
			operation:'FETCHSPECIALITY'
		},
		success:function(data){
			$('#selectSpeciality').append(data);
		}
	});
	$.ajax({
		type:'POST',
		url:'handle/system.php',
		data:{
			operation:'FETCHONCHARGE'
		},
		success:function(data){
			$('#selectOnCharge').append(data);
		}
	});
	$('#select1').change(function(){
		var select1 = $('#select1').val();
		if (select1=='710000' || select1=='810000' || select1=='820000')
		{
			$('#select2').html('');
			$('#select2').attr("disabled",true);
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
					$('#select2').attr("disabled",false);
					$('#select2').html('');
					$('#select2').append(data);
				}
			});
		}
	});
	$('#select2').change(function(){
		var select2 = $('#select2').val();
		$.ajax({
			type:'POST',
			url:'handle/system.php',
			data:{
				operation:'FETCHDEPARTMENT',
				province:select2
			},
			success:function(data){
				//alert(data);
				$('#select3').attr("disabled",false);
				$('#select3').html('');
				$('#select3').append(data);
			}
		});
	});
	$('#inputId').blur(function(){
		var id = $('#inputId').val();
		var pattern = new RegExp(/^[a-zA-Z0-9_]{6,20}$/);
		if(id.length < 6 || id.length > 20){
			$('#errorId').text('用户名长度限制为6~20个字符');
			$('.hasId').addClass('has-error');
			check_id = false;
		}
		else if(!pattern.test(id)){
			$('#errorId').text('用户名要求:字母大小写、数字、下划线(_)');
			$('.hasId').addClass('has-error');
			check_id = false;
		}
		else{
			$.ajax({
				type:'POST',
				url:'handle/register.php',
				data:{
					operation:'CHECKEXIST',
					user_id:id
				},
				success:function(data){
					if(data == 1){
						$('#errorId').text('用户名已存在');
						$('.hasId').addClass('has-error');
						check_id = false;
					}
					else{
						$('#errorId').text('用户名可用');
						$('.hasId').removeClass('has-error');
						check_id = true;
					}
				}
			});
		}
	});
	$('#inputPassword').blur(function(){
		var passwd = $('#inputPassword').val();
		var pattern = new RegExp(/^[a-zA-Z0-9_]{6,20}$/);
		if(passwd.length >20 || passwd.length < 6){
			$('#errorPassword').text('密码长度限制为6~20个字符');
			$('.hasPassword').addClass('has-error');
			check_passwd = false;
		}
		else if(!pattern.test(passwd)){
			$('#errorPassword').text('密码要求:字母大小写、数字、下划线(_)');
			$('.hasPassword').addClass('has-error');
			check_passwd = false;
		}
		else{
			$('#errorPassword').text('密码正确');
			$('.hasPassword').removeClass('has-error');
			check_passwd = true;
		}
	});
	$('#ConfirmPasswd').blur(function(){
		var passwd2 = $('#ConfirmPasswd').val();
		if(check_passwd == false){
			$('#errorConfirmPasswd').text('密码有误');
			$('.hasConfirmPasswd').addClass('has-error');
			check_passwd2 = false;
		}
		else{
			var passwd = $('#inputPassword').val();
			if(passwd != passwd2){
				$('#errorConfirmPasswd').text('密码不匹配');
				$('.hasConfirmPasswd').addClass('has-error');
				check_passwd2 = false;
			}
			else{
				$('#errorConfirmPasswd').text('密码正确');
				$('.hasConfirmPasswd').removeClass('has-error');
				check_passwd2 = true;
			}
		}
	});
	$('#inputPosition').blur(function(){
		var title = $('#inputPosition').val();
		var pattern = new RegExp(/^[\u4e00-\u9fa5]{1,20}$/);
		if(title.length == 0){
			$('#errorPosition').text('请输入职称');
			$('.hasPosition').addClass('has-error');
			check_title = false;
		}
		else if(!pattern.test(title)){
			$('#errorPosition').text('请写中文');
			$('.hasPosition').addClass('has-error');
			check_title = false;
		}
		else{
			$('#errorPosition').text('');
			$('.hasPosition').removeClass('has-error');
			check_title = true;
		}
	});


	$('#btn-register').click(function(){
		if(check_id == true && check_passwd == true && check_passwd2 == true ){
			$.ajax({
				type:'POST',
				url:'handle/register.php',
				data:{
					operation:'REGISTER',
					user_id:$('#inputId').val(),
					password:$('#inputPassword').val(),
					gender:$('#selectGender').val(),
					age:$('#selectAge').val(),
					province:$('#select1').val(),
					city:$('#select2').val(),
					area:'',
					oncharge:'',
					department:$('#select3').val(),
					title:$('#inputTitle').val(),
					speciality:$('#inputSpeciality').val(),
					position:$('#inputPosition').val(),
					seniority:$('#inputTime').val(),
					education:$('#selectEdu').val(),
					email:$('#inputEmail').val(),
				},
				success:function(data){
					alert(data);
					if(data == 1){
						$.ajax({
							type:'POST',
							url:"handle/login.php",
							data:{
								user_id:$('#inputId').val(),
								password:$('#inputPassword').val()
								},
							success:function(data){
								if(data==-1){
									$('#errorMsg').text("用户名或密码错误");
								}
								else if(data==1){
									window.location="admin_zone.php";
								}
								else{
									window.location="login.php";
								}
							}
						});
					}
					else{
						alert('注册失败');
					}
				}
			});
		}
		else{
			$('#errorRegister').text('请检查输入')
		}
	});
});