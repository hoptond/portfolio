<?php

function verifyLogin($username, $password) : bool {
    session_start();
    if(loginExists($username)) {
        if(correctPassword($username, $password)) {
            return true;
        }
    }
    return false;
}

function loginFailMessage() : string {
    if(array_key_exists('badname' , $_POST)) {
        return 'User not in database. Please try again';
    }
    if(array_key_exists('badpass', $_POST)) {
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