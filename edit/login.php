<?php require 'security_functions.php';

session_start();
if (!isset($_POST['username']) || !isset($_POST['username'])) {
    $_SESSION['badfields'] = TRUE;
    header('Location: index.php');
}
if (verifyLogin($_POST['username'], $_POST['password'])) {
    $_SESSION['loggedin'] = TRUE;
    header('Location: dash.php');
} else {
    session_start();
    if (!loginExists($_POST['username'])) {
        echo 'adding badname to $_SESSION' . '<br>';
        $_SESSION['badname'] = TRUE;
    } else if (!correctPassword($_POST['password'], $_POST['password'])) {
        echo 'adding badpass to $_SESSION' . '<br>';
        $_SESSION['badpass'] = TRUE;
    }
    header('Location: index.php');
}

?>