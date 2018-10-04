<?php require 'security_functions.php';

session_start();
if(verifyLogin($_POST['username'], $_POST['password'])) {
    setcookie('id','48975649867947386097823978');
    header('Location: dash.php');
} else {
    if(!loginExists($_POST['username'])) {
        echo 'adding badname to $_SESSION' . '<br>';
        $_POST['badname'] = TRUE;
    } else if(!correctPassword($_POST['password'], $_POST['password'])) {
        echo 'adding badpass to $_SESSION' . '<br>';
        $_POST['badpass'] = TRUE;
    }
    header('Location: index.php');
}

?>