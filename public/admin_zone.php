<?php
	include_once '../sys/core/init.inc.php';

	//echo $result;

?>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8">
	<title>管理员中心</title>
	

	<link rel="stylesheet" href="./assets/dist/css/bootstrap.min.css">
	<script style="text/javascript" src="./assets/js/jquery.js"></script>
	<script style="text/javascript" src="./assets/dist/js/bootstrap.min.js"></script>
	<script style="text/javascript" src="./assets/js/admin_zone.js"></script>
	<script style="text/javascript" src="assets/plugin/highcharts/js/highcharts.js"></script>
	<script style="text/javascript" src="assets/plugin/highcharts/js/modules/exporting.js"></script>
	<link rel="stylesheet" href="./assets/css/admin_zone.css">
	<link rel="stylesheet" href="./assets/css/body.css">
</head>
<body>
<div class="main">

<?php include './include/header.php' ?>
<div class="row">
	<div class="col-md-3">
		<div class="panel panel-default panel-success">
		  <div class="panel-heading">管理员功能</div>
		  <div class="panel-body">
			<div class="list-group">
			  <a href="#" class="list-group-item active">
				Cras justo odio
			  </a>
			  <a href="#" class="list-group-item">Dapibus ac facilisis in</a>
			  <a href="#" class="list-group-item">Morbi leo risus</a>
			  <a href="#" class="list-group-item">Porta ac consectetur ac</a>
			  <a href="#" class="list-group-item">Vestibulum at eros</a>
			</div>
			<ul class="list-group">
			  <li class="list-group-item list-group-item-success">Dapibus ac facilisis in</li>
			  <li class="list-group-item list-group-item-warning">Porta ac consectetur ac</li>
			  <li class="list-group-item list-group-item-danger">Vestibulum at eros</li>
			  <li class="list-group-item list-group-item-info">Cras sit amet nibh libero</li>
			</ul>
		  </div>
		</div>
	</div>
	<div class="col-md-9">
		<div class="panel panel-default">
		  <div class="panel-heading" id="body_title"></div>
		  <div class="panel-body">
			
		  </div>
		</div>
	</div>
</div>
<?php include './include/footer.php' ?>
</div>
</body>
</html>