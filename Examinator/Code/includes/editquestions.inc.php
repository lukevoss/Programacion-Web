if (isset($_POST['submit'])){
    
    $topic = $_POST['topic'];
    $newtopic = $_POST['newtopic'];
    $question = $_POST['question'];
    $answer1 = $_POST['answer1'];
    $correctanswer1 = $_POST['correctanswer1'];
    $answer2 = $_POST['answer2'];
    $correctanswer2 = $_POST['correctanswer2'];
    $answer3 = $_POST['answer3'];
    $correctanswer3 = $_POST['correctanswer3'];
    $answer4 = $_POST['answer4'];
    $correctanswer4 = $_POST['correctanswer4'];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat, $position) !== false) {
        header("location: ../signup.php?error=emptyinput");
        exit();   
    }
    //if (invalidUid($username) !== false) {
    //    header("location: ../signup.php?error=invaliduid");
    //    exit();   
    //}

    if (invalidEmail($email) !== false) {
        header("location: ../signup.php?error=invalidemail");
        exit();   
    }
    if (pwdMatch($pwd, $pwdRepeat) !== false) {
        header("location: ../signup.php?error=pwddontmatch");
        exit();   
    }
    if (uidExists($connection, $username, $email) !== false) {
        header("location: ../signup.php?error=usernametaken");
        exit();   
    }

    createUser($connection, $name, $email, $username, $pwd, $position);
}
else{
    header("location: ../signup.php");
    exit();
}