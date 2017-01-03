<?php
include "common/user_auth_checks.php";
include "common/connect.php";
include "common/exec_info.php";
?>

  
<?php
//only do stuff if this page is reached by POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	//check for incomplete form
	if ($_POST["name"] == '' 			||
			$_POST["email"] == '' 		||
			$_POST["password"] == '' ) {
 		
 		echo '<div class="container">';
		echo '<h3 class="centered"> Missing Info. Please fill in completely. Taking you back...</h3>';
  	echo '</div> <!-- /container -->';
		echo "<script type='text/javascript'>";
    echo "	function redirect () {window.history.back(-1);} ";
    echo "  setTimeout(redirect, 3000);";
    echo "</script>";
	}
	else {
		
		$stmt = $db->prepare("INSERT INTO users(user_name,user_email,user_level,password,phone_num,address,active) VALUES (?, ?, ?, ?, ?, ?, ?)");
	
		//prepare the user_level variable for insertion into DB
		switch ($_POST["user_level"]) {
			case "Client":
				$user_level = CLIENT;
				break;
			case "Tutor":
				$user_level = TUTOR;
				break;
			case "Admin":
				$user_level = ADMIN;
				break;
		}
		
		//encrypt the password for insertion into DB
		$password = sha1($_POST["password"]);
		
		//convert to Y/N for active status
		if ($_POST["active_status"] == 'Active') { $status = 'Y';}
		else { $status = 'N';}
		
		try {
	  	$stmt->execute(array(	$_POST["name"],
  													$_POST["email"],
  													$user_level,
  													$password,
  													$_POST["phone_number"],
  													$_POST["address"],
  													$status ) );
  	} catch (PDOException $ex) {
    	echo "An Error occured!";
    }
    
  	//confirmation statement and redirect back to Add User option
  	echo '<div class="container">';
		echo '<h3 class="centered"> Successfully Added! Taking you back...</h3>';
  	echo '</div> <!-- /container -->';
		echo "<script type='text/javascript'>";
    echo "	function redirect () {window.location = 'add_user.php';} ";
    echo "  setTimeout(redirect, 3000);";
    echo "</script>";
    
	} //check for form completion
} //'post' check

?>