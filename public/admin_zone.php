<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	include_once '../sys/core/init.inc.php';

	//echo $result;
	$navi="";
	if (isset($_GET['navigation']))
	$navi = $_GET['navigation'];
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
<script>
	$(document).ready(function(){
		var navi = <?php echo $navi; ?>;
		if(navi == 1){
			$('#manage-news').click();
		}
		else if(navi == 2){
			$('#manage-share').click();
		}
		else if(navi == 3){
			$('#search-quiz').click();
		}
		else if(navi == 4){
			$('#manage-effect-field').click();
		}
		else if(navi == 5){
			$('#"manage-key-field').click();
		}
		else if(navi == 6){
			$('#manage-key-variable').click();
		}
		else if(navi == 7){
			$('#manage-target').click();
		}
		else if(navi == 8){
			$('#check-user').click();
		}
		else if(navi == 9){
			$('#change-passwd').click();
		}
	});
</script>
<body>
<div class="main">

<?php include './include/header.php'; ?>

<div class="row">
	<div style="width:248px;padding-left:15px;padding-right:15px;float:left;">
		<div class="panel panel-default panel-success" style="border-color:#dddddd;">
		  <div class="panel-heading" style="color:#000000;border-color:#dddddd;">管理员功能</div>
		  <div class="panel-body">
			<div class="list-group">
			  <a class="list-group-item active">
				内容管理
			  </a>
			  <a href="#" class="list-group-item" id="manage-news">管理动态</a>
			  <a href="#" class="list-group-item" id="manage-share">管理分享</a>
			  <a class="list-group-item active">
				查看评测
			  </a>
			  <a href="#" class="list-group-item" id="search-quiz">按条件搜索评测结果</a>
			  <!--<a href="#" class="list-group-item">评测结果总览</a>-->
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
			  <a href="#" class="list-group-item" id="check-user">查看用户资料</a>
			  <a class="list-group-item active">
				问卷统计
			  </a>
			  <a href="./quiz_gov_statistics.php" target="_blank" class="list-group-item">政府问卷</a>
			  <a href="./quiz_pub_statistics.php" target="_blank" class="list-group-item">公众问卷</a>
			  <a class="list-group-item active">
				账户管理
			  </a>
			  <a href="#" class="list-group-item" id="change-passwd">修改管理员密码</a>
			  
			</div>
		  </div>
		</div>
	</div>
	
	<div id="change-share">
		<div class="panel panel-default">
		  <div class="panel-heading" id="body_title">管理分享内容</div>
		  <div class="panel-body">
			<ul class="list-group" id="share-list">
			  
			</ul>
		  </div>
		</div>
	</div>
	
	<div id="change-news">
		<div class="panel panel-default">
		  <div class="panel-heading" id="body_title">管理动态新闻</div>
		  <div class="panel-body">
			<ul class="list-group" id="news-list">
			  
			</ul>
		  </div>
		</div>
	</div>
	<div id="change-effect-field">
		<div class="panel panel-default">
		  <div class="panel-heading" id="body_title">管理作用域</div>
		  <div class="panel-body">
			<ul class="list-group" id="effect-field-list">
			  
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
	
	<div id="change-key-field">
		<div class="panel panel-default">
		  <div class="panel-heading" id="body_title">管理关键域</div>
		  <div class="panel-body">
			<select class="form-control" id="fetch-effect-field-list">
				
			</select>
			<ul class="list-group" id="key-field-list">
			  
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
	
	<div id="change-key-variable">
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
	
	<div id="target-change">
		<div class="panel panel-default">
		  <div class="panel-heading" id="body_title">修改关键域目标值</div>
		  <div class="panel-body">
			<table id="target-table">
			
			</table>
		  </div>
		</div>
	</div>
	
	<div id="quiz-result-search">
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
			<div class="list-group" id="search-result-list">
			</div>
		  </div>
		</div>
	</div>
	
	<div id="passwd-reset">
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
	
	<div id="check-user-data">
		<div class="panel panel-default">
		  <div class="panel-heading" id="body_title">用户资料查询</div>
		  <div class="panel-body">
			<div class="alert alert-info">
				<ul class="list-group">
				  <li class="list-group-item">
					用户条件：
					<div>
						<select id="select-province">
						  <option value="0">请选择省份</option>
						</select>
						<select id="select-city">
						  <option value="0">请选择城市</option>
						</select>
						<select id="select-department">
						  <option value="0">请选择单位</option>
						</select>
						<select id="select-title">
						  <option value="0">请选择职称</option>
						</select>
						<div style="float:right">
							<button class="btn btn-success btn-sm" id="user-search-btn">搜索</button>
						</div>
					</div>
				  </li>
				</ul>
			</div>
			<ul class="list-group" id="user-info-list">
			  
			</ul>
		  </div>
		</div>
	</div>
	
	<div id="user-info-cover" style="display:none">
		<div id="user-info-bar">
			<div class="alert alert-warning">
			<div class="jumbotron" style="border-radius:10px;margin:0">
			  <h1>详细信息</h1>
			  <table style="width:100%">
			  <tr><td>用户名：<span id="user-info1">123</span></td><td>部门：<span id="user-info2">123</span></td></tr>
			  <tr><td>职务：<span id="user-info3">123</span></td><td>  负责工作：<span id="user-info4">123</span></td></tr>
			  <tr><td>专长：<span id="user-info5">123</span></td><td>  年龄：<span id="user-info6">123</span></td></tr>
			  <tr><td>性别：<span id="user-info7">123</span></td><td>  教育程度：<span id="user-info8">123</span></td></tr>
			  <tr><td>职称：<span id="user-info9">123</span></td><td>  工作时长：<span id="user-info10">123</span></td></tr>
			  <tr><td>电子邮件：<span id="user-info11">123</span></td></tr>
			  </table>
			</div>
			</div>
		</div>
	</div>
	
	
</div>
<?php include './include/footer.php' ?>
</div>
</body>
</html>