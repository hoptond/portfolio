<?php

require 'cms_functions.php';



?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Contact Info</title>
    <link rel="stylesheet" href="style.css">
</head>
    <form name ='contact' method='post' action='doacontact.php'>
        <?php echo displayEditContactInfo(getEditEntryID($_GET)) ?>
        <input type="submit" value="Add/Edit">
    </form>
    <div class="listholder">
        <?php echo displayListHolderData('contact', getEditEntryID($_GET)); ?>
    </div>
    <div><?php
        if (isset($_GET['msg'])) {
            echo processMessage($_GET['msg']);
        }
        ?></div>
    <a href="dash.php">Back</a>
</html>
