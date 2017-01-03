<?php
include 'common/connect.php';
include 'common/user_auth_checks.php';

//redirect user not logged in
check_for_signin();
//redirect non-admin user
check_for_admin();

include 'common/header.php';
include 'common/navbar.php';
?>

        <div class="span9">
          <div class="hero-unit">
            	<form method="post" action="add_user_exec.php">
								<h2>Add user</h2>
								<p>Add a new user: Client, Tutor, or Admin.</p><br>
								
								<select class="input-large" name="user_level">
 									<option>Client</option>
 									<option>Tutor</option>
 									<option>Admin</option>
 								</select>
 								<br>
 								
								<input type="text" name ="name" class="input-large" placeholder="Name"><br>
 								<input type="text" name ="email" class="input-large" placeholder="E-mail Address"><br>
								<input type="password" name ="password" class="input-large" placeholder="Password"><br>
								
								User Info:<br>
								<input type="text" name ="phone_number" class="input-large" placeholder="Phone Number"><br>
								<input type="text" name ="address" class="input-xxlarge" placeholder="Address"><br>
								
								<select class="input-large" name="active_status">
 									<option>Active</option>
 									<option>Inactive</option>
 								</select>
 								<br>
								
								<br><button class="btn btn-large btn-primary" type="submit">Add</button>
							</form>
          </div>
        </div><!--/span-->
        
      </div><!--/row-->

      <hr>

<!-- Footer /-->
<?php
include 'common/footer.php';
?>

