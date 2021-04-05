<?php
    $studID = $_SESSION["userid"];
    $asig = $_POST["asig"];
    require_once 'includes/dbh.inc.php';
    $sql = "SELECT * FROM questions, answers WHERE questionsAsig = answersAsig AND questionsQuestion_id = answersQuestion_id AND answersUid = ? AND answersAsig = ?";
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");//TODO
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ss",$studID, $asig );
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    $nfilas = mysqli_num_rows($resultData);