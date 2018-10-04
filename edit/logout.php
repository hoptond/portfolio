<?php require 'security_functions.php';

setcookie('id',0, time() - 1);
header('Location: index.php');

?>