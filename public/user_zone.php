<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
include_once '../sys/core/init.inc.php';

$op = $_GET['navigation'];

?>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8">
	<title>eGov-CMM</title>
	
	
	<link rel="stylesheet" href="./assets/dist/css/bootstrap.css">
	<script style="text/javascript" src="./assets/js/jquery.js"></script>
	<script style="text/javascript" src="./assets/dist/js/bootstrap.min.js"></script>
	<script style="text/javascript" src="./assets/js/user_zone.js"></script>
	<link rel="stylesheet" href="./assets/css/body.css">
	<link rel="stylesheet" href="./assets/css/user_zone.css">

</head>
<script>
$(document).ready(function(){
	var op = <?php echo $op ?>;
	if(op == 1){
		$('#collapse1').click();
		readpromise();
	}
	else if(op == 2){
		$('#collapse1').click();
		doremark();
	}
	else if(op == 3){
		$('#collapse2').click();
		nc_list();
	}
	else if(op == 4){
		$('#collapse2').click();
		c_list();
	}
	else if(op == 5){
		$('#collapse2').click();
		d_list();
	}
	else if(op == 6){
		$('#collapse3').click();
		change_passwd();
	}
	else if(op == 7){
		$('#collapse3').click();
		change_data();
	}
});
</script>
<body>
<div class="main">
<!--header -->
<?php include './include/header.php'; ?>

<div class="group" >
	<div class="panel panel-info" style="min-height:600px;">
		<div class="panel-heading"><div class="panel-title" style="color:#000000">用户空间</div></div>
		<div class="panel-body">

			<div style="float:left;width:200px;padding-right:15px;">
				<div class="panel-group" id="accordion">
				  <div class="panel panel-default">
					<div class="panel-heading">
					  <h4 class="panel-title">
						<a data-toggle="collapse" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" id="collapse1">
						  创建测评
						</a>
					  </h4>
					</div>
					<div id="collapseOne" class="panel-collapse collapse list-group">
						<a href="javascript:readpromise()" id="person" class="list-group-item text-center" >创建个人测评</a>
						<a href="javascript:doremark()" id="department" class="list-group-item text-center">创建单位测评</a>
					</div>
				  </div>
				  <div class="panel panel-default">
					<div class="panel-heading">
					  <h4 class="panel-title">
						<a data-toggle="collapse" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" id="collapse2">
						  我的测评
						</a>
					  </h4>
					</div>
					<div id="collapseTwo" class="panel-collapse collapse list-group">
						<a href="javascript:nc_list()" class="list-group-item text-center">未完成的测评</a>
						<a href="javascript:c_list()" class="list-group-item text-center">已完成的测评</a>
						<a href="javascript:d_list()" id="depart_quiz" class="list-group-item text-center">单位测评</a>
					</div>
				  </div>
				  <div class="panel panel-default">
					<div class="panel-heading">
					  <h4 class="panel-title">
						<a data-toggle="collapse" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" id="collapse3">
						  个人信息修改
						</a>
					  </h4>
					</div>
					<div id="collapseThree" class="panel-collapse collapse list-group">
						<a href="javascript:change_passwd()" class="list-group-item text-center">修改密码</a>
						<a href="javascript:change_data()" class="list-group-item text-center">修改资料</a>
					</div>
				  </div>
				</div>
				<div class="list-group" style="display:none">
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

			<div style="width:725px;padding-right:0px;float:left;">
			
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
					<h3 class="panel-title">阅读评测说明及测评承诺书</h3>
				  </div>
				  <div class="panel-body">
				  
					<div class="group">
						您好！您正在使用电子政务服务管理能力测评系统，问卷中您所填写的信息和数据仅作为电子政务服务能力测评及学术研究之用，绝不会泄露或做其他用途，请放心如实填写。<br>
				请在填写过程中如实填写，这样您才能得到相对真实的测评结果和中肯的测评建议。		
						<div class="group">
							<div class="text-center">
								<button class="btn btn-warning" id="readit">我已经仔细阅读说明并同意相关内容</button>
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
				  
					<div class="form-horizontal" >
						<div class="group" style="margin-bottom:10px;">
							<a class="btn btn-primary" id="all-select">全选</a> <a class="btn btn-warning" id="cancel-select">清除</a>
						</div>
						<div class="group">
							<div class="list-group" id="field-select">
								
							</div>
						</div>
						<div class="group">
							<label class="label-control">输入备注（为了便于区分每一次测评，请填写备注标识这分问卷，可选）：</label>
							<textarea id="user-remark" class="form-control" rows="3"></textarea>
						</div>
						<div class="group">
							<div class="col-md-12 text-center" style="padding-top:10px">
								<button class="btn btn-primary" id="create">确认创建</button>
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
				  
					<div class="group" >
						<div class="row">
							
							<div class="col-md-12">
								<label class="label-control">输入备注（为了便于区分每一次测评，请填写备注标识这分问卷，可选）：</label>
								<textarea id="d-remark" class="form-control" rows="3"></textarea>
							</div>
						</div>
						<div class="row" style="margin-top:10px">
							<div class="col-md-12 text-center">
								<button class="btn btn-primary" id="d-create">确认创建</button>
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
								<button class="btn btn-primary" id="btn-change-passwd">确认</button>
							</div>
						</div>
					</div>
				  </div>
				</div>
				
				<div class="panel panel-default" id="change-data" >
				  <div class="panel-heading">
					<h3 class="panel-title">修改个人资料</h3>
				  </div>
				  <div class="panel-body">
					<div class="form-horizontal">
						<div class="form-group">
							<label class="control-label col-md-3 text-right">用户名:</label>
							<div class="col-md-5">
								<input class="form-control" type="text" id="user_id" value="dwadwa" placeholder="" disabled/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 text-right">所属部门:</label>
							<div class="col-md-5">
								<input class="form-control" type="text" id="user_department" value="dwadwa" placeholder="" disabled/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 text-right">职称:</label>
							<div class="col-md-5">
								<input class="form-control" type="text" id="user_title" value="dwadwa" placeholder="" disabled/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 text-right">负责工作:</label>
							<div class="col-md-5">
								<input class="form-control" type="text" id="user_oncharge" value="dwadwa" placeholder="" disabled/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 text-right">技术专长:</label>
							<div class="col-md-5">
								<input class="form-control" type="text" id="user_spaciality" value="dwadwa" placeholder="" disabled/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3"><span style="color:#ff0000"></span>年龄</label>
							<div class="col-md-5">
							  <select class="form-control" id="selectAge">
								<option value="0">请选择年龄段</option>
								<option value="25">25岁及以下</option>
								<option value="35">26~35岁</option>
								<option value="45">36~45岁</option>
								<option value="55">46~55岁</option>
								<option value="56">56岁及以上</option>
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
								<option value="大专">大专</option>
								<option value="大学本科">大学本科</option>
								<option value="硕士">硕士</option>
								<option value="博士">博士</option>
							  </select>
							</div>
						  </div>
						  <div class="form-group hasTitle">
							<label class="control-label col-md-3"><span style="color:#ff0000"></span>职务</label>
							<div class="col-md-5">
							  <input type="text" class="form-control" id="inputPosition" placeholder="输入您的职务">
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
						<div class="form-group">
						<div class="col-md-8 text-right">
							<button class="btn btn-primary" id="btn-change-data">修改</button>
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

<?php include './include/footer.php'; ?>

</div>
</body>
</html>