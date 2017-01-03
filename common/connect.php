<?php  
//connect.php  

$username   = 'zaid';  
$password   = 'sohel11'; 
//$server = '127.0.0.1';
//$database   = 'tutoring';  

$db = new PDO('mysql:host=127.0.0.1;dbname=tutoring;charset=utf8', $username, $password);

session_start();


//returns a list of students that are tied to the specific user
//function get_students ($user_id, $user_level) {
//	global $db;
//	 
//	$stmt = $db->query('SELECT student_id FROM students_to_tutors WHERE tutor_id = '.$user_id);
//	return $stmt->fetchAll(PDO::FETCH_ASSOC);
//}


?>