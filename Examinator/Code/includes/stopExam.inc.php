<?php
require_once 'includes/functions.inc.php';
require_once 'includes/dbh.inc.php';
//if(isset($_POST['asigRunning'])){
    $asigRunning = $_POST['asigRunning'];
//    if(isset($_POST['start'])){
//        if($_POST['start']==="start"){
//            start_exam($asigRunning, $connection);
//            echo "<p>Exam started!</p>";
//        }
//    }else{
        stop_exam($asigRunning, $connection);
        echo "<p>Exam stopped!</p>";
//    }
//}
header("refresh: 0, url=../profe.php");
//header("refresh: 0");
//echo "<meta http-equiv='Refresh' content='0; url='../profe.php' />";
//header("location: ../profe.php?error=none");
    exit();