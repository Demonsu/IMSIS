<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	include_once '../sys/core/init.inc.php';

	//echo $result;
	$quiz_id = $_GET['quiz_id'];

?>
<html >
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8">
	<title>问卷</title>
	

	<link rel="stylesheet" href="./assets/dist/css/bootstrap.min.css">
	<script style="text/javascript" src="./assets/js/jquery.js"></script>
	<script style="text/javascript" src="./assets/dist/js/bootstrap.min.js"></script>
	<script style="text/javascript" src="./assets/js/statistics.js"></script>
    <script style="text/javascript" src="./assets/js/paste_to_excel.js"></script>
	<script style="text/javascript" src="assets/plugin/highcharts/js/highcharts.js"></script>
	<script style="text/javascript" src="assets/plugin/highcharts/js/modules/exporting.js"></script>
	<script style="text/javascript" src="assets/js/export_excel.js"></script>
	<link rel="stylesheet" href="./assets/css/statistics.css">
	<link rel="stylesheet" href="./assets/css/body.css">
</head>
<body>
<div class="main">
<input type="text" style="display:none" id="quiz_id" value="<?php echo $quiz_id; ?>" />
<?php include 'include/header.php'; ?>

<div class="group">
	<!-- Nav tabs -->
	<div class="group">
		<nav id="navbar-example" class="navbar navbar-default navbar-static" role="navigation">
        <div class="navbar-header">
          <a class="navbar-brand" id="index-show">请选择统计结果</a>
        </div>
        <div class="collapse navbar-collapse bs-js-navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a id="drop1" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">基本数据描述<b class="caret"></b></a>
              <ul class="dropdown-menu" role="menu" aria-labelledby="drop1">
                <li role="presentation"><a role="menuitem" tabindex="1" href="#" id="show-t1">关键变量（CVs）得分表</a></li>
                <li role="presentation"><a role="menuitem" tabindex="2" href="#" id="show-t2">关键变量统计分布</a></li>
                <li role="presentation"><a role="menuitem" tabindex="3" href="#" id="show-t3">关键域（KDs）得分表</a></li>
                <li role="presentation"><a role="menuitem" tabindex="4" href="#" id="show-t4">关键域统计分布</a></li>
				<li role="presentation"><a role="menuitem" tabindex="5" href="#" id="show-t5">作用域（LDs）得分表</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" id="drop2" role="button" class="dropdown-toggle" data-toggle="dropdown">能力描述摘要 <b class="caret"></b></a>
              <ul class="dropdown-menu" role="menu" aria-labelledby="drop2">
                <li role="presentation"><a role="menuitem" tabindex="6" href="#" id="show-t6">目标能力摘要表</a></li>
                <li role="presentation"><a role="menuitem" tabindex="7" href="#" id="show-t7">能力对比分析（能力对比图）</a></li>
              </ul>
            </li>
			<li class="dropdown">
              <a href="#" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown">短缺能描述<b class="caret"></b></a>
              <ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
                <li role="presentation"><a role="menuitem" tabindex="8" href="#" id="show-t8">短缺能力的详细信息</a></li>
                <li role="presentation"><a role="menuitem" tabindex="9" href="#" id="show-t9">短缺能力的作用域分析</a></li>
                <li role="presentation"><a role="menuitem" tabindex="10" href="#" id="show-t10">能力提升分析</a></li>
              </ul>
            </li>
			<li class="dropdown">
              <a href="#" id="drop4" role="button" class="dropdown-toggle" data-toggle="dropdown">优势能力描述<b class="caret"></b></a>
              <ul class="dropdown-menu" role="menu" aria-labelledby="drop4">
                <li role="presentation"><a role="menuitem" tabindex="11" href="#" id="show-t11">优势能力详细信息</a></li>
                <li role="presentation"><a role="menuitem" tabindex="12" href="#" id="show-t12">优势能力的作用域分析</a></li>
                <li role="presentation"><a role="menuitem" tabindex="13" href="#" id="show-t13">优势能力数量分析</a></li>
              </ul>
            </li>
			<li class="dropdown">
              <a href="#" id="drop5" role="button" class="dropdown-toggle" data-toggle="dropdown">评估结果摘要<b class="caret"></b></a>
              <ul class="dropdown-menu" role="menu" aria-labelledby="drop5">
                <li role="presentation"><a role="menuitem" tabindex="14" href="#" id="show-t14">能力情况汇总表</a></li>
                <!--<li role="presentation"><a role="menuitem" tabindex="15" href="#"  id="show-t15">评估报告描述</a></li>-->
              </ul>
            </li>
          </ul>
          
        </div><!-- /.nav-collapse -->
      </nav>
		
		<!--
		<div style="float:left;width:60px">
			<button id="nav-left" class="btn btn-default glyphicon glyphicon-chevron-left" style="width:35px;margin:5px 10px 0 15px"></button>
		</div>
		<div style="float:left;width:900px;overflow:hidden;">
		<div style="width:10000px;float:left;" id="side-left">
		<ul class="nav nav-tabs">
		  <li><a href="#tab-div1" id="tab1" data-toggle="tab" class="tab-tip" data-toggle="tooltip" data-placement="bottom" data-original-title="关键变量（CVs）得分表">#1关键变量（CVs）得分表</a></li>
		  <li><a href="#tab-div2" id="tab2" data-toggle="tab" class="tab-tip" data-toggle="tooltip" data-placement="bottom" data-original-title="关键变量统计分布">#2关键变量统计分布</a></li>
		  <li><a href="#tab-div3" id="tab3" data-toggle="tab" class="tab-tip" data-toggle="tooltip" data-placement="bottom" data-original-title="关键域（KDs）得分表">#3关键域（KDs）得分表</a></li>
		  <li><a href="#tab-div4" id="tab4" data-toggle="tab" class="tab-tip" data-toggle="tooltip" data-placement="bottom" data-original-title="关键域（KDs）能力统计表">#4关键域（KDs）能力统计表</a></li>
		  <li><a href="#tab-div5" id="tab5" data-toggle="tab" class="tab-tip" data-toggle="tooltip" data-placement="bottom" data-original-title="作用域（LDs）的得分表">#5作用域（LDs）的得分表</a></li>
		  <li><a href="#tab-div6" id="tab6" data-toggle="tab" class="tab-tip" data-toggle="tooltip" data-placement="bottom" data-original-title="目标能力摘要表（用户填写）">#6目标能力摘要表（用户填写）</a></li>
		  <li><a href="#tab-div7" id="tab7" data-toggle="tab" class="tab-tip" data-toggle="tooltip" data-placement="bottom" data-original-title="能力对比图">#7能力对比图</a></li>
		  <li><a href="#tab-div8" id="tab8" data-toggle="tab" class="tab-tip" data-toggle="tooltip" data-placement="bottom" data-original-title="短缺能力详细信息">#8短缺能力详细信息</a></li>
		  <li><a href="#tab-div9" id="tab9" data-toggle="tab" class="tab-tip" data-toggle="tooltip" data-placement="bottom" data-original-title="短缺能力的作用域分析">#9短缺能力的作用域分析</a></li>
		  <li><a href="#tab-div10" id="tab10" data-toggle="tab" class="tab-tip" data-toggle="tooltip" data-placement="bottom" data-original-title="能力提升分析">#10能力提升分析</a></li>
		  <li><a href="#tab-div11" id="tab11" data-toggle="tab" class="tab-tip" data-toggle="tooltip" data-placement="bottom" data-original-title="优势能力详细信息">#11优势能力详细信息</a></li>
		  <li><a href="#tab-div12" id="tab12" data-toggle="tab" class="tab-tip" data-toggle="tooltip" data-placement="bottom" data-original-title="优势能力的作用域分析">#12优势能力的作用域分析</a></li>
		  <li><a href="#tab-div13" id="tab13" data-toggle="tab" class="tab-tip" data-toggle="tooltip" data-placement="bottom" data-original-title="优势能力的数量分析">#13优势能力的数量分析</a></li>
		  <li><a href="#tab-div14" id="tab14" data-toggle="tab" class="tab-tip" data-toggle="tooltip" data-placement="bottom" data-original-title="能力情况总汇表">#14能力情况总汇表</a></li>
		</ul>
		</div>
		</div>
	<div style="width:60px;float:left">
		<button id="nav-right" class="btn btn-default glyphicon glyphicon-chevron-right" style="width:35px;margin:5px 15px 0 10px"></button>
	</div>-->
	</div>
	<!-- Tab panes -->
	<div class="row">
	  <div class="tab-pane col-md-12" id="tab-show-t0">
		<div class="jumbotron" style="border-radius:6px">
		  <h1>统计结果查看</h1>
		  <p>
			在这个页面你可以根据你所填写的问卷生成相应的评测指标<br>
			同样你也可以将测评结果生产的表格以及图标下载到您的PC上<br>
			<br>
		  </p>
		  <p><a class="btn btn-primary btn-lg" role="button" onClick="method1()"><span class="glyphicon glyphicon-tasks"></span> 导出报表</a></p>
		</div>
	  </div>
	  <div class="tab-pane col-md-12">
		  <div class="jumbotron group" style="border-radius:6px">
			<h2>您的成熟度目前达到<span id="test-level">3</span>级！</h2>
			<p>
			  该次共有<span id="test-total"></span>个关键域参加参评，统计分析显示，<span id="test-bad"></span>个关键域还存在不足。
			</p>
		  </div>
	  </div>
	  <div class="tab-pane" id="tab-show-t14">
		<div class="col-md-12">
			<table class="col-md-12" id="t14">
	
			</table>
		</div>
	  </div>
	  <div class="tab-pane col-md-12">
		  <div class="jumbotron group" style="border-radius:6px">
			<h2>测评结果总览</h2>
		  </div>
	  </div>
	  <div class="tab-pane" id="tab-show-t1">
		<div class="col-md-12">
			<table class="col-md-12" id="t1">
			
			</table>
		</div>
	  </div>
	  <div class="tab-pane" id="tab-show-t2">
		<div class="col-md-12 text-center">
			<table class="col-md-12" id="t2">
	
			</table>
		</div>
		<div class="col-md-12 text-center">
			<div id="p2" style="width:960px;height: 400px;">
				
			</div>
		</div>
	  </div>
	  <div class="tab-pane" id="tab-show-t3">
		<div class="col-md-12">
			<table class="col-md-12" id="t3">
	
			</table>
		</div>
		<div class="col-md-12 text-center">
			<div id="p3" style="width:960px;height: 400px;">
				
			</div>
		</div>
	  </div>
	  <div class="tab-pane" id="tab-show-t4">
		<div class="col-md-12">
			<table class="col-md-12" id="t4">
	
			</table>
		</div>
		<div class="col-md-12" id="p4" style="width:960px; height: 400px;">
			
		</div>
	  </div>
	  <div class="tab-pane" id="tab-show-t5">
		<div class="col-md-12">
			<table class="col-md-12" id="t5">
	
			</table>
		</div>
		<div class="col-md-12" id="p5-1" style="width:960px; height: 400px;">
			
		</div>
		<div class="col-md-12" id="p5-2" style="width:960px; height: 400px;">
			
		</div>
	  </div>
	  <div class="tab-pane col-md-12">
		  <div class="jumbotron group" style="border-radius:6px">
			<h2>此次评测的衡量标准</h2>
		  </div>
	  </div>
	  <div class="tab-pane" id="tab-show-t6">
		<div class="col-md-12">

			<table class="col-md-12" id="t6">
	
			</table>

		</div>
	  </div>
	  <div class="tab-pane col-md-12">
		  <div class="jumbotron group" style="border-radius:6px">
			<h2>比对以上标准</h2>
		  </div>
	  </div>
	  <div class="tab-pane" id="tab-show-t7">
		<div class="col-md-12">

			<table class="col-md-12" id="t7">
	
			</table>

		</div>
		<div class="col-md-12" id="p7" style="width:960px; height: 400px;">
			
		</div>
	  </div>
	  <div class="tab-pane col-md-12">
		  <div class="jumbotron group" style="border-radius:6px">
			<h2>优势分析</h2>
		  </div>
	  </div>
	  <div class="tab-pane" id="tab-show-t11">
		<div class="col-md-12">
			<table class="col-md-12" id="t11">
	
			</table>
		</div>
	  </div>
	  <div class="tab-pane" id="tab-show-t12">
		<div class="col-md-12">
			<table class="col-md-12" id="t12">
	
			</table>
		</div>
		<div class="col-md-12" id="p12-1" style="width:960px; height: 400px;">
			
		</div>
		<div class="col-md-12" id="p12-2" style="width:960px; height: 400px;">
			
		</div>
	  </div>
	  <div class="tab-pane" id="tab-show-t13">
		<div class="col-md-12">
			<table class="col-md-12" id="t13">
	
			</table>
		</div>
	  </div>
	  <div class="tab-pane col-md-12">
		  <div class="jumbotron group" style="border-radius:6px">
			<h2>组织弱项分析</h2>
		  </div>
	  </div>
	  <div class="tab-pane" id="tab-show-t8">
		<div class="col-md-12">
			<table class="col-md-12" id="t8">
	
			</table>
		</div>
	  </div>
	  <div class="tab-pane" id="tab-show-t9">
		<div class="col-md-12">
			<table class="col-md-12" id="t9">
	
			</table>
		</div>
		<div class="col-md-12" id="p9-1" style="width:960px; height: 400px;">
			
		</div>
		<div class="col-md-12" id="p9-2" style="width:960px; height: 400px;">
			
		</div>
		<div class="col-md-12" id="p9-3" style="width:960px; height: 400px;">
			
		</div>
	  </div>
	  <div class="tab-pane col-md-12">
		  <div class="jumbotron group" style="border-radius:6px">
			<h2>对组织能力提升的建议</h2>
		  </div>
	  </div>
	  
	  <div class="tab-pane" id="tab-show-t10">
		<div class="col-md-12">
			<table class="col-md-12" id="t10">
	
			</table>
		</div>
		<div class="col-md-12" id="p10" style="width:960px; height: 400px;">
			
		</div>
	  </div>
	  
	  
	</div>
</div>

<?php include 'include/footer.php'; ?>

</div>

</div>
</body>
</html>