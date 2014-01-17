$(document).ready(function(){

	$.ajax({
		type:'POST',
		url:'../handle/system.php',
		data:{
			operation:'FETCHSHARELIST2'
		},
		success:function(data){
			//alert(data);
			$('#share-list').html(htmlDecode(data));
		}
	});
	$.ajax({
		type:'POST',
		url:'../handle/system.php',
		data:{
			operation:'FETCHNEWSLIST2'
		},
		success:function(data){
			$('#news-list').html(htmlDecode(data));
		}
	});
	$('#brief-id').click(function(){
		hide();
		$('#brief-panel').show();
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
	$('#map-id').click(function(){
		hide();
		$('#map-panel').show();
	});
	$('#law-id').click(function(){
		hide();
		$('#law-panel').show();
	});
	hide();
	$('#brief-panel').show();
});

function hide(){
	$('#law-panel').hide();
	$('#map-panel').hide()
	$('#link-panel').hide();
	$('#contact-panel').hide();
	$('#news-panel').hide();
	$('#field-panel').hide();
	$('#service-panel').hide();
	$('#member-panel').hide();
	$('#share-panel').hide();
	$('#brief-panel').hide();
}
function htmlDecode(str){
	var s = "";
	if(str.length == 0) return "";
	s = str.replace(/&amp;/g,"&");
	s = s.replace(/&lt;/g, "<");  
	s = s.replace(/&gt;/g, ">");    
	s = s.replace(/&apos;/g, "'");  
	s = s.replace(/&quot;/g, '"');
	return s;
}
function opennews(t){
	var s = t.id.split('_');
	window.open('./include/content.php?type=news&id='+s[1],'newwindow');
}