    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span3">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">Navigation</li>
              <?php
              
              	//=== calendar.php link (on all pages, regardless of user level) 
              	echo "<li ";
              	if (basename($_SERVER['PHP_SELF']) == "calendar.php") {
              		echo "class='active'";
              	}
              	echo "><a href='calendar.php'>Calendar</a></li>";
              	
              	//=== student_profiles.php link (on all pages, regardless of user level) 
              	echo "<li ";
              	if (basename($_SERVER['PHP_SELF']) == "student_profiles.php") {
              		echo "class='active'";
              	}
              	echo "><a href='student_profiles.php'>Student Profiles</a></li>";
              	
              	//========= client and admin nav elements =========//
              	if ($_SESSION["user_level"] == 2 || $_SESSION["user_level"] == 0) {
              	
              		echo "<li ";
              		if (basename($_SERVER['PHP_SELF']) == "tutor_profiles.php") {
              			echo "class='active'";
              		}
              		echo "><a href='tutor_profiles.php'>Tutor Profiles</a></li>";
              		
              		echo "<li ";
              		if (basename($_SERVER['PHP_SELF']) == "view_invoices.php") {
              			echo "class='active'";
              		}
              		echo "><a href='view_invoices.php'>Monthly Invoices</a></li>";
              		
              	}
              	
              	//========= tutor and admin nav elements =========//
              	if ($_SESSION["user_level"] == 1 || $_SESSION["user_level"] == 0) {
              		
              		echo "<li ";
              		if (basename($_SERVER['PHP_SELF']) == "view_sessions.php") {
              			echo "class='active'";
              		}
              		echo "><a href='view_sessions.php'>Search Sessions</a></li>";
              		
              		echo "<li ";
              		if (basename($_SERVER['PHP_SELF']) == "log_session.php") {
              			echo "class='active'";
              		}
              		echo "><a href='log_session.php'>Log Session</a></li>";
              		
              	}
              	
              	//========= admin only nav elements =========//
              	if ($_SESSION["user_level"] == 0) {
              		
              		echo "<li class='nav-header'>Admin Options</li>";
              		
              		//Show all users (client, tutor, or admin)
              		echo "<li ";
              		if (basename($_SERVER['PHP_SELF']) == "all_users.php") {
              			echo "class='active'";
              		}
              		echo "><a href='all_users.php'>Show All Users</a></li>";
              		
              		//add user (client, tutor, or admin)
              		echo "<li ";
              		if (basename($_SERVER['PHP_SELF']) == "add_user.php") {
              			echo "class='active'";
              		}
              		echo "><a href='add_user.php'>Add User</a></li>";
              		
              		//add student (which must be tied to a client)
              		echo "<li ";
              		if (basename($_SERVER['PHP_SELF']) == "add_student.php") {
              			echo "class='active'";
              		}
              		echo "><a href='add_student.php'>Add Student</a></li>";
              		
              		//assign student to tutor
              		echo "<li ";
              		if (basename($_SERVER['PHP_SELF']) == "assign_student_to_tutor.php") {
              			echo "class='active'";
              		}
              		echo "><a href='assign_student_to_tutor.php'>Assign Student to Tutor</a></li>";
              		
              		//billable hours (per specified interval)
              		echo "<li ";
              		if (basename($_SERVER['PHP_SELF']) == "billable_hours.php") {
              			echo "class='active'";
              		}
              		echo "><a href='billable_hours.php'>Billable Hours</a></li>";
              		
              		//view hours billable to client
              		echo "<li ";
              		if (basename($_SERVER['PHP_SELF']) == "hours_per_client.php") {
              			echo "class='active'";
              		}
              		echo "><a href='hours_per_client.php'>Hours Per Client</a></li>";
              		
              	}
              	
              	//========= user options (for all) nav elements =========//
              	echo "<li class='nav-header'>User Options</li>";
              	echo "<li ";
              	if (basename($_SERVER['PHP_SELF']) == "edit_personal_info.php") {
              		echo "class='active'";
              	}
              	echo "><a href='edit_personal_info.php'>Edit Personal Info</a></li>";
              	
              ?>
            
            </ul>
          </div><!--/.well -->
        </div><!--/span-->