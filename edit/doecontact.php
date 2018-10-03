<?php

require ('cms_functions.php');

$command = explode('_', array_keys($_POST)[0]);
if($command[0] === 'del') {
    if(deleteEntryInDB((int)$command[1], 'contact')) {
        header('Location: contact.php?msg=15');
    } else {
        header('Location: contact.php?msg=14');
    }
} else if($command[0] === 'edit') {
    header('Location: contact.php?edit=&id=' . $command[1]);
}
?>