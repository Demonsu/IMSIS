
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	include_once '../sys/core/init.inc.php';

	if (isset($_SESSION["PERMISSION"]) && $_SESSION["PERMISSION"]==1)
		header("Location:./admin_zone.php");
?>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8">
	<title>eGov-CMM</title>
	
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
	<div style="width:675px;padding-left:15px;float:left;padding-right:15px;">
		<div class="jumbotron"  style="border-radius:6px;background-color:#e5e5e5;height:600px;">
		  <h2>系统简介</h2>
		  <p style="font-size:16px;text-indent:2em;">
			电子政务服务能力成熟度模型是以各级政府职能部门为主要研究对象的能力调查。通过电子政务系统领导者对在行电子政务系统运营情况的回答，分析电子政务系统能力的建设情况，从内部评估政府电子化的成熟程度</p>
<!--
			<p style="font-size:14px;text-indent:2em;">希望通过本调查了解政府内部人员（尤其是日常工作中使用电子政务系统的公务人员）对电子政务系统使用情况的感受，以及各部门应用电子政务提供服务情况的客观评价。</p>
			<p style="font-size:14px;text-indent:2em;">您的评测结果将有助于寻找提高贵部门电子政务服务能力的方法和思路。</p>
			<p style="font-size:14px;text-indent:2em;">调查内容包括个人信息、电子政务系统使用情况的个人感受、电子政务系统服务情况的个人感受等三项内容。</p>
			<p style="font-size:14px;text-indent:2em;">作为本领域的专业人士，您的意见对我们的研究工作非常重要，它将是我们了解电子政务系统应用情况的重要参考依据。评测完后，我们将会根据您的评测内容给出评测分析和最终评价结果。</p>
			<p style="font-size:14px;text-indent:2em;">填写问卷时，请选择您认可的成熟度水平相应的选项，1代表成熟度水平最低，5代表成熟度水平最高。</p>
		  </p>-->
		  <p><a id="more" <?php if(isset($_SESSION["PERMISSION"])) ; else echo 'style="display:none"'; ?>" class="btn btn-primary btn-lg" role="button" href="./user_zone.php?navigation=7">更多...</a></p>
		</div>
	</div>
	<div style="width:300px;float:left;">
		<?php 
			if (isset($_COOKIE['username']))
			{
				$username=$_COOKIE['username'];
				//echo $username;
			}else
			{
				//echo "坑爹啊";
				$username="";
			}
			if (isset($_COOKIE['password']))
			{
				$password=$_COOKIE['password'];
			}else
			{
				$password="";
			}
			if (!isset($_SESSION["USERID"])){
			echo '
		
		<div class="form-horizontal" role="form" id="login_main">
			<div class="form-group text-center">
				<span class="span-error" id="errorMsg"></span>
			</div>
			<div class="form-group">
				<label class="control-label col-md-4">用户名:</label>
				<div class="col-md-8">
					<input type="id" class="form-control" id="inputId" placeholder="输入用户名" value="'.$username.'">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-4">密码:</label>
				<div class="col-md-8">
					<input type="password" class="form-control" id="inputPassword" placeholder="输入密码" value="'.$password.'">
				</div>
			</div>
			<div class="form-group text-center">
				<p>
				<span style="margin-right:20px"><input type="checkbox" id="remember"> 记住密码</span>
				<a href="javascript:alert(\'请联系我们\');">忘记密码？</a>
				</p>
				<button id="login" class="btn btn-primary">&nbsp;&nbsp;&nbsp;&nbsp;登录&nbsp;&nbsp;&nbsp;&nbsp;</button>
				<button id="register" class="btn btn-warning">注册</button>
				
			</div>
		</div>
		' ;
			}
			else{
				echo '
		<div class="group" id="login_second">
			<div style="position:relative">
			<div id="cover-u" style="position:absolute;width:300px;height:85px;background:#5bc0de;z-index:1002;border-radius:5px;cursor:pointer" onclick="hide_cover(1)">
				<button type="button" class="btn btn-primary btn-lg btn-block" style="width:300px;height:85px;">
					<span class="glyphicon glyphicon-user"></span><br><h3>个人测评</h3>
				</button>
			</div>
			<div class="btn-group">
				<button class="btn btn-primary" id="u_t" style="width:150px;height:85px">
					<span class="glyphicon glyphicon-user"></span><br><h4>开始测评</h4>
				</button>
				
				<button class="btn btn-primary" onclick="window.location=\'user_zone.php?navigation=4\'" style="width:150px;height:85px">
					<span class="glyphicon glyphicon-th-list"></span><br><h4>我的测评</h4>
				</button>
			</div>
			</div>
			<label class="label-control alert alert-info" style="color:#000000;font-weight:normal">单人测评模式:<br>您可以选择自己熟知的领域，对您所在的部门的某些流程进行测评。测评后可直接获取报表结果。</label>
			<div style="position:relative">
			<div id="cover-d" style="position:absolute;width:300px;height:85px;background:#ed9c28;z-index:1002;border-radius:5px;cursor:pointer"  onclick="hide_cover(2)">
				<button type="button" class="btn btn-primary btn-lg btn-block" style="width:300px;height:85px;">
					<span class="glyphicon glyphicon-briefcase"></span><br><h3>单位测评</h3>
				</button>
			</div>
			<div class="btn-group" style="position:relative">
				<button class="btn btn-primary" id="d_t" style="width:150px;height:85px">
					<span class="glyphicon glyphicon-briefcase"></span><br><h4>创建测评</h4>
				</button>
				
				<button class="btn btn-primary" onclick="window.location=\'user_zone.php?navigation=5\'" style="width:150px;height:85px">
					<span class="glyphicon glyphicon-th-list"></span><br><h4>单位测评</h4>
				</button>
			</div>
			</div>
			<label class="label-control alert alert-info" style="color:#000000;font-weight:normal">多人模式:<br>您可以选择自己熟知的领域，与您的同事一起完成对单位的测评。报告结果会在所有测评项完成后获得。</label>
			<div style="position:relative">
			<div id="cover-d" style="position:absolute;width:300px;height:85px;background:#ed9c28;z-index:1002;border-radius:5px;cursor:pointer">
				<button type="button" class="btn btn-primary btn-lg btn-block" style="width:300px;height:85px;"  onclick="window.open(\'./quiz_gov.php\')"> 
					<span class="glyphicon glyphicon-briefcase"></span><br><h3>问卷调查</h3>
				</button>
			</div>
			</div>
		</div>
		
		' ;
			}
		?>
		<script>
			function show_cover(id){
				if(id == 1)
					$("#cover-u").animate({height:"85px"},400);
				else if(id == 2){
					$("#cover-d").animate({height:"85px"},400);
				}
			}
			$(document).click(function(){
				$('#cover-u').show();
				$('#cover-d').show();
				$("#cover-u").animate({height:"85px"},400);
				$("#cover-d").animate({height:"85px"},400);
			});
			function hide_cover(t){
				if(t == 1){
					$("#cover-u").animate({height:"0px"},400);
					setTimeout("$('#cover-u').hide()",400);
				}
				else if(t == 2){
					$("#cover-d").animate({height:"0px"},400);
					setTimeout("$('#cover-d').hide()",400);
				}
			}
		</script>
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
						<label class="label-control">输入备注（为了便于区分每一次测评，请填写备注标识这分问卷，可选）：</label>
						<textarea id="d-remark" class="form-control" rows="3"></textarea>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-6 text-right">
						<button class="btn btn-primary" id="d-create">确认创建</button>
					</div>
					<div class="col-md-6 text-left">
						<button class="btn btn-warning" id="d-cancel">取消创建</button>
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
		  
			<div class="group" style="font-weight:normal">
				
				<p>测评须知：</p>
				<p>您好！您正在使用电子政务服务管理能力测评系统，问卷中您所填写的信息和数据仅作为电子政务服务能力测评及学术研究之用，绝不会泄露或做其他用途，请放心如实填写。<br>
				请在填写过程中如实填写，这样您才能得到相对真实的测评结果和中肯的测评建议。</p>
		
				<div class="form-group">
					<div class="col-md-12 text-center">
						<button class="btn btn-warning" id="readit">我已经仔细阅读说明并同意相关内容</button>
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
			<h3 class="panel-title">选择你想要测评的项目
				<div style="float:right" class="glyphicon glyphicon-remove-circle" onClick="hide()"></div>
			</h3>
		  </div>
		  <div class="panel-body">
		  
			<div class="form-horizontal">
				<div class="group">
					<div style="margin-bottom:10px;">
						<a class="btn btn-primary" id="all-select">全选</a> <a class="btn btn-warning" id="cancel-select">清除</a>
					</div>
					<div class="list-group" id="field-select">
						
					</div>
				</div>
				<div class="form-group">
					
					<div class="col-md-12">
						<label class="label-control">输入备注（测试名，可选）：</label>
						<textarea id="user-remark" class="form-control" rows="3"></textarea>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-6 text-right">
						<button class="btn btn-primary" id="create">确认创建</button>
					</div>
					<div class="col-md-6 text-left">
						<button class="btn btn-warning" id="u-cancel">取消创建</button>
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
