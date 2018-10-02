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
        <form>
            <?php echo displaySingleValueInput(0, 'badges') ?>
            <input type="submit" value="Add">
        </form>
        <div class="listholder">
            <?php echo displayListHolderData('badges'); ?>
        </div>
        <a href="dash.php">Back</a>
    </body>
</html>