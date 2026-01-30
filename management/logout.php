<?php
session_start();

// if the user is logged in, unset the session
if (isset($_SESSION['db_is_logged_in_management'])) {
   unset($_SESSION['db_is_logged_in_management']);
}

if (isset($_SESSION['userid'])) {
   unset($_SESSION['userid']);
}

if (isset($_SESSION['management'])) {
   unset($_SESSION['management']);
}
// now that the user is logged out,
// go to login page
header('Location: login.php');
?>
