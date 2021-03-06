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
	<script style="text/javascript" src="./assets/js/d_quiz.js"></script>
	<link rel="stylesheet" href="./assets/css/d_quiz.css">
	<link rel="stylesheet" href="./assets/css/body.css">
</head>
<body>
<div class="main">
<input type="text" style="display:none" id="quiz_id" value="<?php echo $quiz_id; ?>" />
<?php include 'include/header.php'; ?>

<div class="row">
	<div class="col-md-1"></div>
	<div class="col-md-10">
		<div class="progress progress-striped active">
		  <div class="progress-bar progress-bar-success" role="progressbar" id="progressBar" style="width: 10%">
			<span class="sr-only"></span>
		  </div>
		</div>
	</div>
	<div class="col-md-1"></div>
</div>
<div class="row">
	<div class="col-md-1"></div>
	<label class="form control col-md-2">第一步:阅读承诺书</label>
	<label class="form control col-md-3">第二步:选择关键域</label>
	<label class="form control col-md-3">第三步:填写问卷</label>
	<!--<label class="form control col-md-2"></label>-->
	<label class="form control col-md-2">第四步:预览并提交</label>
	<div class="col-md-1"></div>
</div>

<div class="group" id="fourth" style="display:none">
	<div class="panel panel-default">
	  <div class="panel-heading">
		<h3 class="panel-title">请指定您的关键域目标值（已给出默认值）</h3>
	  </div>
	  <div class="panel-body">
		<div class="form-group">
			<div class="list-group" id="target_select">
			  
			</div>
			<div class="row">
				<div class="col-md-12 text-right">
				<button class="btn btn-primary" id="confirm-target">确认</button>
				</div>
			</div>
		</div>
	  </div>
	</div>
	
</div>

<div class="group" id="fifth" style="display:none">
	<div class="panel panel-default">
	  <div class="panel-heading">
		<h3 class="panel-title">预览结果并提交答案</h3>
	  </div>
	  <div class="panel-body" id="preview">
		
	  </div>
	  <div class="form-group">
		<div class="col-md-12 text-right">
		<button class="btn btn-primary" id="submit-result">提交</button>
		</div>
	  </div>
	</div>
</div>

<div class="group" id="second" style="display:none">
	<div class="panel panel-default">
	  <div class="panel-heading">
		<h3 class="panel-title">选择你想要测评的域然后创建</h3>
	  </div>
	  <div class="panel-body">
		<div class="group" >
            <div class="col-md-12">
                <div class="list-group" id="field-select">
                    
                </div>
            </div>
			<div class="row">
				<div class="col-md-12 text-center">
					<button class="btn btn-primary" id="d_confirm">确认</button>
				</div>
			</div>
		</div>
	  </div>
	</div>
</div>

<div class="group" id="first">
	<div class="panel panel-default">
	  <div class="panel-heading">
		<h3 class="panel-title">请仔细阅读承诺书
		</h3>
	  </div>
	  <div class="panel-body">
	  
		<div class="group">
			<p>测评须知：</p>
				<p>您好！您正在使用电子政务服务管理能力测评系统，问卷中您所填写的信息和数据仅作为电子政务服务能力测评及学术研究之用，绝不会泄露或做其他用途，请放心如实填写。<br>
				请在填写过程中如实填写，这样您才能得到相对真实的测评结果和中肯的测评建议。</p>
			<div class="row">
				<div class="col-md-12 text-center">
					<button class="btn btn-warning" id="readit">我已经仔细阅读说明并同意相关内容</button>
				</div>
			</div>
		</div>
	  </div>
	</div>
</div>

<div class="row" id="third" style="display:none">
	<div class="col-md-3">
		<div class="panel panel-default">
		  <div class="panel-heading">
			<h3 class="panel-title">问卷进度</h3>
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
					<label ><input type="radio" name="radio11" value="0">
					0.Dapibus ac facilisis in</label><br>
					<label ><input type="radio" name="radio11" id="id11" value="1">
					1.组织是否意识到eGov战略的重要性（在管理层展开讨论）？</label><br>
					<label ><input type="radio" name="radio11" value="2">
					Dapibus ac facilisis in</label><br>
					<label ><input type="radio" name="radio11" value="3">
					Dapibus ac facilisis in</label><br>
					<label ><input type="radio" name="radio11" value="4">
					Dapibus ac facilisis in</label><br>
					<label ><input type="radio" name="radio11" value="5">
					Dapibus ac facilisis in</label><br>
				  </a>
				  <a class="list-group-item">Morbi leo risus</a>
				  <a class="list-group-item">Porta ac consectetur ac</a>
				  <a class="list-group-item">Vestibulum at eros</a>
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