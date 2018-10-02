<?php

require ('cms_functions.php');
if(addContactInfoToDatabase($_POST)) {
    header('Location: contact.php?msg=6');
} else {
    header('Location: contact.php?msg=12');
}

?>