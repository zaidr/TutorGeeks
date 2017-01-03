<?php
include '../common/connect.php';
include '../common/user_auth_checks.php';

//redirect user not logged in
check_for_signin ();
//redirect non-admin user
check_for_client_or_admin ();
//redirect unauthorized client from viewing invoice
check_for_authorized_client ($_GET["student_id"]);

date_default_timezone_set('America/New_York');

//rate and total hours to be calculated when needed
$rate = 0;
$total_hours = 0;

//returns the name of the student identified with $student_id parameter
function get_student_name($student_id) {
	global $db;
	$name = "";
	
	foreach($db->query('SELECT student_name FROM students WHERE student_id ='.$student_id) as $row) {
    $name .= $row['student_name'];
	}
	
	return $name;
}


//returns the name of the client associated with the student identified with $student_id
function get_client_name($student_id) {
	global $db;
	$name = "";
	
	foreach($db->query('SELECT parent_id FROM students WHERE student_id ='.$student_id) as $row) {
    foreach($db->query('SELECT user_name FROM users WHERE user_id ='.$row['parent_id']) as $row2) {
    	$name .= $row2['user_name'];
		}
	}
	
	return $name;
}

//sets variable $rate to current student's rate, and returns rate
function get_rate ($student_id) {
	global $db;
	global $rate;
	
	foreach($db->query('SELECT rate FROM students WHERE student_id ='.$student_id) as $row) {
    $rate = $row['rate'];
	}
	
	return $rate;
}

//sets variable $total_hours to current students total montly session hours, and returns hours
function get_total_hours ($student_id, $month, $year) {
	global $db;
	global $total_hours;

	//calculate dates for start and end of month
	$start_date = $year.'-'.$month.'-01';
	$end_date = $year.'-'.$month.'-'.date('t', mktime(0,0,0,$month,1,$year) ) ;
	
	foreach($db->query('SELECT num_hours FROM sessions WHERE student_id ="'. $student_id .'" AND session_date BETWEEN "'. $start_date .'" AND "'. $end_date.'"' ) as $row) {
		$total_hours += $row['num_hours'];
	}
	
	return $total_hours;
}

//returns itemized sessions for particular student in a specific month
function get_sessions ($student_id, $month, $year) {
	global $db;
	
	//calculate dates for start and end of month
	$start_date = $year.'-'.$month.'-01';
	$end_date = $year.'-'.$month.'-'.date('t', mktime(0,0,0,$month,1,$year) ) ;
	
	$sessions_table = "";
	
	
	foreach($db->query('SELECT * FROM sessions WHERE student_id ="'. $student_id .'" AND session_date BETWEEN "'. $start_date .'" AND "'. $end_date.'"' ) as $row) {
		
		$sessions_table .= "<tr>";
		
		//date for session
		$date = date_create($row["session_date"]);
		$sessions_table .= "<td>". date_format($date, "jS F Y") ."</td>";
		
		//time of session
		$sessions_table .= "<td>". format_time($row["start_hr"], $row["start_min"], $row["end_hr"], $row["end_min"]) ."</td>";
		
		//subject of session
		foreach($db->query('SELECT subject FROM students_to_tutors WHERE student_id = "'.$student_id.'" AND tutor_id = "'.$row["tutor_id"].'"' ) as $result) {
			$sessions_table .= "<td>". $result["subject"] ."</td>";
		}
		
		//time duration of session
		$sessions_table .= "<td>". $row["num_hours"] ."</td>";
		
		//<td>December 1, 2012</td><td>4:00PM - 5:00PM</td><td>Math</td><td>1</td>
		
		$sessions_table .= "</tr>";
	}
	
	return $sessions_table;
}

function format_time ($start_hr, $start_min, $end_hr, $end_min) {
	if (strlen($start_hr) == 1)
		$start_hr = "0".$start_hr;
	
	if (strlen($end_hr) == 1)
		$end_hr = "0".$end_hr;
	
	if (strlen($start_min) == 1)
		$start_min = "0".$start_min;
		
	if (strlen($end_min) == 1)
		$end_min = "0".$end_min;
	
	return $start_hr .":". $start_min ." - ". $end_hr .":". $end_min;
}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="stylesheet" type="text/css" href="invoice_style.css">
	</head>
	<body>
	<div id="container">
		
		<div id="title"><img src="tutorgeeks_invoice_header.gif" alt="Tutor Geeks : Invoice" width="600" height="200"></div>
		
		<div id="month"> <?php echo date('F', mktime(0,0,0,$_GET['month'],1,$_GET['year']) ); ?> </div>
		
		<div id="name">
			<table>
				<tr>
					<th>Client: </th> <td><?php echo get_client_name($_GET["student_id"]); ?></td>
				</tr>
				<tr>
					<th>Student: </th><td><?php echo get_student_name($_GET["student_id"]); ?></td>
				</tr>
			</table>
		</div>
		
		<div id="price">
			<table>
				<tr>
					<th>Time: </th> <td> <?php echo get_total_hours ($_GET["student_id"],$_GET['month'],$_GET['year']) ." Hrs"; ?> </td>
				</tr>
				<tr>
					<th>Rate: </th><td><?php echo get_rate($_GET["student_id"]) ." /Hr"; ?></td>
				</tr>
				<tr>
					<th>Total: </th><td> $ <?php echo $rate * $total_hours; ?></td>
				</tr>
			</table>
		</div>
		
		<div id="itemized">
			<table>
				<tr>
					<th>Date</th><th>Time</th><th>Subject</th><th>Hours</th>
				</tr>
			
				
				<?php
					echo get_sessions($_GET["student_id"],$_GET['month'],$_GET['year']);
				?>
				
				
				<!--
				<tr>
					<td>December 1, 2012</td><td>4:00PM - 5:00PM</td><td>Math</td><td>1</td>
				</tr>
					<td>December 10, 2012</td><td>4:00PM - 5:00PM</td><td>Math</td><td>1</td>
				</tr>
					<td>December 11, 2012</td><td>4:00PM - 5:00PM</td><td>Math</td><td>1</td>
				</tr>
					<td>December 21, 2012</td><td>4:00PM - 5:00PM</td><td>Math</td><td>1</td>
				</tr>
				-->
			
			</table>
		</div>
		
	</div> <!-- Container -->
	<body>
</html>