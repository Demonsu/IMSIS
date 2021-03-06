﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<?php
	$_BASE_PATH="../../";

	include_once '../../sys/core/init.inc.php';

	//echo $result;
	$id = $_GET['shareid'];
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
	var file_url = '';
	var img_url = '';
	$(document).ready(function(){
		var id = $('#newsid').val();
		$('#cancel').click(function(){
			window.location = '../admin_zone.php?navigation=2';
		});
		$('#confirm').click(function(){
			if(parseInt(id) == -1){
				//alert($('input:radio[name="filetype"]:checked').val());
				$.ajax({
					type:'POST',
					url:'../handle/admin_zone.php',
					data:{
						operation:'ADDDISCOVERY',
						title:htmlEncode($('#title').val()),
						type:$(':radio[name="filetype"]:checked').val(),
						content:htmlEncode(editor.html()),
						url:file_url,
						img_url:img_url
					},
					success:function(data){
						if(data == 1)
							window.location = '../admin_zone.php?navigation=2';
						else
							alert(data);
					}
				});
			}
			else{
				//alert(htmlEncode(editor.html()));
				$.ajax({
					type:'POST',
					url:'../handle/admin_zone.php',
					data:{
						operation:'MODIFYDISCOVERY',
						id:id,
						title:htmlEncode($('#title').val()),
						type:$(':radio[name="filetype"]:checked').val(),
						content:htmlEncode(editor.html()),
						url:file_url,
						img_url:img_url
					},
					success:function(data){
						if(data == 1)
							window.location = '../admin_zone.php?navigation=2';
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
					operation:'FETCHDISCOVERYDETAIL',
					id:id
				},
				success:function(str){
					//alert(str);

					str = str.replace(/\r/g,"");
					str = str.replace(/\n/g,"");
					str = str.replace(/\t/g,"");

					var data = jQuery.parseJSON(str);
					$('#title').val(htmlDecode(data.title));
					editor.insertHtml(htmlDecode(data.content));
					file_url = data.url;
					img_url = data.img_url;
					$(':radio').each(function(){
						if($(this).val() == data.type){
							this.checked = true;	
						}
					});
					$('#file_path').text('./public/assets/upload/files/'+file_url);
					$('#img-path').html('<img src="../assets/upload/pics/'+img_url+'" style="max-width:500px;">');
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
				url:'./ajaxfileupload/doajaxfileupload2.php',
				secureuri:false,
				fileElementId:'fileToUpload',
				dataType: 'json',
				data:{name:'logan', id:'id'},
				success: function (data, status)
				{
					//alert("error:"+data.error+" msg:"+data.msg);
					if(typeof(data.error) != 'undefined')
					{
						if(data.error != '')
						{
							alert(data.error);
						}else
						{
							alert(data.msg);
							file_url = data.msg;
							$('#file_path').text('./public/assets/upload/files/'+file_url);
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
	function ajaxFileUpload2()
	{
		$.ajaxFileUpload
		(
			{
				url:'./ajaxfileupload/doajaxfileupload.php',
				secureuri:false,
				fileElementId:'fileToUpload2',
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
							$('#img-path').html('<img src="../assets/upload/pics/'+img_url+'" style="max-width:500px;">');
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
		<textarea id="text-area" name="content" style="width:960px;height:400px;visibility:hidden;resize:none"></textarea>
	</form>
	<div class="group">
		<label>选择文件类型(分配图标)：</label>
		<label><input type="radio" name="filetype" value="zip" checked />.zip</label>
		<label><input type="radio" name="filetype" value="ppt" />.ppt</label>
		<label><input type="radio" name="filetype" value="doc" />.doc</label>
		<label><input type="radio" name="filetype" value="jpg" />.jpg</label>
		<label><input type="radio" name="filetype" value="xls" />.xls</label>
		<label><input type="radio" name="filetype" value="pdf" />.pdf</label>
		<label><input type="radio" name="filetype" value="other" />other</label>
	</div>
	<label>请选择要分享的文件并上传</label>
	<input id="fileToUpload" type="file" size="45" name="fileToUpload" class="input">
	<button class="button" id="buttonUpload" onClick="return ajaxFileUpload();">上传</button>
	<div>
		<label id="file_path"></label>
	</div>
	<br>
	<label>请选择要用于置顶的图片并上传</label>
	<input id="fileToUpload2" type="file" size="45" name="fileToUpload" class="input">
	<button class="button" id="buttonUpload2" onClick="return ajaxFileUpload2();">上传</button>
	
	<div id="img-path">
		
	</div>
	<p style="float:right">
		<button type="button" class="btn btn-success" id="confirm">确定</button>
		<button type="button" class="btn btn-warning" id="cancel">取消</button>
	</p>
</div>
</body>
</html>

