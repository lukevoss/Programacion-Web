<?php
    include_once 'header.php';
    if(isset($_SESSION["userid"]) && $_SESSION["userpos"]==="Student"){
        $sqlEnrolled = "select * from stud where studId = $_SESSION['userid'];";
        
?>

<?php
    }
    else{
        echo "<h1> Error: Access not granted</h1>";
    }
    include_once 'footer.php'
?>