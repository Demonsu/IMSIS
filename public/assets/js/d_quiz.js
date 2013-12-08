$(document).ready(function(){
	$('#readit').click(function(){
		$.ajax({
			type:'POST',
			url:'handle/d_quiz.php',
			data:{
				operation:'IFDEPARTMENTQUESTIONNAIREDONE',
				quiz_id:$('#quiz_id').val();
			},
			success:function(data){
				if(data == 0){
					$.ajax({
						type:'POST',
						url:'handle/d_quiz.php',
						data:{
							operation:'FETCHCHOOSEDEPARTMENTQUESTIONNAIRE',
							quiz_id:$('#quiz_id').val()
						},
						success:function(data){
							alert(data);
							$('#field-select').html(data);
							hide();
							$('#second').show();
							$('#progressBar').css('width','30%');
							$(":checkbox").change(function(){//����checkbox�ĸĶ�
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
				else if(data == 1){
					alert('���ʾ��Ѿ�ѡ�����йؼ��򣬵��ȷ���ص���������');
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
		$.ajax({
			type:'POST',
			url:'handle/user_zone.php',
			data:{
				operation:"USERSUBMITDEPARTMENTREQUEST",
				quiz_id:$('#quiz_id').val(),
				key_field_list:list
			},
			success:function(data){
				if (data == 1){
					fetch_left();
					hide();
					$('#third').show();
					$('#progressBar').css('width','50%');
				}
				else{
					
					alert("ʧ��"+data);
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
			alert('�����йؼ�����û��ѡ����ѡ��������һ���ؼ���');
		}
		else{
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
						//�ϴ�ʧ��
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
					alert('Ŀ��ֵ�޶���1~5֮��');
					return;
				}
				phpChar2 += this.id + ':' + this.value + ';';
			}
		});
		$.ajax({
			type:'POST',
			url:'handle/quiz.php',
			data:{
				operation:'USERFINALSUBMIT',
				quiz_id:$('#quiz_id').val(),
				answer_list:phpChar1,
				goal_list:phpChar2
				
			},
			success:function(data){
				window.location = 'statistics.php?quiz_id'+ $('#quiz_id').val();
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
						//alert(data);
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
			$('#preview-quiz').html(data);
			hide();
			$('#fifth').show();
			$('#progressBar').css('width','80%');
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
				//������һ��
				ask_for_target();
				$('#quiz-answer').html('');
				$('#progressBar').css('width','70%');
				hide();
				$('#fourth').show();
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