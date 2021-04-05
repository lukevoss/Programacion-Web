<?php
if (isset($_POST['deletecourses'])) {
    if (!(isset($_POST['delete']))){
        header("location: ../editcourses.php");
        exit();
    }

    $delete = $_POST['delete'];
    $nrows = count($delete);

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    for ($i = 0; $i<$nrows; $i++){
        if (examRunning($connection, $delete[$i]))
        {
            header("location: ../editcourses.php?deleteerror=examrunning");
            exit();
        }
    }
    
    for ($i = 0; $i<$nrows; $i++){
        deleteCourse($connection, $delete[$i]);
    }
    header("location: ../editcourses.php?deleteerror=none");
    exit();
}
else{
    header("location: ../editcourses.php");
    exit();
}