<?php

require ('cms_functions.php');

$db = getDBConnection();

if (anyFieldEmpty($_POST)) {
    header('Location: addproj.php?msg=16');
    exit;
}
if (addProjectToDatabase($db, getProjectDataFromPOST($_POST))) {
    header('Location: addproj.php?msg=4');
} else {
    header('Location: addproj.php?msg=12');
}
?>