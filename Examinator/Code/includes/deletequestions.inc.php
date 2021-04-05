<?php
if (isset($_POST['deletequestions'])) {
    if (!(isset($_POST['delete']))){
        header("location: ../editquetions.php");
        exit();
    }
    $delete = $_POST['delete'];
    $nrows = count($delete);

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    for ($i = 0; $i<$nrows; $i++){
        deleteQuestion($connection, $delete[$i]);
    }
    header("location: ../editquestion.php?deleteerror=none");
    exit();
}
else{
    header("location: ../editquestion.php");
    exit();
}