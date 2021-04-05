<?php
    $asig = $_POST['asig'];
    require_once 'includes/dbh.inc.php';

////following part just to get number of questions////

    $sql = "SELECT studId FROM stud WHERE studAsig = ? LIMIT 1";
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        die("someting went wrong!");//TODO
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $asig );
    mysqli_stmt_execute($stmt);
    $studentsqli = mysqli_stmt_get_result($stmt);
    if(!($studentArray = mysqli_fetch_row($studentsqli))){
        header("location: profe.php?error=noStudent");
        exit();
    }
    $sql = "SELECT COUNT(*) AS nQuestions FROM questions, answers WHERE questionsAsig = answersAsig AND questionsQuestion_id = answersQuestion_id AND answersAsig = ? GROUP BY answersUid LIMIT 1";
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        die("something went wrong");//TODO
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $asig );
    mysqli_stmt_execute($stmt);
    $aux = mysqli_stmt_get_result($stmt);
    $array = mysqli_fetch_assoc($aux);
    $nQuestions = $array['nQuestions'];

//// real sql to get data.. count counts only correct answers for each student ////
  
$sql = "SELECT first.studId, first.usersName, first.usersEmail, second.points \n"
. "FROM (SELECT distinct studId, usersName, usersEmail FROM stud, users, answers WHERE studAsig = ? AND  studId = usersId AND answersUid = studId AND answersAsig = ?) AS first \n"
. "LEFT JOIN \n"
. "(SELECT studId, COUNT(*) AS points FROM stud, users, questions, answers WHERE studAsig = ? AND studAsig = questionsAsig AND studId = usersId AND questionsQuestion_id = answersQuestion_id AND questionsCorrect_answer = answersAnswer AND answersUid = studId GROUP BY studId) AS second ON first.studId = second.studId ORDER BY usersName";
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        die("someting went wrong!");//TODO
        exit();
    }
    mysqli_stmt_bind_param($stmt, "sss", $asig, $asig, $asig );
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    $nfilas = mysqli_num_rows($resultData);
