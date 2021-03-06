<?php
session_start();


if (isset($_POST['startExam'])){
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
    $idUser= $_SESSION['userid'];
    $course=$_POST['startExam'];
    $_SESSION['course'] = $course;
    
    if (examAlreadyTaken($connection, $idUser, $course)){
        unset($_SESSION['course']);
        header("location: ../student.php?error=examalreadytaken");
        exit();
    }

    if (examOver($connection, $course)){
        unset($_SESSION['course']);
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