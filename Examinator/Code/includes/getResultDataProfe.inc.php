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
    $studId= $studentArray[0];
    $sql = "SELECT * FROM questions, answers WHERE questionsAsig = answersAsig AND questionsQuestion_id = answersQuestion_id AND answersUid = ? AND answersAsig = ?";
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        die("something went wrong");//TODO
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ss",$studID, $asig );
    mysqli_stmt_execute($stmt);
    $aux = mysqli_stmt_get_result($stmt);
    $nQuestions = mysqli_num_rows($aux);

//// real sql to get data.. count counts only correct answers for each student ////
  
    $sql = "SELECT studId, usersName, usersEmail, COUNT(*) FROM stud, users, questions, answers WHERE studAsig = ? AND studAsig = questionsAsig AND studId = usersId AND questionsQuestion_id = answersQuestion_id AND questionsCorrect_answer = answersAnswer ORDER BY studId";
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        die("someting went wrong!");//TODO
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $asig );
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    $nfilas = mysqli_num_rows($resultData);
