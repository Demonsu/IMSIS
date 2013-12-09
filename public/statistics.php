<?php
	include_once '../sys/core/init.inc.php';

	//echo $result;
	$quiz_id = $_GET['quiz_id'];

?>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8">
	<title>问卷</title>
	<link rel="stylesheet" href="./assets/css/body.css">

	<link rel="stylesheet" href="./assets/dist/css/bootstrap.min.css">
	<script style="text/javascript" src="./assets/js/jquery.js"></script>
	<script style="text/javascript" src="./assets/dist/js/bootstrap.min.js"></script>
	<script style="text/javascript" src="./assets/js/statistics.js"></script>
	<script style="text/javascript" src="assets/plugin/highcharts/js/highcharts.js"></script>
	<script style="text/javascript" src="assets/plugin/highcharts/js/modules/exporting.js"></script>
	<link rel="stylesheet" href="./assets/css/statistics.css">
</head>
<body>
<div class="main">
<input type="text" style="display:none" id="quiz_id" value="<?php echo $quiz_id; ?>" />
<?php include 'include/header.php'; ?>

<div class="row">
	<!-- Nav tabs -->
	<div class="row">
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
	</div>
	</div>
	<!-- Tab panes -->
	<div class="tab-content">
	  <div class="tab-pane" id="tab-div1">
		
	  </div>
	  <div class="tab-pane" id="tab-div2">
		<div class="col-md-6">
			<table class="col-md-12" id="t2">
	
			</table>
		</div>
		<div class="col-md-7" id="p2">

		</div>
	  </div>
	  <div class="tab-pane" id="tab-div3">3</div>
	  <div class="tab-pane" id="tab-div4">4</div>
	  <div class="tab-pane" id="tab-div5">5</div>
	  <div class="tab-pane" id="tab-div6">6</div>
	  <div class="tab-pane" id="tab-div7">7</div>
	  <div class="tab-pane" id="tab-div8">8</div>
	  <div class="tab-pane" id="tab-div9">9</div>
	  <div class="tab-pane" id="tab-div10">10</div>
	  <div class="tab-pane" id="tab-div11">11</div>
	  <div class="tab-pane" id="tab-div12">12</div>
	  <div class="tab-pane" id="tab-div13">13</div>
	  <div class="tab-pane" id="tab-div14">14</div>
	</div>
</div>

<?php include 'include/footer.php'; ?>

</div>

</div>
</body>
</html>