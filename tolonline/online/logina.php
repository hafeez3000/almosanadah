<?php

include("../../db/db.php");
session_start();
$errorMessage = 'Not Logged';
if (isset($_POST['userid']) && isset($_POST['password'])) {


   $userId = $_POST['userid'];

   $sl_userId = strtolower($userId);

   $password = $_POST['password'];



   // check if the user id and password combination exist in database
   $sql = "SELECT user_sno,user_id,account_code,company_name,country,email FROM users WHERE LOWER(user_id) = '$sl_userId' AND user_password = '$password' and online_status=true";


   $result = pg_query($sql) ;
    if (!$result) {
	echo "An error occured.\n";
	exit;
	}


   if (pg_num_rows($result) == 1) {
      // the user id and password match,
      // set the session
      $_SESSION['db_is_logged_in_online'] = true;
      $_SESSION['userid'] = $userId;

	  $_SESSION['deptsr'] = "Online Reservation";

	  	  while ($rows = pg_fetch_array($result)){
	  $_SESSION['user_sno'] = $rows["user_sno"];
	  $_SESSION['user_a_code'] = $rows["account_code"];
      $_SESSION['ol_company_name'] = $rows["company_name"];
	   $_SESSION['ol_country'] = $rows["country"];
	   $_SESSION['ol_email'] = $rows["email"];

	  }
      // after login we move to the main page
       header('Location: uhome.php');
      exit;
   } else {
        header('Location: elogin.php');
	   exit;
   }


}
?>

