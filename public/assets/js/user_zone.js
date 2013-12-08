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
					alert("创建成功");
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
	
	
	
	$('#btn-change-passwd').click(function(){
		$.ajax({
			type:'POST',
			url:'handle/user_zone.php',
			data:{
				operation:'',
				
			},
			success:function(data){
			
			}
		});
	});
	
	$('#btn-change-data').click(function(){
		$.ajax({
			type:'POST',
			url:'handle/user_zone.php',
			data:{
				operation:'',
				
			},
			success:function(data){
			
			}
		});
	});
});

function readpromise(){//显示承诺书
	hide();
	$('#user-promise').show();
}
function user_test(){
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
		}
	});
}
function doremark(){//单位测评创建时提示
	//alert("aew");
	$.ajax({
		type:'POST',
		url:'handle/user_zone.php',
		data:{
			operation:'CHECKDEPARTMENTQUESTIONNAIRE',
		},
		success:function(data){
			//alert(data);
			if(data == 1){
				var returnVal = window.confirm('已经存在未填完的单位问卷，确定要再创建一份单位问卷吗？','是否创建？');
				if(returnVal){
					hide();
					$('#enter-remark').show();
				}
				else{
					d_list();
				}
			}
			else if(data == 0){
				hide();
				$('#enter-remark').show();
				//alert(data);
			}
		}
	});
}
function depart_test(){
	alert($('#d-remark').val());
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
				d_list();
			}
			else{
				alert(data);
			}
		}
	});
}
function nc_list(){//未完成列表
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
		}
	});
}
function c_list(){//已完成列表
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
		}
	});
}
function d_list(){//单位测评列表
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
		}
	});
}
function change_passwd(){//修改密码
	hide();
	$('#change-passwd').show();
}
function change_data(){//修改用户资料
	$.ajax({
		
	});
}
function deleteitem(t){
	var returnVal = window.confirm('执行操作后不可恢复，是否确定删除？','你确定要删除吗');
	if(returnVal){
		$.ajax({
			type:'POST',
			url:'handle/user_zone.php',
			data:{
				operation:'DELETEQUESTIONNAIRE',
				quiz_id:t.parentNode.id
			},
			success:function(data){
				if(data == 1){
					alert('删除成功')
					t.hide();
				}
				else{
					alert(data);
				}
			}
		});
	}
}
function checkresult(t){
	$.ajax({
		type:'POST',
		url:'handle/user_zone.php',
		data:{
			operation:'',
			quiz_id:t.id
		},
		success:function(data){
			alert(data);
			if(data == 1){
				window.location = 'check_quiz.php?quiz_id=' + t.parentNode.id;
			}
			else{
			
			}
		}
	});
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