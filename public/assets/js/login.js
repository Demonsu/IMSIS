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
		$('#step1').show();
		//window.location = 'quiz.php';
	});
	$('#readit').click(function(){
		$.ajax({
			type:'POST',
			url:'handle/user_zone.php',
			data:{
				operation:'FETCHPALEQUESTIONNAIRE',
			},
			success:function(data){
				//alert(data);
				$('#step1').hide();
				$('#field-select').html(data);
				$('#step2').show();
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
	$('#u-cancel').click(function(){
		$('#step2').hide();
	});
	$('#d-cancel').click(function(){
		$('#cover').hide();
	});
	
});
function hide(){
	$('#cover').hide();
	$('#step1').hide();
	$('#step2').hide();
}