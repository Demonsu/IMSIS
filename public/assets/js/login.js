$(document).ready(function(){
	$('#login').click(function(){
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
	});
	$('#register').click(function(){
		window.location="register.php";
	});
	$('#forget').click(function(){
		
	});
	$('#inputPassword').keypress(function(e){
		if(e.keyCode == 13)
			$('#login').click();
	});
	$('#u_t').click(function(){
		window.location = 'quiz.php';
	});
	$('#d_t').click(function(){
		
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
						$('#cover').show();
					}
				}
				else if(data == 0){
					$('#cover').show();
					//alert(data);
				}
			}
		});
	});
	$('#d-create').click(function(){
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
					$('#cover').hide();
				}
				else{
					alert(data);
				}
			}
		});
	});
	$('#d-cancel').click(function(){
		$('#cover').hide();
	});
});