$(document).ready(function(){
	$('#readit').click(function(){
		hide();
		$('#second').show();
		$('#progressBar').css('width','30%');
	});
	$('#d_confirm').click(function(){
		hide();
		$('#third').show();
		$('#progressBar').css('width','50%');
	});
	$('#next-key-field').click(function(){
		hide();
		$('#fourth').show();
		$('.collapse').collapse('hide');
		$('#progressBar').css('width','70%');
	});
	$('#confirm-target').click(function(){
		var phpChar = '';
		$('select').each(function(){
			var id = this.id;
			phpChar += id + ':' + this.value +';';
		});
		alert(phpChar);
		hide();
		$('#fifth').show();
		$('#progressBar').css('width','90%');
	});
	$('#submit-result').click(function(){
		hide();
		$('#progressBar').css('width','100%');
	});
});

function hide(){
	$('#first').hide();
	$('#second').hide();
	$('#third').hide();
	$('#fourth').hide();
}