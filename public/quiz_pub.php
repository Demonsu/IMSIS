<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	include_once '../sys/core/init.inc.php';
?>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8">
	<title>政府网络服务公众接受度</title>
	
	<link rel="stylesheet" href="./assets/dist/css/bootstrap.min.css">
	<script style="text/javascript" src="./assets/js/jquery.js"></script>
	<script style="text/javascript" src="./assets/dist/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="./assets/css/body.css">
	<script>
	var num = new Array();
	$(document).ready(function(){
		for(var j=0;j<14;j++){
			num[j] = false;
		}
		$(':radio').each(function(){
			$(this).change(function(){
				var t = this.name.split('o')[1];
				num[t-1] = true;
				if(!$('#q'+t).hasClass('checked')){
					$('#q'+t).addClass('checked');
				}
				$(':radio[name="'+this.name+'"]').each(function(){
					if($(this.parentNode).hasClass('checked')){
						$(this.parentNode).removeClass('checked');
					}
				});
				$(this.parentNode).addClass('checked');
			});
		});
		$('#submit').click(function(){
			var i,temp=0;
			for(i=0;i<14;i++){
				if(num[i] == true)
					temp++;
			}
			if(temp < 14){
				alert('请填完所有问题');
				return;
			}
			var chr = '';
			chr += '1:'+$(':radio[name="gender"]:checked').val()+';';
			chr += '2:'+$('#age').val()+';';
			chr += '3:'+$(':radio[name="depart"]:checked').val()+';';
			chr += '4:'+$(':radio[name="pay"]:checked').val()+';';
			chr += '5:'+$(':radio[name="edu"]:checked').val()+';';
			chr += '6:'+$('#time').val()+';';
			for(i=1;i<=14;i++){
				chr += (i+6)+':'+$(':radio[name="radio'+i+'"]:checked').val()+';';
			}
			alert(chr);
			
			$.ajax({
				type:'POST',
				url:'./handle/system.php',
				data:{
					operation:'ANSWERPUBQUIZ',
					answer_list:chr,
					quiz_suggestion:htmlEncode($('#t1').val())
				},
				success:function(data){
					if(data == 1){
						window.location('./user_zone.php?navigation=7');
					}
					else
						alert(data);
				}
			});
		});
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
	</script>
	<style>
	.checked{
		background-color:#f0ad4e;
	}
	
	th {
	 font: bold 11px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;
	 color: #000000;
	 border-right: 1px solid #C1DAD7;
	 border-bottom: 1px solid #C1DAD7;
	 border-top: 1px solid #C1DAD7;
	 letter-spacing: 2px;
	 text-transform: uppercase;
	 text-align: left;
	 padding: 6px 6px 6px 12px;
	 background: #CAE8EA;
	}
	th.nobg {
	 border-top: 0;
	 border-left: 0;
	 border-right: 1px solid #C1DAD7;
	 background: none;
	}
	td {
	 border-right: 1px solid #C1DAD7;
	 border-bottom: 1px solid #C1DAD7;
	 background: #fff;
	 font-size:11px;
	 padding: 6px 6px 6px 12px;
	 color: #000000;
	}
	td.alt {
	 background: #F5FAFA;
	 color: #000000;
	}
	th.spec {
	 border-left: 1px solid #C1DAD7;
	 border-top: 0;
	 background: #fff;
	 font: bold 10px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;
	}
	th.specalt {
	 border-left: 1px solid #C1DAD7;
	 border-top: 0;
	 background: #f5fafa url(images/bullet2.gif) no-repeat;
	 font: bold 10px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;
	 color: #000000;
	}
	table{
	 margin-top:25px;
	 margin-bottom:25px;
	}
	</style>
</head>

<body>
<div class="main">
<?php include "include/header.php"; ?>
<h3><b>个人信息</b></h3>
<table style="width:100%;">
	<tr>
		<td style="width:20%;">性别</td>
		<td>
			<label class="checked"><input type="radio" name="gender" value="1" checked />男</label>
			<label><input type="radio" name="gender" value="2"/>女</label>
		</td>
	</tr>
	<tr>
		<td style="width:20%;">年龄</td>
		<td>
			<label><input type="text" id="age" value="30"/>岁</label>
		</td>
	</tr>
	<tr>
		<td style="width:20%;">单位性质</td>
		<td>
			<p><label class="checked"><input type="radio" name="depart" value="1" checked />国家机关</label></p>
			<p><label><input type="radio" name="depart" value="2"/>私营企业</label></p>
			<p><label><input type="radio" name="depart" value="3"/>事业单位</label></p>
			<p><label><input type="radio" name="depart" value="4"/>国有企业</label></p>
			<p><label><input type="radio" name="depart" value="5"/>外资企业</label></p>
			<p><label><input type="radio" name="depart" value="6"/>其他</label></p>
		</td>
	</tr>
	<tr>
		<td style="width:20%;">收入</td>
		<td>
			<p><label class="checked"><input type="radio" name="pay" value="1" checked />2000元/月及以下</label></p>
			<p><label><input type="radio" name="pay" value="2"/>2000~3500元/月</label></p>
			<p><label><input type="radio" name="pay" value="3"/>3500~5000元/月</label></p>
			<p><label><input type="radio" name="pay" value="4"/>5000~7000元/月</label></p>
			<p><label><input type="radio" name="pay" value="5"/>7000~10000元/月</label></p>
			<p><label><input type="radio" name="pay" value="6"/>10000~50000元/月</label></p>
			<p><label><input type="radio" name="pay" value="7"/>50000元/月以上</label></p>
		</td>
	</tr>
	<tr>
		<td style="width:20%;">学历</td>
		<td>
			<label class="checked"><input type="radio" name="edu" value="1" checked />博士</label>
			<label><input type="radio" name="edu" value="2"/>硕士</label>
			<label><input type="radio" name="edu" value="3"/>本科</label>
			<label><input type="radio" name="edu" value="4"/>大专</label>
			<label><input type="radio" name="edu" value="5"/>中专/技校</label>
			<label><input type="radio" name="edu" value="6"/>高中</label>
			<label><input type="radio" name="edu" value="7"/>初中</label>
			<label><input type="radio" name="edu" value="8"/>其他</label>
		</td>
	</tr>
	<tr>
		<td style="width:20%;">工作时间</td>
		<td>
			<label><input type="text" id="time" value="5"/>年</label>
		</td>
	</tr>
</table>
<h3><b>公众接受态度调查</b></h3>
<table style="width:100%;">
	<tr>
		<th style="width:15%;">
			<b>主题</b>
		</th>
		<th style="width:70%;">
			<b>相关问题</b>
		</th>
		<th><b>非常同意</b></th><th><b>同意</b></th><th><b>可能是</b></th><th><b>不同意</b></th><th><b>非常不同意</b></th>
	</tr>
	
	<tr>
		<td rowspan=4>
			感知有用性
		</td>
		<td id="q1">
			可以通过政府网站获取信息、办事或与公务人员进行交流。
		</td>
		<td><input type="radio" name="radio1" value="1" /></td>
		<td><input type="radio" name="radio1" value="2" /></td>
		<td><input type="radio" name="radio1" value="3" /></td>
		<td><input type="radio" name="radio1" value="4" /></td>
		<td><input type="radio" name="radio1" value="5" /></td>
	</tr>
	<tr>
		<td id="q2">
			政府网站让我获取信息、办事或与公务人员进行交流更容易。
		</td>
		<td><input type="radio" name="radio2" value="1" /></td>
		<td><input type="radio" name="radio2" value="2" /></td>
		<td><input type="radio" name="radio2" value="3" /></td>
		<td><input type="radio" name="radio2" value="4" /></td>
		<td><input type="radio" name="radio2" value="5" /></td>
	</tr>
	<tr>
		<td id="q3">
			通过政府网站获取信息、办事或与公务人员交流花费时间更短。
		</td>
		<td><input type="radio" name="radio3" value="1" /></td>
		<td><input type="radio" name="radio3" value="2" /></td>
		<td><input type="radio" name="radio3" value="3" /></td>
		<td><input type="radio" name="radio3" value="4" /></td>
		<td><input type="radio" name="radio3" value="5" /></td>
	</tr>
	<tr>
		<td id="q4">
			通过政府网站获取信息、办事或与公务人员交流更令人满意。
		</td>
		<td><input type="radio" name="radio4" value="1" /></td>
		<td><input type="radio" name="radio4" value="2" /></td>
		<td><input type="radio" name="radio4" value="3" /></td>
		<td><input type="radio" name="radio4" value="4" /></td>
		<td><input type="radio" name="radio4" value="5" /></td>
	</tr>
	
	<tr>
		<td rowspan=4>
			感知易用性
		</td>
		<td id="q5">
			对我而言，学习该系统不难。
		</td>
		<td><input type="radio" name="radio5" value="1" /></td>
		<td><input type="radio" name="radio5" value="2" /></td>
		<td><input type="radio" name="radio5" value="3" /></td>
		<td><input type="radio" name="radio5" value="4" /></td>
		<td><input type="radio" name="radio5" value="5" /></td>
	</tr>
	<tr>
		<td id="q6">
			使用政府网上服务系统办事更容易。
		</td>
		<td><input type="radio" name="radio6" value="1" /></td>
		<td><input type="radio" name="radio6" value="2" /></td>
		<td><input type="radio" name="radio6" value="3" /></td>
		<td><input type="radio" name="radio6" value="4" /></td>
		<td><input type="radio" name="radio6" value="5" /></td>
	</tr>
	<tr>
		<td id="q7">
			弄懂政府网上服务系统的使用方法很容易。
		</td>
		<td><input type="radio" name="radio7" value="1" /></td>
		<td><input type="radio" name="radio7" value="2" /></td>
		<td><input type="radio" name="radio7" value="3" /></td>
		<td><input type="radio" name="radio7" value="4" /></td>
		<td><input type="radio" name="radio7" value="5" /></td>
	</tr>
	<tr>
		<td id="q8">
			我很快就能熟练使用政府网上服务系统进行事务办理了。
		</td>
		<td><input type="radio" name="radio8" value="1" /></td>
		<td><input type="radio" name="radio8" value="2" /></td>
		<td><input type="radio" name="radio8" value="3" /></td>
		<td><input type="radio" name="radio8" value="4" /></td>
		<td><input type="radio" name="radio8" value="5" /></td>
	</tr>
	
	<tr>
		<td rowspan=3>
			使用行为
		</td>
		<td id="q9">
			我经常使用政府网上服务系统办事。
		</td>
		<td><input type="radio" name="radio9" value="1" /></td>
		<td><input type="radio" name="radio9" value="2" /></td>
		<td><input type="radio" name="radio9" value="3" /></td>
		<td><input type="radio" name="radio9" value="4" /></td>
		<td><input type="radio" name="radio9" value="5" /></td>
	</tr>
	<tr>
		<td id="q10">
			我经常就政府网上服务系统使用中出现的问题与政府工作人员进行交流。
		</td>
		<td><input type="radio" name="radio10" value="1" /></td>
		<td><input type="radio" name="radio10" value="2" /></td>
		<td><input type="radio" name="radio10" value="3" /></td>
		<td><input type="radio" name="radio10" value="4" /></td>
		<td><input type="radio" name="radio10" value="5" /></td>
	</tr>
	<tr>
		<td id="q11">
			通过不断交流，政府网上服务系统的功能改进很大。
		</td>
		<td><input type="radio" name="radio11" value="1" /></td>
		<td><input type="radio" name="radio11" value="2" /></td>
		<td><input type="radio" name="radio11" value="3" /></td>
		<td><input type="radio" name="radio11" value="4" /></td>
		<td><input type="radio" name="radio11" value="5" /></td>
	</tr>
	
	<tr>
		<td rowspan=3>
			使用意愿
		</td>
		<td id="q12">
			我喜欢使用政府网上服务系统办事。
		</td>
		<td><input type="radio" name="radio12" value="1" /></td>
		<td><input type="radio" name="radio12" value="2" /></td>
		<td><input type="radio" name="radio12" value="3" /></td>
		<td><input type="radio" name="radio12" value="4" /></td>
		<td><input type="radio" name="radio12" value="5" /></td>
	</tr>
	<tr>
		<td id="q13">
			我会再次使用政府网上服务系统办事。
		</td>
		<td><input type="radio" name="radio13" value="1" /></td>
		<td><input type="radio" name="radio13" value="2" /></td>
		<td><input type="radio" name="radio13" value="3" /></td>
		<td><input type="radio" name="radio13" value="4" /></td>
		<td><input type="radio" name="radio13" value="5" /></td>
	</tr>
	<tr>
		<td id="q14">
			我会推荐朋友使用政府网上服务系统办事。
		</td>
		<td><input type="radio" name="radio14" value="1" /></td>
		<td><input type="radio" name="radio14" value="2" /></td>
		<td><input type="radio" name="radio14" value="3" /></td>
		<td><input type="radio" name="radio14" value="4" /></td>
		<td><input type="radio" name="radio14" value="5" /></td>
	</tr>
</table>

<p>您对本问卷调查的建议</p>
<textarea id="t1" style="resize:none;width:100%;height:50px;border-radius:5px;" ></textarea>
<p style="text-align:right;margin-top:10px;"><button class="btn btn-primary" id="submit">提交</button></p>
<?php include "include/footer.php"; ?>
</div>
</body>
</html>