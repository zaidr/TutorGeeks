<?php
	if (basename($_SERVER['PHP_SELF']) == "index.php") {
    echo "Tutor Geeks - Home";
  } elseif (basename($_SERVER['PHP_SELF']) == "about.php") {
  	echo "Tutor Geeks - About";
  } elseif (basename($_SERVER['PHP_SELF']) == "contact.php") {
  	echo "Tutor Geeks - Contact";
  } else {
  	echo "Tutor Geeks";
  }
?>