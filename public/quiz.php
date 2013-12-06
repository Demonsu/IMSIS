<?php
	include_once '../sys/core/init.inc.php';

	//echo $result;
	$quiz_id = $_GET['quiz_id']

?>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8">
	<title>问卷</title>
	<link rel="stylesheet" href="./assets/css/body.css">

	<link rel="stylesheet" href="./assets/dist/css/bootstrap.min.css">
	<script style="text/javascript" src="./assets/js/jquery.js"></script>
	<script style="text/javascript" src="./assets/dist/js/bootstrap.min.js"></script>
	<script style="text/javascript" src="./assets/js/quiz.js"></script>
	<link rel="stylesheet" href="./assets/css/quiz.css">
</head>
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
	<label class="form control col-md-3">第一步:填写问卷</label>
	<label class="form control col-md-3">第二步:设定目标值</label>
	<label class="form control col-md-2">第三步:预览并提交</label>
	<div class="col-md-2"></div>
</div>



<div class="row" id="first">
	<div class="col-md-3">
		<div class="panel panel-default">
		  <div class="panel-heading">
			<h3 class="panel-title">问卷进度</h3>
		  </div>
		  <div class="panel-body" id="quiz-progress">
			<div class="list-group">
			  <a class="list-group-item active">作用域1</a>
			  <a href="#" class="list-group-item text-center over-done">关键域1</a>
			  <a href="#" class="list-group-item text-center over-doing">关键域2</a>
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
			<h3 class="panel-title">答题</h3>
		  </div>
		  <div class="panel-body">
			<div class="form-group">
				<div class="list-group" id="quiz-answer">
				  <a class="list-group-item active">
					关键域:1.1 中长期规划（战略规划，Strategy Planning）
				  </a>
				  <a class="list-group-item">
			        <p class="">关键变量：中长期规划（E：电子政务战略（eGov Strategy）eGov战略及应用的长期计划。）</p>
					<label ><input type="radio" name="radio11" id="id11" value="option11">
					0.Dapibus ac facilisis in</label><br>
					<label ><input type="radio" name="radio11" id="id11" value="option11">
					1.组织是否意识到eGov战略的重要性（在管理层展开讨论）？</label><br>
					<label ><input type="radio" name="radio11" id="id11" value="option11">
					Dapibus ac facilisis in</label><br>
					<label ><input type="radio" name="radio11" id="id11" value="option11">
					Dapibus ac facilisis in</label><br>
					<label ><input type="radio" name="radio11" id="id11" value="option11">
					Dapibus ac facilisis in</label><br>
					<label ><input type="radio" name="radio11" id="id11" value="option11">
					Dapibus ac facilisis in</label><br>
				  </a>
				  <a class="list-group-item">Morbi leo risus</a>
				  <a class="list-group-item">Porta ac consectetur ac</a>
				  <a class="list-group-item">Vestibulum at eros</a>
				</div>
				<div class="text-right row">
					<div class="col-md-12">
						<button class="btn btn-success">下一个关键域</div>
					</div>
				</div>
			</div>
		  </div>
		</div>
	</div>
</div>

<div class="row" id="second">
	
</div>

<div class="row" id="third">

</div>

</div>

</div>
</body>
</html>