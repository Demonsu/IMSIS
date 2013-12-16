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
	<script style="text/javascript" src="./assets/plugin/date/calendar.js"></script>
	<link rel="stylesheet" href="./assets/plugin/date/calendar.css">
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
			  <a href="#" class="list-group-item" id="search-quiz">按条件搜索评测结果</a>
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
			  <a href="#" class="list-group-item" id="change-passwd">修改管理员密码</a>
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
		  <div class="panel-heading" id="body_title">修改关键域目标值</div>
		  <div class="panel-body">
			<table id="target-table">
			
			</table>
		  </div>
		</div>
	</div>
	
	<div class="col-md-9" id="quiz-result-search">
		<div class="panel panel-default">
		  <div class="panel-heading" id="body_title">条件查找</div>
		  <div class="panel-body">
			<div class="alert alert-info">
				<ul class="list-group">
				  <li class="list-group-item">
					问卷所属区域：
					<label><input type="checkbox" id="area-check" checked />所有</label>
					<div style="float:right">
						<select id="select1" disabled>
						  <option value="0">请选择省份</option>
						</select>
						<select id="select2" disabled>
						  <option value="0">请选择城市</option>
						</select>
						<select id="select3" disabled>
						  <option value="0">请选择单位</option>
						</select>
					</div>
				  </li>
				  <li class="list-group-item">
					时间段：
					<label><input type="checkbox" id="timespan-check" value="0" checked />全部</label>
					<div style="float:right">
						<label>开始时间：<input type="text" id="time-start" placeholder="格式：01/01/2013" disabled /></label>
						<label>结束时间：<input type="text" id="time-end" placeholder="格式：01/01/2013" disabled /></label>
					</div>
				  </li>
				  <li class="list-group-item">
					问卷类型：
					<label><input type="radio" name="radio-settype" value="0" checked />所有</label>
					<label><input type="radio" name="radio-settype" value="2" />个人</label>
					<label><input type="radio" name="radio-settype" value="1" />单位</label>
				  </li>
				  <li class="list-group-item">
					答题情况：
					<label><input type="radio" name="radio-setstate" value="2" checked />已完成</label>
					<label><input type="radio" name="radio-setstate" value="1" />未完成</label>
					<label><input type="radio" name="radio-setstate" value="0" />全部</label>
					<div style="float:right">
						<button class="btn btn-success btn-sm" id="search-btn">搜索</button>
					</div>
				  </li>
				</ul>
				
			</div>
			<ul class="list-group" id="search-result-list">
			  <li class="list-group-item">Cras justo odio</li>
			  <li class="list-group-item">Dapibus ac facilisis in</li>
			  <li class="list-group-item">Morbi leo risus</li>
			  <li class="list-group-item">Porta ac consectetur ac</li>
			  <li class="list-group-item">Vestibulum at eros</li>
			</ul>
		  </div>
		</div>
	</div>
	
	<div class="col-md-9" id="passwd-reset">
		<div class="panel panel-default">
		  <div class="panel-heading" id="body_title">修改管理员密码</div>
		  <div class="panel-body">
			<div class="form-horizontal">
				<div class="form-group hasOrigin">
					<label class="control-label col-md-4 text-right">原密码：</label>
					<div class="col-md-4">
						<input class="form-control" type="password" id="originPasswd" placeholder="输入原密码"/>
					</div>
					<label class="control-label col-md-4" style="text-align:left;" id="errorPasswd"></label>
				</div>
				<div class="form-group hasPasswd">
					<label class="control-label col-md-4 text-right">新密码：</label>
					<div class="col-md-4">
						<input class="form-control" type="password" id="newPasswd" placeholder="输入新密码"/>
					</div>
					<label class="control-label col-md-4" style="text-align:left;" id="errorPassword"></label>
				</div>
				<div class="form-group hasConfirm">
					<label class="control-label col-md-4 text-right">确认新密码：</label>
					<div class="col-md-4">
						<input class="form-control" type="password" id="confirmPasswd" placeholder="确认新密码"/>
					</div>
					<label class="control-label col-md-4" style="text-align:left;" id="errorConfirmPassword"></label>
				</div>
				<div class="form-group">
					<div class="col-md-12 text-center">
						<button class="btn btn-success" id="btn-change-passwd">确认</button>
					</div>
				</div>
			</div>
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