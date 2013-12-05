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
					<a class="list-group-item active">创建测评</a>
					<a href="javascript:readpromise()" id="person" class="list-group-item text-center" >创建个人测评</a>
					<a href="javascript:doremark()" id="department" class="list-group-item text-center">创建单位测评</a>
					<a class="list-group-item active">我的测评</a>
					<a href="javascript:nc_list()" class="list-group-item text-center">未完成的测评</a>
					<a href="javascript:c_list()" class="list-group-item text-center">已完成的测评</a>
					<a href="javascript:d_list()" id="depart_quiz" class="list-group-item text-center">单位测评</a>
					<a class="list-group-item active">个人信息修改</a>
					<a href="#" class="list-group-item text-center">修改密码</a>
					<a href="#" class="list-group-item text-center">修改资料</a>
				</div>
			</div>
			<div class="col-md-9">
				
				<div class="panel panel-default" id="nc-list" style="display:none">
				  <div class="panel-heading">
					<h3 class="panel-title">未完成的测评</h3>
				  </div>
				  <div class="panel-body">
				  
					<div class="list-group" id="nc-list-items">
					
					</div>
				  </div>
				</div>
				
				<div class="panel panel-default" id="c-list" style="display:none">
				  <div class="panel-heading">
					<h3 class="panel-title">已完成的测评</h3>
				  </div>
				  <div class="panel-body">
				  
					<div class="list-group" id="c-list-items">
						
					</div>
				  </div>
				</div>
				
				<div class="panel panel-default" id="d-list" style="display:none">
				  <div class="panel-heading">
					<h3 class="panel-title">单位测评</h3>
				  </div>
				  <div class="panel-body">
				  
					<div class="list-group" id="d-list-items">
					  <
					</div>
				  </div>
				</div>
			
				<div class="panel panel-default" id="user-promise" style="display:none;">
				  <div class="panel-heading">
					<h3 class="panel-title">请仔细阅读承诺书</h3>
				  </div>
				  <div class="panel-body">
				  
					<div class="row">
						<div class="row">
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
						</div>
						<div class="row">
							<div class="col-md-12 text-center">
								<button class="btn btn-success" id="readit">我已经仔细阅读《XXX》并同意相关内容</button>
							</div>
						</div>
					</div>
				  </div>
				</div>
				
				<div class="panel panel-default" id="select-quiz" style="display:none;">
				  <div class="panel-heading">
					<h3 class="panel-title">选择你想要测评的域然后创建</h3>
				  </div>
				  <div class="panel-body">
				  
					<div class="row" >
						<div class="row">
							<div class="col-md-12">
								<div class="list-group" id="field-select">
									
								</div>
							</div>
						</div>
						<div class="row">
							
							<div class="col-md-12">
								<label class="label-control">输入备注（可选）：</label>
								<textarea id="user-remark" class="form-control" rows="3"></textarea>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 text-center">
								<button class="btn btn-success" id="create">确认创建</button>
							</div>
						</div>
					</div>
				  </div>
				</div>
				
				<div class="panel panel-default" id="enter-remark" style="display:none;">
				  <div class="panel-heading">
					<h3 class="panel-title">填写备注（用于区分每次测评）：</h3>
				  </div>
				  <div class="panel-body">
				  
					<div class="row" >
						<div class="row">
							
							<div class="col-md-12">
								<label class="label-control">输入备注（可选）：</label>
								<textarea id="d-remark" class="form-control" rows="3"></textarea>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 text-center">
								<button class="btn btn-success" id="d-create">确认创建</button>
							</div>
						</div>
					</div>
				  </div>
				</div>
				
				<div class="panel panel-default" id="change-passwd" style="display:none">
				  <div class="panel-heading">
					<h3 class="panel-title">选择你想要测评的域然后创建</h3>
				  </div>
				  <div class="panel-body">
					<div class="form-horizontal">
						<div class="form-group">
							<label class="control-label col-md-4 text-right">原密码：</label>
							<div class="col-md-4">
								<input class="form-control" type="password" id="originPasswd" placeholder="输入原密码"/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-4 text-right">新密码：</label>
							<div class="col-md-4">
								<input class="form-control" type="password" id="newPasswd" placeholder="输入新密码"/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-4 text-right">确认新密码：</label>
							<div class="col-md-4">
								<input class="form-control" type="password" id="confirmPasswd" placeholder="确认新密码"/>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12 text-center">
								<button class="btn btn-success" id="newPasswd">确认</button>
							</div>
						</div>
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