<?php

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Edit Badges</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <form>
            <label>New Badge:</label>
            <input name="badge" type="text">
            <input type="submit" value="Add">
        </form>
        <div class="listholder">
            <ul>
                <li>
                    <div>
                        <p>devicon-csharp-plain</p>
                        <button class="delete">X</button>
                        <button class="edit">EDIT</button>
                    </div>
                </li>
                <li>
                    <div>
                        <p>devicon-html5-plain</p>
                        <button class="delete">X</button>
                        <button class="edit">EDIT</button>
                    </div>
                </li>
                <li>
                    <div>
                        <p>devicon-css3-plain</p>
                        <button class="delete">X</button>
                        <button class="edit">EDIT</button>
                    </div>
                </li>
            </ul>
        </div>
        <a href="dash.php">Back</a>
    </body>
</html>