<?php

?>
<!DOCTYPE html>
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
                    <button class="delete">X</button>
                    <button class="edit">EDIT</button>
                </div>
                <div>
                    <p>github.com/hoptond/</p>
                    <button class="delete">X</button>
                    <button class="edit">EDIT</button>
                </div>
                <div>
                    <p>linkedin.com/in/daniel-hopton</p>
                    <button class="delete">X</button>
                    <button class="edit">EDIT</button>
                </div>
            </li>
        </ul>
    </div>
    <a href="dash.php">Back</a>
</html>
