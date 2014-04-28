<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8">
	<title>电子政务与数据智能Lab-主页</title>
	
	<link rel="stylesheet" href="./assets/dist/css/bootstrap.min.css">
	<script style="text/javascript" src="./assets/js/jquery.js"></script>
	<script style="text/javascript" src="./assets/dist/js/bootstrap.min.js"></script>
	<script style="text/javascript" src="./assets/js/index.js"></script>
	<link rel="stylesheet" href="./assets/css/index.css">
	<link rel="stylesheet" href="./assets/css/body.css">
</head>
<body>

<div class="main">
	<div class="header-group">
		<img src="./assets/img/index/logo.png" height="60px" alt="logo" />
		<div class="title-search-panel" style="float:right;margin-right:10px;margin-top:14px;">
			<p style="text-align:right;line-height:13px;font-size:12px;"><span style="cursor:pointer;" onClick="window.open('./include/member.php?navigation=9')">网站导航</span> | <span style="cursor:pointer;" onClick="AddFavorite()">加入收藏</span></p>
		    <input type="text" id="search-name" style="height:22px;margin-top;border-radius:5px 0px 0px 5px;border-right:0px;">
			<button class="btn-mine" type="button" id="search-go">搜索</button>
		</div>
		<div class="navi-container">
			<nav class="navbar navbar-mine" role="navigation">
			  <!-- Collect the nav links, forms, and other content for toggling -->
			  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
				  <li class="active"><a href="#">主页</a></li>
				  <li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">研究领域<b class="caret"></b></a>
					<ul class="dropdown-menu">
					  <li><a href="./include/member.php?navigation=2">探索视点</a></li>
					  <li><a href="./include/member.php?navigation=2">科研成果</a></li>
					</ul>
				  </li>
				  <li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">服务<b class="caret"></b></a>
					<ul class="dropdown-menu">
					  <li><a href="./include/member.php?navigation=3">咨询服务</a></li>
					  <li><a href="./include/member.php?navigation=3">开发服务</a></li>
					  <li><a href="./include/member.php?navigation=3">运维服务</a></li>
					</ul>
				  </li>
				  <li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">成员<b class="caret"></b></a>
					<ul class="dropdown-menu">
					  <li><a href="./include/member.php?navigation=6">实验室成员</a></li>
					  <li><a href="./include/member.php?navigation=6">实验室相册</a></li>
					</ul>
				  </li>
				 
				</ul>
			  </div><!-- /.navbar-collapse -->
			</nav>
		</div>
	</div>
	
	<div class="main-wapper">
		<div class="view-content">
			<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
				<ul class="carousel-indicators">
					<li data-target="#carousel-example-generic" data-slide-to="0" class="active" title="1"></li>
					<li data-target="#carousel-example-generic" data-slide-to="1" title="2"></li>
					<li data-target="#carousel-example-generic" data-slide-to="2" title="3"></li>
					<li data-target="#carousel-example-generic" data-slide-to="3" title="4"></li>
				</ul>
			  <!-- Wrapper for slides -->
			  <div class="carousel-inner">
				<div class="item active">
				  <img src="./assets/img/index/homepage_0.jpg" alt="...">
				  <div class="carousel-caption">
				  </div>
				</div>
				<div class="item">
				  <img src="./assets/img/index/homepage_1.jpg" alt="...">
				  <div class="carousel-caption">
				  </div>
				</div>
				<div class="item">
				  <img src="./assets/img/index/homepage_2.jpg" alt="...">
				  <div class="carousel-caption">
				  </div>
				</div>
				<div class="item">
				  <img src="./assets/img/index/homepage_3.jpg" alt="...">
				  <div class="carousel-caption">
				  </div>
				</div>
			  </div>

			  <!-- Controls -->
			  <div style="display:none">
				  <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left"></span>
				  </a>
				  <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right"></span>
				  </a>
			  </div>
			</div>
		</div>
		<div class="brief-content">
			<div style="width:350px;font-size:20px;text-align:center;color:#ffffff;font-weight:bold;">
				实验室简介
			</div>
			<p style="color:#ffffff;font-size:14px;margin-top:10px">
				南京大学电子政务与数据智能实验室（E-government & Data Intelligence Laboratory，EG&DI lab）成立于2012年，依托于南京大学信息管理学院，面向电子政务及数据智能，结合当前信息社会发展的需要，开展电子政务系统以及大数据的相关管理与应用研究。主要研究方向...<br>
				<a style="float:right;color:white" href="./include/member.php?navigation=1">更多...</a>
			</p>
		</div>
	</div>
	
	<div class="main-content">
		<div class="content-container">
			<div class="content-one">
				<div style="text-align:center;color:#931414;font-size:20px;font-weight:bold;cursor:pointer" onClick="window.open('./include/member.php?navigation=5')">
					最新动态
				</div>
				<div id="news-div">
				<!--
					<div style="border:1px solid #aaaaaa;padding:3px;margin-top:10px;">
						<img src="./assets/img/index/news-title.jpg" width="277px" height="90px"/>
					</div>
					<ul class="list-group" style="margin-left:-7px;margin-top:10px;" >
						<li class="list-group-item list-group-item-success">
							<img src="./assets/img/index/list.png" width="28px" />
							<a title="Hadoop平台架构" href="./assets/download/The_big_data_revolution_in_healthcare.pdf" target="_blank">医疗大数据革命</a></li>
						<li class="list-group-item list-group-item-success">
							<img src="./assets/img/index/list.png" width="28px" />
							<a title="Hadoop平台架构" href="./assets/download/Hadoop平台架构.pptx" target="_blank">Hadoop平台架构</a></li>
						<li class="list-group-item list-group-item-success">
							<img src="./assets/img/index/list.png" width="28px" />
							<a title="电子政务服务能力" href="./assets/download/电子政务服务能力.zip" target="_blank">电子政务服务能力</a></li>
					</ul>
					-->
				</div>
				
				
				
				
			</div>
			<div class="content-two">
				<div style="text-align:center;color:#931414;font-size:20px;font-weight:bold;cursor:pointer" onClick="window.open('./include/member.php?navigation=4')">
					探索与分享
				</div>
				<div id="share-div">
				<!--
					<div style="border:1px solid #aaaaaa;padding:3px;margin-top:10px;">
						<a href="./assets/download/The_big_data_revolution_in_healthcare.pdf" target="_blank" title="The_big_data_revolution_in_healthcare">
							<img src="./assets/img/index/pdf-download.jpg" width="277px" height="90px"/>
						</a>
					</div>
					<ul class="list-group" style="margin-left:-7px;margin-top:10px;" >
						<li class="list-group-item list-group-item-success">
							<img src="./assets/img/index/icon/pdf.png" style="width:24px;margin:2px"/>
							<a title="Hadoop平台架构" href="./assets/download/The_big_data_revolution_in_healthcare.pdf" target="_blank">医疗大数据革命</a></li>
						<li class="list-group-item list-group-item-success">
							<img src="./assets/img/index/icon/pptx.png" style="width:24px;margin:2px"/>
							<a title="Hadoop平台架构" href="./assets/download/Hadoop平台架构.pptx" target="_blank">Hadoop平台架构</a></li>
						<li class="list-group-item list-group-item-success">
							<img src="./assets/img/index/icon/zip.png" style="width:24px;margin:2px"/>
							<a title="电子政务服务能力" href="./assets/download/电子政务服务能力.zip" target="_blank">电子政务服务能力</a></li>
					</ul>
					-->
				</div>
			</div>
			<div class="content-three">
				<div style="text-align:center;color:#931414;font-size:20px;font-weight:bold">
					电子政务评测系统
				</div>
				
				<div style="width:285px;float:left">
                	<div style="width:90px;height:110px;padding:10px;float:left;">
                    <a href="./login.php" target="_blank" title="eGov-CMM">
                    	<img src="./assets/img/index/eGov-CMM2.png" width="70px" height="70px" style="border-radius:5px;float:left;" />
                        <p style="width:70px;text-align:center">系统</p>
                    </a>
                    </div>
                    <div style="width:195px;float:left;padding-top:20px">
                    <a href="./login.php" target="_blank" title="eGov-CMM">
                    	电子政务服务能力成熟度在线评估系统
                    </a>
                    </div>
                </div>
                
                <div style="width:285px;float:left">
                	<div style="width:90px;height:110px;padding:10px;float:left;">
                    <a href="./quiz_pub.php.php" target="_blank" title="eGov-quiz">
                    	<img src="./assets/img/index/eGov-CMM1.png" width="70px" height="70px" style="border-radius:5px;float:left;" />
                        <p style="width:70px;text-align:center">问卷</p>
                    </a>
                    </div>
                    <div style="width:195px;float:left;padding-top:20px">
                    <a href="./quiz_pub.php" target="_blank" title="eGov-CMM">
                    	公众满意度调查系统
                    </a>
                    </div>
                </div>
                
                <div style="width:285px;float:left">
                	<div style="width:90px;height:110px;padding:10px;float:left;">
                    	<img src="./assets/img/index/eGov-CMM0.png" width="70px" height="70px" style="border-radius:5px;float:left;" />
                        <p style="width:70px;text-align:center">更多</p>
                    </div>
                    <div style="width:195px;float:left;padding-top:20px">
                    	后续系统，正在建设
                    </div>
                </div>
                <!--
				<div class="down3" style="border:0px;padding:3px;margin-top:10px;float:left;width:100px;">
					<div style="padding:10px;">
						<a href="./login.php" target="_blank" title="eGov-CMM">
							<img src="./assets/img/index/eGov-CMM2.png" width="70px" height="70px" style="border-radius:5px;" />
						</a>
						<a href="./quiz_pub.php" target="_blank" title="">
							<img src="./assets/img/index/eGov-CMM1.png" width="70px" height="70px" style="margin-top:18px;border-radius:5px;" />
						</a>
						<a href="#" title="更多..." >
							<img src="./assets/img/index/eGov-CMM0.png" width="70px" height="70px" style="margin-top:18px;border-radius:5px;" />
						</a>
					</div>
				</div>
			    <div class="down3" style="padding:4px;margin-top:10px;margin-left:10px;float:left;width:130px;">
					<div style="padding:10px;">
						<p style="height:70px;">电子政务服务能力成熟度在线评估系统</p>
                        <p style="height:70px;margin-top:18px">公众满意度调查系统</p>
                        <p style="height:70px;margin-top:18px">更多</p>
					</div>
				</div>
				<!--
				<p style="width:135px;margin:10px 25px 0px 25px;float:left">电子政务服务能力成熟度在线评估系统旨在帮助用户快速了解评估的内容、方法、流程，以及引导用户在线完成整个评估过程，并将结果反馈。</p>
			-->
				<!--<div style="width:285px;height:1px;background-color:#000000;margin-top:10px;margin-bottom:10px;"></div>-->
			</div>
		</div>
	</div>
	
	<div class="footer-wapper">
		<table style="width:100%;">
			<tr>
				<td rowspan=2 style="width:340px;text-align:right">
					<a href="http://www.nju.edu.cn/" target="_blank">
					<img src="./assets/img/index/nju.png" width="50" />
					</a>
				</td>
				<td>
					<span class="footer-content">
					<a href="./include/member.php?navigation=8">联系我们</a>
					| <a href="./include/member.php?navigation=10">法律声明</a>
					| <a href="./include/member.php?navigation=7">友情链接</a>
					| <a href="./include/member.php?navigation=9">网站地图</a>
					</span>
				</td>
				<td rowspan=2 style="width:340px"></td>
			</tr>
			<tr>
				<td>
				<span style="line-height:36px;">Copyright©2013 All Rights Reserved</span>
				</td>
			</tr>
		</table>
	</div>
</div>

</body>
</html>