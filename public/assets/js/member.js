$(document).ready(function(){

	$.ajax({
		type:'POST',
		url:'handle/system.php',
		data:{
			operation:'FETCHSHARELIST2'
		},
		success:function(data){
			$('#share-list').html(data);
		}
	});
	$.ajax({
		type:'POST',
		url:'handle/system.php',
		data:{
			operation:'FETCHNEWSLIST2'
		},
		success:function(data){
			$('#news-list').html(data);
		}
	});
	
	$('#news-id').click(function(){
		hide();
		$('#news-panel').show();
	});
	$('#field-id').click(function(){
		hide();
		$('#field-panel').show();
	});
	$('#service-id').click(function(){
		hide();
		$('#service-panel').show();
	});
	$('#share-id').click(function(){
		hide();
		$('#share-panel').show();
	});
	$('#member-id').click(function(){
		hide();
		$('#member-panel').show();
	});
	$('#bried-id').click(function(){
		hide();
		$('#brief-panel').show();
	});
	$('#link-id').click(function(){
		hide();
		$('#link-panel').show();
	});
	$('#contact-id').click(function(){
		hide();
		$('#contact-panel').show();
	});
	hide();
	$('#brief-panel').show();
});
function opennews(t){
	var s = t.id.split('_');
	window.open('./include/content.php?type=news&id='+s[1],'newwindow');
}
function hide(){
	$('#link-panel').hide();
	$('#contact-panel').hide();
	$('#news-panel').hide();
	$('#field-panel').hide();
	$('#service-panel').hide();
	$('#member-panel').hide();
	$('#share-panel').hide();
	$('#brief-panel').hide();
}