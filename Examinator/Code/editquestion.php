<?php
    include_once 'header.php'
?>
<?php
    //heading for course
    echo "<h1>" . $_POST['asig'] . "</h1>";
?>
<section class="add-questions-form">
    <h2>Add Question</h2>
    <div class="add-question-form-form">
    <form action="includes/editquestion.inc.php" method="post">
        
        <Label for="topic">Topic:</Label>
        <select name="topic" id="topic">
            <?php
            //show all Topics from that course
            require_once "includes/dbh.inc.php";
            //$sql = "select distinct questionsTopic from questions where questionsAsig = " . $course .";";
            $sql = "select questionsTopic from questions where questionsAsig ='".  $_POST['asig'] ."';";
            $query = mysqli_query($connection, $sql) or die ("Ups, something went wrong!");
            $nrows = mysqli_num_rows($query);
            //BETTER for each
            for($i = 0; $i<$nrows; $i++){
                $result = mysqli_fetch_array($query);
                //replace all whitespaces to get a unique value without spaces
                echo "<option value='" . $result['questionsTopic'] . "'>" . $result['questionsTopic'] . "</option>";
            }
            ?>
            <option value="add Topic">+ add Topic</option>
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
                <input type="radio" name="correctanswer" id="1" value="1" checked>
                </td>
            </tr>
            <tr>
                <td>
                <input type="text" name="answer2" size="50">
                </td>
                <td>
                <input type="radio" name="correctanswer" id="2" value="2">
                </td>
            </tr>
            <tr>
                <td>
                <input type="text" name="answer3" size="50">
                </td>
                <td>
                <input type="radio" name="correctanswer" id="3" value="3">
                </td>
            </tr>
            <tr>
                <td>
                <input type="text" name="answer4" size="50">
                </td>
                <td>
                <input type="radio" name="correctanswer" id="4" value="4">
                </td>
            </tr>
        </table>
        <?php
        echo "<input type='hidden' name='course' value =". $_POST['asig'] .">";
        ?>
        <input type="submit" name="addquestion" value="Add Question">
    </form>
    </div>
    <?php
        if (isset($_GET['error'])){
            if ($_GET['error'] == "emptyinput") {
                echo "<p>Fill in all fields! Answer 1 and 2 have to be filled!</p>";
            }
            elseif ($_GET['error'] == "invalidcheckbox") {
                echo "<p>Correct Answer can't be Empty!</p>";
            }
            elseif ($_GET['error'] == "invalidTopic") {
                echo "<p>Please clear Field 'New Topic' to add question to choosen Topic!</p>";
            }
            elseif ($_GET['error'] == "stmtfailed") {
                echo "<p> Something went wrong, try again!</p>";
            }
            elseif ($_GET['error'] == "none") {
                echo "<p>New Question added!</p>";
            }
        }
        ?>
</section>

<section class="delete-form">
    <h2>Delete Question</h2>
    <div class="delete-form-form">
    
    </div>
</section>

<?php
    include_once 'footer.php'
?>
