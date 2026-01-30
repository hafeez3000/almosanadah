<?php
session_start();

// if the user is logged in, unset the session
if (isset($_SESSION['db_is_logged_in_online'])) {
   unset($_SESSION['db_is_logged_in_online']);
}

if (isset($_SESSION['userid'])) {
   unset($_SESSION['userid']);
}

if (isset($_SESSION['deptsr'])) {
   unset($_SESSION['deptsr']);
}

if (isset($_SESSION['user_sno'])) {
   unset($_SESSION['user_sno']);
}

if (isset($_SESSION['user_a_code'])) {
   unset($_SESSION['user_a_code']);
}

if (isset($_SESSION['ol_company_name'])) {
   unset($_SESSION['ol_company_name']);
}


if (isset($_SESSION['ol_country'])) {
   unset($_SESSION['ol_country']);
}


if (isset($_SESSION['ol_email'])) {
   unset($_SESSION['ol_email']);
}




// now that the user is logged out,
// go to login page
header('Location: index.php');
?>
