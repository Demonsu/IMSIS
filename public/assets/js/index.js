$(document).ready(function(){
	$.ajax({
		type:'POST',
		url:'handle/system.php',
		data:{
			operation:'FETCHSHARELIST'
		},
		success:function(data){
			//alert(data);
			data = data.replace(/\r/g,"");
			data = data.replace(/\n/g,"");
			data = data.replace(/\t/g,"");
			$('#share-div').html(htmlDecode(data));
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
			data = data.replace(/\r/g,"");
			data = data.replace(/\n/g,"");
			data = data.replace(/\t/g,"");
			$('#news-div').html(htmlDecode(data));
		}
	});
	
	$('#search-go').click(function(){
		window.open('./include/search.php?search='+$('#search-name').val());
	});
});
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