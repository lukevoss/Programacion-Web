<?php
if (isset($_POST['deleteuser']) && isset($_POST['select'])) {
    if (!(isset($_POST['select']))){
        header("location: ../signup.php");
        exit();
    }
    $select = $_POST['select'];
    $nrows = count($select);

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    for ($i = 0; $i<$nrows; $i++){
        deleteUser($connection, $select[$i]);
    }
    header("location: ../signup.php?deleteerror=none");
    exit();
}elseif (isset($_POST['assignAsig']) && isset($_POST['asigName']) && isset($_POST['select'])) {
    $select = $_POST['select'];
    $nrows = count($select);
    $asigName = $_POST['asigName'];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
    $error = "none";
    for ($i = 0; $i<$nrows; $i++){
        if(!addAsig($connection, $select[$i],$asigName)){
            $error = "notastudent";
        }
    }
    header("location: ../signup.php?error=" . $error);
    exit();
}