<?php
if (isset($_POST['signupuser'])){
    session_start();
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['uid'];
    $pwd = $_POST['pwd'];
    $pwdRepeat = $_POST['pwdrepeat'];
    $position = $_POST['position'];
    $faculty = $_SESSION['userfaculty'];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

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

    createUser($connection, $name, $email, $username, $pwd, $position, $faculty);
}
else{
    header("location: ../signup.php");
    exit();
}