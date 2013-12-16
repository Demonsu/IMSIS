$(document).ready(function(){
	$('#readit').click(function(){
		$('#loading-cover').show();
		$.ajax({
			type:'POST',
			url:'handle/user_zone.php',
			data:{
				operation:'IFDEPARTMENTQUESTIONNAIREDONE',
				quiz_id:$('#quiz_id').val()
			},
			success:function(data){
				//alert(data);
				if(data == 0){
					$.ajax({
						type:'POST',
						url:'handle/user_zone.php',
						data:{
							operation:'FETCHCHOOSEDEPARTMENTQUESTIONNAIRE',
							quiz_id:$('#quiz_id').val()
						},
						success:function(data){
							//alert(data);
							$('#field-select').html(data);
							hide();
							$('#second').show();
							$('#progressBar').css('width','30%');
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
				else if(data == 1){
					$('#loading-cover').hide();
					alert('该问卷已经选完所有关键域，点击确定回到个人中心');
					window.location = "user_zone.php";
				}
			}
		});
		
	});
	$('#d_confirm').click(function(){
		var list = "";
		$(':checkbox').each(function(){
			if(this.checked && !this.disabled && this.id.length > 4){
				list += this.value + ";";
			}
		});
		$('#loading-cover').show();
		$.ajax({
			type:'POST',
			url:'handle/user_zone.php',
			data:{
				operation:"USERSUBMITDEPARTMENTREQUEST",
				quiz_id:$('#quiz_id').val(),
				is_public:'1',
				key_field_list:list
			},
			success:function(data){
				if (data == 1){
					fetch_left();
					hide();
					$('#third').show();
					$('#progressBar').css('width','60%');
				}
				else{
					$('#loading-cover').hide();
					alert("失败"+data);
				}
			}
		});
		
		
	});
	$('#next-key-field').click(function(){
		var varNum = 0;
		var checkedNum = 0;
		var phpChar = '';
		$(':radio').each(function(){
			varNum++;
			if(this.checked){
				checkedNum++;
				var name = this.name;
				phpChar += (name.substr(5,name.length) + ':' + this.value + ';');
			}
		});
		if(checkedNum * 6 < varNum){
			alert('您还有关键变量没有选择，请选完后继续下一个关键域');
		}
		else{
			$('#loading-cover').show();
			$.ajax({
				type:'POST',
				url:'handle/quiz.php',
				data:{
					operation:'ANSERQUESTIONNAIRE',
					quiz_id:$('#quiz_id').val(),
					answer:phpChar
				},
				success:function(data){
					//alert(data);
					if(data == 1){
						fetch_left();
					}
					else{
						$('#loading-cover').hide();
						//上传失败
					}
				}
			});
		}
	});
	$('#confirm-target').click(function(){
		var phpChar = '';
		$('select').each(function(){
			var id = this.id;
			phpChar += id + ':' + this.value +';';
		});
		alert(phpChar);
		$.ajax({
			type:'POST',
			url:'handle/quiz.php',
			data:{
				operation:'USERSETGOAL',
				quiz_id:$('#quiz_id').val(),
				goal_list:phpChar
				
			},
			success:function(data){
				if(data == 1){
					ask_for_preview();
				}
			}
		});
		
	});
	$('#submit-result').click(function(){
		var phpChar1 = '';
		$(':radio').each(function(){
			if(this.checked){
				var name = this.name;
				phpChar1 += (name.substr(5,name.length) + ':' + this.value + ';');
			}
		});
		var phpChar2 = '';
		$(':text').each(function(){
			if(this.id != 'quiz_id'){
				if(this.value > 5 || this.value < 1 || isNaN(this.value) || this.value.length != 1){
					alert('目标值限定在1~5之间');
					return;
				}
				phpChar2 += this.id + ':' + this.value + ';';
			}
		});
		$('#loading-cover').show();
		$.ajax({
			type:'POST',
			url:'handle/quiz.php',
			data:{
				operation:'USERFINALSUBMIT',
				quiz_id:$('#quiz_id').val(),
				answer_list:phpChar1,
				goal_list:phpChar2,
				is_public:'1'
				
			},
			success:function(data){
				$('#loading-cover').hide();
				if(data == 1)
					window.location = 'statistics.php?quiz_id'+ $('#quiz_id').val();
				else if(data == 0){
					alert('请等待单位其他人完成整份问卷后再查看结果，点击确定回到主页');
					window.location = 'login.php';
				}else
				{
					alert(data);
				}
					
			}
		});
		hide();
		$('#progressBar').css('width','100%');
	});
});
function ask_for_target(){
	$.ajax({
		type:'POST',
		url:'handle/quiz.php',
		data:{
			operation:'CHECKGOALSET',
			quiz_id:$('#quiz_id').val()
		},
		success:function(data){
			if(data == 1){
				ask_for_preview();
			}
			else if(data == 0){
				$.ajax({
					type:'POST',
					url:'handle/quiz.php',
					data:{
						operation:'FETCHTARGETQUESTIONNAIRE',
						quiz_id:$('#quiz_id').val()
					},
					success:function(data){
						alert(data);
						$('#target_select').html(data);
						$('.collapse').collapse('hide');
					}
				});
			}
		}
	});	
}
function ask_for_preview(){
	$.ajax({
		type:'POST',
		url:'handle/quiz.php',
		data:{
			operation:'FETCHPREVIEWQUESTIONNAIRE',
			quiz_id:$('#quiz_id').val()
		},
		success:function(data){
			//alert(data);
			$('#target_select').html('');
			data = data.replace(/<br>/g,'');
			$('#preview').html(data);
			
			$(':radio').each(function(){
				if(this.checked == false){
					$(this.parentNode).hide();
				}
				if(this.checked == true){
					$(this.parentNode).addClass('radio-selected');
				}
			});
			$('.button-modify').click(function(){
				var siblings = $(this.parentNode).siblings();
				var i;

				for(i=0;i<siblings.length;i++){
					$(siblings[i]).css('display','block');
				}
				$(siblings[i-1]).css('display','none');
			});
			$(':radio').click(function(){
				var name = this.name;
				$(':radio').each(function(){
					if(this.name == name)
						$(this.parentNode).removeClass('radio-selected');
				});
				$(this.parentNode).addClass('radio-selected');
			});
			hide();
			$('#fifth').show();
			$('#progressBar').css('width','90%');
			$('#loading-cover').hide();
		}
	});
}
function fetch_left(){
	$.ajax({
		type:'POST',
		url:'handle/quiz.php',
		data:{
			operation:'FETCHQUIZPROCESS',
			quiz_id:$('#quiz_id').val()
		},
		success:function(data){
			if(data == 0){
				//跳到下一步
				ask_for_target();
				$('#quiz-answer').html('');
				$('#progressBar').css('width','70%');
				hide();
				$('#fourth').show();
				$('#confirm-target').click();
			}
			else{
				//alert(data);
				$('#quiz-progress').html(data);
				$('.over-doing').each(function(){
					fetch_right(this);
				});
			}
		}
	});
}
function fetch_right(t){
	var id = t.id;
	$.ajax({
		type:'POST',
		url:'handle/quiz.php',
		data:{
			operation:'FETCHKEYVARIABLE',
			key_field_id:id
		},
		success:function(data){
			//	(data);
			$('#quiz-answer').html(data);
			$(':radio').click(function(){
				var name = this.name;
				$(':radio').each(function(){
					if(this.name == name)
						$(this.parentNode).removeClass('radio-selected');
				});
				$(this.parentNode).addClass('radio-selected');
			});
			$('#loading-cover').hide();
		}
	});
}

function set_checked(name,val){
	$(':radio').each(function(){
		if(this.value == val && this.name == name){
			this.checked = true;
		}
	});
}
function hide(){
	$('#first').hide();
	$('#second').hide();
	$('#third').hide();
	$('#fourth').hide();
	$('fifth').hide();
}