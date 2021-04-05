<?php
session_start();


if (isset($_POST['examsubmitted'])){
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
    $idUser= $_SESSION['userid'];
    $course=$_SESSION['course'];
    $questions = $_SESSION['questions'];
    
    if (examAlreadyTaken($connection, $idUser, $course)){
        unset($_SESSION["course"]);
        header("location: ../student.php?error=examalreadytaken");
        exit();
    }

    if (examOver($connection, $course)){
        unset($_SESSION["course"]);
        header("location: ../student.php?error=examover");
        exit();
    }

    foreach ($questions as $questionId) {
        $answer = $_POST["$questionId"];
        $sql = "Insert into answers (answersUid, answersAsig, answersQuestion_id, answersAnswer) values ('$idUser','$course','$questionId','$answer');";
        mysqli_query($connection, $sql) or die ("Failed to store Answers");
    }
    header("location: ../viewResultsStudent.php");
    exit();
}
else{
    header("location: ../exam.php");
    exit();
}