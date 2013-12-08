<?php
	include_once '../sys/core/init.inc.php';

	//echo $result;
	$quiz_id = $_GET['quiz_id'];

?>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8">
	<title>问卷</title>
	<link rel="stylesheet" href="./assets/css/body.css">

	<link rel="stylesheet" href="./assets/dist/css/bootstrap.min.css">
	<script style="text/javascript" src="./assets/js/jquery.js"></script>
	<script style="text/javascript" src="./assets/dist/js/bootstrap.min.js"></script>
	<script style="text/javascript" src="./assets/js/d_quiz.js"></script>
	<link rel="stylesheet" href="./assets/css/d_quiz.css">
</head>
<body>
<div class="main">
<input type="text" style="display:none" id="quiz_id" value="<?php echo $quiz_id; ?>" />
<?php include 'include/header.php'; ?>

<div class="row">
	<!-- Nav tabs -->
	<ul class="nav nav-tabs">
	  <li><a href="#home" data-toggle="tab">Home</a></li>
	  <li><a href="#profile" data-toggle="tab">Profile</a></li>
	  <li><a href="#messages" data-toggle="tab">Messages</a></li>
	  <li><a href="#settings" data-toggle="tab">Settings</a></li>
	</ul>

	<!-- Tab panes -->
	<div class="tab-content">
	  <div class="tab-pane active" id="home">1</div>
	  <div class="tab-pane" id="profile">2</div>
	  <div class="tab-pane" id="messages">3</div>
	  <div class="tab-pane" id="settings">4</div>
	</div>
</div>

<?php include 'include/footer.php'; ?>

</div>

</div>
</body>
</html>