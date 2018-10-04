<?php

function verifyLogin($username, $password) : bool {
    session_start();
    if(loginExists($username)) {
        if(correctPassword($username, $password)) {
            unset($_SESSION['badname']);
            unset($_SESSION['badpass']);
            return true;
        }
    }
    return false;
}

function verifyUser() {
    session_start();
    if($_COOKIE['id'] != session_id()) {
        setcookie('id',0, time() - 1);
        header('Location: index.php');
    }
    session_destroy();
}

function loginFailMessage() : string {
    session_start();
    if(array_key_exists('badname' , $_SESSION)) {
        session_destroy();
        return 'User not in database. Please try again';
    }
    if(array_key_exists('badpass', $_SESSION)) {
        session_destroy();
        return 'Wrong password. Please try again.';
    }
    return '';
}



function loginExists($username) : bool {
    if($username == 'badmin') {
        return true;
    }
    return false;
}

function correctPassword($username ,$password) {
    $dbpassword = '$2y$10$4u0SlOo/oAhRLwaMuC17BOWCjF/YUT2TJqGh4F4h8dnurxVJuxH2K';
    if(password_verify($password, $dbpassword)) {
        return true;
    }
    return false;
}