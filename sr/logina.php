<?php

include("../db/db.php");
session_start(); 
$errorMessage = 'Not Logged';
if (isset($_POST['userid']) && isset($_POST['password'])) {
  

   $userId = $_POST['userid'];
   $password = $_POST['password'];



   // check if the user id and password combination exist in database
   $sql = "SELECT user_id FROM users WHERE user_id = '$userId' AND user_password = '$password' and sr_status=true";


   $result = pg_query($sql) ;
    if (!$result) {
	echo "An error occured.\n";
	exit;
	}


   if (pg_num_rows($result) == 1) {
      // the user id and password match, 
      // set the session
      $_SESSION['db_is_logged_in_sr'] = true;
      $_SESSION['userid'] = $userId;
	  $_SESSION['deptsr'] = "Sales & Reservation";
      // after login we move to the main page
       header('Location: header.php');
      exit;
   } else {
        header('Location: elogin.php');
	   exit;
   }


}
?>

