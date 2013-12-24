$(document).ready(function(){
	$.ajax({
		type:'POST',
		url:'handle/system.php',
		data:{
			operation:'FETCHSHARELIST'
		},
		success:function(data){
			//alert(data);
			$('#share-div').html(data);
		}
	});
	
	$.ajax({
		type:'POST',
		url:'handle/system.php',
		data:{
			operation:'FETCHNEWSLIST'
		},
		success:function(data){
			//alert(data);
			$('#news-div').html(data);
		}
	});
});

function opennews(t){
	var s = t.id.split('_');
	window.open('./include/content.php?type=news&id='+s[1],'newwindow');
}

function openshare(t){
	var s = t.id.split('_');
	window.open('./include/content.php?type=share&id='+s[1],'newwindow');
}