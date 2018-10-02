<?php

require ('cms_functions.php');

//TODO: kick unathorised individuals off our page

if(count($_POST) > 2) {
     if(updateSingleValueInTable($_POST['id'], 'badges', $_POST['value'])) {
         header('Location: badges.php?msg=3');
     } else {
         header('Location: badges.php?msg=13');
     }
} else {
    $command = explode('_', array_keys($_POST)[0]);
    if($command[0] === 'del') {
        if(deleteEntryInDB((int)$command[1], 'badges')) {
            header('Location: badges.php?msg=15');
        } else {
            header('Location: badges.php?msg=14');
        }
    } else if($command[0] === 'edit') {
        header('Location: badges.php?edit=&id=' . $command[1]);
    }
}
?>