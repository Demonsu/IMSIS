<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php

	$type = $_GET['type'];
	$id = '';
	if($type == 'news'){
		$id = $_GET['id'];
	}
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
			var type = '<?php echo $type; ?>';
			var id = '';
			if(type == 'news'){
				id = <?php echo $id; ?>;
				$.ajax({
					type:'POST',
					url:'../handle/admin_zone.php',
					data:{
						operation:'FETCHNEWSDETAIL',
						id:id
					},
					success:function(str){
						//alert(str);
						var data = jQuery.parseJSON(str);
						//$('#title-div').text(data.title);
						$('#content-div').html(data.content);
					}
				});
			}
		});
	</script>
</head>
<body>

<div class="main">

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
	
	</div>
</div>

</div>

</body>
</html>