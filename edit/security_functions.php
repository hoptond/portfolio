<?php

/*
 * Verifies the username and password. If it is correct, any session data relating to incorrect entry is removed.
 *
 * @param string $username The given username.
 * @param string $password The given password.
 *
 * @return bool Returns TRUE if the credentials match, otherwise FALSE.
 */
function verifyLogin($username, $password) : bool {
    session_start();
    if (loginExists($username)) {
        if (correctPassword($username, $password)) {
            unset($_SESSION['badname']);
            unset($_SESSION['badpass']);
            return true;
        }
    }
    return false;
}

/*
 * If the cookie ID does not match the session ID, the user is punted out of the session. GET OUTTA HERE
 */
function verifyUser() {
    session_start();
    if ($_COOKIE['id'] != session_id()) {
        setcookie('id',0, time() - 1);
        header('Location: index.php');
    }
    session_destroy();
}

/*
 * Verifies the username and password. If it is correct, any session data relating to incorrect entry is removed.
 *
 * @return string Returns a message if either the username or password is incorrect. If the user has entered no data,
 * this value is blank.
 */
function loginFailMessage() : string {
    session_start();
    if (array_key_exists('badname' , $_SESSION)) {
        session_destroy();
        return 'User not in database. Please try again';
    }
    if (array_key_exists('badpass', $_SESSION)) {
        session_destroy();
        return 'Wrong password. Please try again.';
    }
    return '';
}


/*
 * Determines if the login exists. At the moment, we only have a static login, so it is compared against that.
 *
 * @param string $username The given username.
 *
 * @return bool Returns TRUE if the username matches, otherwise false.
 */
function loginExists($username) : bool {
    if ($username == 'badmin') {
        return true;
    }
    return false;
}

/*
 * Determines if the password is correct. At the moment, we only have a static password hash, so it is compared against that.
 *
 * @param string $username The given username. At the moment, this value does nothing because we only have a static entry but
 * in a real DB this would have to be compared in a query.
 * @param string $password The given password.
 *
 * @return bool Returns TRUE if the password matches, otherwise false.
 */
function correctPassword($username, $password) {
    $dbpassword = '$2y$10$4u0SlOo/oAhRLwaMuC17BOWCjF/YUT2TJqGh4F4h8dnurxVJuxH2K';
    if (password_verify($password, $dbpassword)) {
        return true;
    }
    return false;
}