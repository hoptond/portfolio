<?php

require 'cms_functions.php';
require 'security_functions.php';

verifyUser();

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <title>Add Project</title>
    <link rel="stylesheet" href="css/style.css">
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
            <div class="longinputlarge">
                <label>Desc: </label>
                <textarea name="desc"></textarea>
            </div>
            <div class="longinput">
                <label>Image: </label>
                <input name="img" type="text">
            </div>
            <div class="longinput">
                <label>Repo Link: </label>
                <input name="repo_link" type="text">
            </div>
            <div class="longinput">
                <label>Demo Link: </label>
                <input name="use_link" type="text">
            </div>
            <input type="submit" value="Add">
        </form>
        <div><?php
            if (isset($_GET['msg'])) {
                echo processMessage($_GET['msg']);
            }
            ?></div>
        <a href="dash.php">Back</a>
    </body>
</html>