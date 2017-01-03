<?php
include "common/connect.php";
$stmt = $db->prepare("INSERT INTO users(user_name,user_email,user_level,password,phone_num,address,active) VALUES (?, ?, ?, ?, ?, ?, ?)");
$affected_rows = $stmt->execute( array ("test client","email@email.com","2","password","416","home address","Y") );
echo $affected_rows.' were affected'
?>