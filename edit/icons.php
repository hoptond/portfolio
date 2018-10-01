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
            <div>
                <label>Icon: </label>
                <input name="name" type="text">
                <input type="submit" value="Change">
            </div>
        </form>
        <div class="listholder">
            <ul>
                <li>
                    <div>
                        <p>fa fa-circle</p>
                        <button class="delete">X</button>
                        <button class="edit">EDIT</button>
                    </div>
                    <div>
                        <p>fa fa-github</p>

                        <button class="delete">X</button>
                        <button class="edit">EDIT</button>
                    </div>
                    <div>
                        <p>fa fa-at</p>

                        <button class="delete">X</button>
                        <button class="edit">EDIT</button>
                    </div>
                    <div>
                        <p>fa fa-linkedin</p>
                        <button class="delete">X</button>
                        <button class="edit">EDIT</button>
                    </div>
                </li>
            </ul>
        </div>
        <a href="dash.php">Back</a>
    </body>
</html>
