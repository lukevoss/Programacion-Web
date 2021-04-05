<?php
if (isset($_POST['deleteuser'])) {
    $select = $_POST['select'];
    $nrows = count($select);

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    for ($i = 0; $i<$nrows; $i++){
        deleteUser($connection, $select[$i]);
    }
    header("location: ../signup.php?deleteerror=none");
    exit();
}elseif (isset($_POST['addAsig']) && isset($_POST['asigName'])) {
    $select = $_POST['select'];
    $nrows = count($select);
    $asigName = $_POST['asigName'];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    for ($i = 0; $i<$nrows; $i++){
        addAsig($connection, $select[$i],$asigName);
    }
    header("location: ../signup.php?error=none");
    exit();
}