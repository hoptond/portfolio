<?php require 'security_functions.php';

session_start();
if (verifyLogin($_POST['username'], $_POST['password'])) {
    setcookie('id', session_id());
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