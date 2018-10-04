<?php


require 'cms_functions.php';

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Edit/Delete Projects</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php
        echo displayEditProjectInput(getEditEntryID($_GET)); ?>
        <div class="listholder">
            <?php echo displayListHolderData('projects', getEditEntryID($_GET)); ?>
        </div>
        <div><?php
            if (isset($_GET['msg'])) {
                echo processMessage($_GET['msg']);
            }
            ?></div>
        <a href="dash.php">Back</a>
    </body>
</html>
