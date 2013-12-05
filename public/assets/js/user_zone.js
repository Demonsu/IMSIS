$(document).ready(function(){
	$('#readit').click(function(){
		user_test();
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