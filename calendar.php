<?php
include 'common/connect.php';
include 'common/user_auth_checks.php';

//redirect user not logged in
check_for_signin();

include 'common/header.php';
include 'common/navbar.php';
include "common/draw_calendar.php";
?>

        <div class="span9">
          <div class="hero-unit">
            <h2>Calendar</h2>
            <p>View sessions for the month.</p><br>
          	<?php
          		echo date('F') .' '.date('Y');
          		echo draw_calendar(date('n'),date('Y'));
          		
          	?>
          </div>
        </div><!--/span-->
      </div><!--/row-->

      <hr>

<!-- Footer /-->
<?php
include 'common/footer.php';
?>
