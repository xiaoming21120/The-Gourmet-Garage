<?php
// admin_logout.php
session_start();

session_unset();
header("Location: admin_login.php");
exit;
?>