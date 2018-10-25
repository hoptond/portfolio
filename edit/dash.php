<?php

require 'security_functions.php';

verifyUser();

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Dash</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <h1>DASH</h1>
        <h3>About</h3>
        <ul>
            <li><a href="about.php">Edit Text</a></li>
            <li><a href="badges.php">Edit/Delete Badges</a></li>
        </ul>
        <h3>Projects</h3>
        <ul>
            <li><a href="addproj.php">Add a Project</a></li>
            <li><a href="editproj.php">Edit/Delete Projects</a></li>
        </ul>
        <h3>Contact</h3>
        <ul>
            <li><a href="contact.php">Edit Contact Info</a></li>
            <li><a href="icons.php">Edit FA Icons</a></li>
        </ul>
        <a href="logout.php">Logout</a>
    </body>
</html>
