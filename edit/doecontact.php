<?php

require ('cms_functions.php');
require 'security_functions.php';

verifyUser();

$db = getDBConnection();

if (anyFieldEmpty($_POST)) {
    header('Location: contact.php?msg=16');
    exit;
}
$command = explode('_', array_keys($_POST)[0]);
if ($command[0] === 'del') {
    if (deleteEntryInDB($db, (int)$command[1], 'contact')) {
        header('Location: contact.php?msg=15');
    } else {
        header('Location: contact.php?msg=14');
    }
} else if ($command[0] === 'edit') {
    header('Location: contact.php?edit=&id=' . $command[1]);
}
?>