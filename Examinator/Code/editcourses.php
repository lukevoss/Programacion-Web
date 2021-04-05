<?php
    include_once 'header.php'
?>

<?php
if(isset($_SESSION["userid"]) && $_SESSION["userpos"]==="Admin"){
    echo "<h1>" . $_SESSION['userfaculty'] . "</h1>";
?>
    <section class="course-form">
        <h2>Add Course</h2>
        <div class="course-form-form">
            <form action="includes/editcourses.inc.php" method="post">
                <input type="text" name="course" placeholder="Name of Course">
                <select name="prof" id="prof">
                    <?php
                    //show all Topics from that course
                    require_once "includes/dbh.inc.php";
                    $sql = "select usersId, usersName from users where usersPos = 'Professor' and usersFaculty = '" . $_SESSION['userfaculty'] . "' order by usersName asc;";
                    $query = mysqli_query($connection, $sql) or die ("Ups, something went wrong!");
                    $nrows = mysqli_num_rows($query);
                    for($i = 0; $i<$nrows; $i++){
                        $result = mysqli_fetch_array($query);
                        echo "<option value='" . $result['usersId'] . "'>" . $result['usersName'] . "</option>";
                    }
                    ?>
                </select>
                <button type="submit" name="addcourse">Add Course</button>
            </form>
        </div>
        <?php
        if (isset($_GET['error'])){
            if ($_GET['error'] == "emptyinput") {
                echo "<p>Fill in all fields!</p>";
            }
            elseif ($_GET['error'] == "coursealreadyexists") {
                echo "<p>This Course already exists in the Database</p>";
            }
            elseif ($_GET['error'] == "none") {
                echo "<p>New Course added!</p>";
            }
        }
        ?>
    </section>


    <section class="delete-form">
    <h2>Delete Courses</h2>
        <div class="delete-form-form">
            <?php
                require_once 'includes/dbh.inc.php';
                $sql = "select * from courses where coursesFaculty = '" . $_SESSION['userfaculty'] . "' order by coursesAsig asc;";
                $query = mysqli_query($connection, $sql) or die ("Failed Access to Table, check SQL");
                $nrows = mysqli_num_rows($query);
                if($nrows >0){
            ?>
            <form action="includes/deletequestions.inc.php" method="post">
                <table>
                <tr>
                <th>Topic</th>
                <th>ID</th>
                <th>Question</th>
                <th>1. Answer</th>
                <th>2. Answer</th>
                <th>3. Answer</th>
                <th>4. Answer</th>
                <th>Correct Answer</th>
                </tr>
                <?php
                for ($i = 0; $i<$nrows; $i++){
                    $result = mysqli_fetch_array($query);
                    echo "<tr>";
                    echo "<td>" . $result['questionsTopic'] . "</td>";
                    echo "<td>" . $result['questionsQuestion_id'] . "</td>";
                    echo "<td>" . $result['questionsQuestion'] . "</td>";
                    echo "<td>" . $result['questionsAnswer_1'] . "</td>";
                    echo "<td>" . $result['questionsAnswer_2'] . "</td>";
                    echo "<td>" . $result['questionsAnswer_3'] . "</td>";
                    echo "<td>" . $result['questionsAnswer_4'] . "</td>";
                    echo "<td>" . $result['questionsCorrect_answer'] . "</td>";
                    echo "<td><input type='checkbox' name='delete[]' value='" . $result['questionsQuestion_id'] . "'></td>";
                    echo "</tr>";
                }
                ?>
                </table>
                <input type="submit" name="deletequestions" value="Delete Questions">
            </form>
            <?php
                }
                else {
                    echo "There are currently no questions in this course";
                }
            ?>
        </div>
        <?php
        if (isset($_GET['deleteerror'])){
            if ($_GET['deleteerror'] == "none") {
                echo "<p>Questions have been deleted!</p>";
            }
        }
        ?>
    </div>
</section>

    <?php
    }
    else{
        echo "<h1> Error: Access not granted</h1>";
    }
    ?>

<?php
    include_once 'footer.php'
?>
