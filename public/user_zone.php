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

<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>

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
					<a href="javascript:change_passwd()" class="list-group-item text-center">修改密码</a>
					<a href="javascript:change_data()" class="list-group-item text-center">修改资料</a>
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
					<h3 class="panel-title">修改密码</h3>
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
				
				<div class="panel panel-default" id="change-data" class="display:none">
				  <div class="panel-heading">
					<h3 class="panel-title">修改个人资料</h3>
				  </div>
				  <div class="panel-body">
					<div class="form-horizontal">
						<div class="form-group">
							<label class="control-label col-md-3 text-right">用户名:</label>
							<div class="col-md-5">
								<input class="form-control" type="text" value="dwadwa" placeholder="输入原密码" disabled/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 text-right">所属部门:</label>
							<div class="col-md-5">
								<input class="form-control" type="text" value="dwadwa" placeholder="输入原密码" disabled/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 text-right">职务:</label>
							<div class="col-md-5">
								<input class="form-control" type="text" value="dwadwa" placeholder="输入原密码" disabled/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 text-right">负责工作:</label>
							<div class="col-md-5">
								<input class="form-control" type="text" value="dwadwa" placeholder="输入原密码" disabled/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 text-right">技术专长:</label>
							<div class="col-md-5">
								<input class="form-control" type="text" value="dwadwa" placeholder="输入原密码" disabled/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3"><span style="color:#ff0000"></span>年龄</label>
							<div class="col-md-5">
							  <select class="form-control" id="selectAge">
								<option value="0">请选择年龄段</option>
								<option value="1">25岁及以下</option>
								<option value="2">26~35岁</option>
								<option value="3">36~45岁</option>
								<option value="4">46~55岁</option>
								<option value="5">56岁及以上</option>
							  </select>
							</div>
						  </div>
						  <div class="form-group">
							<label class="control-label col-md-3"><span style="color:#ff0000"></span>性别</label>
							<div class="col-md-5">
							  <select class="form-control" id="selectGender">
								<option value="0">请选择性别</option>
								<option value="1">男</option>
								<option value="2">女</option>
							  </select>
							</div>
						  </div>
						  <div class="form-group">
							<label class="control-label col-md-3"><span style="color:#ff0000"></span>教育程度</label>
							<div class="col-md-5">
							  <select class="form-control" id="selectEdu">
								<option value="0">请选择教育程度</option>
								<option value="1">大专</option>
								<option value="2">大学本科</option>
								<option value="3">硕士</option>
								<option value="4">博士</option>
							  </select>
							</div>
						  </div>
						  <div class="form-group hasTitle">
							<label class="control-label col-md-3"><span style="color:#ff0000"></span>职称</label>
							<div class="col-md-5">
							  <input type="text" class="form-control" id="inputTitle" placeholder="输入您的职称">
							</div>
							<label class="control-label col-md-3" style="text-align:left;" id="errorTitle"></label>
						  </div>
						<div class="form-group">
							<label class="control-label col-md-3"><span style="color:#ff0000"></span>从事现工作时长</label>
							<div class="col-md-5">
							  <input type="text" class="form-control" id="inputTime" placeholder="输入您从事现任工作的时长">
							</div>
							<label class="control-label col-md-3" style="text-align:left;" id="errorTime"></label>
						  </div>
						  <div class="form-group">
							<label class="control-label col-md-3"><span style="color:#ff0000"></span>邮箱</label>
							<div class="col-md-5">
							  <input type="text" class="form-control" id="inputEmail" placeholder="输入您的邮箱">
							</div>
							<label class="control-label col-md-3" style="text-align:left;" id="errorEmail"></label>
						  </div>
							</div>
						</div>
						<div class="form-group">
						<div class="col-md-8 text-right">
							<button class="btn btn-success" id="btn-change-data">修改</div>
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