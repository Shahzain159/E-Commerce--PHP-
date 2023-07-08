<?php
session_start();
// session_destroy();
unset($_SESSION["auth_admin"]);
header("location:login.php");

?>