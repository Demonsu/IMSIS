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
				key_field_list:list,
				remark:$('#user-remark').val()
			},
			success:function(){
				window.location = 'quiz.php';
			}
		});
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
			operation:'FETCHPALEQUESTIONNAIRE',
		},
		success:function(data){
			hide();
			$('#field-select').html(data);
			$('#select-quiz').show();
		}
	});
}

function hide(){
	$('#user-promise').hide();
	$('#select-quiz').hide();
}