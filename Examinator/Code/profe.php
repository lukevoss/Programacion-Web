<?php
    include_once 'header.php'
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
                    <form action="test.php" method="post">
                        <input type="hidden" name="asig" value=<?php echo $asigName; ?>>
                        <button type="submit" name="edit">Edit Questions</button>
                    </form>
                    <form action="TODO" method="post">
                        <button type="submit" name="results">View Results</button>
                    </form>
                    <?php
                    $examRunning = mysqli_fetch_row($examRunningSqli);
                    //$eR = implode("",$examRunning);
                    if($examRunning[0]){
                        ?>
                        <form action="TODO" method="post">
                            <button type="submit" name="startExam">start Exam</button>
                        </form>
                        <?php
                    }
                    else{
                        ?>
                        <form action="TODO" method="post">
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