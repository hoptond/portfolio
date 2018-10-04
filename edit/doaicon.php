<?php

require ('cms_functions.php');
require 'security_functions.php';

verifyUser();

$db = getDBConnection();
if (anyFieldEmpty($_POST)) {
    header('Location: icons.php?msg=16');
    exit;
}
if (!isset($_POST['id'])) {
    if (addSingleValueToTable($db,'icons', $_POST['value'])) {
        header('Location: icons.php?msg=8');
    } else {
        header('Location: icons.php?msg=12');
    }
}
if (updateSingleValueInTable($db, $_POST['id'], 'icons', $_POST['value'])) {
    header('Location: icons.php?msg=9');
} else {
    header('Location: icons.php?msg=13');
}
?>