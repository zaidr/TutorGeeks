<?php
//user_auth_checks.php
//shared login auth checks for all pages

require_once "user_level_def.php";
require_once "connect.php";

function check_for_signin() {
	if ( !isset($_SESSION["signed_in"]) ) {
		header ('Location: index.php');
	}
}

function check_for_admin() {
	if ( $_SESSION["user_level"] != ADMIN ) {
		header ('Location: index.php');
	}
}

function check_for_client_or_admin () {
	if ( $_SESSION["user_level"] != ADMIN && $_SESSION["user_level"] != CLIENT ) {
		header ('Location: index.php');
	}
}

//admin are tutors by default
function check_for_tutor() {
	if ( $_SESSION["user_level"] != ADMIN && $_SESSION["user_level"] != TUTOR) {
		header ('Location: index.php');
	}
}

function check_for_authorized_client ($student_id) {
	global $db;
	$authorized_user = false;
	
	if ($_SESSION["user_level"] == CLIENT) {
		
		foreach($db->query('SELECT student_id FROM students WHERE parent_id ="'.$_SESSION["user_id"]."'") as $row) {
			if ($student_id == $row["student_id"])
				$authorized_user = true;
		}
		
		if (!$authorized_user) {
			header ('Location: index.php');
		}
	}
}

?>