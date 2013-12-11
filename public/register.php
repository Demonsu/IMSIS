<?php
include_once '../sys/core/init.inc.php';



?>

<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8">
	<title>注册</title>
	
	<link rel="stylesheet" href="./assets/css/register.css">
	<link rel="stylesheet" href="./assets/dist/css/bootstrap.min.css">
	<script style="text/javascript" src="./assets/js/jquery.js"></script>
	<script style="text/javascript" src="./assets/dist/js/bootstrap.min.js"></script>
	<script style="text/javascript" src="./assets/js/register.js"></script>
	<link rel="stylesheet" href="./assets/css/body.css">
</head>
<body>
<div class="main">
<!--header -->
<?php include './include/header.php'; ?>
	<div class="wraper">
		<div class="form-horizontal">
		  <div class="form-group">
			<h3 class="text-center"><strong>新用户注册</strong></h3>
		  </div>
		  <div class="form-group hasId">
			<label class="control-label col-md-3"><span style="color:#ff0000">*</span>用户名</label>
			<div class="col-md-5">
			  <input type="id" class="form-control" id="inputId" placeholder="输入用户名">
			</div>
			<label class="control-label col-md-4" style="text-align:left;" id="errorId"></label>
		  </div>
		  <div class="form-group hasPassword">
			<label class="control-label col-md-3"><span style="color:#ff0000">*</span>密码</label>
			<div class="col-md-5">
			  <input type="password" class="form-control" id="inputPassword" placeholder="输入密码">
			</div>
			<label class="control-label col-md-4" style="text-align:left;" id="errorPassword"></label>
		  </div>
		  <div class="form-group hasConfirmPasswd">
			<label class="control-label col-md-3"><span style="color:#ff0000">*</span>确认密码</label>
			<div class="col-md-5">
			  <input type="password" class="form-control" id="ConfirmPasswd" placeholder="确认密码">
			</div>
			<label class="control-label col-md-3" style="text-align:left;" id="errorConfirmPasswd"></label>
		  </div>
		  <div class="form-group hasDepartment">
			<label class="control-label col-md-3"><span style="color:#ff0000">*</span>所属部门</label>
			<div class="col-md-2">
			  <select class="form-control" id="select1">
				<option value="0">请选择省份</option>
			  </select>
			</div>
			<div class="col-md-2">
			  <select class="form-control" id="select2">
				<option value="0">请选择城市</option>
			  </select>
			</div>
			<div class="col-md-2">
			  <select class="form-control" id="select3">
				<option value="0">请选择单位</option>
			  </select>
			</div>
			<div class="col-md-2">
			  <input type="text" class="form-control" id="department" placeholder="处室名称">
			</div>
			<label class="control-label col-md-1" style="text-align:left;" id="errorSelect"></label>
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
			 <select class="form-control" id="selectTitle">
			  </select>
			</div>
			<label class="control-label col-md-3" style="text-align:left;" id="errorTitle"></label>
		  </div>
		  <div class="form-group hasPosition">
			<label class="control-label col-md-3"><span style="color:#ff0000">*</span>职务</label>
			<div class="col-md-5">
			  <input type="text" class="form-control" id="inputPosition" placeholder="输入您的职务">
			</div>
			<label class="control-label col-md-3" style="text-align:left;" id="errorPosition"></label>
		  </div>
		  <div class="form-group hasWork">
			<label class="control-label col-md-3"><span style="color:#ff0000">*</span>负责工作</label>
			<div class="col-md-5">
			  <select class="form-control" id="selectOnCharge">
			  </select>
			</div>
			<label class="control-label col-md-3" style="text-align:left;" id="errorWork"></label>
		  </div>
		  <div class="form-group">
			<label class="control-label col-md-3"><span style="color:#ff0000"></span>从事现工作时长</label>
			<div class="col-md-5">
			  <input type="text" class="form-control" id="inputTime" placeholder="输入您从事现任工作的时长">
			</div>
			<label class="control-label col-md-3" style="text-align:left;" id="errorTime"></label>
		  </div>
		  <div class="form-group hasSpeciality">
			<label class="control-label col-md-3"><span style="color:#ff0000">*</span>专长</label>
			<div class="col-md-5">
			  <select class="form-control" id="selectSpeciality">
			  </select>
			</div>
			<label class="control-label col-md-3" style="text-align:left;" id="errorSpeciality"></label>
		  </div>
		  <div class="form-group">
			<label class="control-label col-md-3"><span style="color:#ff0000"></span>邮箱</label>
			<div class="col-md-5">
			  <input type="text" class="form-control" id="inputEmail" placeholder="输入您的邮箱">
			</div>
			<label class="control-label col-md-3" style="text-align:left;" id="errorEmail"></label>
		  </div>
		  
		  <div class="form-group">
			<div class="control-label col-md-8">
			  <button id="btn-register" class="btn btn-default">注册</button>
			</div>
			  <label class="control-label col-md-4" style="text-align:left;color:#b94a48" id="errorRegister"></label>
		  </div>
		</div>
	</div>
<?php include './include/footer.php'; ?>
</div>
</body>
</html>