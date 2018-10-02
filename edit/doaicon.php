<?php

require ('cms_functions.php');
if(!isset($_POST['id'])) {
    if(addSingleValueToTable('icons', $_POST['value'])) {
        header('Location: icons.php?msg=8');
    } else {
        header('Location: icons.php?msg=12');
    }
} else {
    var_dump($_POST);
    updateSingleValueInTable((int)$_POST['id'],'icons', $_POST['value']);
    header('Location: icons.php?msg=9');
}
?>