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
        <form name="about" method="post" action ='doabout.php'>
            <?php echo displayAboutMeInput(); ?>
            <input type="submit" value="Change">
        </form>
        <div><?php
            if (isset($_GET['msg'])) {
                echo processMessage($_GET['msg']);
            }
            ?></div>
        <a href="dash.php">Back</a>
    </body>
</html>