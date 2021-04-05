<?php
    include_once 'header.php';
    if (isset($_GET['error'])){
        if ($_GET['error'] == "noStudent") {
            echo "<h5>Since there is no Student enrolled in the course there are no results!</h5>";
        }
    }
?>
<body>
    <h1>Welcome to the <abbr title="Student-destroy-Unit">SdU</abbr>!</h1>
    <section class = "select-asig-form">
        <h2>Your courses</h2>
        <?php
            require_once 'includes/getAsig.inc.php';
            require_once 'includes/functions.inc.php';
            if($nfilas>0){
                foreach ($resultData as $asig){ //asig is now an array of one line.
                    $asigName = $asig['coursesAsig']; //convert array to string implode("",$asig)
                    echo "<h3>$asigName</h3>";
                    ?>
                    <form action="editquestion.php" method="post">
                        <input type="hidden" name="asig" value='<?php echo $asigName; ?>'>
                        <button type="submit" name="edit">Edit Questions</button>
                    </form>
                    <form action="viewResultsProfe.php" method="post">
                        <input type="hidden" name="asig" value='<?php echo $asigName; ?>'>
                        <button type="submit" name="results">View Results</button>
                    </form>
                    <?php
                    $examRunning = mysqli_fetch_row($examRunningSqli);
                    $noQuestions = getNumberOfQuestions($asigName,$connection);
                    if(!$examRunning[0]){
                        if($noQuestions>= 1){
                            ?>
                            <form action="includes/startExam.inc.php" method="post">
                                <input type="hidden" name="asigRunning" value='<?php echo $asigName; ?>'>
                                <input type="hidden" name="start" value="start">
                                <label for="numberQuestions">Number of Questions</label>
                                <input type="number" min="1" max=<?php echo $noQuestions; ?> step="1" value='<?php echo round($noQuestions/2,0); ?>' name = "numberQuestions">
                                <button type="submit" name="startExam" value = "test">start Exam</button>
                            </form>
                            <?php
                        }else{
                            echo "<h5>To be able to start the exam you have to add questions first!</h5>";
                        }
                    }
                    else{
                        ?>
                        <form action="includes/stopExam.inc.php" method="post">
                            <input type="hidden" name="asigRunning" value='<?php echo $asigName; ?>'>
                            <button type="submit" name="stopExam">stop Exam</button>
                        </form>
                        <?php
                    }
                    ?>
                    </div>
                    <?php
                }
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