<?php

require ('cms_functions.php');
require 'security_functions.php';

verifyUser();
$db = getDBConnection();

if (anyFieldEmpty($_POST)) {
    if (empty($_POST['repo_link']) && empty($_POST['use_link'])) {
        header('Location: editproj.php?msg=16');
        exit;
    }
}
if (count($_POST) > 2) {
     if (updateProjectInDatabase($db, $_POST['id'], getProjectDataFromPOST($_POST))) {
         header('Location: editproj.php?msg=5');
     } else {
         header('Location: editproj.php?msg=13');
     }
} else {
    $command = explode('_', array_keys($_POST)[0]);
    if ($command[0] === 'del') {
        if (deleteEntryInDB($db, (int)$command[1], 'projects')) {
            header('Location: editproj.php?msg=15');
        } else {
            header('Location: editproj.php?msg=14');
        }
    } else if ($command[0] === 'edit') {
        header('Location: editproj.php?edit=&id=' . $command[1]);
    }
}
?>