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
			$.ajax({
				type:'POST',
				url:'handle/quiz.php',
				data:{
					operation:'ANSERQUESTIONNAIRE',
					answer:phpChar
				},
				success:function(data){
					if(data == 1){
						getprogress();
					}
					else{
						//上传失败
					}
				}
			});
		}
	});
	
});

function getprogress(){//获取第一步左边的进度表，调用函数获取问卷
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
			}
			else{
				alert(data);
				$('#quiz-progress').html(data);
				$('.over-doing').each(function(){
					get_key_field(this);
				});
			}
		}
	});
}

function get_key_field(t){//获取第一步右边的问卷
	var id = t.id;
	$.ajax({
		type:'POST',
		url:'handle/quiz.php',
		data:{
			operation:'FETCHKEYVARIABLE',
			key_field_id:id
			
		},
		success:function(data){
			alert(data);
			$('#quiz-answer').html(data);
		}
	});
}

