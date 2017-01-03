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
          
            <form method="post" action="add_student_exec.php">
								<h2>Add Student</h2>
								<p>Add a new Student - Must be assigned to an existing Client.</p><br>
								
								Parent:<br>
								<select class="input-large" name="parent_id">
									<option value=0>None</option>
									
 									<?php
 									
 										$stmt = $db->query('SELECT user_id FROM users WHERE user_level = 2');
 										
										while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
									    
									    $stmt_name = $db->prepare("SELECT user_name FROM users WHERE user_id = ?");
									    $stmt_name->execute( array ($row["user_id"]) );
									    
									    while ($name_row = $stmt_name->fetch(PDO::FETCH_ASSOC)) {
									    	echo "<option value='".$row["user_id"]."'>". $name_row['user_name'] ."</option>";
											}
										}
 									?>
 									</select>
 								
 								<br>
 								Student Info:
 								<br>
 								
								<input type="text" name ="student_name" class="input-large" placeholder="Name"><br>
								
								<input type="text" name ="rate" class="input-large" placeholder="Rate Per Hour"><br>
								
								<select class="input-large" name="active_status">
 									<option value="Y">Active</option>
 									<option value="N">Inactive</option>
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