$(document).ready(function(){
	
	$('#login').click(function(){
		$('#loading-cover').show();
		var id = $('#inputId').val();
		var passwd = $('#inputPassword').val();
		var remember = document.getElementById('remember').checked?1:0;
		if(id != '' && passwd !=''){
			$.ajax({
				type:'POST',
				url:"handle/login.php",
				data:{
					user_id:id,
					password:passwd,
					remember:remember
				},
				success:function(data){
					alert(data);
					if(data==-1){
						$('#errorMsg').text("用户名或密码错误");
						$('#loading-cover').hide();
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
			$('#errorMsg').text("请输入用户名或密码");
			$('#loading-cover').hide();
		}
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
		$('#loading-cover').show();
		$.ajax({
			type:'POST',
			url:'./handle/login.php',
			data:{
				operation:'USERLOGINSTATE',
				is_public:0
			},
			success:function(data){
				if(data == 0){
					$('#loading-cover').hide();
					$('#step1').show();
				}
				else if(data == 1){
					window.location = 'user_zone.php?navigation=4';
				}
				else
					alert(data);
			}
			
		});
		
		//window.location = 'quiz.php';
	});
	$('#readit').click(function(){
		$('#loading-cover').show();
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
				$('#loading-cover').hide();
			}
		});
	});
	$('#create').click(function(){
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
				if (!isNaN(data))
				{
					//alert("创建成功");
					window.location = 'quiz.php?quiz_id='+data;
				}else
				{
					$('#loading-cover').hide();
					alert("创建失败"+data);
				}
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
		$('#loading-cover').show();
		$.ajax({
			type:'POST',
			url:'./handle/login.php',
			data:{
				operation:'USERLOGINSTATE',
				is_public:1
			},
			success:function(data){
				if(data == 0){
					$.ajax({
						type:'POST',
						url:'handle/user_zone.php',
						data:{
							operation:'CHECKDEPARTMENTQUESTIONNAIRE',
						},
						success:function(data){
							$('#loading-cover').hide();
							if(data == 1){
								var returnVal = window.confirm('已经存在未填完的单位问卷，确定要再创建一份单位问卷吗？','是否创建？');
								if(returnVal){
									$('#cover').show();
								}
								else{
									window.location = 'user_zone.php?navigation=5';
								}
							}
							else if(data == 0){
								$('#cover').show();
								//alert(data);
							}
						}
					});
				}
				else if(data == 1){
					window.location = 'user_zone.php';
				}
				else
					alert(data);
			}
			
		});
	});
	$('#d-create').click(function(){
		$('#loading-cover').show();
		$.ajax({
			type:'POST',
			url:'handle/user_zone.php',
			data:{
				operation:'CREATEDEPARTMENTQUESTIONNAIRE',
				remark:$('#d-remark').val()
			},
			success:function(data){
				$('#loading-cover').hide();
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