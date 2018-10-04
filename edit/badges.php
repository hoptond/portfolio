<?php

require 'cms_functions.php';
require 'security_functions.php';

verifyUser();

$db = getDBConnection();

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Edit Badges</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <form name="badges" method="post" action ='doabadge.php'>
            <?php echo displaySingleValueInput($db, getEditEntryID($_GET), 'badges') ?>
            <input type="submit" value="Add/Edit">
        </form>
        <div class="listholder">
            <?php echo displayListHolderData($db,'badges', getEditEntryID($_GET)); ?>
        </div>
        <div><?php
            if (isset($_GET['msg'])) {
                echo processMessage($_GET['msg']);
            }
            ?></div>
        <a href="dash.php">Back</a>
    </body>
</html>