<?php
    include_once 'header.php';
    if(isset($_POST['asigRunning'])){
        $asigRunning = $_POST['asigRunning'];
        if(isset($_POST['start'])){
            if($_POST['start']==="start"){
                echo "<p>Exam started!</p>";
                //TODO SQL
            }
        }else{
            echo "<p>Exam stopped!</p>";
        }
    }

?>
<body>
    <h1>Welcome to the <abbr title="Student-destroy-Unit">SdU</abbr>!</h1>
    <section class = "select-asig-form">
        <h2>Your courses</h2>
        <?php
            require_once 'includes/getAsig.inc.php';
            if($nfilas===0){
                foreach ($resultData as $asig){ //asig is now an array of one line.
                    $asigName = implode("",$asig); //convert array to string
                    echo $asigName;
                    ?>
                    <form action="editquestion.php" method="post">
                        <input type="hidden" name="asig" value=<?php echo $asigName; ?>>
                        <button type="submit" name="edit">Edit Questions</button>
                    </form>
                    <form action="TODO" method="post">
                        <button type="submit" name="results">View Results</button>
                    </form>
                    <?php
                    $examRunning = mysqli_fetch_row($examRunningSqli);
                    //$eR = implode("",$examRunning);
                    if(!$examRunning[0]){
                        ?>
                        <form action="profe.php" method="post">
                            <input type="hidden" name="asigRunning" value=<?php echo $asigName; ?>>
                            <input type="hidden" name="start" value="start">
                            <button type="submit" name="startExam" value = "test">start Exam</button>
                        </form>
                        <?php
                    }
                    else{
                        ?>
                        <form action="profe.php" method="post">
                            <input type="hidden" name="asigRunning" value=<?php echo $asigName; ?>>
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