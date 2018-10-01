<?php
/**
 * Created by PhpStorm.
 * User: academy
 * Date: 01/10/2018
 * Time: 10:46
 */

?>
<html>
<head>
    <title>Edit/Delete Projects</title>
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
            <li>
                <input type="submit" value="Edit">
            </li>
        </ul>
    </form>
    <div class="listholder">
        <ul>
            <li>
                <div>
                    <p>MAGICIANS</p>
                    <button class="edit">EDIT</button>
                    <button class="delete">X</button>
                </div>
                <div>
                    <p>PORTFOLIO</p>
                    <button class="edit">EDIT</button>
                    <button class="delete">X</button>
                </div>
            </li>
        </ul>
    </div>
    <a href="dash.php">Back</a>
</body>
</html>
