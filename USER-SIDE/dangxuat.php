<?php
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page
echo "<script type='text/javascript'> window.location.href='../index.php';</script>";
?>
