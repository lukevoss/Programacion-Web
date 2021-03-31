<?php
if (isset($_POST['deleteuser'])) {
    $delete = $_POST['delete'];
    $nrows = count($delete);

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    for ($i = 0; $i<$nrows; $i++){
        deleteUser($connection, $delete[$i]);
    }
    header("location: ../signup.php?deleteerror=none");
    exit();
}