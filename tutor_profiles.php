<?php
include 'common/connect.php';
include 'common/user_auth_checks.php';

//redirect user not logged in
check_for_signin();

include 'common/header.php';
include 'common/navbar.php';
?>

        <div class="span9">
        
          <div class="hero-unit">
            <h2>Tutor Profiles</h2>
            <p>View the tutor's information and profile.</p>
          </div>
          
        </div><!--/span-->
        
      </div><!--/row-->

      <hr>

<!-- Footer /-->
<?php
include 'common/footer.php';
?>