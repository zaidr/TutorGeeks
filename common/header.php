<?php 
session_start(); 
date_default_timezone_set('America/New_York');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?php include 'title.php'; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      
      /* Featurettes
    ------------------------- */

    .featurette-divider {
      margin: 80px 0; /* Space out the Bootstrap <hr> more */
    }
    .featurette {
      padding-top: 120px; /* Vertically center images part 1: add padding above and below text. */
      padding-left: 0px;
      overflow: hidden; /* Vertically center images part 2: clear their floats. */
    }
    .featurette-image {
      margin-top: -120px; /* Vertically center images part 3: negative margin up the image the same amount of the padding to center it. */
    }

    /* Give some space on the sides of the floated elements so text doesn't run right into it. */
    .featurette-image.pull-left {
      margin-right: 40px;
    }
    .featurette-image.pull-right {
      margin-left: 40px;
    }

    /* Thin out the marketing headings */
    .featurette-heading {
      font-size: 50px;
      font-weight: 300;
      line-height: 1;
      letter-spacing: -1px;
    }
    
    </style>		
  </head>
  <body>

	<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="brand" href="index.php">Tutor Geeks</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <?php include 'nav_active.php'?>
            </ul>
          </div><!--/.nav-collapse -->
          
          <!-- Signing in here -->
          <div class="nav-collapse collapse pull-right"> 
          	<ul class="nav">
          	
          	<!-- Code for putting up signed in status on top right of page header -->
          	<?php
          		//put the "Sign In" text on the top right, or the user's name if already signed in
          		if (isset($_SESSION["signed_in"])) {
          			/*
          			signed_in session var assigned, so user is signed in. Assume at time of sign-in,
          			we will have $_SESSION filled with all user info (or at least the user_id)
          			*/
          			foreach($db->query("SELECT user_name FROM users WHERE user_id =". $_SESSION["user_id"]) as $row) {
    							echo '<li><a href="calendar.php">' . $row['user_name'] . '</a></li>';
								}
          			echo '<li><a href="logout.php"> Log Out </a></li>';
          		}
          		else {
          			echo '<li><a href="signin.php"> Sign In </a></li>';
          		}
          	?>
          	<!-- /signed in status -->
          	</ul>
          </div>
          
        </div>
      </div>
    </div> 