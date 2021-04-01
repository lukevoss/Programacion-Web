<?php
    include_once 'header.php'
?>
<?php
    //heading for course
    echo "<h1>" . $_GET['course'] . "</h1>";
?>
<section class="add-questions-form">
    <h2>Add Question</h2>
    <div class="add-question-form-form">
    <form action="includes/editquestions.inc.php" method="post">
        
        <Label for="topic">Topic:</Label>
        <select name="topic" id="topic">
            <?php
            //show all Topics from that course
            require_once "includes/dbh.inc.php";
            //$sql = "select distinct questionsTopic from questions where questionsAsig = " . $course .";";
            $sql = "select questionsTopic from questions where questionsAsig =".  $_GET['course'] .";";
            $query = mysqli_query($connection, $sql) or die ("Ups, something went wrong!");
            $nrows = mysqli_num_rows($query);
            //BETTER for each
            for($i = 0; $i<$nrows; $i++){
                $result = mysqli_fetch_array($query);
                //replace all whitespaces to get a unique value without spaces
                echo "<option value=" . preg_replace('/\s+/', '', $result['questionsTopic']) . ">" . $result['questionsTopic'] . "</option>";
            }
            ?>
        </select>
        <label for="newtopic">New Topic:</label>
        <input type="text" name="newtopic">
        <br>
        <label for="question">Question:</label>
        <input type="text" name="question" size="50">
        <br>
        <table>
            <tr>
            <th>Answers:</th>
            <th>Correct Answer:</th>
            </tr>
            <tr>
                <td>
                <input type="text" name="answer1" size="50">
                </td>
                <td>
                <input type="checkbox" name="correctanswer1" id="correctanswer1">
                </td>
            </tr>
            <tr>
                <td>
                <input type="text" name="answer2" size="50">
                </td>
                <td>
                <input type="checkbox" name="correctanswer2" id="correctanswer2">
                </td>
            </tr>
            <tr>
                <td>
                <input type="text" name="answer3" size="50">
                </td>
                <td>
                <input type="checkbox" name="correctanswer3" id="correctanswer3">
                </td>
            </tr>
            <tr>
                <td>
                <input type="text" name="answer4" size="50">
                </td>
                <td>
                <input type="checkbox" name="correctanswer4" id="correctanswer4">
                </td>
            </tr>
        </table>
        <input type="submit" value="Add Question">
    </form>
    </div>
</section>

<section class="delete-form">
    <h2>Delete Question</h2>
    <div class="delete-form-form">
    
    </div>
</section>

<?php
    include_once 'footer.php'
?>
