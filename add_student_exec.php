<?php
include "common/user_auth_checks.php";
include "common/connect.php";
include "common/exec_info.php";
?>

  
<?php
//only do stuff if this page is reached by POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	//check for incomplete form
	if ($_POST["student_name"] == '' || $_POST["parent_id"] == 0 || $_POST["rate"] == '') {
 		
 		echo '<div class="container">';
		echo '<h3 class="centered"> Missing Info. Please fill in completely. Taking you back...</h3>';
  	echo '</div> <!-- /container -->';
		echo "<script type='text/javascript'>";
    echo "	function redirect () {window.history.back(-1);} ";
    echo "  setTimeout(redirect, 3000);";
    echo "</script>";
	}
	elseif ( !is_numeric($_POST["rate"]) ) {
		echo '<div class="container">';
		echo '<h3 class="centered"> Rate must be a number! Taking you back...</h3>';
  	echo '</div> <!-- /container -->';
		echo "<script type='text/javascript'>";
    echo "	function redirect () {window.history.back(-1);} ";
    echo "  setTimeout(redirect, 3000);";
    echo "</script>";
	}
	else {
		
		$stmt = $db->prepare("INSERT INTO students(student_name,parent_id,active_status,rate) VALUES (?, ?, ?, ?)");
		
		$error = false;
		try {
	  	$stmt->execute(array(	$_POST["student_name"],$_POST["parent_id"],$_POST["active_status"],$_POST["rate"] ) );
  	} catch (PDOException $ex) {
    	echo "An Error occured!";
    	$error = true;
    }
    
    if (!$error) {
  	//confirmation statement and redirect back to Add Student option
  	echo '<div class="container">';
		echo '<h3 class="centered"> Successfully Added! Taking you back...</h3>';
  	echo '</div> <!-- /container -->';
		echo "<script type='text/javascript'>";
    echo "	function redirect () {window.location = 'add_student.php';} ";
    echo "  setTimeout(redirect, 3000);";
    echo "</script>";
    }
	} //check for form completion
} //'post' check

?>