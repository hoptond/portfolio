<?php require 'security_functions.php';

session_start();
session_unset();
session_destroy();
header('Location: index.php');

?>