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
            
            <?php 
            	
            	//get the user
            	$stmt = $db->prepare("SELECT * FROM users WHERE user_id = ?");
    					$stmt->execute( array ($_GET['user']) );	
    					$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    					$row = $result[0];
    					
    					//display the user
    					echo "<h4>".$row['user_name']."</h4>";
    					if ($row['user_level'] == ADMIN) { echo "Admin <br>";}
    					elseif ($row['user_level'] == TUTOR) { echo "Tutor <br>";}
            	elseif ($row['user_level'] == CLIENT) { echo "Client <br>";}
            	echo "<br>";
            	echo "E-mail: ". $row["user_email"] ."<br>";
            	echo "Phone: ". $row["phone_num"]."<br>";
            	echo "Address: ". $row["address"]."<br>";
            ?>
            
          </div>
        </div><!--/span-->
        
      </div><!--/row-->

      <hr>

<!-- Footer /-->
<?php
include 'common/footer.php';
?>