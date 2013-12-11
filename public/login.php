<?php
	include_once '../sys/core/init.inc.php';
	if (isset($_SESSION["USERID"]))
	{
		header("Location:user_zone.php");
	}
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
<div class="row">
	<div class="col-md-8">
		<div class="jumbotron">
		  <h1>系统简介</h1>
		  <p>该系统（下称“eGov-CMM”）作为电子政务能力成熟度模型的网络评估工具，旨在帮助用户快速了解评估的内容、方法、流程，以及引导用户在线完成整个评估过程，并将结果反馈。它是政府快速了解自我能力的渠道，也将成为政府提升服务能力的有效工具，对我国电子政务事业的深化发展具有重要的促进意义。</p>
		  <p><a class="btn btn-primary btn-lg" role="button">Learn more</a></p>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-horizontal" role="form">
			<div class="form-group text-center">
				<span class="span-error" id="errorMsg"></span>
			</div>
			<div class="form-group">
				<label class="control-label col-md-4">用户名:</label>
				<div class="col-md-8">
					<input type="id" class="form-control" id="inputId" placeholder="输入用户名">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-4">密码:</label>
				<div class="col-md-8">
					<input type="password" class="form-control" id="inputPassword" placeholder="输入密码">
				</div>
			</div>
			<div class="form-group text-right">
				<button id="login" class="btn btn-primary">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;登陆&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
				<button id="register" class="btn btn-warning">注册</button>
				<button id="forget" class="btn btn-link">忘记密码?</button>
			</div>
		</div>
	</div>
</div>

<?php include './include/footer.php'; ?>
</div>
</body>
</html>
