<?php

if (isset($_POST['examsubmitted'])){
    require_once 'dbh.inc.php';
    $questions = $_SESSION['questions'];
    $idUser= $_SESSION['userid'];
    $course=$_SESSION['course'];

    foreach ($questions as $questionId) {
        $answer = $_POST["$questionId"];
        $sql = "Insert into answers (answersUid, answersAsig, answersQuestion_id, answersAnswer) values ($idUser,$course,$questionId,$answer);";
        mysqli_query($connection, $sql) or die ("Failed to store Answers");
    }
    header("location: ../viewResultsStudent.php");
    exit();
}
else{
    header("location: ../exam.php");
    exit();
}