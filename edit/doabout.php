<?php

require ('cms_functions.php');
require 'security_functions.php';

verifyUser();

if (anyFieldEmpty($_POST)) {
    header('Location: about.php?msg=16');
    exit;
}
updateAbout(getDBConnection(), $_POST);
header('Location: about.php?msg=1');

?>