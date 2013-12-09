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
	<ul class="nav nav-tabs">
	  <li><a href="#tab-div1" id="tab1" data-toggle="tab" class="tab-tip" data-toggle="tooltip" data-placement="bottom" data-original-title="关键变量（CVs）得分表">#1</a></li>
	  <li><a href="#tab-div2" id="tab2" data-toggle="tab" class="tab-tip" data-toggle="tooltip" data-placement="bottom" data-original-title="Tooltip on bottom">#2</a></li>
	  <li><a href="#tab-div3" id="tab3" data-toggle="tab" class="tab-tip" data-toggle="tooltip" data-placement="bottom" data-original-title="Tooltip on bottom">#3</a></li>
	  <li><a href="#tab-div4" id="tab4" data-toggle="tab" class="tab-tip" data-toggle="tooltip" data-placement="bottom" data-original-title="Tooltip on bottom">#4</a></li>
	  <li><a href="#tab-div5" id="tab5" data-toggle="tab" class="tab-tip" data-toggle="tooltip" data-placement="bottom" data-original-title="Tooltip on bottom">#5</a></li>
	  <li><a href="#tab-div6" id="tab6" data-toggle="tab" class="tab-tip" data-toggle="tooltip" data-placement="bottom" data-original-title="Tooltip on bottom">#6</a></li>
	  <li><a href="#tab-div7" id="tab7" data-toggle="tab" class="tab-tip" data-toggle="tooltip" data-placement="bottom" data-original-title="Tooltip on bottom">#7</a></li>
	  <li><a href="#tab-div8" id="tab8" data-toggle="tab" class="tab-tip" data-toggle="tooltip" data-placement="bottom" data-original-title="Tooltip on bottom">#8</a></li>
	  <li><a href="#tab-div9" id="tab9" data-toggle="tab" class="tab-tip" data-toggle="tooltip" data-placement="bottom" data-original-title="Tooltip on bottom">#9</a></li>
	  <li><a href="#tab-div10" id="tab10" data-toggle="tab" class="tab-tip" data-toggle="tooltip" data-placement="bottom" data-original-title="Tooltip on bottom">#10</a></li>
	  <li><a href="#tab-div11" id="tab11" data-toggle="tab" class="tab-tip" data-toggle="tooltip" data-placement="bottom" data-original-title="Tooltip on bottom">#11</a></li>
	  <li><a href="#tab-div12" id="tab12" data-toggle="tab" class="tab-tip" data-toggle="tooltip" data-placement="bottom" data-original-title="Tooltip on bottom">#12</a></li>
	  <li><a href="#tab-div13" id="tab13" data-toggle="tab" class="tab-tip" data-toggle="tooltip" data-placement="bottom" data-original-title="Tooltip on bottom">#13</a></li>
	  <li><a href="#tab-div14" id="tab14" data-toggle="tab" class="tab-tip" data-toggle="tooltip" data-placement="bottom" data-original-title="Tooltip on bottom">#14</a></li>
	</ul>
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