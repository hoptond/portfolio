<?php

require ('cms_functions.php');
if (anyFieldEmpty($_POST)) {
    header('Location: contact.php?msg=16');
    exit;
}
if (!isset($_POST['id'])) {
    if (addContactInfoToDatabase(getContactInfoFromPOST($_POST))) {
        header('Location: contact.php?msg=6');
    } else {
        header('Location: contact.php?msg=12');
    }
}
if (updateContactInfoInDatabase($_POST['id'], $_POST)) {
    header('Location: contact.php?msg=7');
} else {
    header('Location: contact.php?msg=13');
}
?>