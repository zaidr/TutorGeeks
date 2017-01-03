<?php
include "common/user_auth_checks.php";
include "common/connect.php";
include "common/exec_info.php";
?>

  
<?php
//only do stuff if this page is reached by POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	//check for incomplete form
	if ($_POST["subject"] == '' ||
			$_POST["student_id"] == 0 ||
			$_POST["tutor_id"] == 0		) {
			
 		echo '<div class="container">';
		echo '<h3 class="centered"> Missing Info. Please fill in completely. Taking you back...</h3>';
  	echo '</div> <!-- /container -->';
		echo "<script type='text/javascript'>";
    echo "	function redirect () {window.history.back(-1);} ";
    echo "  setTimeout(redirect, 3000);";
    echo "</script>";
	}
	else {
		
		$stmt = $db->prepare("INSERT INTO students_to_tutors(student_id,tutor_id,subject) VALUES (?, ?, ?)");
		
		
		try {
	  	$stmt->execute(array(	$_POST["student_id"],$_POST["tutor_id"],$_POST["subject"] ) );
  	} catch (PDOException $ex) {
    	echo "An Error occured!";
    }
    
  	//confirmation statement and redirect back to Add User option
  	echo '<div class="container">';
		echo '<h3 class="centered"> Successfully Added! Taking you back...</h3>';
  	echo '</div> <!-- /container -->';
		echo "<script type='text/javascript'>";
    echo "	function redirect () {window.location = 'assign_students_to_tutor.php';} ";
    echo "  setTimeout(redirect, 3000);";
    echo "</script>";
    
	} //check for form completion
} //'post' check

?>