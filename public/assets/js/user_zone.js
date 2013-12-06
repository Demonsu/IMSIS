$(document).ready(function(){
	$('#readit').click(function(){
		user_test();
	});
	
	$('#create').click(function(){
		var list = "";
		$(':checkbox').each(function(){
			if(this.checked){
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
					window.location = 'quiz.php?quiz_id=data';
				}else
				{
					alert(data);
					//alert("创建失败");
				}
			}
		});
	});
	
	$('#d-create').click(function(){
		depart_test();
	});
	$(":checkbox").change(function(){
		if(this.id.length == 4 && this.checked){
			var id = this.id;
			$(':checkbox').each(function(){
				var id2 = this.id;
				if(id2.substr(0,4) == id){
					this.checked = true;
				}
			});
		}
		if(this.id.length == 5 && !this.checked){
			var id = this.id;
			$(':checkbox').each(function(){
				var id2 = this.id;
				if(id2 == id.substr(0,4)){
					this.checked = false;
				}
			});
		}
	});
});

function readpromise(){
	hide();
	$('#user-promise').show();
}
function user_test(){
	$.ajax({
		type:'POST',
		url:'handle/user_zone.php',
		data:{
			operation:'FETCHPALEQUESTIONNAIRE'
		},
		success:function(data){
			hide();
			$('#field-select').html(data);
			$('#select-quiz').show();
		}
	});
}
function doremark(){
	//alert("!!");
	$.ajax({
		type:'POST',
		url:'handle/user_zone.php',
		data:{
			operation:'CHECKDEPARTMENTQUESTIONNAIRE'
		},
		success:function(data){
			//alert(data);
			if(data == 1){
				var returnVal = window.confirm('已经存在未填完的单位问卷，确定要再创建一份单位问卷吗？','是否创建？');
				if(!returnVal){
					return;

				}
			}
			else if(data != 0){

				alert(data);
			}
			hide();
			$('#enter-remark').show();
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
				$('#depart_quiz').click();
			}
			else{
				alert(data);
			}
		}
	});
}
function nc_list(){
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
function c_list(){
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
function d_list(){
	$.ajax({
		type:'POST',
		url:'handle/user_zone.php',
		data:{
			operation:'FETCHDEPARTMENTQUESTIONNAIRE'
		},
		success:function(data){
			hide();
			$('#d-list-items').html(data);
			$('#d-list').show();
		}
	});
}
function deleteitem(t){
	alert(t.id);
}

function hide(){
	$('#enter-remark').hide();
	$('#nc-list').hide();
	$('#c-list').hide();
	$('#d-list').hide();
	$('#user-promise').hide();
	$('#select-quiz').hide();
	$('#change-passwd').hide();
}