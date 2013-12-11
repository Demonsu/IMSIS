<style>
.dsawdasdaw:hover{
	cursor:pointer;
}
</style>
<div class="row">
	<div class="page-header">
		<div class="alert alert-success text-center dsawdasdaw" >
			<h2 class="text-center"  onclick="window.location='user_zone.php';"><strong>电子政务服务能力成熟度在线评估系统<strong><br><small>eGov-CMM</small></h2>
			<?php
				if (isset($_SESSION['USERID']))
					echo '<h4 class="text-right" >'.$_SESSION['USERID'].' <span class="label label-danger" onclick="window.location='.'\''.'./handle/logout.php'.'\''.'">退出</span></h4>';
				else
					echo '<h4 class="text-right"> <span class="label label-success" onclick="window.location='.'\''.'login.php'.'\''.'">登录</span></h4>';
					
			?>
			
		</div>
		
	</div>
</div>
