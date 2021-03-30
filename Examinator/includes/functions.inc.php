<?php

function emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat, $position){
    $result;
    if(empty($name) || empty($email)||empty($username)||empty($pwd)||empty($pwdRepeat)||empty($position)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

//function invalidUid($username){
//    $result;
//    if(preg_match("/^[a-zA-Z0-9]*$/",$username)){
//        $result = true;
//    }
//    else{
//        $result = false;
//    }
//    return $result;
//}

function invalidEmail($email){
    $result;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function pwdMatch($pwd, $pwdRepeat){
    $result;
    if($pwd !== $pwdRepeat){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function uidExists($connection, $username, $email){
    $sql = "select * from users where usersUid = ? or usersEmail = ?;";
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if (mysqli_fetch_assoc($resultData)) {
        return $row;
    }
    else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function createUser($connection, $name, $email, $username, $pwd, $position){
    $sql = "Insert into users (usersName, usersEmail, usersUid, usersPwd, usersPos) values (?,?,?,?,?);";
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssss", $name, $email, $username, $hashedPwd, $position);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../signup.php?error=none");
        exit();
}

function emptyInputLogin($username, $pwd){
    $result;
    if(empty($username)||empty($pwd)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function loginUser($connection, $username, $pwd){
    $uidExists = uidExists($conn, $username, $username);

    if ($uidExists === false) {
        header("location: ../login.php?error=wrongusername");
        exit();
    }

    $pwdHashed = $uidExists["userPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);
    if ($checkPwd === false){
        header("location: ../login.php?error=wrongpassword");
        exit();
    }
    elseif($checkPwd === true){
        session_start();
        $_SESSION["userid"] = $uidExists["usersId"];
        $_SESSION["useruid"] = $uidExists["usersUid"];
        //TODO send to Home page
        header("location: ../index.php");
        exit();
    }
}