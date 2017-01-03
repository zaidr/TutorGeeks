<?php
include 'common/connect.php';
include 'common/user_auth_checks.php';

//redirect user not logged in
check_for_signin();
//redirect if not a tutor (or admin, who is by default a tutor)
check_for_tutor();

include 'common/header.php';
include 'common/navbar.php';
?>


	<body>
		<div class="span9">
	  	<div class="hero-unit">
	  	<h2>Log Session</h2>
      <p>Log a tutoring session into the calendar.</p><br>
	  	
				<form method="post" action="log_session_exec.php">
          	
          	<!-- Select the student tied with this session-->
          	Student:<br>
          	<select class="input-large" name="student_id">
								<option>None</option>
								
 									<?php
 									
 									if ($_SESSION["user_level"] == ADMIN) {
 										$stmt = $db->query('SELECT student_id FROM students');
 										
										while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
									    
									    $stmt_name = $db->prepare("SELECT student_name FROM students WHERE student_id = ?");
									    $stmt_name->execute( array ($row["student_id"]) );
									    
									    while ($name_row = $stmt_name->fetch(PDO::FETCH_ASSOC)) {
									    	echo "<option value='".$row["student_id"]."'>". $name_row['student_name'] ."</option>";
											}
										}
									}
									elseif ($_SESSION["user_level"] == TUTOR) {
										$stmt = $db->query('SELECT student_id FROM students_to_tutors WHERE tutor_id ='.$_SESSION["user_id"]);
 										
										while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
									    
									    $stmt_name = $db->prepare("SELECT student_name FROM students WHERE student_id = ?");
									    $stmt_name->execute( array ($row["student_id"]) );
									    
									    while ($name_row = $stmt_name->fetch(PDO::FETCH_ASSOC)) {
									    	echo "<option value='".$row["student_id"]."'>". $name_row['student_name'] ."</option>";
											}
										}
									}
 									?>
 							</select>
 							<br>
 							
 							<!-- Select the tutor that is tied with this session -->
 							Tutor:<br>
							<select class="input-large" name="tutor_id">
							<option>None</option>
								
 							<?php
 								if ($_SESSION["user_level"] == ADMIN) {
 									$stmt = $db->query('SELECT user_id FROM users WHERE user_level < 2');
 										
									while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
									    
									  $stmt_name = $db->prepare("SELECT user_name FROM users WHERE user_id = ?");
									  $stmt_name->execute( array ($row["user_id"]) );
									    
									  while ($name_row = $stmt_name->fetch(PDO::FETCH_ASSOC)) {
									    echo "<option value='".$row["user_id"]."'>". $name_row['user_name'] ."</option>";
										}
									}
								}
								elseif ($_SESSION["user_level"] == TUTOR) {
									echo "<option value='".$_SESSION["user_id"]."'>". $_SESSION['user_name'].'</option>';
								}
 							?>
 							</select>	
 							<br>
 							
 							Date:<br>
							<input type="text" id="datepicker" name='date'><br>
 							
 							Time: (24 hr clock)<br>
 							<?php
 								
 								//prepare hours and minutes selects
 								$hours = array (0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23);
 								$mins = array('00',15,30,45);
 								
 								$select_hours = '<option>'.implode('</option><option>',$hours).'</option></select>';
 								$select_mins = '<option>'.implode('</option><option>',$mins).'</option></select>';
 								
 								//start hour
 								echo '<select class="input-small" name="start_hr"><option>Hr</option>';
 								echo $select_hours;
 								//start minute
 								echo '<select class="input-small" name="start_min"><option>Min</option>';
 								echo $select_mins;
 								
 								echo " - To - ";
 								
 								//end hour
 								echo '<select class="input-small" name="end_hr"><option>Hr</option>';
								echo $select_hours; 								
 								//end minute
 								echo '<select class="input-small" name="end_min"><option>Min</option>';
 								echo $select_mins;
 							?>
 							<br>
 							
 							Notes:<br>
 							<textarea rows="4" name="notes" class="span7"></textarea>
 							<br>
 							
 							Status:<br>
 							<select class="input-large" name="completed_status">
 							 <option value="N">Pending</option>
 							 <option value="Y">Completed</option>
 							</select>
 							<br>
 							
 							<br><button class="btn btn-large btn-primary" type="submit">Log This Session</button>
          	</form>
          </div>
        </div><!--/span-->
        
      </div><!--/row-->

      <hr>
      
	<link rel="stylesheet" href="development-bundle/themes/base/jquery.ui.all.css">
	<script src="development-bundle/jquery-1.8.3.js"></script>
	<script src="development-bundle/ui/jquery.ui.core.js"></script>
	<script src="development-bundle/ui/jquery.ui.widget.js"></script>
	<script src="development-bundle/ui/jquery.ui.datepicker.js"></script>
	<link rel="stylesheet" href="../demos.css">
	<script>
	$(function() {
		$( "#datepicker" ).datepicker({ dateFormat: "yy-mm-dd" });
	});
	</script>
	
	
<!-- Footer /-->
<?php
include 'common/footer.php';
?>