<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	$_BASE_PATH="../../";

	include_once '../../sys/core/init.inc.php';

	//echo $result;
	$id = $_GET['newsid'];
?>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8">
	<title>管理员中心</title>
	

	<link rel="stylesheet" href="../assets/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/css/body.css">
	<link rel="stylesheet" href="./themes/default/default.css" />
	<script charset="utf-8" src="./kindeditor-min.js"></script>
	<script charset="utf-8" src="./lang/zh_CN.js"></script>
	<script src="../assets/js/jquery.js" type="text/javascript"></script>
	<script src="./ajaxfileupload/ajaxfileupload.js" type="text/javascript"></script>
</head>
<script>
	var editor;
	KindEditor.ready(function(K) {
		editor = K.create('textarea[name="content"]', {
			allowFileManager : true
		});
	});
	var img_url = '';
	$(document).ready(function(){
		var id = $('#newsid').val();
		$('#cancel').click(function(){
			window.location = '../admin_zone.php?navigation=1';
		});
		$('#confirm').click(function(){
			if(parseInt(id) == -1){
				$.ajax({
					type:'POST',
					url:'../handle/admin_zone.php',
					data:{
						operation:'ADDNEWS',
						title:htmlEncode($('#title').val()),
						content:htmlEncode(editor.html()),
						img_url:img_url
					},
					success:function(data){
						
						if(data == 1)
							window.location = '../admin_zone.php?navigation=1';
						else
							alert(data);
					}
				});
			}
			else{
				$.ajax({
					type:'POST',
					url:'../handle/admin_zone.php',
					data:{
						operation:'MODIFYNEWS',
						id:id,
						title:htmlEncode($('#title').val()),
						content:htmlEncode(editor.html()),
						img_url:img_url
					},
					success:function(data){
						alert(htmlEncode(editor.html()));
						if(data == 1)
							window.location = '../admin_zone.php?navigation=1';
						else
							alert(data);
					}
				});
			}
		});
		if(parseInt(id) != -1){
			$.ajax({
				type:'POST',
				url:'../handle/admin_zone.php',
				data:{
					operation:'FETCHNEWSDETAIL',
					id:id
				},
				success:function(str){
<<<<<<< HEAD
					//alert(str);
					str = str.replace(/\r/g,"");
					str = str.replace(/\n/g,"");
					str = str.replace(/\t/g,"");
					//alert(str);
=======
					alert(str);
>>>>>>> b6f4dc0ef5de434642e71183f5acc9db76b48cd2
					var data = jQuery.parseJSON(str);
					$('#title').val(htmlDecode(data.title));
					editor.insertHtml(htmlDecode(data.content));
					img_url = data.img_url;
					$('#img-show').html('<img src="../assets/upload/pics/'+img_url+'" style="max-width:500px;">');
				}
			});
		}
	});
	function htmlEncode(str) {
		var s = "";  
		if (str.length == 0) return "";  
		s = str.replace(/&/g, "&amp;");  
		s = s.replace(/</g, "&lt;");  
		s = s.replace(/>/g, "&gt;");  
		s = s.replace(/'/g, "&apos;");  
		s = s.replace(/"/g, "&quot;");
		return s;  
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
	function ajaxFileUpload()
	{
		$.ajaxFileUpload
		(
			{
				url:'./ajaxfileupload/doajaxfileupload.php',
				secureuri:false,
				fileElementId:'fileToUpload',
				dataType: 'json',
				data:{name:'logan', id:'id'},
				success: function (data, status)
				{
					if(typeof(data.error) != 'undefined')
					{
						if(data.error != '')
						{
							alert(data.error);
						}else
						{
							alert(data.msg);
							img_url = data.msg;
							$('#img-show').html('<img src="../assets/upload/pics/'+img_url+'" style="max-width:500px;">');
						}
					}
				},
				error: function (data, status, e)
				{
					alert(e);
				}
			}
		)
		
		return false;

	}
</script>
<body>
<div class="main">
	<input type="text" id="newsid" value="<?php echo $id; ?>" style="display:none"/>
	<div class="input-group" style="margin-top:30px;">
	  <span class="input-group-addon">标题</span>
	  <input type="text" class="form-control" id="title" placeholder="标题">
	</div>
	<form>
		<textarea name="content" style="width:960px;height:400px;visibility:hidden;resize:none"></textarea>
	</form>
	<input id="fileToUpload" type="file" size="45" name="fileToUpload" class="input">
	<button class="button" id="buttonUpload" onClick="return ajaxFileUpload();">上传</button>
	<div id="img-show" style="max-width:600px;">
		
	</div>
	<p style="float:right">
		<button type="button" class="btn btn-success" id="confirm">确定</button>
		<button type="button" class="btn btn-warning" id="cancel">取消</button>
	</p>
</div>
</body>
</html>

