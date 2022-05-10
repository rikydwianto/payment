<?php
header("X-XSS-Protection: 1; mode=block");

$con = mysqli_connect("localhost", $username, $password, $db_name);
$kon = $con;
// session_start();
session_start();
?>