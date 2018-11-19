<?php

require ('cms_functions.php');
require 'security_functions.php';

verifyUser();


$db = getDBConnection();

if (anyFieldEmpty($_POST)) {
    if (empty($_POST['repo_link']) && empty($_POST['use_link'])) {
        header('Location: addproj.php?msg=16');
        exit;
    }
}
if (addProjectToDatabase($db, getProjectDataFromPOST($_POST))) {
    header('Location: addproj.php?msg=4');
} else {
    header('Location: addproj.php?msg=12');
}
?>