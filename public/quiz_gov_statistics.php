<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	include_once '../sys/core/init.inc.php';
?>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8">
	<title>电子政务系统应用效果与服务能力自我评价</title>
	
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
				operation:'FETCHGOVQUIZSTATISTICS',
			},
			success:function(str){
				alert(str);
				var data = jQuery.parseJSON(str);
				for(var i=0;i<data.length;i++){
					for(var j=1;j<=data[i].length;j++){
						$('#r'+(i+1)+'-'+j).text(data[i][j-1]);
					}
				}
			}
		});
		
		$.ajax({
			type:'POST',
			url:'./handle/system.php',
			data:{
				operation:'FETCHGOVQUIZQUESTIONSUGGESTIONLIST',
			},
			success:function(str){
				alert(str);
				var data = jQuery.parseJSON(str);
				for(var i=0;i<data.length;i++){
					$('#t1').append('<p>'+(i+1)+':'+htmlDecode(data[i])+'</p>');
				}
			}
		});
		
		$.ajax({
			type:'POST',
			url:'./handle/system.php',
			data:{
				operation:'FETCHGOVQUIZSUGGESTION',
			},
			success:function(str){
				alert(str);
				var data = jQuery.parseJSON(str);
				for(var i=0;i<data.length;i++){
					$('#t2').append('<p>'+(i+1)+':'+htmlDecode(data[i])+'</p>');
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
<h3><b>电子政务系统的使用感受</b></h3>
<p>（请您根据您日常使用该电子政务系统的感受回答下列问题，1-5代表您感受到的程度，1为最低，5为最高。）</p>
<table style="width:100%;">
	<tr>
		<th style="width:15%;">
			<b>主题</b>
		</th>
		<th style="width:60%;">
			<b>相关问题</b>
		</th>
		<th><b>1</b></th><th><b>2</b></th><th><b>3</b></th><th><b>4</b></th><th><b>5</b></th>
	</tr>
	
	<tr>
		<td rowspan=4>
			感知有用性
		</td>
		<td id="q1">
			该系统可以用于业务办理，不需要再使用纸质办理。
		</td>
		<td id="r1-1"></td>
		<td id="r1-2"></td>
		<td id="r1-3"></td>
		<td id="r1-4"></td>
		<td id="r1-5"></td>
	</tr>
	<tr>
		<td id="q2">
			相比纸质办公系统，该系统使我的工作更加容易。
		</td>
		<td id="r2-1"></td>
		<td id="r2-2"></td>
		<td id="r2-3"></td>
		<td id="r2-4"></td>
		<td id="r2-5"></td>
	</tr>
	<tr>
		<td id="q3">
			相比纸质办公系统，使用该系统办件的时间更短。
		</td>
		<td id="r3-1"></td>
		<td id="r3-2"></td>
		<td id="r3-3"></td>
		<td id="r3-4"></td>
		<td id="r3-5"></td>
	</tr>
	<tr>
		<td id="q4">
			相比纸质办公系统，使用该系统办事的满意度（质量）更高，出错少。
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
			使用该系统开展工作很容易。
		</td>
		<td id="r6-1"></td>
		<td id="r6-2"></td>
		<td id="r6-3"></td>
		<td id="r6-4"></td>
		<td id="r6-5"></td>
	</tr>
	<tr>
		<td id="q7">
			理解该系统的操作步骤不难。
		</td>
		<td id="r7-1"></td>
		<td id="r7-2"></td>
		<td id="r7-3"></td>
		<td id="r7-4"></td>
		<td id="r7-5"></td>
	</tr>
	<tr>
		<td id="q8">
			我很快就能熟练使用该系统。
		</td>
		<td id="r8-1"></td>
		<td id="r8-2"></td>
		<td id="r8-3"></td>
		<td id="r8-4"></td>
		<td id="r8-5"></td>
	</tr>
	
	<tr>
		<td rowspan=4>
			工作参与
		</td>
		<td id="q9">
			您对该系统建设目标、各参与方（监管部门、承建单位、业主单位、服务对象）的了解程度。
		</td>
		<td id="r9-1"></td>
		<td id="r9-2"></td>
		<td id="r9-3"></td>
		<td id="r9-4"></td>
		<td id="r9-5"></td>
	</tr>
	<tr>
		<td id="q10">
			您参与该系统设计、开发中遇到问题的讨论的程度。
		</td>
		<td id="r10-1"></td>
		<td id="r10-2"></td>
		<td id="r10-3"></td>
		<td id="r10-4"></td>
		<td id="r10-5"></td>
	</tr>
	<tr>
		<td id="q11">
			您参与该系统建设工作经验分享的程度。
		</td>
		<td id="r11-1"></td>
		<td id="r11-2"></td>
		<td id="r11-3"></td>
		<td id="r11-4"></td>
		<td id="r11-5"></td>
	</tr>
	<tr>
		<td id="q12">
			您为该系统建设工作提出的建议被采纳的情况。
		</td>
		<td id="r12-1"></td>
		<td id="r12-2"></td>
		<td id="r12-3"></td>
		<td id="r12-4"></td>
		<td id="r12-5"></td>
	</tr>
	
	<tr>
		<td rowspan=3>
			职业发展
		</td>
		<td id="q13">
			使用该系统开展工作容易出工作成绩。
		</td>
		<td id="r13-1"></td>
		<td id="r13-2"></td>
		<td id="r13-3"></td>
		<td id="r13-4"></td>
		<td id="r13-5"></td>
	</tr>
	<tr>
		<td id="q14">
			使用该系统开展工作容易得到单位的认可。
		</td>
		<td id="r14-1"></td>
		<td id="r14-2"></td>
		<td id="r14-3"></td>
		<td id="r14-4"></td>
		<td id="r14-5"></td>
	</tr>
	<tr>
		<td id="q15">
			该系统的工作理念与我个人的职业价值观一致。
		</td>
		<td id="r15-1"></td>
		<td id="r15-2"></td>
		<td id="r15-3"></td>
		<td id="r15-4"></td>
		<td id="r15-5"></td>
	</tr>
</table>

<h3><b>电子政务系统的服务效果评价<b></h3>
<p>（是您应用电子政务系统提供服务情况的感受，1-5代表您感受到的程度，1为最低，5为最高。）</p>
<table style="width:100%">
	<tr>
		<th style="width:15%;">
			<b>主题</b>
		</th>
		<th style="width:60%;">
			<b>相关问题</b>
		</th>
		<th><b>1</b></th><th><b>2</b></th><th><b>3</b></th><th><b>4</b></th><th><b>5</b></th>
	</tr>
	
	<tr>
		<td rowspan=5>
			信息服务能力
		</td>
		<td id="q16">
			通过该系统发布政务信息。
		</td>
		<td id="r16-1"></td>
		<td id="r16-2"></td>
		<td id="r16-3"></td>
		<td id="r16-4"></td>
		<td id="r16-5"></td>
	</tr>
	<tr>
		<td id="q17">
			按政策（如信息公开法）要求，主动向社会发布信息。
		</td>
		<td id="r17-1"></td>
		<td id="r17-2"></td>
		<td id="r17-3"></td>
		<td id="r17-4"></td>
		<td id="r17-5"></td>
	</tr>
	<tr>
		<td id="q18">
			信息发布及时，比如在信息产生后一周内即向社会发布。
		</td>
		<td id="r18-1"></td>
		<td id="r18-2"></td>
		<td id="r18-3"></td>
		<td id="r18-4"></td>
		<td id="r18-5"></td>
	</tr>
	<tr>
		<td id="q19">
			发布的信息内容准确，属第一手资料或其他来源明确的官方资料。
		</td>
		<td id="r19-1"></td>
		<td id="r19-2"></td>
		<td id="r19-3"></td>
		<td id="r19-4"></td>
		<td id="r19-5"></td>
	</tr>
	<tr>
		<td id="q20">
			发布的信息受益人群的大小。
		</td>
		<td id="r20-1"></td>
		<td id="r20-2"></td>
		<td id="r20-3"></td>
		<td id="r20-4"></td>
		<td id="r20-5"></td>
	</tr>
	
	<tr>
		<td rowspan=5>
			事务服务能力
		</td>
		<td id="q21">
			该系统提供办事指南、表格下载、咨询反馈等服务。
		</td>
		<td id="r21-1"></td>
		<td id="r21-2"></td>
		<td id="r21-3"></td>
		<td id="r21-4"></td>
		<td id="r21-5"></td>
	</tr>
	<tr>
		<td id="q22">
			可通过该系统为公众、企业办理业务。
		</td>
		<td id="r22-1"></td>
		<td id="r22-2"></td>
		<td id="r22-3"></td>
		<td id="r22-4"></td>
		<td id="r22-5"></td>
	</tr>
	<tr>
		<td id="q23">
			该系统进行业务办理比窗口办事更容易。
		</td>
		<td id="r23-1"></td>
		<td id="r23-2"></td>
		<td id="r23-3"></td>
		<td id="r23-4"></td>
		<td id="r23-5"></td>
	</tr>
	<tr>
		<td id="q24">
			相对于传统方式，该系统办理业务的时间更短。
		</td>
		<td id="r24-1"></td>
		<td id="r24-2"></td>
		<td id="r24-3"></td>
		<td id="r24-4"></td>
		<td id="r24-5"></td>
	</tr>
	<tr>
		<td id="q25">
			相对于传统方式，该系统办理业务的差错更少。
		</td>
		<td id="r25-1"></td>
		<td id="r25-2"></td>
		<td id="r25-3"></td>
		<td id="r25-4"></td>
		<td id="r25-5"></td>
	</tr>
	
	<tr>
		<td rowspan=5>
			参与服务能力
		</td>
		<td id="q26">
			已开通了网上信访、领导信箱、在线访谈等服务。
		</td>
		<td id="r26-1"></td>
		<td id="r26-2"></td>
		<td id="r26-3"></td>
		<td id="r26-4"></td>
		<td id="r26-5"></td>
	</tr>
	<tr>
		<td id="q27">
			可通过该系统受理公众意见与问题。
		</td>
		<td id="r27-1"></td>
		<td id="r27-2"></td>
		<td id="r27-3"></td>
		<td id="r27-4"></td>
		<td id="r27-5"></td>
	</tr>
	<tr>
		<td id="q28">
			通过该系统受理公众意见与问题更容易。
		</td>
		<td id="r28-1"></td>
		<td id="r28-2"></td>
		<td id="r28-3"></td>
		<td id="r28-4"></td>
		<td id="r28-5"></td>
	</tr>
	<tr>
		<td id="q29">
			通过该系统处理公众意见与问题比其它途径更快。
		</td>
		<td id="r29-1"></td>
		<td id="r29-2"></td>
		<td id="r29-3"></td>
		<td id="r29-4"></td>
		<td id="r29-5"></td>
	</tr>
	<tr>
		<td id="q30">
			通过该系统反馈公众意见与问题的处理结果。
		</td>
		<td id="r30-1"></td>
		<td id="r30-2"></td>
		<td id="r30-3"></td>
		<td id="r30-4"></td>
		<td id="r30-5"></td>
	</tr>
	
	<tr>
		<td rowspan=6>
			服务传递能力
		</td>
		<td id="q31">
			该系统的服务内容可被IE、Firefox等常见浏览器访问。
		</td>
		<td id="r31-1"></td>
		<td id="r31-2"></td>
		<td id="r31-3"></td>
		<td id="r31-4"></td>
		<td id="r31-5"></td>
	</tr>
	<tr>
		<td id="q32">
			该系统的服务内容设计了清晰的导航结构，基于用户导向的界面设计。
		</td>
		<td id="r32-1"></td>
		<td id="r32-2"></td>
		<td id="r32-3"></td>
		<td id="r32-4"></td>
		<td id="r32-5"></td>
	</tr>
	<tr>
		<td id="q33">
			通过该系统提供服务内容比传统方式更快。
		</td>
		<td id="r33-1"></td>
		<td id="r33-2"></td>
		<td id="r33-3"></td>
		<td id="r33-4"></td>
		<td id="r33-5"></td>
	</tr>
	<tr>
		<td id="q34">
			通过该系统提供的服务内容是一站式的。
		</td>
		<td id="r34-1"></td>
		<td id="r34-2"></td>
		<td id="r34-3"></td>
		<td id="r34-4"></td>
		<td id="r34-5"></td>
	</tr>
	<tr>
		<td id="q35">
			该系统提供服务过程中不断线、不宕机、不报错等。
		</td>
		<td id="r35-1"></td>
		<td id="r35-2"></td>
		<td id="r35-3"></td>
		<td id="r35-4"></td>
		<td id="r35-5"></td>
	</tr>
	<tr>
		<td id="q36">
			该系统未被非授权用户入侵过。
		</td>
		<td id="r36-1"></td>
		<td id="r36-2"></td>
		<td id="r36-3"></td>
		<td id="r36-4"></td>
		<td id="r36-5"></td>
	</tr>
	
	<tr>
		<td rowspan=5>
			随需应变能力
		</td>
		<td id="q37">
			该系统注重采用新的信息技术提供（新）所需功能吗？
		</td>
		<td id="r37-1"></td>
		<td id="r37-2"></td>
		<td id="r37-3"></td>
		<td id="r37-4"></td>
		<td id="r37-5"></td>
	</tr>
	<tr>
		<td id="q38">
			单位非常注重持续开发信息资源，并转化为新的系统项目吗？
		</td>
		<td id="r38-1"></td>
		<td id="r38-2"></td>
		<td id="r38-3"></td>
		<td id="r38-4"></td>
		<td id="r38-5"></td>
	</tr>
	<tr>
		<td id="q39">
			单位能快速将该系统建设中的成功案例（包括本单位或外单位的），推广到本单位其他类似项目上吗？
		</td>
		<td id="r39-1"></td>
		<td id="r39-2"></td>
		<td id="r39-3"></td>
		<td id="r39-4"></td>
		<td id="r39-5"></td>
	</tr>
	<tr>
		<td id="q40">
			单位能根据客户需求的变化不断调整内部资源的配置，来提供新的业务功能吗？
		</td>
		<td id="r40-1"></td>
		<td id="r40-2"></td>
		<td id="r40-3"></td>
		<td id="r40-4"></td>
		<td id="r40-5"></td>
	</tr>
	<tr>
		<td id="q41">
			为有效预防该系统应用过程中出现的突发事件，贵单位设立了相应的应急措施（比如双机容错机制、UPS、热备份系统等）吗？
		</td>
		<td id="r41-1"></td>
		<td id="r41-2"></td>
		<td id="r41-3"></td>
		<td id="r41-4"></td>
		<td id="r41-5"></td>
	</tr>
	
	<tr>
		<td rowspan=3>
			服务保障能力
		</td>
		<td id="q42">
			该系统设计有完善的使用帮助平台。
		</td>
		<td id="r42-1"></td>
		<td id="r42-2"></td>
		<td id="r42-3"></td>
		<td id="r42-4"></td>
		<td id="r42-5"></td>
	</tr>
	<tr>
		<td id="q43">
			该系统设计有完善的突发故障应急反应机制。
		</td>
		<td id="r43-1"></td>
		<td id="r43-2"></td>
		<td id="r43-3"></td>
		<td id="r43-4"></td>
		<td id="r43-5"></td>
	</tr>
	<tr>
		<td id="q44">
			该系统可根据用户的服务需求（用户量、强度）的高低动态调整服务水平。
		</td>
		<td id="r44-1"></td>
		<td id="r44-2"></td>
		<td id="r44-3"></td>
		<td id="r44-4"></td>
		<td id="r44-5"></td>
	</tr>
</table>
<p>对上述问题提法的建议：</p>
<div style="width:100%;overflow:auto;height:200px;" id="t1">

</div>

<p>对本调查的建议：</p>
<div style="width:100%;overflow:auto;height:200px;" id="t2">

</div>

<?php include "include/footer.php"; ?>
</div>
</body>
</html>