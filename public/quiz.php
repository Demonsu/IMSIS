<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	include_once '../sys/core/init.inc.php';

	//echo $result;
	$quiz_id = $_GET['quiz_id'];

?>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8">
	<title>问卷</title>
	

	<link rel="stylesheet" href="./assets/dist/css/bootstrap.css">
	<script style="text/javascript" src="./assets/js/jquery.js"></script>
	<script style="text/javascript" src="./assets/dist/js/bootstrap.min.js"></script>
	<script style="text/javascript" src="./assets/js/quiz.js"></script>
	<link rel="stylesheet" href="./assets/css/quiz.css">
	<link rel="stylesheet" href="./assets/css/body.css">
</head>
<style>
a .over-doing:hover{
	background-color:#f0ad4e;
}
</style>
<body>
<div class="main">
<input type="text" style="display:none" id="quiz_id" value="<?php echo $quiz_id; ?>" />
<?php include 'include/header.php'; ?>

<div class="row">
	<div class="col-md-1"></div>
	<div class="col-md-10">
		<div class="progress progress-striped active">
		  <div class="progress-bar progress-bar-success" role="progressbar" id="progressBar" style="width: 20%">
			<span class="sr-only"></span>
		  </div>
		</div>
	</div>
	<div class="col-md-1"></div>
</div>
<div class="row">
	<div class="col-md-2"></div>
	<label class="form control col-md-6">第一步:填写问卷</label>
	<!--<label class="form control col-md-3">第二步:设定目标值</label>-->
	<label class="form control col-md-2">第二步:预览并提交</label>
	<div class="col-md-2"></div>
</div>

<div class="row" id="second" style="display:none">
	<div class="panel panel-default">
	  <div class="panel-heading">
		<h3 class="panel-title">请指定您的关键域目标值（已给出默认值）</h3>
	  </div>
	  <div class="panel-body">
		<div class="form-group">
			<div class="list-group" id="target_select">
			  
			</div>
			<div class="text-right row">
				<div class="col-md-12">
					<button class="btn btn-primary" id="confirm-target">确定</button>
				</div>
			</div>
		</div>
	  </div>
	</div>
</div>
<div class="group" id="third" class="display:none">
	<div class="panel panel-default">
	  <div class="panel-heading">
		<h3 class="panel-title">预览结果</h3>
	  </div>
	  <div class="panel-body">
		<div class="form-group">
			<div class="list-group" id="preview-quiz">
			  
			</div>
			<div class="text-right row">
				<div class="col-md-12">
					<button class="btn btn-primary" id="submit-quiz">提交</button>
				</div>
			</div>
		</div>
	  </div>
	</div>
</div>

<div class="row" id="first" style="display:none">
	<div class="col-md-3">
		<div class="panel panel-default">
		  <div class="panel-heading">
			<h3 class="panel-title">问卷进度 <span> 已答:<label id="answered-quiz">7/10</label></span></h3>
		  </div>
		  <div class="panel-body" id="quiz-progress">
			<div class="list-group">
			  <a class="list-group-item active">作用域1</a>
			  <a href="#" class="list-group-item text-center over-done">关键域1</a>
			  <a href="javascript:get_key_field(this)" class="list-group-item text-center over-doing" id="21">关键域2</a>
			  <a href="#" class="list-group-item text-center">关键域3</a>
			  <a href="#" class="list-group-item text-center">关键域4</a>
			</div>
			<div class="list-group">
			  <a href="#" class="list-group-item">Dapibus ac facilisis in</a>
			  <a href="#" class="list-group-item">Morbi leo risus</a>
			  <a href="#" class="list-group-item">Porta ac consectetur ac</a>
			  <a href="#" class="list-group-item">Vestibulum at eros</a>
			</div>
			<div class="list-group">
			  <a href="#" class="list-group-item">Dapibus ac facilisis in</a>
			  <a href="#" class="list-group-item">Morbi leo risus</a>
			  <a href="#" class="list-group-item">Porta ac consectetur ac</a>
			  <a href="#" class="list-group-item">Vestibulum at eros</a>
			</div>
			
		  </div>
		</div>
	</div>
	<div class="col-md-9">
		<div class="panel panel-default">
		  <div class="panel-heading">
			<h3 class="panel-title">答题<a href="#" id="return-top"></a></h3>
		  </div>
		  <div class="panel-body">
			<div class="form-group">
				<div class="list-group" id="quiz-answer">
				  
				</div>
				<div class="text-right row">
					<div class="col-md-12">
						<button class="btn btn-primary" id="next-key-field">保存并继续</button>
					</div>
				</div>
			</div>
		  </div>
		</div>
	</div>
</div>



<?php include 'include/footer.php'; ?>

</div>

</div>
</body>
</html>