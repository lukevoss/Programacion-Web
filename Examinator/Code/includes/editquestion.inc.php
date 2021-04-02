<?php
if (isset($_POST['addquestion'])){
    
    $topic = $_POST['topic'];
    $newtopic = $_POST['newtopic'];
    $question = $_POST['question'];
    $answer1 = $_POST['answer1'];
    $answer2 = $_POST['answer2'];
    $answer3 = $_POST['answer3'];
    $answer4 = $_POST['answer4'];
    $correctanswer = $_POST['correctanswer'];
    $course = $_POST['course'];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputQuestion($topic, $newtopic, $question, $answer1, $answer2) !== false) {
        header("location: ../editquestion.php?error=emptyinput");
        exit();   
    }

    if (invalidCheckbox($correctanswer, $answer3, $answer4) !== false) {
        header("location: ../editquestion.php?error=invalidcheckbox");
        exit();   
    }

    if (invalidTopic($topic, $newtopic) !== false) {
        header("location: ../editquestion.php?error=invalidTopic");
        exit();   
    }

    createQuestion($connection, $course, $topic, $newtopic, $question, $answer1, $answer2, $answer3, $answer4, $correctanswer);
}
else{
    header("location: ../editquestion.php");
    exit();
}