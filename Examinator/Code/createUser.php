<?php
    $name = "Henri";
    $email = "H@gmail.com";
    $username = "H";
    $pwd = "123";
    $pwdRepeat = "123";
    $position = "Professor";

    require_once 'includes/dbh.inc.php';
    require_once 'includes/functions.inc.php';

    if (emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat, $position) !== false) {
        header("location: ../signup.php?error=emptyinput");
        exit();   
    }
    //if (invalidUid($username) !== false) {
    //    header("location: ../signup.php?error=invaliduid");
    //    exit();   
    //}

    if (invalidEmail($email) !== false) {
        header("location: ../signup.php?error=invalidemail");
        exit();   
    }
    if (pwdMatch($pwd, $pwdRepeat) !== false) {
        header("location: ../signup.php?error=pwddontmatch");
        exit();   
    }
    if (uidExists($connection, $username, $email) !== false) {
        header("location: ../signup.php?error=usernametaken");
        exit();   
    }

    createUser($connection, $name, $email, $username, $pwd, $position);