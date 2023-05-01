<?php 

session_start();
$_SESSION = [];
session_unset();

header("location: ../../login/login.php");