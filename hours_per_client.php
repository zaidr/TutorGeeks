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
            <h2>Hours per Client</h2>
            <p>View how many hours you have assigned per client. This is an overall sum.</p>
          
          </div>
        </div><!--/span-->
      </div><!--/row-->

      <hr>

<!-- Footer /-->
<?php
include 'common/footer.php';
?>