<?php

require 'cms_functions.php';
require 'security_functions.php';

verifyUser();

$db = getDBConnection();

$db = getDBConnection();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Icons</title>
    <link rel="stylesheet" href="style.css">
</head>
    <body>
        <form name="icons" method="post" action ='doaicon.php'>
            <?php echo displaySingleValueInput($db, getEditEntryID($_GET), 'icons') ?>
            <input type="submit" value="Add">
        </form>
        <div class="listholder">
            <?php echo displayListHolderData($db,'icons', getEditEntryID($_GET)); ?>
        </div>
        <div><?php
            if (isset($_GET['msg'])) {
                echo processMessage($_GET['msg']);
            }
            ?></div>
        <a href="dash.php">Back</a>
    </body>
</html>
