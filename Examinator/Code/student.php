<?php
    include_once 'header.php';
?>
<body>
    <h1>Course Overview!</h1>
    <section class = "select-asig-form">
        <h2>Your courses:</h2>
        <?php
            require_once 'includes/getAsigStud.inc.php';
            require_once 'includes/functions.inc.php';
            if($nfilas === 0){
                echo "<h3>You don't have any courses</h3>";
            }else{
                while($resultRow = mysqli_fetch_row($resultData)){
                    $examRunning = $resultRow[1];
                    $asigName = $resultRow[0];
                    echo "<h3>$asigName</h3>";
                    ?>
                    <form action="viewResultsStudent.php" method="post">
                        <input type="hidden" name="asig" value=<?php echo $asigName; ?>>
                        <button type="submit" name="edit">view Results</button>
                    </form>
                    <?php
                    if($examRunning){
                        ?>
                        <form action="includes/student.inc.php" method="post">
                            <button type="submit" name="startExam" value = <?php echo $asigName; ?>>start Exam</button>
                        </form>
                        <?php
                    }
                    ?>
                    </div>
                    <?php
                    } 
            }          
        if (isset($_GET['error'])){
            if ($_GET['error'] == "examalreadytaken") {
                echo "<p>You already completed this Exam!</p>";
            }
            elseif ($_GET['error'] == "examover") {
                echo "<p>The Exam ended bevore you submitted, your answers were not submitted! :(</p>";
            }
            else{
            echo "<p>Unexpected Error occured!</p>";
            }
        }
        ?>
    </section>

</body>

<?php
    include_once 'footer.php'
?>