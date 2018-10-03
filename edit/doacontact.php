<?php

require ('cms_functions.php');
if(!isset($_POST['id'])) {
    if(addContactInfoToDatabase(getContactInfoFromPOST($_POST))) {
        header('Location: contact.php?msg=6');
    } else {
        header('Location: contact.php?msg=12');
    }
}
if(updateContactInfoInDatabase($_POST['id'], $_POST)) {
    header('Location: contact.php?msg=7');
} else {
    var_dump($_POST);
    //header('Location: contact.php?msg=13');
}
?>