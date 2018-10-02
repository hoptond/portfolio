<?php

require 'cms_functions.php';

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Edit About</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <form>
            <?php echo displayAboutMeInput(); ?>
            <input type="submit" value="Change">
        </form>
        <a href="dash.php">Back</a>
    </body>
</html>