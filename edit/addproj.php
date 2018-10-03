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
        <form name="badges" method="post" action ='doaproject.php'>
            <div class="longinput">
                <label>Name: </label>
                <input name="title" type="text">
            </div>
            <div class="longinput">
                <label>Type: </label>
                <input name="type" type="text">
            </div>

            <div class="longinput">
                <label>Desc: </label>
                <input name="desc" type="text">
            </div>
            <div class="longinput">
                <label>Image: </label>
                <input name="img" type="text">
            </div>
            <div class="longinput">
                <label>Link: </label>
                <input name="link" type="text">
            </div>
            <input type="submit" value="Add">
        </form>
        <div><?php
            if(isset($_GET['msg'])) {
                echo processMessage($_GET['msg']);
            }
            ?></div>
        <a href="dash.php">Back</a>
    </body>
</html>