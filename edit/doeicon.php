<?php

require ('cms_functions.php');
require 'security_functions.php';

verifyUser();

$db = getDBConnection();

$command = explode('_', array_keys($_POST)[0]);
if ($command[0] === 'del') {
    if (deleteEntryInDB($db, (int)$command[1], 'icons')) {
        header('Location: icons.php?msg=15');
    } else {
        header('Location: icons.php?msg=14');
    }
} else if ($command[0] === 'edit') {
    header('Location: icons.php?edit=&id=' . $command[1]);
}
?>