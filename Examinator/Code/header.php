<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Examinator</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav>
        <div class="wrapper">
            <ul>
                <?php
                    //Home
                    if (isset($_SESSION["useruid"])) {
                        if($_SESSION["userpos"]==="Professor"){
                            echo "<li><a href='profe.php'>Home</a></li>";
                        }
                        //TODO
                        elseif($_SESSION["userpos"]==="Student"){
                            echo "<li><a href='student.php'>Home</a></li>";
                        }
                        else {
                            echo "<li><a href='index.php'>Home</a></li>";
                        }
                    }
                    else{
                        echo "<li><a href='index.php'>Home</a></li>";
                    }
                    //Signup/Login/Logout
                    if (isset($_SESSION["useruid"])) {
                        if($_SESSION["userpos"]==="Admin"){
                            echo "<li><a href='signup.php'>Administration User</a></li>";
                        }
                       echo "<li><a href='includes/logout.inc.php'>Log out</a></li>"; 
                    }
                    else{
                        echo "<li><a href='login.php'>Log in</a></li>";
                    }
                ?>
                
            </ul>
        </div>
     </nav>

<div class = "wrapper">
