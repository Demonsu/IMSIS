<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
	$navi = $_GET['navigation'];
?>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8">
	<title>电子政务与数据智能Lab-主页</title>
	

	<link rel="stylesheet" href="../assets/dist/css/bootstrap.min.css">
	<script style="text/javascript" src="../assets/js/jquery.js"></script>
	<script style="text/javascript" src="../assets/dist/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="../assets/css/body.css">
	<script style="text/javascript" src="../assets/js/member.js"></script>
	<style>
		.td-css{
			height:40px;
			/*border-right:1px solid #a94442;*/
		}
		.span-level{
			padding:5px 0px 0px 5px;
			margin-right:27px;
			width:150px;
			height:30px;
			border:1px solid #ffffff;
		}
		.span-level:hover{
			border:1px solid #a94442;
			cursor:pointer;
		}
		.main{
			padding:5px;
			border-radius:5px;
			background-color:#ffffff;
			height:500px;
		}
		body{
			background-color:rgb(235,235,235);
		}
	</style>
	<script>
		$(document).ready(function(){
			var navi = <?php echo $navi; ?>;
			if(navi == 1){
				$('#brief-id').click();
			}
			else if(navi == 2){
				$('#field-id').click();
			}
			else if(navi == 3){
				$('#service-id').click();
			}
			else if(navi == 4){
				$('#share-id').click();
			}
			else if(navi == 5){
				$('#news-id').click();
			}
			else if(navi == 6){
				$('#member-id').click();
			}
			else if(navi == 7){
				$('#link-id').click();
			}
			else if(navi == 8){
				$('#contact-id').click();
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

<div style="float:left;">
	<table>
		<tr><td class="td-css"><span class="glyphicon glyphicon-home span-level" onclick="window.location='../index.php'"> 首页</span></td></tr>
		<tr><td class="td-css"><span class="glyphicon glyphicon-pushpin span-level" id="brief-id"> 简介</span></td></tr>
		<tr><td class="td-css"><span class="glyphicon glyphicon-book span-level" id="field-id"> 研究领域</span></td></tr>
		<tr><td class="td-css"><span class="glyphicon glyphicon-cloud span-level" id="service-id"> 服务</span></td></tr>
		<tr><td class="td-css"><span class="glyphicon glyphicon-download-alt span-level" id="share-id"> 探索与分享</span></td></tr>
		<tr><td class="td-css"><span class="glyphicon glyphicon-certificate span-level" id="news-id"> 最新动态</span></td></tr>
		<tr><td class="td-css"><span class="glyphicon glyphicon-user span-level" id="member-id"> 成员</span></td></tr>
		<tr><td class="td-css"><span class="glyphicon glyphicon-user span-level" id="link-id"> 友情链接</span></td></tr>
		<tr><td class="td-css"><span class="glyphicon glyphicon-user span-level" id="contact-id"> 联系我们</span></td></tr>
		<!--<tr><td class="td-css"><span class="glyphicon glyphicon-download-alt span-level" onclick="show_IBM()"> </span></td></tr>
		<tr><td class="td-css"><span class="glyphicon glyphicon-download-alt span-level" onclick="show_MIS()"> </span></td></tr>
		<tr><td class="td-css"><span class="glyphicon glyphicon-download-alt span-level" onclick="show_other()"> </span></td></tr>-->
	</table>
</div>

<div style="float:left;width:660px;padding:0px 20px 0px 20px;border-left:1px solid #a94442" id="content">
	<div style="float:left;width:660px;" id="share-panel">
		<h3>探索与分享</h3>
		<hr>
		<div id="share-list">
			<div class="media">
			  <a class="pull-left">
				<img class="media-object" src="../assets/img/index/icon/pptx.png" width="64px">
			  </a>
			  <div class="media-body">
				<h4 class="media-heading"><a href="../assets/download/Hadoop平台架构.pptx">Hadoop平台架构.pptx</a></h4>
				Hadoop是一个开源的分布式系统基础架构，由Apache基金会开发。
				Hadoop优点：高可靠性；高扩展性；高效性；高容错性。
				Hadoop的核心为HDFS和MapReduce；
			  </div>
			</div>
			<div class="media">
			  <a class="pull-left">
				<img class="media-object" src="../assets/img/index/icon/zip.png" width="64px">
			  </a>
			  <div class="media-body">
				<h4 class="media-heading"><a href="../assets/download/电子政务服务能力.zip">电子政务服务能力.zip</a></h4>
				项目成果
			  </div>
			</div>
			<div class="media">
			  <a class="pull-left">
				<img class="media-object" src="../assets/img/index/icon/pdf.png" width="64px">
			  </a>
			  <div class="media-body">
				<h4 class="media-heading"><a href="../assets/download/The_big_data_revolution_in_healthcare.pdf">The_big_data_revolution_in_healthcare.pdf</a></h4>
				医疗大数据革命
			  </div>
			</div>
		</div>
	</div>
	
	<div style="float:left;width:660px;" id="news-panel">
		<h3>最新动态</h3>
		<hr>
		<table style="width:100%;" id="news-list">
			<tr>
				<td><a id="news_%s" onclick="opennews(this)">第五届机器学习及其应用学生研讨会</a></td>
				<td>2010-11-05 到 2010-11-07</td>	
			</tr>
		</table>
	</div>
	
	<div style="float:left;width:660px;" id="link-panel">
		<h3>友情链接</h3>
		<hr>
		<table style="width:100%;" id="news-list">
			<tr>
				<td>南京大学：</td>
				<td><a href="http://nju.edu.cn" target="_blank">http://nju.edu.cn</a></td>	
			</tr>
			<tr>
				<td>南京大学信息管理学院：</td>
				<td><a href="http://im.nju.edu.cn/" target="_blank">http://im.nju.edu.cn/</a></td>	
			</tr>
			<tr>
				<td>中国政务网站服务能力建设网：</td>
				<td><a href="http://www.gwd.gov.cn/" target="_blank">http://www.gwd.gov.cn/</a></td>	
			</tr>
			<tr>
				<td>北京市政务数据资源网：</td>
				<td><a href="http://www.bjdata.gov.cn/" target="_blank">http://www.bjdata.gov.cn/</a></td>	
			</tr>
			<tr>
				<td>上海市政务数据服务网：</td>
				<td><a href="http://www.datashanghai.gov.cn/" target="_blank">http://www.datashanghai.gov.cn/</a></td>	
			</tr>
			<tr>
				<td>美国政府数据中心：</td>
				<td><a href="http://www.data.gov/" target="_blank">http://www.data.gov/</a></td>	
			</tr>
		</table>
	</div>
	
	<div style="float:left;width:660px;" id="contact-panel">
		<h3>联系我们</h3>
		<hr>
		<table style="width:100%;" id="news-list">
			<tr>
				<td></td>
				<td></td>	
			</tr>
		</table>
	</div>
	
	<div style="float:left;width:660px;" id="brief-panel">
		<h3>实验室简介</h3>
		<hr>
		<img src="../assets/img/index/homepage.jpg" style="float:right" width="360"/>
		<p>
		南京大学电子政务与数据智能实验室（E-government & Data Intelligence Laboratory，EG&DI lab）成立于2012年，依托于南京大学信息管理学院，面向电子政务及数据智能，结合当前信息社会发展的需要，开展电子政务系统以及大数据的相关管理与应用研究。主要研究方向包括：电子政务系统的开发与管理、电子政务服务能力管理、大数据智能、互联网商务模式（IBMs）管理、分布式信息系统设计与开发方法等。实验室具备充满活力的科研梯队以及良好的硬件设施环境。胡广伟副教授为实验室主要负责人，固定成员包括硕士研究生8人，本科生多名。实验室先后承担各类科研项目几十项，发表国内外学术期刊论文数十篇，出版专著多部，研究报告多部。实验室本着“充实、完善、凝炼、提升”思想，坚持“开放与联合”的原则，不断开拓进取，努力成为特色鲜明、可持续创新的电子政务系统及大数据智能研究开发基地和人才培养基地。
		</p>
	</div>
	
	<div style="float:left;width:660px;" id="field-panel">
		<h2>研究领域</h2>
		<h3>探索视点</h3>
		<hr>
		
		<h3>科研成果</h3>
		<hr>
	</div>
	
	<div style="float:left;width:660px;" id="service-panel">
		<h2>服务</h2>
		<h3>咨询服务</h3>
		<hr>
		
		<h3>开发服务</h3>
		<hr>
		
		<h3>运维服务</h3>
		<hr>
	</div>
	
	<div style="float:left;width:660px;" id="member-panel">
		<h3>成员</h3>
		<hr>
		<table style="width:600px" id="member-content">
			<tr style="border-bottom:1px solid #000000"><th colspan=2>教师</th></tr>
			<tr><td><a>XXX</a></td><td>博士,教授</td></tr>
			<tr><td><a>XXX</a></td><td>博士,教授</td></tr>
			<tr><td><a>XXX</a></td><td>博士,教授</td></tr>
			<tr style="border-bottom:1px solid #000000"><th colspan=2>博士</th></tr>
			<tr><td><a>XXX</a></td><td>博士</td></tr>
			<tr><td><a>XXX</a></td><td>博士</td></tr>
			<tr><td><a>XXX</a></td><td>博士</td></tr>
			<tr style="border-bottom:1px solid #000000"><th colspan=2>硕士</th></tr>
			<tr><td><a>XXX</a></td><td>硕士</td></tr>
			<tr><td><a>XXX</a></td><td>硕士</td></tr>
			<tr><td><a>XXX</a></td><td>硕士</td></tr>
		</table>
	</div>

</div>
<?php include './index_footer.php'; ?>
</div>
</body>
</html>