<?php
include "common/user_auth_checks.php";
include "common/connect.php";
include "common/exec_info.php";
?>

  
<?php

function go_back ($message) {
		echo '<div class="container">';
		echo '<h3 class="centered"> '.$message.' </h3>';
  	echo '</div> <!-- /container -->';
		echo "<script type='text/javascript'>";
    echo "	function redirect () {window.history.back(-1);} ";
    echo "  setTimeout(redirect, 3000);";
    echo "</script>";
}

//only do stuff if this page is reached by POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	//check for incomplete form
	if ($_POST["date"] == '' || 
			$_POST["student_id"] == 'None' ||
			$_POST["tutor_id"] == 'None' ||
			$_POST["start_hr"] == 'Hr' ||
			$_POST["start_min"] == 'Min' ||
			$_POST["end_hr"] == 'Hr' ||
			$_POST["end_min"] == 'Min' ) {
 		
 		go_back("Missing Information. Taking you back...");
	}
	else {
	
		$end_time = $_POST['end_hr'];
		switch ($_POST['end_min']) {
			case '00':
				$end_time += 0;
				break;
			case 15:
				$end_time += 0.25;
				break;
			case 30:
				$end_time += 0.50;
				break;
			case 45:
				$end_time += 0.75;
				break;
		}
		
		$start_time = $_POST['start_hr'];
		switch ($_POST['start_min']) {
			case '00':
				$start_time += 0;
				break;
			case 15:
				$start_time += 0.25;
				break;
			case 30:
				$start_time += 0.50;
				break;
			case 45:
				$start_time += 0.75;
				break;
		}
		
		$num_hours = $end_time - $start_time;
		
		if ($num_hours <= 0) {
			go_back("Wrong Time Interval<br>You can't go back in time!<br>Taking you back...");
		}
		else {
			//insert validated info into db
			
			$stmt = $db->prepare("INSERT INTO sessions(session_date,student_id,tutor_id,num_hours,start_hr,start_min,end_hr,end_min,notes,completed_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		
			try {
	  		$stmt->execute(array(	$_POST["date"],
	  													$_POST["student_id"],
	  													$_POST["tutor_id"],
	  													$num_hours,
	  													$_POST["start_hr"],
	  													$_POST["start_min"],
	  													$_POST["end_hr"],
	  													$_POST["end_min"],
	  													$_POST["notes"],
	  													$_POST["completed_status"] ) );
  		} catch (PDOException $ex) {
    		go_back("SQL Error - Please try again later, or if the problem persists, contact Admin.");
    		return;
    	}	
    
    
  		//confirmation statement and redirect back to Log Session option
  		echo '<div class="container">';
			echo '<h3 class="centered"> Successfully Added! Taking you back...</h3>';
  		echo '</div> <!-- /container -->';
			echo "<script type='text/javascript'>";
    	echo "	function redirect () {window.location = 'log_session.php';} ";
    	echo "  setTimeout(redirect, 3000);";
    	echo "</script>";
    	
    }//check for correct time interval
	} //check for form completion
} //'post' check

?>