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
	<link rel="stylesheet" href="./assets/css/statistics.css">
</head>
<body>
<div class="main">
<input type="text" style="display:none" id="quiz_id" value="<?php echo $quiz_id; ?>" />
<?php include 'include/header.php'; ?>

<div class="row">
	<!-- Nav tabs -->
	<ul class="nav nav-tabs">
	  <li><a href="#tab-div1" data-toggle="tab" class="tab-tip" data-toggle="tooltip" data-placement="right" data-original-title="Tooltip on bottom">#1</a></li>
	  <li><a href="#tab-div2" data-toggle="tab" class="tab-tip" data-toggle="tooltip" data-placement="right" data-original-title="Tooltip on bottom">#2</a></li>
	  <li><a href="#tab-div3" data-toggle="tab" class="tab-tip" data-toggle="tooltip" data-placement="right" data-original-title="Tooltip on bottom">#3</a></li>
	  <li><a href="#tab-div4" data-toggle="tab" class="tab-tip" data-toggle="tooltip" data-placement="right" data-original-title="Tooltip on bottom">#4</a></li>
	  <li><a href="#tab-div5" data-toggle="tab" class="tab-tip" data-toggle="tooltip" data-placement="right" data-original-title="Tooltip on bottom">#5</a></li>
	  <li><a href="#tab-div6" data-toggle="tab" class="tab-tip" data-toggle="tooltip" data-placement="right" data-original-title="Tooltip on bottom">#6</a></li>
	  <li><a href="#tab-div7" data-toggle="tab" class="tab-tip" data-toggle="tooltip" data-placement="right" data-original-title="Tooltip on bottom">#7</a></li>
	  <li><a href="#tab-div8" data-toggle="tab" class="tab-tip" data-toggle="tooltip" data-placement="right" data-original-title="Tooltip on bottom">#8</a></li>
	  <li><a href="#tab-div9" data-toggle="tab" class="tab-tip" data-toggle="tooltip" data-placement="right" data-original-title="Tooltip on bottom">#9</a></li>
	  <li><a href="#tab-div10" data-toggle="tab" class="tab-tip" data-toggle="tooltip" data-placement="right" data-original-title="Tooltip on bottom">#10</a></li>
	  <li><a href="#tab-div11" data-toggle="tab" class="tab-tip" data-toggle="tooltip" data-placement="right" data-original-title="Tooltip on bottom">#11</a></li>
	  <li><a href="#tab-div12" data-toggle="tab" class="tab-tip" data-toggle="tooltip" data-placement="right" data-original-title="Tooltip on bottom">#12</a></li>
	  <li><a href="#tab-div13" data-toggle="tab" class="tab-tip" data-toggle="tooltip" data-placement="right" data-original-title="Tooltip on bottom">#13</a></li>
	  <li><a href="#tab-div14" data-toggle="tab" class="tab-tip" data-toggle="tooltip" data-placement="right" data-original-title="Tooltip on bottom">#14</a></li>
	</ul>
	<!-- Tab panes -->
	<div class="tab-content">
	  <div class="tab-pane active" id="tab-div1">1</div>
	  <div class="tab-pane" id="tab-div2">2</div>
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