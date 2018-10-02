<?php

require ('cms_functions.php');
if(!isset($_POST['id'])) {
    if(addSingleValueToTable('badges', $_POST['value'])) {
        header('Location: badges.php?msg=2');
    } else {
        header('Location: badges.php?msg=12');
    }
} else {
    var_dump($_POST);
    updateSingleValueInTable((int)$_POST['id'],'badges', $_POST['value']);
    header('Location: badges.php?msg=3');
}
?>