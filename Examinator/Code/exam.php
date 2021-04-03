<?php
    include_once 'header.php';
    if(isset($_SESSION["userid"]) && $_SESSION["userpos"]==="Student"){
?>

<?php
    require_once 'dbh.inc.php';
    $course = $_POST['course'];
    $_SESSION['course'] = $course;
    $sql_numQuestions = "select * from courses where coursesAsig = ".$course."';";
    $query_course = mysqli_query($connection, $sql_numQuestions) or die ("Wrong SQL Command");
    $result_course = mysqli_fetch_assoc($query_course);
    $nQuestions = $result_course['coursesNoQuestions'];
    $examRunning = $result_course['coursesExam_running'];
    if (!$examRunning){
        header("location: ../student.php?error=examnotstarted");
        exit(); 
    }
    /*$sql_topics = "select questionsTopic from questions where questionsAsig = $course";
    $query_topics = mysqli_query($connection, $sql_topics) or die ("Wrong SQL Command");
    $nTopics = mysqli_num_rows($query_topics);*/
    //TODO: Kp mehr wie ich hier eine gleichmäßige verteilung der Themen erziehlen kann
    //generate Questions
    $sql_questions = "select * from questions where questionsAsig ='".$course."' order by rand() limit $nQuestions;";
    $query_questions = mysqli_query($connection, $sql_questions);
    echo "<form action='exam.inc.php' method='post'>";
    $questions = [];
    for($i = 0; $i<$nQuestions;$i++){
        $question = mysqli_fetch_assoc($query_question);
        $id =  $question['questionsQuestion_id'];
        $questions[$i] = $id;
        echo "<h3>" . $question['questionsQuestion'] . "</h3>";
        
        //Answer 1
        echo "<input type='radio' name='". $id ."' id='1' value='1'>";
        echo "<label for='1'>". $question['questionsAnswer_1'] ."</label>";
        //Answer 2
        echo "<input type='radio' name='".$id ."' id='2' value='2'>";
        echo "<label for='2'>". $question['questionsAnswer_2'] ."</label>";
        //Answer 3
        echo "<input type='radio' name='".$id ."' id='3' value='3'>";
        echo "<label for='3'>". $question['questionsAnswer_3'] ."</label>";
        //Answer 4
        echo "<input type='radio' name='".$id ."' id='4' value='4'>";
        echo "<label for='4'>". $question['questionsAnswer_4'] ."</label>";

    }
    $_SESSION['questions'] = $questions;
    echo "<input type='submit' name='examsubmitted' value='Done!'>";
    echo "</form>";
?>

<?php
    }
    else{
        echo "<h1> Error: Access not granted</h1>";
    }
    include_once 'footer.php'
?>