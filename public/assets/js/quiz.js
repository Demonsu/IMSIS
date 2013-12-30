$(document).ready(function(){	
	getprogress();//页面初始化操作
	
	
	$('#next-key-field').click(function(){//点击下一个关键域的时候统计页面内容
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
						getprogress();
					}
					else{
						//上传失败
					}
				}
			});
			$('#loading-cover').hide();
		}
	});
	
	$('#confirm-target').click(function(){
		var phpChar = '';
		$('select').each(function(){
			var id = this.id;
			phpChar += id + ':' + this.value +';';
		});
		//alert(phpChar);
		$('#loading-cover').show();
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
		$('#loading-cover').hide();
	});
	
	$('#submit-quiz').click(function(){
	
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
				if(this.value > 5 || this.value < 0 || isNaN(this.value) || this.value.length != 1){
					alert('目标值限定在0~5之间');
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
				goal_list:phpChar2
				
			},
			success:function(data){
				//alert(data);
				window.location = 'statistics.php?quiz_id='+ $('#quiz_id').val();
			}
		});
		$('#loading-cover').hide();
		
	});
	
});
function ask_for_preview(){
	$('#loading-cover').show();
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
			$('#preview-quiz').html(data);
			
			$(':radio').each(function(){
				if(this.checked == false){
					$(this.parentNode).hide();
				}
			});
			$('.button-modify').click(function(){
				var t = this;
				$(':radio').each(function(){
					if(this.checked && this.parentNode.parentNode == t.parentNode.parentNode)
						$(this.parentNode).addClass('radio-selected');
				});
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
			$('#third').show();
			$('#progressBar').css('width','80%');
		}
	});
	$('#loading-cover').hide();
}	
function set_checked(name,val){
	$(':radio').each(function(){
		if(this.value == val && this.name == name){
			this.checked = true;
		}
	});
}

function getprogress(){//获取第一步左边的进度表，调用函数获取问卷
	$('#loading-cover').show();
	$.ajax({
		type:'POST',
		url:'handle/quiz.php',
		data:{
			operation:'FETCHANSWERPROCESS',
			quiz_id:$('#quiz_id').val()
		},
		success:function(data){
			//alert(data);
			$('#answered-quiz').text(data);
		}
	});
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
				$('#quiz-answer').html('');
				$('#progressBar').css('width','50%');
				hide();
				$('#second').show();
				ask_for_target();
			}
			else{
				//alert(data);
				hide();
				$('#first').show();
				$('#quiz-progress').html(data);
				
				$('.remove-circle').each(function(){
					$(this).click(function(){
						//alert(this.parentNode.id);
						$.ajax({
							type:'POST',
							url:'handle/quiz.php',
							data:{
								operation:'DELETEKEYFIELD',
								quiz_id:$('#quiz_id').val(),
								key_field_id:this.parentNode.id
							},
							success:function(data){
								if(data == 1){
									window.location.reload();
								}
								else
									alert(data);
							}
						});
					});
				});
				$('.select-field').each(function(){
					$(this).click(function(){
						//alert($(this.parentNode.parentNode).html());
						if(!$(this.parentNode).hasClass('over-doing')){
							var t = this;
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
							if(checkedNum * 6 >= varNum){
								var sub = window.confirm('你已经填完当前关键域，是否保存');
								if(sub){
									//alert(phpChar);
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
												$('.over-doing').addClass('over-done');
											}
											else{
												alert(data);//上传失败
											}
										}
									});
									$('#loading-cover').hide();
								}
							}
							$('#loading-cover').show();
							$.ajax({
								type:'POST',
								url:'handle/quiz.php',
								data:{
									operation:'FETCHMYKEYVARIABLE',
									quiz_id:$('#quiz_id').val(),
									key_field_id:this.parentNode.id
								},
								success:function(data){
									$('.over-doing').removeClass('over-doing');
									$(t.parentNode).addClass('over-doing');
									$('#quiz-answer').html(data);
									$(':radio').each(function(){
										if(this.checked == true){
											$(this.parentNode).addClass('radio-selected');
										}
									});
									$(':radio').click(function(){
										var name = this.name;
										$(':radio').each(function(){
											if(this.name == name)
												$(this.parentNode).removeClass('radio-selected');
										});
										$(this.parentNode).addClass('radio-selected');
									});
								}
							});
							$('#loading-cover').hide();
						}
					});
				});
				
				$('.over-doing').each(function(){
					get_key_field(this);
				});
			}
		}
	});
	$('#loading-cover').hide();
}

function ask_for_target(){
	$('#loading-cover').show();
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
				$('#loading-cover').show();
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
						//目标不用用户设置
						$('#confirm-target').click();
					}
				});
				$('#loading-cover').hide();
			}
		}
	});	
	$('#loading-cover').hide();
}

function get_key_field(t){//获取第一步右边的问卷
	var id = t.id;
	$('#loading-cover').show();
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
				var temp = 0;
				$(':radio').each(function(){
					if(this.name == name && $(this.parentNode).hasClass('radio-selected')){
						$(this.parentNode).removeClass('radio-selected');
						temp++;
					}
				});
				if(temp == 0){
					temp = $('#answered-quiz').text();
					var s = temp.split('/');
					$('#answered-quiz').text((parseInt(s[0])+1)+'/'+s[1]);
					if(parseInt(s[0])+1 == parseInt(s[1]))
						$('#next-key-field').text('完成测评');
				}
				$(this.parentNode).addClass('radio-selected');
			});
			$('body,html').animate({scrollTop:"180px"});
		}
	});
	$('#loading-cover').hide();
}

function hide(){
	$('#first').hide();
	$('#second').hide();
	$('#third').hide();
}
