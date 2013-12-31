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
	
	$('#search-go').click(function(){
		window.open('./include/search.php?search='+$('#search-name').val());
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

function AddFavorite() {
	var ctrl = (navigator.userAgent.toLowerCase()).indexOf('mac') != -1 ? 'Command/Cmd' : 'CTRL';
    if (window.sidebar) {
		//alert(1);
        window.sidebar.addPanel("电子政务与数据只能实验室(E-government & Data Intelligence Laboratory)", "http://ilab.nju.edu.cn", "");
    } else if (document.all) {
		//alert(2);
        window.external.AddFavorite("http://ilab.nju.edu.cn", "电子政务与数据只能实验室(E-government & Data Intelligence Laboratory)");
    } else {
        alert('通过快捷键' + ctrl + ' + D 加入到收藏夹~')
    }
}