<?php
include 'common/connect.php';
include 'common/user_auth_checks.php';

//redirect user not logged in
check_for_signin();
//redirect non-admin user
check_for_tutor();

include 'common/header.php';
include 'common/navbar.php';
?>

        <div class="span9">
          <div class="hero-unit">
            <h2>View Sessions</h2>
            <p>View Sessions should be integrated into the calendar. Remove this page.</p>
          </div>
          
        </div><!--/span-->
        
      </div><!--/row-->

      <hr>

<!-- Footer /-->
<?php
include 'common/footer.php';
?>