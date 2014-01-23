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
	var num = new Array();
	$(document).ready(function(){
		for(var j=0;j<44;j++){
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
			for(i=0;i<44;i++){
				if(num[i] == true)
					temp++;
			}
			if(temp < 44){
				alert('请填完所有问题');
				return;
			}
			var chr = '';
			for(i=1;i<=44;i++){
				chr += i+':'+$(':radio[name="radio'+i+'"]:checked').val()+';';
			}
			//alert(chr);
			
			$.ajax({
				url:'./handle/system.php',
				data:{
					operation:'ANSWERGOVQUIZ',
					answer_list:chr,
					question_suggestion:htmlEncode($('#t1').val()),
					quiz_suggestion:htmlEncode($('#t2').val())
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
<h3><b>电子政务系统的使用感受</b></h3>
<p>（请您根据您日常使用该电子政务系统的感受回答下列问题，1-5代表您感受到的程度，1为最低，5为最高。）</p>
<table style="width:100%;">
	<tr>
		<th style="width:15%;">
			<b>主题</b>
		</th>
		<th style="width:70%;">
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
		<td><input type="radio" name="radio1" value="1" /></td>
		<td><input type="radio" name="radio1" value="2" /></td>
		<td><input type="radio" name="radio1" value="3" /></td>
		<td><input type="radio" name="radio1" value="4" /></td>
		<td><input type="radio" name="radio1" value="5" /></td>
	</tr>
	<tr>
		<td id="q2">
			相比纸质办公系统，该系统使我的工作更加容易。
		</td>
		<td><input type="radio" name="radio2" value="1" /></td>
		<td><input type="radio" name="radio2" value="2" /></td>
		<td><input type="radio" name="radio2" value="3" /></td>
		<td><input type="radio" name="radio2" value="4" /></td>
		<td><input type="radio" name="radio2" value="5" /></td>
	</tr>
	<tr>
		<td id="q3">
			相比纸质办公系统，使用该系统办件的时间更短。
		</td>
		<td><input type="radio" name="radio3" value="1" /></td>
		<td><input type="radio" name="radio3" value="2" /></td>
		<td><input type="radio" name="radio3" value="3" /></td>
		<td><input type="radio" name="radio3" value="4" /></td>
		<td><input type="radio" name="radio3" value="5" /></td>
	</tr>
	<tr>
		<td id="q4">
			相比纸质办公系统，使用该系统办事的满意度（质量）更高，出错少。
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
			使用该系统开展工作很容易。
		</td>
		<td><input type="radio" name="radio6" value="1" /></td>
		<td><input type="radio" name="radio6" value="2" /></td>
		<td><input type="radio" name="radio6" value="3" /></td>
		<td><input type="radio" name="radio6" value="4" /></td>
		<td><input type="radio" name="radio6" value="5" /></td>
	</tr>
	<tr>
		<td id="q7">
			理解该系统的操作步骤不难。
		</td>
		<td><input type="radio" name="radio7" value="1" /></td>
		<td><input type="radio" name="radio7" value="2" /></td>
		<td><input type="radio" name="radio7" value="3" /></td>
		<td><input type="radio" name="radio7" value="4" /></td>
		<td><input type="radio" name="radio7" value="5" /></td>
	</tr>
	<tr>
		<td id="q8">
			我很快就能熟练使用该系统。
		</td>
		<td><input type="radio" name="radio8" value="1" /></td>
		<td><input type="radio" name="radio8" value="2" /></td>
		<td><input type="radio" name="radio8" value="3" /></td>
		<td><input type="radio" name="radio8" value="4" /></td>
		<td><input type="radio" name="radio8" value="5" /></td>
	</tr>
	
	<tr>
		<td rowspan=4>
			工作参与
		</td>
		<td id="q9">
			您对该系统建设目标、各参与方（监管部门、承建单位、业主单位、服务对象）的了解程度。
		</td>
		<td><input type="radio" name="radio9" value="1" /></td>
		<td><input type="radio" name="radio9" value="2" /></td>
		<td><input type="radio" name="radio9" value="3" /></td>
		<td><input type="radio" name="radio9" value="4" /></td>
		<td><input type="radio" name="radio9" value="5" /></td>
	</tr>
	<tr>
		<td id="q10">
			您参与该系统设计、开发中遇到问题的讨论的程度。
		</td>
		<td><input type="radio" name="radio10" value="1" /></td>
		<td><input type="radio" name="radio10" value="2" /></td>
		<td><input type="radio" name="radio10" value="3" /></td>
		<td><input type="radio" name="radio10" value="4" /></td>
		<td><input type="radio" name="radio10" value="5" /></td>
	</tr>
	<tr>
		<td id="q11">
			您参与该系统建设工作经验分享的程度。
		</td>
		<td><input type="radio" name="radio11" value="1" /></td>
		<td><input type="radio" name="radio11" value="2" /></td>
		<td><input type="radio" name="radio11" value="3" /></td>
		<td><input type="radio" name="radio11" value="4" /></td>
		<td><input type="radio" name="radio11" value="5" /></td>
	</tr>
	<tr>
		<td id="q12">
			您为该系统建设工作提出的建议被采纳的情况。
		</td>
		<td><input type="radio" name="radio12" value="1" /></td>
		<td><input type="radio" name="radio12" value="2" /></td>
		<td><input type="radio" name="radio12" value="3" /></td>
		<td><input type="radio" name="radio12" value="4" /></td>
		<td><input type="radio" name="radio12" value="5" /></td>
	</tr>
	
	<tr>
		<td rowspan=3>
			职业发展
		</td>
		<td id="q13">
			使用该系统开展工作容易出工作成绩。
		</td>
		<td><input type="radio" name="radio13" value="1" /></td>
		<td><input type="radio" name="radio13" value="2" /></td>
		<td><input type="radio" name="radio13" value="3" /></td>
		<td><input type="radio" name="radio13" value="4" /></td>
		<td><input type="radio" name="radio13" value="5" /></td>
	</tr>
	<tr>
		<td id="q14">
			使用该系统开展工作容易得到单位的认可。
		</td>
		<td><input type="radio" name="radio14" value="1" /></td>
		<td><input type="radio" name="radio14" value="2" /></td>
		<td><input type="radio" name="radio14" value="3" /></td>
		<td><input type="radio" name="radio14" value="4" /></td>
		<td><input type="radio" name="radio14" value="5" /></td>
	</tr>
	<tr>
		<td id="q15">
			该系统的工作理念与我个人的职业价值观一致。
		</td>
		<td><input type="radio" name="radio15" value="1" /></td>
		<td><input type="radio" name="radio15" value="2" /></td>
		<td><input type="radio" name="radio15" value="3" /></td>
		<td><input type="radio" name="radio15" value="4" /></td>
		<td><input type="radio" name="radio15" value="5" /></td>
	</tr>
</table>

<h3><b>电子政务系统的服务效果评价<b></h3>
<p>（是您应用电子政务系统提供服务情况的感受，1-5代表您感受到的程度，1为最低，5为最高。）</p>
<table style="width:100%">
	<tr>
		<th style="width:15%;">
			<b>主题</b>
		</th>
		<th style="width:70%;">
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
		<td><input type="radio" name="radio16" value="1" /></td>
		<td><input type="radio" name="radio16" value="2" /></td>
		<td><input type="radio" name="radio16" value="3" /></td>
		<td><input type="radio" name="radio16" value="4" /></td>
		<td><input type="radio" name="radio16" value="5" /></td>
	</tr>
	<tr>
		<td id="q17">
			按政策（如信息公开法）要求，主动向社会发布信息。
		</td>
		<td><input type="radio" name="radio17" value="1" /></td>
		<td><input type="radio" name="radio17" value="2" /></td>
		<td><input type="radio" name="radio17" value="3" /></td>
		<td><input type="radio" name="radio17" value="4" /></td>
		<td><input type="radio" name="radio17" value="5" /></td>
	</tr>
	<tr>
		<td id="q18">
			信息发布及时，比如在信息产生后一周内即向社会发布。
		</td>
		<td><input type="radio" name="radio18" value="1" /></td>
		<td><input type="radio" name="radio18" value="2" /></td>
		<td><input type="radio" name="radio18" value="3" /></td>
		<td><input type="radio" name="radio18" value="4" /></td>
		<td><input type="radio" name="radio18" value="5" /></td>
	</tr>
	<tr>
		<td id="q19">
			发布的信息内容准确，属第一手资料或其他来源明确的官方资料。
		</td>
		<td><input type="radio" name="radio19" value="1" /></td>
		<td><input type="radio" name="radio19" value="2" /></td>
		<td><input type="radio" name="radio19" value="3" /></td>
		<td><input type="radio" name="radio19" value="4" /></td>
		<td><input type="radio" name="radio19" value="5" /></td>
	</tr>
	<tr>
		<td id="q20">
			发布的信息受益人群的大小。
		</td>
		<td><input type="radio" name="radio20" value="1" /></td>
		<td><input type="radio" name="radio20" value="2" /></td>
		<td><input type="radio" name="radio20" value="3" /></td>
		<td><input type="radio" name="radio20" value="4" /></td>
		<td><input type="radio" name="radio20" value="5" /></td>
	</tr>
	
	<tr>
		<td rowspan=5>
			事务服务能力
		</td>
		<td id="q21">
			该系统提供办事指南、表格下载、咨询反馈等服务。
		</td>
		<td><input type="radio" name="radio21" value="1" /></td>
		<td><input type="radio" name="radio21" value="2" /></td>
		<td><input type="radio" name="radio21" value="3" /></td>
		<td><input type="radio" name="radio21" value="4" /></td>
		<td><input type="radio" name="radio21" value="5" /></td>
	</tr>
	<tr>
		<td id="q22">
			可通过该系统为公众、企业办理业务。
		</td>
		<td><input type="radio" name="radio22" value="1" /></td>
		<td><input type="radio" name="radio22" value="2" /></td>
		<td><input type="radio" name="radio22" value="3" /></td>
		<td><input type="radio" name="radio22" value="4" /></td>
		<td><input type="radio" name="radio22" value="5" /></td>
	</tr>
	<tr>
		<td id="q23">
			该系统进行业务办理比窗口办事更容易。
		</td>
		<td><input type="radio" name="radio23" value="1" /></td>
		<td><input type="radio" name="radio23" value="2" /></td>
		<td><input type="radio" name="radio23" value="3" /></td>
		<td><input type="radio" name="radio23" value="4" /></td>
		<td><input type="radio" name="radio23" value="5" /></td>
	</tr>
	<tr>
		<td id="q24">
			相对于传统方式，该系统办理业务的时间更短。
		</td>
		<td><input type="radio" name="radio24" value="1" /></td>
		<td><input type="radio" name="radio24" value="2" /></td>
		<td><input type="radio" name="radio24" value="3" /></td>
		<td><input type="radio" name="radio24" value="4" /></td>
		<td><input type="radio" name="radio24" value="5" /></td>
	</tr>
	<tr>
		<td id="q25">
			相对于传统方式，该系统办理业务的差错更少。
		</td>
		<td><input type="radio" name="radio25" value="1" /></td>
		<td><input type="radio" name="radio25" value="2" /></td>
		<td><input type="radio" name="radio25" value="3" /></td>
		<td><input type="radio" name="radio25" value="4" /></td>
		<td><input type="radio" name="radio25" value="5" /></td>
	</tr>
	
	<tr>
		<td rowspan=5>
			参与服务能力
		</td>
		<td id="q26">
			已开通了网上信访、领导信箱、在线访谈等服务。
		</td>
		<td><input type="radio" name="radio26" value="1" /></td>
		<td><input type="radio" name="radio26" value="2" /></td>
		<td><input type="radio" name="radio26" value="3" /></td>
		<td><input type="radio" name="radio26" value="4" /></td>
		<td><input type="radio" name="radio26" value="5" /></td>
	</tr>
	<tr>
		<td id="q27">
			可通过该系统受理公众意见与问题。
		</td>
		<td><input type="radio" name="radio27" value="1" /></td>
		<td><input type="radio" name="radio27" value="2" /></td>
		<td><input type="radio" name="radio27" value="3" /></td>
		<td><input type="radio" name="radio27" value="4" /></td>
		<td><input type="radio" name="radio27" value="5" /></td>
	</tr>
	<tr>
		<td id="q28">
			通过该系统受理公众意见与问题更容易。
		</td>
		<td><input type="radio" name="radio28" value="1" /></td>
		<td><input type="radio" name="radio28" value="2" /></td>
		<td><input type="radio" name="radio28" value="3" /></td>
		<td><input type="radio" name="radio28" value="4" /></td>
		<td><input type="radio" name="radio28" value="5" /></td>
	</tr>
	<tr>
		<td id="q29">
			通过该系统处理公众意见与问题比其它途径更快。
		</td>
		<td><input type="radio" name="radio29" value="1" /></td>
		<td><input type="radio" name="radio29" value="2" /></td>
		<td><input type="radio" name="radio29" value="3" /></td>
		<td><input type="radio" name="radio29" value="4" /></td>
		<td><input type="radio" name="radio29" value="5" /></td>
	</tr>
	<tr>
		<td id="q30">
			通过该系统反馈公众意见与问题的处理结果。
		</td>
		<td><input type="radio" name="radio30" value="1" /></td>
		<td><input type="radio" name="radio30" value="2" /></td>
		<td><input type="radio" name="radio30" value="3" /></td>
		<td><input type="radio" name="radio30" value="4" /></td>
		<td><input type="radio" name="radio30" value="5" /></td>
	</tr>
	
	<tr>
		<td rowspan=6>
			服务传递能力
		</td>
		<td id="q31">
			该系统的服务内容可被IE、Firefox等常见浏览器访问。
		</td>
		<td><input type="radio" name="radio31" value="1" /></td>
		<td><input type="radio" name="radio31" value="2" /></td>
		<td><input type="radio" name="radio31" value="3" /></td>
		<td><input type="radio" name="radio31" value="4" /></td>
		<td><input type="radio" name="radio31" value="5" /></td>
	</tr>
	<tr>
		<td id="q32">
			该系统的服务内容设计了清晰的导航结构，基于用户导向的界面设计。
		</td>
		<td><input type="radio" name="radio32" value="1" /></td>
		<td><input type="radio" name="radio32" value="2" /></td>
		<td><input type="radio" name="radio32" value="3" /></td>
		<td><input type="radio" name="radio32" value="4" /></td>
		<td><input type="radio" name="radio32" value="5" /></td>
	</tr>
	<tr>
		<td id="q33">
			通过该系统提供服务内容比传统方式更快。
		</td>
		<td><input type="radio" name="radio33" value="1" /></td>
		<td><input type="radio" name="radio33" value="2" /></td>
		<td><input type="radio" name="radio33" value="3" /></td>
		<td><input type="radio" name="radio33" value="4" /></td>
		<td><input type="radio" name="radio33" value="5" /></td>
	</tr>
	<tr>
		<td id="q34">
			通过该系统提供的服务内容是一站式的。
		</td>
		<td><input type="radio" name="radio34" value="1" /></td>
		<td><input type="radio" name="radio34" value="2" /></td>
		<td><input type="radio" name="radio34" value="3" /></td>
		<td><input type="radio" name="radio34" value="4" /></td>
		<td><input type="radio" name="radio34" value="5" /></td>
	</tr>
	<tr>
		<td id="q35">
			该系统提供服务过程中不断线、不宕机、不报错等。
		</td>
		<td><input type="radio" name="radio35" value="1" /></td>
		<td><input type="radio" name="radio35" value="2" /></td>
		<td><input type="radio" name="radio35" value="3" /></td>
		<td><input type="radio" name="radio35" value="4" /></td>
		<td><input type="radio" name="radio35" value="5" /></td>
	</tr>
	<tr>
		<td id="q36">
			该系统未被非授权用户入侵过。
		</td>
		<td><input type="radio" name="radio36" value="1" /></td>
		<td><input type="radio" name="radio36" value="2" /></td>
		<td><input type="radio" name="radio36" value="3" /></td>
		<td><input type="radio" name="radio36" value="4" /></td>
		<td><input type="radio" name="radio36" value="5" /></td>
	</tr>
	
	<tr>
		<td rowspan=5>
			随需应变能力
		</td>
		<td id="q37">
			该系统注重采用新的信息技术提供（新）所需功能吗？
		</td>
		<td><input type="radio" name="radio37" value="1" /></td>
		<td><input type="radio" name="radio37" value="2" /></td>
		<td><input type="radio" name="radio37" value="3" /></td>
		<td><input type="radio" name="radio37" value="4" /></td>
		<td><input type="radio" name="radio37" value="5" /></td>
	</tr>
	<tr>
		<td id="q38">
			单位非常注重持续开发信息资源，并转化为新的系统项目吗？
		</td>
		<td><input type="radio" name="radio38" value="1" /></td>
		<td><input type="radio" name="radio38" value="2" /></td>
		<td><input type="radio" name="radio38" value="3" /></td>
		<td><input type="radio" name="radio38" value="4" /></td>
		<td><input type="radio" name="radio38" value="5" /></td>
	</tr>
	<tr>
		<td id="q39">
			单位能快速将该系统建设中的成功案例（包括本单位或外单位的），推广到本单位其他类似项目上吗？
		</td>
		<td><input type="radio" name="radio39" value="1" /></td>
		<td><input type="radio" name="radio39" value="2" /></td>
		<td><input type="radio" name="radio39" value="3" /></td>
		<td><input type="radio" name="radio39" value="4" /></td>
		<td><input type="radio" name="radio39" value="5" /></td>
	</tr>
	<tr>
		<td id="q40">
			单位能根据客户需求的变化不断调整内部资源的配置，来提供新的业务功能吗？
		</td>
		<td><input type="radio" name="radio40" value="1" /></td>
		<td><input type="radio" name="radio40" value="2" /></td>
		<td><input type="radio" name="radio40" value="3" /></td>
		<td><input type="radio" name="radio40" value="4" /></td>
		<td><input type="radio" name="radio40" value="5" /></td>
	</tr>
	<tr>
		<td id="q41">
			为有效预防该系统应用过程中出现的突发事件，贵单位设立了相应的应急措施（比如双机容错机制、UPS、热备份系统等）吗？
		</td>
		<td><input type="radio" name="radio41" value="1" /></td>
		<td><input type="radio" name="radio41" value="2" /></td>
		<td><input type="radio" name="radio41" value="3" /></td>
		<td><input type="radio" name="radio41" value="4" /></td>
		<td><input type="radio" name="radio41" value="5" /></td>
	</tr>
	
	<tr>
		<td rowspan=3>
			服务保障能力
		</td>
		<td id="q42">
			该系统设计有完善的使用帮助平台。
		</td>
		<td><input type="radio" name="radio42" value="1" /></td>
		<td><input type="radio" name="radio42" value="2" /></td>
		<td><input type="radio" name="radio42" value="3" /></td>
		<td><input type="radio" name="radio42" value="4" /></td>
		<td><input type="radio" name="radio42" value="5" /></td>
	</tr>
	<tr>
		<td id="q43">
			该系统设计有完善的突发故障应急反应机制。
		</td>
		<td><input type="radio" name="radio43" value="1" /></td>
		<td><input type="radio" name="radio43" value="2" /></td>
		<td><input type="radio" name="radio43" value="3" /></td>
		<td><input type="radio" name="radio43" value="4" /></td>
		<td><input type="radio" name="radio43" value="5" /></td>
	</tr>
	<tr>
		<td id="q44">
			该系统可根据用户的服务需求（用户量、强度）的高低动态调整服务水平。
		</td>
		<td><input type="radio" name="radio44" value="1" /></td>
		<td><input type="radio" name="radio44" value="2" /></td>
		<td><input type="radio" name="radio44" value="3" /></td>
		<td><input type="radio" name="radio44" value="4" /></td>
		<td><input type="radio" name="radio44" value="5" /></td>
	</tr>
</table>
<p>您对上述问题提法的建议：</p>
<textarea id="t1" style="resize:none;width:100%;height:50px;border-radius:5px;" ></textarea>

<p>对本调查的建议（如有建议请填写）：</p>
<textarea id="t2" style="resize:none;width:100%;height:50px;border-radius:5px;" ></textarea>
<p style="text-align:right;margin-top:10px;"><button class="btn btn-primary" id="submit">提交</button></p>
<?php include "include/footer.php"; ?>
</div>
</body>
</html>