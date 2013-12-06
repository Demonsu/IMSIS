$(document).ready(function(){
	
	$.ajax({
		type:'POST',
		url:'handle/quiz.php',
		data:{
			operation:'FETCHQUIZPROCESS',
			quiz_id:$('#quiz_id').val()
		},
		success:function(data){
			alert(data)
			$('#quiz-progress').html(data);
			$('.over-doing').each(function(){
				get_key_field(this);
			});
		}
	});
	
	
});

function get_key_field(t){
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