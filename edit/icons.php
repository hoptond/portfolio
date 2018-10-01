<?php

?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Icons</title>
    <link rel="stylesheet" href="style.css">
</head>
    <body>
        <form>
            <ul>
                <li>
                    <label>Icon: </label>
                    <input name="name" type="text">
                    <input type="submit" value="Change">
                </li>
            </ul>
        </form>
        <div class="listholder">
            <ul>
                <li>
                    <div>
                        <p>fa fa-circle</p>
                        <button class="edit">EDIT</button>
                        <button class="delete">X</button>
                    </div>
                    <div>
                        <p>fa fa-github</p>
                        <button class="edit">EDIT</button>
                        <button class="delete">X</button>
                    </div>
                    <div>
                        <p>fa fa-at</p>
                        <button class="edit">EDIT</button>
                        <button class="delete">X</button>
                    </div>
                    <div>
                        <p>fa fa-linkedin</p>
                        <button class="edit">EDIT</button>
                        <button class="delete">X</button>
                    </div>
                </li>
            </ul>
        </div>
        <a href="dash.php">Back</a>
    </body>
</html>
