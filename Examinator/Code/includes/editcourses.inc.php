<?php
if (isset($_POST['addcourse'])){
    
    $course = $_POST['course'];
    $profId = $_POST['prof'];
    $faculty = $_SESSION['userfaculty'];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputCourse($course, $profId) !== false) {
        header("location: ../editcourses.php?error=emptyinput");
        exit();   
    }

    if (courseAlreadyExists($connection, $course) !== false) {
        header("location: ../editcourses.php?error=coursealreadyexists");
        exit();   
    }

    createCourse($connection, $course, $profId, $faculty);
}
else{
    header("location: ../editcourses.php");
    exit();
}