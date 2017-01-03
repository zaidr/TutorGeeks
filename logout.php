<?php 
	//logout.php will destroy the current session and send you back to the homepage (index.php)
	session_start();
	session_destroy();
	header("Location: index.php");
?>