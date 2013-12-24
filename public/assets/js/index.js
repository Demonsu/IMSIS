$(document).ready(function(){
	$.ajax({
		type:'POST',
		url:'handle/system.php',
		data:{
			
		},
		success:function(data){
			alert(data);
			$('#share-div').html(data);
		}
	});
	
	$.ajax({
		type:'POST',
		url:'handle/system.php',
		data:{
			
		},
		success:function(data){
			alert(data);
			$('#news-div').html(data);
		}
	});
});