<?php
    include_once 'header.php';
    if(isset($_SESSION["userid"]) && $_SESSION["userpos"]==="Student")
    {
?>

<?php
    require_once 'includes/dbh.inc.php';
    require_once 'includes/functions.inc.php';
    if (isset($_SESSION["course"]))
    {
        $course = $_SESSION["course"];
        if(examOver($connection, $course)){
            unset($_SESSION["course"]);
            header("location: ../student.php?error=examover");
            exit();
        }
        

        $sql_numQuestions = "select * from courses where coursesAsig = '".$course."';";
        $query_course = mysqli_query($connection, $sql_numQuestions) or die ("Wrong SQL Command");
        $result_course = mysqli_fetch_assoc($query_course);
        $nQuestions = $result_course['coursesNoQuestions'];
        $examRunning = $result_course['coursesExam_running'];
        if (!$examRunning){
            unset($_SESSION["course"]);
            header("location: ../student.php?error=examnotstarted");
            exit(); 
        }
        //Topics
        $sql_topics = "select distinct questionsTopic from questions where questionsAsig = '$course'";
        $query_topics = mysqli_query($connection, $sql_topics) or die ("Wrong SQL Command");
        $nTopics = mysqli_num_rows($query_topics);
        //Questions
        $nQuestionsPerTopic = round(($nQuestions/$nTopics),0);
        $sql_questionsPerTopic = "CALL GetXRandQuestionsForEachTopic('$course',$nQuestionsPerTopic);";
        $query_questions = mysqli_query($connection, $sql_questionsPerTopic) or die("Can't connect to Database, wrong SQL Code");
        echo "<form action='includes/exam.inc.php' method='post'>";
        $questions = [];
        for($i = 0; $i<$nQuestions;$i++){
            $question = mysqli_fetch_assoc($query_questions);
            $id =  $question['questionsQuestion_id'];
            $questions[$i] = $id;
            echo "<h3>" . $question['questionsQuestion'] . "</h3>";
            echo "<h5>Topic: " . $question['questionsTopic'] . "</h5>";
            
            //Answer 1
            echo "<input type='radio' name='". $id ."' id='1' value='1'>";
            echo "<label for='1'>". $question['questionsAnswer_1'] ."</label>";
            echo "<br>";
            //Answer 2
            echo "<input type='radio' name='".$id ."' id='2' value='2'>";
            echo "<label for='2'>". $question['questionsAnswer_2'] ."</label>";
            echo "<br>";
            //Answer 3
            if(($question['questionsAnswer_3'])!=="")
            {
                echo "<input type='radio' name='".$id ."' id='3' value='3'>";
                echo "<label for='3'>". $question['questionsAnswer_3'] ."</label>";
                echo "<br>";
                if(($question['questionsAnswer_4'])!=="")
                {
                    //Answer 4
                    echo "<input type='radio' name='".$id ."' id='4' value='4'>";
                    echo "<label for='4'>". $question['questionsAnswer_4'] ."</label>";
                    echo "<br>";
                }
            }
            

        }
        $_SESSION['questions'] = $questions;
        echo "<input type='submit' name='examsubmitted' value='Done!'>";
        echo "</form>";
    }
    else {
       echo "<h1> Error: Access not granted</h1>";
    }
?>

<?php
    }
    else{
        echo "<h1> Error: Access not granted</h1>";
    }
    include_once 'footer.php'
?>