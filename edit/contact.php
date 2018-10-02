<?php

require 'cms_functions.php';

?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Contact Info</title>
    <link rel="stylesheet" href="style.css">
</head>
    <form>
        <?php echo displayEditContactInfo(0) ?>
        <input type="submit" value="Add/Edit">
    </form>
    <div class="listholder">
    <?php echo displayListHolderData('contact'); ?>
    </div>
    <a href="dash.php">Back</a>
</html>
