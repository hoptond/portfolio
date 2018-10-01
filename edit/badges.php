<?php
/**
 * Created by PhpStorm.
 * User: academy
 * Date: 01/10/2018
 * Time: 09:56
 */


?>

<html>
    <head>
        <title>Edit Badges</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <form>
            <label>New Badge:</label>
            <input type="text">
            <input type="submit" value="Add">
        </form>
        <div class="listholder">
            <ul>
                <li>
                    <div>
                        <p>devicon-csharp-plain</p>
                        <button class="edit">EDIT</button>
                        <button class="delete">X</button>
                    </div>
                    <div>
                        <p>devicon-html5-plain</p>
                        <button class="edit">EDIT</button>
                        <button class="delete">X</button>
                    </div>
                    <div>
                        <p>devicon-css3-plain</p>
                        <button class="edit">EDIT</button>
                        <button class="delete">X</button>
                    </div>
                </li>
            </ul>
        </div>
        <a href="dash.php">Back</a>
    </body>
</html>