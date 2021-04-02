<?php
 //asig names
        require_once 'includes/dbh.inc.php';
        $sql = "SELECT studAsig, coursesExam_running FROM stud, courses WHERE studAsig = coursesAsig AND studUid = ?";
        $stmt = mysqli_stmt_init($connection);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../signup.php?error=stmtfailed");//TODO
            exit();
        }
        $studID = $_SESSION["userid"];
        mysqli_stmt_bind_param($stmt, "s",$studID );
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);
        $nfilas = mysqli_num_rows($resultData);
