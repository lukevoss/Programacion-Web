<?php
 //asig names
        require_once 'includes/dbh.inc.php';
        $sql = "SELECT coursesAsig FROM `courses` WHERE coursesProfId = ?;";
        $stmt = mysqli_stmt_init($connection);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../signup.php?error=stmtfailed");
            exit();
        }
        $profId = $_SESSION["userid"];
        mysqli_stmt_bind_param($stmt, "s",$profId );
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);
        $nfilas = mysqli_stmt_num_rows($stmt);

// exam running

        $sql = "SELECT coursesExam_running FROM `courses` WHERE coursesProfId = ?;";
        $stmt = mysqli_stmt_init($connection);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../signup.php?error=stmtfailed");
            exit();
        }
        $profId = $_SESSION["userid"];
        mysqli_stmt_bind_param($stmt, "s",$profId );
        mysqli_stmt_execute($stmt);
        $examRunningSqli = mysqli_stmt_get_result($stmt);
        

        /**while($asigName = $stmt->fetch()){
            echo $asigName;
         }
         
         $stmt->free_result();
         $stmt->close();**/