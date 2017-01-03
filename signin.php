<?php 
	include 'common/connect.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Sign in &middot; Toronto Tutoring</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>

  <body>
  
  <?php
  
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // came to this page by by pressing the "submit" button
  
  	$stmt = $db->prepare("SELECT * FROM users WHERE user_email = ? && password = ?");
    $stmt->execute( array ($_POST["email"], sha1($_POST["password"]) ) );	
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if ($stmt->rowCount() == 1) {
    	//user found, set session vars and send me to the landing page
 	  	$row = $result[0];
 	  	
 	  	//setting session vars
 	  	$_SESSION["user_id"] = $row["user_id"];
 	  	$_SESSION["user_name"] = $row["user_name"];
 	  	$_SESSION["user_level"] = $row["user_level"];
 	  	$_SESSION["signed_in"] = true;
 	  	
 	  	echo "<script type='text/javascript'>";
    	echo "	window.location = 'calendar.php' ";
  	  echo "</script>";    	
    }
    else {
    	echo "<p><center>* Incorrect Email/Password Combination. Please try again.</p><br><br>";
    }
  } 
  else { 
  	//came here with direct URL
    if ( isset($_SESSION["signed_in"]) ) { 
      //since i'm signed in already, take me to the landing page
      
      echo "<script type='text/javascript'>";
      echo "	window.location = 'index.php' ";
      echo "</script>";
    
    } 
  }
  //not signed in, so let me do so
  echo '<div class="container">';
	echo ' <form class="form-signin" method="post" action="">';
	echo '  <h2 class="form-signin-heading">Please sign in</h2>';
	echo '    <input type="text" name ="email" class="input-block-level" placeholder="Email address">';
 	echo '    <input type="password" name ="password"class="input-block-level" placeholder="Password">';
	echo '  <button class="btn btn-large btn-primary" type="submit">Sign in</button>';
	echo '  </form>';
  echo '</div> <!-- /container -->';
    
  ?>
    
  </body>
</html>;


