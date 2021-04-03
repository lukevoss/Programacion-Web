<?php
session_start();


if (isset($_POST['startExam'])){
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
    $idUser= $_SESSION['userid'];
    $course=$_SESSION['course'];
    
    if (examAlreadyTaken($connection, $idUser, $course)){
        header("location: ../student.php?error=examalreadytaken");
        exit();
    }

    if (examOver($connection, $course)){
        header("location: ../student.php?error=examover");
        exit();
    }

    header("location: ../exam.php");
    exit();
}
else{
    header("location: ../student.php");
    exit();
}