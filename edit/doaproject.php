<?php

require ('cms_functions.php');
if(addProjectToDatabase(getProjectDataFromPOST($_POST))) {
    header('Location: addproj.php?msg=4');
} else {
    header('Location: addproj.php?msg=12');
}
?>