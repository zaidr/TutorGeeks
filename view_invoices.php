<?php
include 'common/connect.php';
include 'common/user_auth_checks.php';

//redirect user not logged in
check_for_signin();
//redirect non-admin user
check_for_client_or_admin();

include 'common/header.php';
include 'common/navbar.php';
?>


        <div class="span9">
          <div class="hero-unit">
            <h2>View Invoices</h2>
            <p>View your monthly invoices for completed sessions.</p>
          	
          	<form name=form method="get" target="Invoice" onsubmit="window.open('','Invoice','width=600,height=790,scrollbars=yes')"action="monthly_invoices/monthly_invoice.php">
          	
          	<!-- Select the student tied with this session-->
          	Student:<br>
          	<select class="input-large" name="student_id">
								
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
									elseif ($_SESSION["user_level"] == CLIENT) {
										$stmt = $db->query('SELECT student_id FROM students WHERE parent_id ='.$_SESSION["user_id"]);
 										
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
 							
 							Date:<br>
 							<select class="input-large" name="month">
 								<?php
 									$months = array ('January','February','March','April','May','June','July','August','September','October','November','December');
 									
 									$select_months = "";
 									$month_count = 1;
 									foreach ($months as $month) {
 										$select_months .= '<option value='.$month_count.'>'.$month.'</option>';
 										$month_count++;
 									}
 									echo $select_months;
 								?>
 							</select>
 							
 							<select class="input-medium" name="year">
 								<?php
 									$select_year = "";
 									for ($i = 2012; $i <= MAX_YEAR; $i++) {
 										$select_year .= '<option>'.$i.'</option>';
 									}
 									
 									echo $select_year;
 								?>
 							</select>
 							<br>
 							
 							<br><button class="btn btn-large btn-primary" type="submit">Invoice Me!</button>
 							
 							</form>
          
          </div>
        </div><!--/span-->
        
      </div><!--/row-->

      <hr>

<!-- Footer /-->
<?php
include 'common/footer.php';
?>