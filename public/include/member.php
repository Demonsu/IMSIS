
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
			height:590px;
		}
		body{
			background-color:rgb(235,235,235);
		}
		table a{
			color:#000000;
		}
		#content{
			height:450px;
			overflow:auto;
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
			else if(navi == 9){
				$('#map-id').click();
			}
			else if(navi == 10){
				$('#law-id').click();
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
		<tr><td class="td-css"><span class="glyphicon glyphicon-link span-level" id="link-id"> 友情链接</span></td></tr>
		<tr><td class="td-css"><span class="glyphicon glyphicon-phone-alt span-level" id="contact-id"> 联系我们</span></td></tr>
		<tr><td class="td-css"><span class="glyphicon glyphicon-globe span-level" id="map-id"> 网站地图</span></td></tr>
		<tr><td class="td-css"><span class="glyphicon glyphicon-briefcase span-level" id="law-id"> 法律声明</span></td></tr>
		<!--<tr><td class="td-css"><span class="glyphicon glyphicon-download-alt span-level" onclick="show_IBM()"> </span></td></tr>
		<tr><td class="td-css"><span class="glyphicon glyphicon-download-alt span-level" onclick="show_MIS()"> </span></td></tr>
		<tr><td class="td-css"><span class="glyphicon glyphicon-download-alt span-level" onclick="show_other()"> </span></td></tr>-->
	</table>
</div>

<div style="float:left;width:770px;padding:0px 20px 0px 20px;border-left:1px solid #a94442" id="content">
	<div style="float:left;width:720px;" id="share-panel">
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
	
	<div style="float:left;width:720px;" id="news-panel">
		<h3>最新动态</h3>
		<hr>
		<table style="width:100%;" id="news-list">
			<tr>
				<td><a id="news_%s" onclick="opennews(this)">第五届机器学习及其应用学生研讨会</a></td>
				<td>2010-11-05 到 2010-11-07</td>	
			</tr>
		</table>
	</div>
	<div style="float:left;width:720px;" id="law-panel">
		<h3>法律声明</h3>
		<hr>
		<p style="text-indent:2em;">
			衷心欢迎您光临电子政务与数据智能（ilab.nju.edu.cn 以下简称本网站）！
			</p><p style="text-indent:2em;">1．本网站提供的任何内容（包括但不限于数据、文字、图表、图像、声音或录像等）的版权均属于网研中心或相关权利人。已经网研中心许可的媒体、网站，在下载、转载使用时必须注明“稿件来源：中国政务网站服务能力建设网”，违者将依法追究责任。未经网研中心或相关权利人事先的书面许可，您不得以任何方式擅自复制、再造、传播、出版、转帖、改编或陈列本网站的内容。同时，未经网研中心书面许可，对于本网站上的任何内容，任何人不得在非网研中心所属的服务器上做镜像。未经授权不得链接本网站，违者将依法追究责任。任何未经授权使用本网站的行为都将违反《中华人民共和国著作权法》和其他法律法规以及有关国际公约的规定。
			</p><p style="text-indent:2em;">2．网研中心不能保证本网站上任何内容的正确性、及时性、完整性和可靠性以及使用这些内容得出的结果。网研中心以及其分支机构、员工、代理以及其他任何代表（以下简称相关人）对于本网站内容的任何错误、不准确和遗漏以及使用本网站内容得出的结果都将不承担任何责任。
			</p><p style="text-indent:2em;">任何情况下，网研中心及相关人对于进入或使用本网站引起的任何依赖本网站内容而做出的决定或采取的行动不承担任何责任，对进入或使用本网站而产生的任何直接的、间接的、惩罚性的损失或其他任何形式的损失包括但不限于业务中断、数据丢失或利润损失不承担任何责任。
		</p>
	</div>
	<div style="float:left;width:720px;" id="map-panel">
		<h3>网站地图</h3>
		<hr>
		<table style="width:100%;">
			<tr>
				<td><a href="../index.php" style="font-weight:bold;background-color:#aaaaaa">首&nbsp;&nbsp;&nbsp;&nbsp;页</a></td>
				<td>
					<a href="?navigation=1">实验室简介</a>‖
					<a href="?navigation=2">研究领域</a>‖
					<a href="?navigation=3">服务</a>‖
					<a href="?navigation=4">探索与分享</a>‖
					<a href="?navigation=5">最新动态</a>‖
					<a href="?navigation=6">成员</a>‖
					<a href="?navigation=7">友情链接</a>‖
					<a href="?navigation=8">联系我们</a>
				</td>	
			</tr>
			<tr>
				<td><a href="../index.php" style="font-weight:bold;text-align:right">研究领域</a></td>
				<td>
					<a href="?navigation=2">探索视点</a>‖
					<a href="?navigation=2">科研成果</a>
				</td>
			</tr>
			<tr>
				<td><a href="../index.php" style="font-weight:bold;text-align:right">服务</a></td>
				<td>
					<a href="?navigation=3">咨询服务</a>‖
					<a href="?navigation=3">开发服务</a>‖
					<a href="?navigation=3">运维服务</a>
				</td>
			</tr>
			<tr>
				<td><a href="../index.php" style="font-weight:bold;text-align:right">成员</a></td>
				<td>
					<a href="?navigation=3">实验室成员</a>‖
					<a href="?navigation=3">相册</a>
				</td>
			</tr>
		</table>
	</div>
	<div style="float:left;width:720px;" id="link-panel">
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
	
	<div style="float:left;width:720px;" id="contact-panel">
		<h3>联系我们</h3>
		<hr>
		
		<table style="width:300px;" style="float:left;">
			<tr>
				<td>邮箱：</td>
				<td></td>	
			</tr>
			<tr>
				<td>电话：</td>
				<td></td>	
			</tr>
			<tr>
				<td>传真：</td>
				<td></td>	
			</tr>
			<tr>
				<td>地址：</td>
				<td></td>	
			</tr>
		</table>
		<img src="../assets/img/index/map.png" style="float:right"/>
	</div>
	
	<div style="float:left;width:720px;" id="brief-panel">
		<h3>实验室简介</h3>
		<hr>
		<img src="../assets/img/index/homepage.jpg" style="float:right" width="360"/>
		<p>
		南京大学电子政务与数据智能实验室（E-government & Data Intelligence Laboratory，EG&DI lab）成立于2012年，依托于南京大学信息管理学院，面向电子政务及数据智能，结合当前信息社会发展的需要，开展电子政务系统以及大数据的相关管理与应用研究。主要研究方向包括：电子政务系统的开发与管理、电子政务服务能力管理、大数据智能、互联网商务模式（IBMs）管理、分布式信息系统设计与开发方法等。实验室具备充满活力的科研梯队以及良好的硬件设施环境。胡广伟副教授为实验室主要负责人，固定成员包括硕士研究生8人，本科生多名。实验室先后承担各类科研项目几十项，发表国内外学术期刊论文数十篇，出版专著多部，研究报告多部。实验室本着“充实、完善、凝炼、提升”思想，坚持“开放与联合”的原则，不断开拓进取，努力成为特色鲜明、可持续创新的电子政务系统及大数据智能研究开发基地和人才培养基地。
		</p>
	</div>
	
	<div style="float:left;width:720px;" id="field-panel">
		<h2>研究领域</h2>
		<h3>探索视点</h3>
		<hr>
		
		<h3>科研成果</h3>
		<hr>
		<h4>主要科研项目</h4>
		<table>
			<tr>
				<th>项目来源</th>
				<th>项目名称</th>
				<th>起始时间</th>
			</tr>
			<tr>
				<td>教育部人文社会科学基金</td>
				<td>电子政务服务能力影响因素实证研究</td>
				<td>2008</td>
			</tr>
			<tr>
				<td>江苏省高校哲学社会科学基金</td>
				<td>电子政务服务能力管理机制实证研究：基于江苏省典型政府服务部门的实验</td>
				<td>2009</td>
			</tr>
			<tr>
				<td>2010年省科技型企业技术创新基金</td>
				<td>安元重大危险源网络化安全监管与应急管理GIS平台研发</td>
				<td>2010</td>
			</tr>
			<tr>
				<td>国家科技支撑计划子课题</td>
				<td>基于创新应用链的创新型企业评价体系研究与实证</td>
				<td>2011</td>
			</tr>
			<tr>
				<td>江苏省高校哲学社会科学基金</td>
				<td>江苏政府职能部门电子政务能力提升路径研究</td>
				<td>2012</td>
			</tr>
		</table>
		
		<h4>代表性论文</h4>
		<ul>
			<li>
				胡广伟. 电子政务服务能力管理路径研究进展[J]. 电子政务,2013,(7).
			</li>
			<li>
				胡广伟,顾日红. 电子参与及其决策模式选择方法研究[J]. 情报科学,2013,(5).
			</li>
			<li>
				胡广伟,邓三鸿,卢明欣,石进. 电子政务服务能力测评模型的结构与关系分析[J]. 管理学报,2012,(5).
			</li>
			<li>
				胡广伟,潘文文,顾日红. 电子政务服务、内容及其规划方法[J]. 电子政务,2010,(9).
			</li>
			<li>
			胡广伟,顾日红,陈建生. 电子政务服务能力管理研究的问题与思路[J]. 电子政务,2010,(9).
			</li>
			<li>
			胡广伟. 电子政务服务能力测评体系研究[J]. 电子政务,2010,(9).
			</li>
			<li>
			胡广伟,蒋婉洁,官佳琪,王婷,王婧. 地方政府职能部门电子政务服务能力现状分析[J]. 电子政务,2010,(9).
			</li>
			<li>
			胡广伟,潘文文. 电子政务的概念:国际同行的视角[J]. 电子政务,2010,(9).
			</li>
			<li>
			胡广伟. 电子政务实施管理框架探析[J]. 情报杂志,2010,(6).
			</li>
			<li>
			胡广伟,潘文文,顾日红. 电子政务服务及其应用层次模型探讨[J]. 情报杂志,2010,(3).
			</li>
			<li>
			Guangwei Hu, Hui Lin, Wenwen Pan. Conceptualizing and Examining E-Government Service Capability: A Review and Empirical Study. Journal of the American Society for Information Science and Technology,2013,64(11)：2379–2395
			</li>
			<li>
			Guangwei Hu, Jin Shi, Wenwen Pan, Jie Wang. A hierarchical model of e-government service capability: An empirical analysis.Government Information Quarterly,2012(29):564-572
			</li>
			<li>
			Guangwei Hu, Wenwen Pan, Jie Wang. The distinctive lexicon and consensual conception of e-Government: an exploratory perspective. International Review of Administrative Sciences,2010, 76(3): 577–597
			</li>
			<li>
			顾日红,胡广伟,. 电子政务战略管理对其服务能力的影响路径分析[J]. 电子政务,2012,(5).
			</li>
			<li>
			丁锐,胡广伟,. 政府业务整合水平对电子政务服务能力的影响[J]. 情报杂志,2013,(7).
			</li>
			<li>
			丁锐,胡广伟,. 电子政务环境下政府业务整合水平评测模型研究[J]. 电子政务,2012,(6).
			</li>
			<li>
			吴云,胡广伟,. 电子政务服务能力成熟度模型演化路径探讨[J]. 电子政务,2013,(10).
			</li>
			<li>
			吴云,胡广伟,. 政务社交媒体研究进展[J]. 电子政务,2013,(5).
			</li>
		</ul>
		<h4>代表性专著及研究报告</h4>
		<ul>
			<li>
			电子政务服务管理／胡广伟著．南京：南京大学出版社，2010.7
			</li>
			<li>
			电子政务服务能力管理理论与方法／胡广伟著．北京：科学出版社，2014.1
			</li>
			<li>
			江苏省典型政府服务部门电子政务服务能力调研报告
			</li>
			<li>
			江苏省典型政府服务部门电子政务服务能力管理机制政策咨询报告
			</li>
		</ul>
	</div>
	
	<div style="float:left;width:720px;" id="service-panel">
		<h2>服务</h2>
		<h3>咨询服务</h3>
		<hr>
		
		<h3>开发服务</h3>
		<hr>
		
		<h3>运维服务</h3>
		<hr>
	</div>
	
	<div style="float:left;width:720px;" id="member-panel">
		<h3>成员</h3>
		<hr>
		<table style="width:600px" id="member-content">
			<tr style="border-bottom:1px solid #000000"><th colspan=3>实验室主任</th></tr>
			<tr><td><a href="http://im.nju.edu.cn/showstaff.aspx?departmentid=6&titleid=4&id=28">胡广伟</a></td><td>博士</td><td>副教授</td></tr>
			<tr><td>&nbsp;</td><td> </td><td> </td></tr>
			<tr style="border-bottom:1px solid #000000"><th colspan=3>实验室成员</th></tr>
			<tr><td><a>丁锐</a></td><td>情报学</td><td>硕士研究生</td></tr>
			<tr><td><a>吴云</a></td><td>情报学</td><td>硕士研究生</td></tr>
			<tr><td><a>田原</a></td><td>情报学</td><td>硕士研究生</td></tr>
			<tr><td><a>李妍</a></td><td>情报学</td><td>硕士研究生</td></tr>
			<tr><td><a>徐蕾</a></td><td>情报学</td><td>硕士研究生</td></tr>
			<tr><td><a>刘柳</a></td><td>情报学</td><td>硕士研究生</td></tr>
			<tr><td><a>汪松兴</a></td><td>情报学</td><td>硕士研究生</td></tr>
			<tr><td><a>夏航宇</a></td><td>情报学</td><td>硕士研究生</td></tr>
		</table>
	</div>

</div>
<?php include './index_footer.php'; ?>
</div>
</body>
</html>