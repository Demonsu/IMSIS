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

<?php include './include/header.php'; ?>
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
			  <a href="#" class="list-group-item" id="manage-target">修改关键域目标值</a>
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
			  <li class="list-group-item" id="12">Cras justo odiodwads
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
				  <input type="text" id="effect-field-input" class="form-control" placeholder="作用域名称" >
				  <input type="text" id="effect-field-id" style="display:none;" value=""/>
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
			<select class="form-control" id="fetch-effect-field-list">
				
			</select>
			<ul class="list-group" id="key-field-list">
			  <li class="list-group-item" id="">Cras justo odiodwads
				<label class="label label-danger" onclick="delete_key_field(this)">删除</label>
				<label class="label label-info" onclick="show_hide_key_field(this)">显示</label>
				<label class="label label-warning" onclick="modify_key_field(this)">修改</label>
			  </li>
			  <li class="list-group-item text-center" onclick="add_key_field()"><span class="glyphicon glyphicon-plus"></span></li>
			</ul>
		  </div>
		</div>
	</div>
	<div id="key-field-cover">
		<div class="key-field-edit">
			<div class="alert alert-warning">
				<div class="input-group">
				  <span class="input-group-addon" id="key-field-title"></span>
				  <input type="text" id="key-field-input" class="form-control" placeholder="作用域名称">
				  <input type="text" id="key-field-id" style="display:none;" value=""/>
				  <span class="input-group-btn">
					<button class="btn btn-default" type="button" id="confirm-key-field">确认</button>
					<button class="btn btn-default" type="button" id="cancel-key-field">取消</button>
				  </span>
				</div>
			</div>
		</div>
	</div>
	
	<div class="col-md-9" id="change-key-variable">
		<div class="panel panel-default">
		  <div class="panel-heading" id="body_title">管理关键变量</div>
		  <div class="panel-body">
			<div class="row">
				<div class="col-md-6">
					<select class="form-control" id="fetch-effect-field-list2">
						
					</select>
				</div>
				<div class="col-md-6">
					<select class="form-control" id="fetch-key-field-list2">
						
					</select>
				</div>
			</div>
			<ul class="list-group" id="key-variable-list">
			  <li class="list-group-item" id="">Cras justo odiodwads
				<label class="label label-danger" onclick="delete_key_variable(this)">删除</label>
				<label class="label label-info" onclick="show_hide_key_variable(this)">显示</label>
				<label class="label label-warning" onclick="modify_key_variable(this)">修改</label>
			  </li>
			  <li class="list-group-item text-center" onclick="add_key_variable()"><span class="glyphicon glyphicon-plus"></span></li>
			</ul>
		  </div>
		</div>
	</div>
	<div id="key-variable-cover">
		<div class="key-variable-edit">
			<div class="alert alert-warning">
				<div class="input-group" style="float:right">

				  <input type="text" id="key-variable-id" style="display:none;" value=""/>
				  <div class="btn-group">
					<button type="button" class="btn btn-default" id="confirm-key-variable">确认</button>
					<button type="button" class="btn btn-default" id="cancel-key-variable">取消</button>
				  </div>
				</div>
				<div class="input-group">
				  <span class="input-group-addon">问题</span>
				  <input type="text" id="key_variable_question" class="form-control" placeholder="问题">
				</div>
				<div class="input-group">
				  <span class="input-group-addon">1分选项</span>
				  <input type="text" id="key_variable_a" class="form-control" placeholder="1">
				</div>
				<div class="input-group">
				  <span class="input-group-addon">2分选项</span>
				  <input type="text" id="key_variable_b" class="form-control" placeholder="2">
				</div>
				<div class="input-group">
				  <span class="input-group-addon">3分选项</span>
				  <input type="text" id="key_variable_c" class="form-control" placeholder="3">
				</div>
				<div class="input-group">
				  <span class="input-group-addon">4分选项</span>
				  <input type="text" id="key_variable_d" class="form-control" placeholder="4">
				</div>
				<div class="input-group">
				  <span class="input-group-addon">5分选项</span>
				  <input type="text" id="key_variable_e" class="form-control" placeholder="5">
				</div>
			</div>
		</div>
	</div>
	
	<div class="col-md-9" id="target-change">
		<div class="panel panel-default">
		  <div class="panel-heading" id="body_title"></div>
		  <div class="panel-body">
			<table id="target-table">
			
			</table>
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