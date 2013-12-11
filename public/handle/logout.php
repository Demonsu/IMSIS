<?php
	if (isset($_SESSION["USERID"]))
	{
		session_destroy();
		header("Location: ../login.php");
	}


?>