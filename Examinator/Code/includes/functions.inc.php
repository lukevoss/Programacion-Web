<?php

function getNumberOfQuestions($asigName, $connection){
    $sql = "SELECT count(*) as noQuestions FROM questions WHERE questionsAsig = ?;";
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        die("something went wrong");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s",$asigName );
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    $resultArray = mysqli_fetch_assoc($resultData);
    $noQuestions = $resultArray['noQuestions'];
    return $noQuestions;
}

function emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat, $position){
    $result = true;
    if(empty($name) || empty($email)||empty($username)||empty($pwd)||empty($pwdRepeat)||empty($position)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function invalidEmail($email){
    $result = true;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function pwdMatch($pwd, $pwdRepeat){
    $result = true;
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

    if ($row = mysqli_fetch_assoc($resultData)) {
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
    $result = true;
    if(empty($username)||empty($pwd)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function loginUser($connection, $username, $pwd){
    $uidExists = uidExists($connection, $username, $username);
    print("<p>test</p>");
    if ($uidExists === false) {
        header("location: ../login.php?error=wrongusername");
        exit();
    }
    
    $pwdHashed = $uidExists["usersPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);
    if ($checkPwd === false){
        header("location: ../login.php?error=wrongpassword");
        exit();
    }
    elseif($checkPwd === true){
        session_start();
        $_SESSION["userid"] = $uidExists["usersId"];
        $_SESSION["useruid"] = $uidExists["usersUid"];
        $_SESSION["userName"] = $uidExists["usersName"];
        $_SESSION["userpos"] = $uidExists["usersPos"];
        //TODO send to Home page
        if($_SESSION["userpos"]==="Professor"){
            header("location: ../profe.php");
            exit();
        }

        header("location: ../index.php");
        exit();
    }
}

function deleteUser($connection, $userId){
    $sql = "delete from users where usersId = $userId";
    mysqli_query($connection, $sql) or die ("Failed to delete User");
}

function emptyInputQuestion($topic, $newtopic, $question, $answer1, $answer2){
    $result = true;
    if(empty($topic) || empty($question)||empty($answer1)||empty($answer2))
        $result = true;
    elseif (ctype_space($answer1) || ctype_space($answer2))
        $result = true;
    elseif($topic === "add Topic" && empty($newtopic))
        $result = true;
    else $result = false;
    return $result;
}

function invalidCheckbox($correctanswer, $answer3, $answer4){
    $result = true;
    if($correctanswer === "3" && (ctype_space($answer3)||empty($answer3)))
    {
        $result = true;
    }
    elseif($correctanswer === "4" && (ctype_space($answer4)||empty($answer4))){
        $result = true;
    }
    else{
        $result=false;
    }
    return $result;
}

function invalidTopic($topic, $newtopic){
    $result = true;
    if ($topic !== "add Topic" && !empty($newtopic))
    $result = true;
    else $result = false;
    return $result;
}

function createQuestion($connection, $course, $topic, $newtopic, $question, $answer1, $answer2, $answer3, $answer4, $correctanswer){
    $sql = "Insert into questions (questionsAsig, questionsTopic, questionsQuestion, questionsAnswer_1, questionsAnswer_2, questionsAnswer_3, questionsAnswer_4, questionsCorrect_answer) values (?,?,?,?,?,?,?,?);";
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../editquestion.php?error=stmtfailed");
        exit();
    }
    if ($topic === "add Topic")
        $topic = $newtopic;
    mysqli_stmt_bind_param($stmt, "ssssssss", $course, $topic, $question, $answer1, $answer2, $answer3, $answer4, $correctanswer);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../editquestion.php?error=none");
        exit();
}

function start_exam($asigName, $noQuestions, $connection){
    $sql = "UPDATE `courses` SET `coursesExam_running` = '1', `coursesNoQuestions` = ? WHERE `courses`.`coursesAsig` = ?";
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        die("SQL error");
    }
    mysqli_stmt_bind_param($stmt, "is", $noQuestions, $asigName );
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../profe.php?");
    exit();
}

function stop_exam($asigName, $connection){
    $sql = "UPDATE `courses` SET `coursesExam_running` = '0' WHERE `courses`.`coursesAsig` = ?";
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        die("SQL error");
    }
    mysqli_stmt_bind_param($stmt, "s",$asigName );
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../profe.php?");
    exit();
}

function deleteQuestion($connection, $questionId){
    $sql = "delete from questions where questionsQuestion_id = $questionId";
    mysqli_query($connection, $sql) or die ("Failed to delete Question");
}

function examAlreadyTaken($connection, $idUser, $course){
    $result = true;
    $sql_Done = "Select Distinct answersUid from answers where answersUid = '$idUser' and answersAsig = '$course';";
    $query_Done = mysqli_query($connection, $sql_Done);
    $result_Done = mysqli_fetch_row($query_Done) or die("Failed to Access Database");
    if (isset($result_Done[0])){
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function examOver($connection, $course){
    $result = true;
    $sql = "select coursesExam_running from courses where coursesAsig ='$course';";
    $query = mysqli_query($connection, $sql) or die ("Failed Accessing Exam_running");
    $Exam_running = mysqli_fetch_row($query);
    if ($Exam_running[0]==0){
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}