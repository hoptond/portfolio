<?php

require 'security_functions.php';

session_start();
if($_SESSION['loggedin']) {
    header('Location: dash.php');
}


?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <form name="login" method="post" action="login.php">
        <label>Login:</label>
        <input name="username" type="text">
        <label>Password:</label>
        <input name="password" type="password">
        <input value="submit" type="submit">
    </form>
    <p><?php echo loginFailMessage(); ?></p>
    <a href="../index.php">Back</a>
</body>
</html>


