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
                <li><a href="index.php">Home</a></li>
                <li><a href="discover.php">About Us</a></li>
                <li><a href="blog.php">Find Blog</a></li>
                <?php
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
</body>
</html>