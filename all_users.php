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
          
            <h2> Show All Users</h2>
            <p>View all users, including Clients, Tutors, and Admin.</p><br>
            
            <?php
            	
            	$stmt = $db->query('SELECT * FROM users');
 
							while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
								
    						echo '<a href="all_users_detail.php?user=' . $row['user_id'] . '">'. $row['user_name'] .'</a>'; 
    						echo "<br>";
							}
            	
            ?>
            
            
          </div> <!-- /hero unit-->
        </div><!--/span-->
        
      </div><!--/row-->

      <hr>

<!-- Footer /-->
<?php
include 'common/footer.php';
?>