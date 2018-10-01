<?php


?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit/Delete Projects</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form>
        <div class="longinput">
            <label>Name: </label>
            <input name="name" type="text">
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
        <input type="submit" value="Edit">
    </form>
    <div class="listholder">
        <ul>
            <li>
                <div>
                    <p>MAGICIANS</p>
                    <button class="delete">X</button>
                    <button class="edit">EDIT</button>
                </div>
                <div>
                    <p>PORTFOLIO</p>
                    <button class="delete">X</button>
                    <button class="edit">EDIT</button>
                </div>
            </li>
        </ul>
    </div>
    <a href="dash.php">Back</a>
</body>
</html>
