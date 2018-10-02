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
    <form>
        <?php echo displayEditProjectInput(0); ?>
        <input type="submit" value="Edit">
    </form>
    <div class="listholder">
        <?php echo displayListHolderData('projects'); ?>
    </div>
    <a href="dash.php">Back</a>
</body>
</html>
