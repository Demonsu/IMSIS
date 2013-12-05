<?php
include_once '../sys/core/init.inc.php';



?>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8">
	<title>个人空间</title>
	<link rel="stylesheet" href="./assets/css/body.css">
	<link rel="stylesheet" href="./assets/css/user_zone.css">
	<link rel="stylesheet" href="./assets/dist/css/bootstrap.min.css">
	<script style="text/javascript" src="./assets/js/jquery.js"></script>
	<script style="text/javascript" src="./assets/dist/js/bootstrap.min.js"></script>
	<script style="text/javascript" src="./assets/js/user_zone.js"></script>
</head>
<body>
<div class="main">
<!--header -->
<?php include './include/header.php'; ?>

<div class="row">
	<div class="panel panel-success">
		<div class="panel-heading"><div class="panel-title">用户空间</div></div>
		<div class="panel-body">
			<div class="col-md-3">
				<div class="list-group">
					<a class="list-group-item active">创建问卷</a>
					<a href="javascript:readpromise()" class="list-group-item text-center" >个人测评</a>
					<a href="#" class="list-group-item text-center">单位测评</a>
					<a class="list-group-item active">我的测评</a>
					<a href="#" class="list-group-item text-center">未完成</a>
					<a href="#" class="list-group-item text-center">已完成</a>
					<a href="#" class="list-group-item text-center">单位评测</a>
					<a class="list-group-item active">个人信息修改</a>
					<a href="#" class="list-group-item text-center">修改密码</a>
					<a href="#" class="list-group-item text-center">修改资料</a>
				</div>
			</div>
			<div class="col-md-9">
			
				<div class="row" id="user-promise" style="display:none;">
					<div class="col-md-1"></div>
					<div class="col-md-10">
						<div class="panel panel-default">
						  <div class="panel-heading">承诺书</div>
						  <div class="panel-body">
							Some default panel content here. Nulla vitae elit libero, a pharetra augue. Aenean lacinia bibendum nulla sed consectetur. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Nullam id dolor id nibh ultricies vehicula ut id elit.
						  </div>
						</div>
					</div>
					<div class="col-md-1"></div>
					<div class="row">
						<div class="col-md-12 text-center">
							<button class="btn btn-success" id="readit">我已经仔细阅读《XXX》并同意</button>
						</div>
					</div>
				</div>
				
				<div class="row" id="select-quiz" style="display:none;">
					<div class="col-md-2"></div>
					<div class="col-md-8" >
						<div class="list-group" id="field-select">
						
						</div>
					</div>
					<div class="col-md-2"></div>
					<div class="row col-md-12">
						<label class="label-control">输入备注（可选）：</label>
						<textarea id="user-remark" class="form-control" rows="3"></textarea>
					</div>
					<div class="row">
						<div class="col-md-12 text-center">
							<button class="btn btn-success">确认创建</button>
						</div>
					</div>
				</div>
				
				
				
			</div>
		</div>
	</div>
	<div class="col-md-9">
		
	</div>
</div>


</div>
</body>
</html>