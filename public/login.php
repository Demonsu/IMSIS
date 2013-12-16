<?php
	include_once '../sys/core/init.inc.php';
?>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8">
	<title>个人空间</title>
	
	<link rel="stylesheet" href="./assets/css/login.css">
	<link rel="stylesheet" href="./assets/dist/css/bootstrap.min.css">
	<script style="text/javascript" src="./assets/js/jquery.js"></script>
	<script style="text/javascript" src="./assets/dist/js/bootstrap.min.js"></script>
	<script style="text/javascript" src="./assets/js/login.js"></script>
	<link rel="stylesheet" href="./assets/css/body.css">
</head>
<body>
<div class="main">
<!--header -->
<?php include './include/header.php'; ?>
<div class="row">
	<div class="col-md-8">
		<div class="jumbotron"  style="border-radius:6px">
		  <h1>系统简介</h1>
		  <p>该系统（下称“eGov-CMM”）作为电子政务能力成熟度模型的网络评估工具，旨在帮助用户快速了解评估的内容、方法、流程，以及引导用户在线完成整个评估过程，并将结果反馈。它是政府快速了解自我能力的渠道，也将成为政府提升服务能力的有效工具，对我国电子政务事业的深化发展具有重要的促进意义。</p>
		  <p><a class="btn btn-primary btn-lg" role="button">更多......</a></p>
		</div>
	</div>
	<div class="col-md-4">
		<?php 
			if (!isset($_SESSION["USERID"])){
			echo '
		
		<div class="form-horizontal" role="form" id="login_main">
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
		' ;
			}
			else{
				echo '
		<div class="form-horizontal" id="login_second" >
			<button class="btn btn-info btn-lg btn-block" id="u_t"><span class="glyphicon glyphicon-user"></span><br><h3>个人测评</h3></button>
			<label class="label-control alert alert-success">个人评测说明:<br>个人测评中用户选择自己想要测评的关键域进行测评，每个用户只能看到自己的测评</label>
			<button class="btn btn-warning btn-lg btn-block" id="d_t"><span class="glyphicon glyphicon-briefcase"></span><br><h3>单位测评</h3></button>
			<label class="label-control alert alert-success">单位评测说明:<br>单位测评创建时所有属于本单位的用户都可以看到并进行测评，每个用户可以选择自己想要测评的关键域进行测评，只有所有关键域都测评完之后才能查看结果</label>
		</div>
		' ;
			}
		?>
	</div>
</div>
<div class="d_cover" id="cover">
	<div class="cover_content">
		<div class="panel panel-default">
		  <div class="panel-heading">
			<h3 class="panel-title text-center">创建单位测评：
				<div style="float:right" class="glyphicon glyphicon-remove-circle" onClick="hide()"></div>
			</h3>
		  </div>
		  <div class="panel-body">
		  
			<div class="form-horizontal" >
				<div class="form-group">
					<div class="col-md-12">
						<label class="label-control">输入备注（用于区分每次测评，可选）：</label>
						<textarea id="d-remark" class="form-control" rows="3"></textarea>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-6 text-right">
						<button class="btn btn-success" id="d-create">确认创建</button>
					</div>
					<div class="col-md-6 text-left">
						<button class="btn btn-danger" id="d-cancel">取消创建</button>
					</div>
				</div>
			</div>
		  </div>
		</div>
	</div>
</div>
<div class="u_cover" id="step1">
	<div class="u_cover_content">
		<div class="panel panel-default" id="user-promise">
		  <div class="panel-heading">
			<h3 class="panel-title">阅读评测说明及测评承诺书
				<div style="float:right" class="glyphicon glyphicon-remove-circle" onClick="hide()"></div>
			</h3>
		  </div>
		  <div class="panel-body">
		  
			<div class="group">
				Some default panel content here. Nulla vitae elit libero, a pharetra augue. Aenean lacinia bibendum nulla sed consectetur. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Nullam id dolor id nibh ultricies vehicula ut id elit
						
				<div class="form-group">
					<div class="col-md-12 text-center">
						<button class="btn btn-success" id="readit">我已经仔细阅读说明并同意相关内容</button>
					</div>
				</div>
			</div>
		  </div>
		</div>
	</div>
</div>
<div class="u_cover" id="step2">
	<div class="u_cover_content">
		<div class="panel panel-default">
		  <div class="panel-heading">
			<h3 class="panel-title">选择你想要测评的域然后创建
				<div style="float:right" class="glyphicon glyphicon-remove-circle" onClick="hide()"></div>
			</h3>
		  </div>
		  <div class="panel-body">
		  
			<div class="form-horizontal">
				<div class="group">
					<div style="margin-bottom:10px;">
						<a class="btn btn-info" id="all-select">全选</a> <a class="btn btn-warning" id="cancel-select">清除</a>
					</div>
					<div class="list-group" id="field-select">
						
					</div>
				</div>
				<div class="form-group">
					
					<div class="col-md-12">
						<label class="label-control">输入备注（可选）：</label>
						<textarea id="user-remark" class="form-control" rows="3"></textarea>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-6 text-right">
						<button class="btn btn-success" id="create">确认创建</button>
					</div>
					<div class="col-md-6 text-left">
						<button class="btn btn-danger" id="u-cancel">取消创建</button>
					</div>
				</div>
			</div>
		  </div>
		</div>
	</div>
</div>
<?php include './include/footer.php'; ?>
</div>
</body>
</html>
