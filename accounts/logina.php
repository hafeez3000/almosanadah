<?php

include("../db/db.php");
if (session_status() === PHP_SESSION_NONE) {
    session_start();
} 
$errorMessage = 'Not Logged';
if (isset($_POST['userid']) && isset($_POST['password'])) {
  

   $userId = $_POST['userid'];
   $password = $_POST['password'];



   // check if the user id and password combination exist in database
   $sql = "SELECT user_sno, user_id FROM users WHERE user_id = '$userId' AND user_password = '$password' and accounts_status=true";


   $result = pg_query($conn, $sql) ;
    if (!$result) {
	echo "An error occured.\n";
	exit;
	}
// $rowcr["sno"];

   if (pg_num_rows($result) == 1) {
      // the user id and password match, 
      // set the session
      $_SESSION['db_is_logged_in_accounts'] = true;
      $_SESSION['userid'] = $userId;
	  $_SESSION['deptaccounts'] = "Accounts Department";

	  while ($rows = pg_fetch_array($result)){
	  $_SESSION['user_sno'] = $rows["user_sno"];
	  }
      // after login we move to the main page
       header('Location: accountstree.php');
      exit;
   } else {

      header('Location: elogin.php');
	   exit;
   }


}
?>

