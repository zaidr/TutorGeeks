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
          
            <form method="post" action="assign_student_to_tutor_exec.php">
							<h2>Assign Student to Tutor</h2>
							<p>Assign an existing student a tutor, and describe the subject being taught.</p><br>
								
							Student:<br>
								<select class="input-large" name="student_id">
								<option value=0>None</option>
								
 									<?php
 									
 										$stmt = $db->query('SELECT student_id FROM students');
 										
										while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
									    
									    $stmt_name = $db->prepare("SELECT student_name FROM students WHERE student_id = ?");
									    $stmt_name->execute( array ($row["student_id"]) );
									    
									    while ($name_row = $stmt_name->fetch(PDO::FETCH_ASSOC)) {
									    	echo "<option value='".$row["student_id"]."'>". $name_row['student_name'] ."</option>";
											}
										}
 									?>
 									</select>	
 								<br>
 								
 								Tutor:<br>
								<select class="input-large" name="tutor_id">
								<option value=0>None</option>
								
 									<?php
 									
 										$stmt = $db->query('SELECT user_id FROM users WHERE user_level < 2');
 										
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
 									
 									<input type="text" name ="subject" class="input-xlarge" placeholder="Subject"><br>
								
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