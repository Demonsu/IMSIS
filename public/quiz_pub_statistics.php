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
	$(document).ready(function(){
		$.ajax({
			type:'POST',
			url:'./handle/system.php',
			data:{
				operation:'FETCHPUBQUIZSTATISTICS',
			},
			success:function(str){
				alert(str);
				var data = jQuery.parseJSON(str);
				$('#gender1').text(data[0][0]);
				$('#gender2').text(data[0][1]);
				
				$('#age').text(Math.round(data[1][0]/(data[0][0]+data[1][0])));
				
				$('#depart1').text(data[2][0]);
				$('#depart2').text(data[2][1]);
				$('#depart3').text(data[2][2]);
				$('#depart4').text(data[2][3]);
				$('#depart5').text(data[2][4]);
				$('#depart6').text(data[2][5]);
				
				$('#pay1').text(data[3][0]);
				$('#pay2').text(data[3][1]);
				$('#pay3').text(data[3][2]);
				$('#pay4').text(data[3][3]);
				$('#pay5').text(data[3][4]);
				$('#pay6').text(data[3][5]);
				$('#pay7').text(data[3][6]);
				
				$('#edu1').text(data[4][0]);
				$('#edu2').text(data[4][1]);
				$('#edu3').text(data[4][2]);
				$('#edu4').text(data[4][3]);
				$('#edu5').text(data[4][4]);
				$('#edu6').text(data[4][5]);
				$('#edu7').text(data[4][6]);
				$('#edu8').text(data[4][7]);
				
				$('#time').text(data[5][0]);
				
				for(var i=6;i<data.length;i++){
					for(var j=0;j<data[i].length;j++){
						$('#r'+(i-5)+'-'+(j+1)).text(data[i][j]);
					}
				}
			}
		});
		
		$.ajax({
			type:'POST',
			url:'./handle/system.php',
			data:{
				operation:'FETCHPUBQUIZSUGGESTION',
			},
			success:function(str){
				alert(str);
				var data = jQuery.parseJSON(str);
				for(var i=0;i<data.length;i++){
					$('#t1').append('<p>'+(i+1)+':'+htmlDecode(data[i])+'</p>');
				}
			}
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
			<label>男:</label><span id="gender1"></span>
			<label>女:</label><span id="gender2"></span>
		</td>
	</tr>
	<tr>
		<td style="width:20%;">年龄</td>
		<td>
			<span id="age"></span><label>岁</label>
		</td>
	</tr>
	<tr>
		<td style="width:20%;">单位性质</td>
		<td>
			<p><label>国家机关:</label><span id="depart1"></span></p>
			<p><label>私营企业:</label><span id="depart2"></span></p>
			<p><label>事业单位:</label><span id="depart3"></span></p>
			<p><label>国有企业:</label><span id="depart4"></span></p>
			<p><label>外资企业:</label><span id="depart5"></span></p>
			<p><label>其他:</label><span id="depart6"></span></p>
		</td>
	</tr>
	<tr>
		<td style="width:20%;">收入</td>
		<td>
			<p><label>2000元/月及以下:</label><span id="pay1"></span></p>
			<p><label>2000~3500元/月:</label><span id="pay2"></span></p>
			<p><label>3500~5000元/月:</label><span id="pay3"></span></p>
			<p><label>5000~7000元/月:</label><span id="pay4"></span></p>
			<p><label>7000~10000元/月:</label><span id="pay5"></span></p>
			<p><label>10000~50000元/月:</label><span id="pay6"></span></p>
			<p><label>50000元/月以上:</label><span id="pay7"></span></p>
		</td>
	</tr>
	<tr>
		<td style="width:20%;">学历</td>
		<td>
			<label>博士:</label><span id="edu1"></span>
			<label>硕士:</label><span id="edu2"></span>
			<label>本科:</label><span id="edu3"></span>
			<label>大专:</label><span id="edu4"></span>
			<label>中专/技校:</label><span id="edu5"></span>
			<label>高中:</label><span id="edu6"></span>
			<label>初中:</label><span id="edu7"></span>
			<label>其他:</label><span id="edu8"></span>
		</td>
	</tr>
	<tr>
		<td style="width:20%;">工作时间</td>
		<td>
			<span id="time"></span><label>年</label>
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
		<td id="r1-1"></td>
		<td id="r1-2"></td>
		<td id="r1-3"></td>
		<td id="r1-4"></td>
		<td id="r1-5"></td>
	</tr>
	<tr>
		<td id="q2">
			政府网站让我获取信息、办事或与公务人员进行交流更容易。
		</td>
		<td id="r2-1"></td>
		<td id="r2-2"></td>
		<td id="r2-3"></td>
		<td id="r2-4"></td>
		<td id="r2-5"></td>
	</tr>
	<tr>
		<td id="q3">
			通过政府网站获取信息、办事或与公务人员交流花费时间更短。
		</td>
		<td id="r3-1"></td>
		<td id="r3-2"></td>
		<td id="r3-3"></td>
		<td id="r3-4"></td>
		<td id="r3-5"></td>
	</tr>
	<tr>
		<td id="q4">
			通过政府网站获取信息、办事或与公务人员交流更令人满意。
		</td>
		<td id="r4-1"></td>
		<td id="r4-2"></td>
		<td id="r4-3"></td>
		<td id="r4-4"></td>
		<td id="r4-5"></td>
	</tr>
	
	<tr>
		<td rowspan=4>
			感知易用性
		</td>
		<td id="q5">
			对我而言，学习该系统不难。
		</td>
		<td id="r5-1"></td>
		<td id="r5-2"></td>
		<td id="r5-3"></td>
		<td id="r5-4"></td>
		<td id="r5-5"></td>
	</tr>
	<tr>
		<td id="q6">
			使用政府网上服务系统办事更容易。
		</td>
		<td id="r6-1"></td>
		<td id="r6-2"></td>
		<td id="r6-3"></td>
		<td id="r6-4"></td>
		<td id="r6-5"></td>
	</tr>
	<tr>
		<td id="q7">
			弄懂政府网上服务系统的使用方法很容易。
		</td>
		<td id="r7-1"></td>
		<td id="r7-2"></td>
		<td id="r7-3"></td>
		<td id="r7-4"></td>
		<td id="r7-5"></td>
	</tr>
	<tr>
		<td id="q8">
			我很快就能熟练使用政府网上服务系统进行事务办理了。
		</td>
		<td id="r8-1"></td>
		<td id="r8-2"></td>
		<td id="r8-3"></td>
		<td id="r8-4"></td>
		<td id="r8-5"></td>
	</tr>
	
	<tr>
		<td rowspan=3>
			使用行为
		</td>
		<td id="q9">
			我经常使用政府网上服务系统办事。
		</td>
		<td id="r9-1"></td>
		<td id="r9-2"></td>
		<td id="r9-3"></td>
		<td id="r9-4"></td>
		<td id="r9-5"></td>
	</tr>
	<tr>
		<td id="q10">
			我经常就政府网上服务系统使用中出现的问题与政府工作人员进行交流。
		</td>
		<td id="r10-1"></td>
		<td id="r10-2"></td>
		<td id="r10-3"></td>
		<td id="r10-4"></td>
		<td id="r10-5"></td>
	</tr>
	<tr>
		<td id="q11">
			通过不断交流，政府网上服务系统的功能改进很大。
		</td>
		<td id="r11-1"></td>
		<td id="r11-2"></td>
		<td id="r11-3"></td>
		<td id="r11-4"></td>
		<td id="r11-5"></td>
	</tr>
	
	<tr>
		<td rowspan=3>
			使用意愿
		</td>
		<td id="q12">
			我喜欢使用政府网上服务系统办事。
		</td>
		<td id="r12-1"></td>
		<td id="r12-2"></td>
		<td id="r12-3"></td>
		<td id="r12-4"></td>
		<td id="r12-5"></td>
	</tr>
	<tr>
		<td id="q13">
			我会再次使用政府网上服务系统办事。
		</td>
		<td id="r13-1"></td>
		<td id="r13-2"></td>
		<td id="r13-3"></td>
		<td id="r13-4"></td>
		<td id="r13-5"></td>
	</tr>
	<tr>
		<td id="q14">
			我会推荐朋友使用政府网上服务系统办事。
		</td>
		<td id="r14-1"></td>
		<td id="r14-2"></td>
		<td id="r14-3"></td>
		<td id="r14-4"></td>
		<td id="r14-5"></td>
	</tr>
</table>

<p>对本问卷调查的建议</p>
<div style="width:100%;overflow:auto;height:200px;" id="t1">

</div>
<?php include "include/footer.php"; ?>
</div>
</body>
</html>