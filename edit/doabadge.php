<?php

require ('cms_functions.php');
if (anyFieldEmpty($_POST)) {
    header('Location: badges.php?msg=16');
    exit;
}
if (!isset($_POST['id'])) {
    if (addSingleValueToTable('badges', $_POST['value'])) {
        header('Location: badges.php?msg=2');
    } else {
        header('Location: badges.php?msg=12');
    }
} else {
    if (updateSingleValueInTable($_POST['id'], 'badges', $_POST['value'])) {
        header('Location: badges.php?msg=3');
    } else {
        header('Location: badges.php?msg=13');
    }
}
?>