<?php
    include_once 'header.php';
?>
<body>
    <h1>Course Overview!</h1>
    <section class = "select-asig-form">
        <h2>Your courses</h2>
        <?php
            require_once 'includes/getAsigStud.inc.php';
            require_once 'includes/functions.inc.php';
            while($resultRow = mysqli_fetch_row($resultData)){
                $examRunning = $resultRow[1];
                $asigName = $resultRow[0];
                echo "<h3>$asigName</h3>";
                ?>
                <form action="editquestion.php" method="post">
                    <input type="hidden" name="asig" value=<?php echo $asigName; ?>>
                    <button type="submit" name="edit">view Results</button>
                </form>
                <?php
                if(!$examRunning){
                    ?>
                    <form action="includes/startExam.inc.php" method="post">
                        <input type="hidden" name="asigRunning" value=<?php echo $asigName; ?>>
                        <input type="hidden" name="start" value="start">
                        <label for="numberQuestions">Number of Questions</label>
                        <input type="number" min="1" max="999" step="1" value="20" name = "numberQuestions">
                        <button type="submit" name="startExam" value = "test">start Exam</button>
                    </form>
                    <?php
                }
                else{
                    ?>
                    <form action="includes/stopExam.inc.php" method="post">
                        <input type="hidden" name="asigRunning" value=<?php echo $asigName; ?>>
                        <button type="submit" name="stopExam">stop Exam</button>
                    </form>
                    <?php
                }
                ?>
                </div>
                <?php
                }
            
        if (isset($_GET['error'])){
            echo "<p>Unexpected Error occured!</p>";
        }
        ?>
    </section>

</body>

<?php
    include_once 'footer.php'
?>