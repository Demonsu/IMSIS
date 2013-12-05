<?php
	include_once '../sys/core/init.inc.php';

?>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8">
	<title>个人空间</title>
	<link rel="stylesheet" href="./assets/css/body.css">
	<link rel="stylesheet" href="./assets/css/login.css">
	<link rel="stylesheet" href="./assets/dist/css/bootstrap.min.css">
	<script style="text/javascript" src="./assets/js/jquery.js"></script>
	<script style="text/javascript" src="./assets/dist/js/bootstrap.min.js"></script>
	<script style="text/javascript" src="./assets/js/login.js"></script>
</head>
<body>
<div class="main">
<!--header -->
<?php include './include/header.php'; ?>
<div class="form-horizontal" role="form">
	<div class="form-group text-center">
		<span class="span-error" id="errorMsg"></span>
	</div>
	<div class="form-group">
		<label class="control-label col-md-5">用户名:</label>
		<div class="col-md-3">
			<input type="id" class="form-control" id="inputId" placeholder="输入用户名">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-md-5">密码:</label>
		<div class="col-md-3">
			<input type="password" class="form-control" id="inputPassword" placeholder="输入密码">
		</div>
	</div>
	<div class="form-group text-center">
		<button id="login" class="btn btn-primary">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;登陆&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
		<button id="register" class="btn btn-warning">注册</button>
		<button id="forget" class="btn btn-link">忘记密码?</button>
	</div>
</div>
</div>
</body>
</html>
