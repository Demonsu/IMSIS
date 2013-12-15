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
			  <a class="list-group-item active">
				内容管理
			  </a>
			  <a href="#" class="list-group-item">管理动态</a>
			  <a href="#" class="list-group-item">管理分享</a>
			  <a class="list-group-item active">
				查看评测
			  </a>
			  <a href="#" class="list-group-item">按条件搜索评测结果</a>
			  <a href="#" class="list-group-item">评测结果总览</a>
			  <a class="list-group-item active">
				设置指标
			  </a>
			  <a href="#" class="list-group-item" id="manage-effect-field">管理作用域</a>
			  <a href="#" class="list-group-item" id="manage-key-field">管理关键域</a>
			  <a href="#" class="list-group-item" id="manage-key-variable">管理关键变量</a>
			   <a class="list-group-item active">
				设置参数
			  </a>
			  <a href="#" class="list-group-item">修改关键域目标值</a>
			  <a class="list-group-item active">
				用户管理
			  </a>
			  <a href="#" class="list-group-item">修改用户密码</a>
			  <a class="list-group-item active">
				账户管理
			  </a>
			  <a href="#" class="list-group-item">修改管理员密码</a>
			</div>
		  </div>
		</div>
	</div>
	
	<div class="col-md-9" id="change-effect-field">
		<div class="panel panel-default">
		  <div class="panel-heading" id="body_title">管理作用域</div>
		  <div class="panel-body">
			<ul class="list-group" id="effect-field-list">
			  <li class="list-group-item" id="">Cras justo odiodwads
				<label class="label label-danger" onclick="delete_effect_field(this)">删除</label>
				<label class="label label-info" onclick="show_hide_effect_field(this)">显示</label>
				<label class="label label-warning" onclick="modify_effect_field(this)">修改</label>
			  </li>
			  <li class="list-group-item text-center" onclick="add_effect_field()"><span class="glyphicon glyphicon-plus"></span></li>
			</ul>
		  </div>
		</div>
	</div>
	<div id="effect-field-cover">
		<div class="effect-field-edit">
			<div class="alert alert-warning">
				<div class="input-group">
				  <span class="input-group-addon" id="effect-field-title"></span>
				  <input type="text" id="effect-field-input" class="form-control" placeholder="作用域名称">
				  <span class="input-group-btn">
					<button class="btn btn-default" type="button" id="confirm-effect-field">确认</button>
					<button class="btn btn-default" type="button" id="cancel-effect-field">取消</button>
				  </span>
				</div>
			</div>
		</div>
	</div>
	
	<div class="col-md-9" id="change-key-field">
		<div class="panel panel-default">
		  <div class="panel-heading" id="body_title">管理关键域</div>
		  <div class="panel-body">
			<ul class="list-group">
			
			</ul>
		  </div>
		</div>
	</div>
	
	<div class="col-md-9" id="change-key-variable">
		<div class="panel panel-default">
		  <div class="panel-heading" id="body_title">管理关键变量</div>
		  <div class="panel-body">
			<ul>
			
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