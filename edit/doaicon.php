<?php

require ('cms_functions.php');
if(anyFieldEmpty($_POST)) {
    header('Location: icons.php?msg=16');
    exit;
}
if(!isset($_POST['id'])) {
    if(addSingleValueToTable('icons', $_POST['value'])) {
        header('Location: icons.php?msg=8');
    } else {
        header('Location: icons.php?msg=12');
    }
}
if(updateSingleValueInTable($_POST['id'], 'icons', $_POST['value'])) {
    header('Location: icons.php?msg=9');
} else {
    header('Location: icons.php?msg=13');
}
?>