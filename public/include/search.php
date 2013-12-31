<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php

	$search = $_GET['search'];
?>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8">
	<title>电子政务与数据智能Lab-主页</title>
	

	<link rel="stylesheet" href="../assets/dist/css/bootstrap.min.css">
	<script style="text/javascript" src="../assets/js/jquery.js"></script>
	<script style="text/javascript" src="../assets/dist/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="../assets/css/body.css">
	<script style="text/javascript" src="../assets/js/content.js"></script>
	<style>
		.main-content{
			width:900;
			margin-left:30px;
			margin-right:30px;
		}
		#title-div{
			width:100%;
			text-align:center;
		}
		#content-div{
			width:100%;
			min-height:500px;
		}
		p{
			text-indent:2em;
		}
	</style>
	<script>
		$(document).ready(function(){
			var search = $('#search').val();
			//alert(search);
			$.ajax({
				type:'POST',
				url:'../handle/system.php',
				data:{
					operation:'SEARCHWEBSITE',
					key_word:search
				},
				success:function(str){
					//alert(str);
					
					var data = jQuery.parseJSON(str);
					var show = '';
					for(var i=0;i<data.length;i++){
						show += '<li>';
						if(data[i].type == 'news'){
							show += '<span><a href="./content.php?type=news&id='+data[i].id+'">';
						}
						else if(data[i].type == 'share'){
							show += '<span><a href="../assets/upload/files/'+data[i].id+'">';
						}
						show += data[i].title+'</a></span>';
						show += '<span style="float:right">'+data[i].time+'</span>';
						show += '</li>';
					}
					$('#list').html(show);
				}
			});
		});
	</script>
</head>
<body>

<div class="main">
<input style="display:none" type="text" id="search" value="<?php echo $search; ?>" />
<div style="height:130px;width:100%;float:left;">
	<div class="col-md-3">
		<img src="../assets/img/index/logo.png" />
	</div>
	<div class="col-md-6">
	</div>
	<div class="col-md-3">
		
	</div>
</div>

<div class="main-content">
	<div id="content-div">
		<ul style="width:800px;margn-left:50px;margin-right:50px;" id="list">
			
		</ul>
	</div>
</div>

</div>

</body>
</html>