<?php

require 'cms_functions.php';

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Edit Badges</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <form name="badges" method="post" action ='doabadge.php'>
            <?php echo displaySingleValueInput(getEditEntryID($_GET), 'badges') ?>
            <input type="submit" value="Add/Edit">
        </form>
        <div class="listholder">
            <?php echo displayListHolderData('badges', getEditEntryID($_GET)); ?>
        </div>
        <div><?php
            if (isset($_GET['msg'])) {
                echo processMessage($_GET['msg']);
            }
            ?></div>
        <a href="dash.php">Back</a>
    </body>
</html>