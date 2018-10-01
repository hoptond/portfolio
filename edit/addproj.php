<?php
/**
 * Created by PhpStorm.
 * User: academy
 * Date: 01/10/2018
 * Time: 10:21
 */

?>

<html>
<head>
    <title>Edit Badges</title>
    <link rel="stylesheet" href="style.css">
</head>
    <body>
        <form>
            <ul>
                <li>
                    <div class="longinput">
                        <label>Name: </label>
                        <input name="name" type="text">
                    </div>
                </li>
                <li>
                    <div class="longinput">
                        <label>Type: </label>
                        <input name="type" type="text">
                    </div>
                </li>
                <li>
                    <div class="longinput">
                        <label>Desc: </label>
                        <input name="desc" type="text">
                    </div>
                </li>
                <li>
                    <div class="longinput">
                        <label>Image: </label>
                        <input name="img" type="text">
                    </div>
                </li>
                <li>
                    <div class="longinput">
                        <label>Link: </label>
                        <input name="link" type="text">
                    </div>
                </li>
                    <input type="submit" value="Add">
                </li>
            </ul>
        </form>
        <a href="dash.php">Back</a>
    </body>
</html>