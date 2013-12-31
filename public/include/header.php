<style>
.dsawdasdaw:hover{
	cursor:pointer;
}
#loading-cover{
	display:none;
	position:fixed;
	width:100%;
	height:100%;
	top:0px;
	left:0px;
	background:rgba(225,225,225,0.5);
	z-index:1001;
}
.loading-bar{
	position:fixed;
	width:600px;
	top:50%;
	left:50%;
	margin-left:-300px;
}
.progress{
	margin-bottom:0px;
}
</style>
<div class="group" style="margin-top:20px">
	<div class="alert alert-info text-center dsawdasdaw" >
		<h1 class="text-center"  onclick="window.location='login.php';"><strong>电子政务服务能力成熟度在线评估系统<strong><br><small>eGov-CMM</small></h1>
		<?php
			if (isset($_SESSION['USERID'])){
				if ($_SESSION["USERID"]!="admin")
					echo '<h4 class="text-right" style="color:#000000">你好 <a href="user_zone.php?navigation=7" style="color:#000000" title="点击进入个人中心">'.$_SESSION['USERID'].'</a> ';
				else
					echo '<h4 class="text-right" style="color:#000000">你好 <a href="admin_zone.php?navigation=7" style="color:#000000" title="点击进入管理员页面">'.$_SESSION['USERID'].'</a> ';
				echo ' <span class="label label-warning" onclick="window.location=\'./handle/logout.php\'">退出</span></h4>';
			}
		?>
		
	</div>
</div>
<div id="loading-cover">
	<div class="alert alert-warning loading-bar">
		<div class="progress progress-striped active">
		  <div class="progress-bar progress-bar-success" id="loading-rate" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
			<span>正在载入...</span>
		  </div>
		</div>
	</div>
</div>