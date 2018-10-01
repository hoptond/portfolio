<?php
/**
 * Created by PhpStorm.
 * User: academy
 * Date: 01/10/2018
 * Time: 10:55
 */

?>

<head>
    <title>Edit Contact Info</title>
    <link rel="stylesheet" href="style.css">
</head>
<html>
    <form>
        <div class="longinput">
            <label>Icon ID: </label>
            <input name="id" type="text">
        </div>
        <div class="longinput">
            <label>Link: </label>
            <input name="link" type="text">
        </div>
        <div class="longinput">
            <label>Text: </label>
            <input name="name" type="text">
        </div>
        <input type="submit" value="Add/Edit">
    </form>
    <div class="listholder">
        <ul>
            <li>
                <div>
                    <p>hoptond848@protonmail.com</p>
                    <button class="edit">EDIT</button>
                    <button class="delete">X</button>
                </div>
                <div>
                    <p>github.com/hoptond/</p>
                    <button class="edit">EDIT</button>
                    <button class="delete">X</button>
                </div>
                <div>
                    <p>linkedin.com/in/daniel-hopton</p>
                    <button class="edit">EDIT</button>
                    <button class="delete">X</button>
                </div>
            </li>
        </ul>
    </div>
    <a href="dash.php">Back</a>
</html>
