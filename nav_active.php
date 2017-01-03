<?php
	echo '<li ';
	if (basename($_SERVER['PHP_SELF']) == "index.php") {
		echo 'class="active"';
	}
	echo '><a href="index.php">Home</a></li>';
	
	echo '<li ';
	if (basename($_SERVER['PHP_SELF']) == "about.php") {
		echo 'class="active"';
	}
	echo '><a href="about.php">About</a></li>';
	
	echo '<li ';
	if (basename($_SERVER['PHP_SELF']) == "contact.php") {
		echo 'class="active"';
	}
	echo '><a href="contact.php">Contact</a></li>';
?>