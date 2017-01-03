<?php
include 'common/connect.php';
include 'common/header.php';
?>

<script>
function validateForm()
{
//check if a properly formed email address is filled in
var x=document.forms["form"]["email"].value;
var atpos=x.indexOf("@");
var dotpos=x.lastIndexOf(".");
if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
	{
  alert("Please Enter a valid email address");
  return false;
  }

//check if name is filled in
var name = document.forms["form"]["name"].value;
if (name == null || name == "")
	{
	alert("Please fill in your name");
	return false;
	}

//check if comment is filled in
if (document.getElementById("comments").value == '')
	{
	alert ("Please leave a comment");
	return false;
	}
}
</script>

<!-- Header + DB Connection /-->

	<div class="container">

      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="well">
        <h1>Contact</h1>
        
        <?php
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
					
					//DO SHIT TO AVOID SPAM FILTERS! SET YOUR OWN HEADERS, DUMMY!
					$email_from = 'zaidrahman@gmail.com';
					ini_set("sendmail_from", $email_from);
					$headers = "From: $email_from";

					if (mail ($email_from,"New Message From: ".$_POST['name']." / Email Address: ".$_POST['email'], $_POST['comments'], $headers) ) {
					echo '<br><br>';
					echo '<div class="alert alert-success">';
 					echo '<h4>Success!</h4>';
  				echo 'Message sent. We will get back to you soon!';
					echo '</div>';
					} else {
					echo '<br><br>';
					echo '<div class="alert alert-error">';
 					echo '<h4>Error</h4>';
  				echo 'Message was not sent.';
					echo '</div>';
					
					}
					
					
        }
        else {
        	echo '<p> Drop us a message, and we can set up a meet, or answer any questions you may have.</p><br>';
       		echo '<form name="form" method="post" action="contact.php" onsubmit="return validateForm();">';
        	echo '	<input type="text" name="name" placeholder="Name" /> <br>';
        	echo '	<input type="text" name="email" placeholder="E-mail Address" /> <br>';
 					echo '	<textarea rows="5" class="field span6" name="comments" placeholder="Comments" id="comments"></textarea>';
 					echo '	<br><button class="btn btn-large btn-primary" type="submit">Send Message</button>';
        	echo '</form>';
        }
        
      	?>
        
      </div>

      <hr>
 
<!-- Footer /-->
<?php
include 'common/footer.php';
?>