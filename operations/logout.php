<?php
session_start();

// if the user is logged in, unset the session
if (isset($_SESSION['db_is_logged_in_umrah'])) {
   unset($_SESSION['db_is_logged_in_umrah']);
}

if (isset($_SESSION['userid'])) {
   unset($_SESSION['userid']);
}

if (isset($_SESSION['deptumrah'])) {
   unset($_SESSION['deptumrah']);
}
// now that the user is logged out,
// go to login page
header('Location: login.php');
?>
