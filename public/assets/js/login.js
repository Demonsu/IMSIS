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
				data==-1?$('#errorMsg').text("用户名或密码错误"):(data==1?window.location="admin_zone.php":window.location="user_zone.php");
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
});