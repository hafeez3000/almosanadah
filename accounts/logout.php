<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// if the user is logged in, unset the session
if (isset($_SESSION['db_is_logged_in_accounts'])) {
   unset($_SESSION['db_is_logged_in_accounts']);
}

if (isset($_SESSION['userid'])) {
   unset($_SESSION['userid']);
}

if (isset($_SESSION['deptaccounts'])) {
   unset($_SESSION['deptaccounts']);
}
// now that the user is logged out,
// go to login page
header('Location: login.php');
?>
