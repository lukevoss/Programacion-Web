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
                $sql = "select * from courses,users where coursesFaculty = '" . $_SESSION['userfaculty'] . "' and coursesProfId = usersId order by coursesAsig asc;";
                $query = mysqli_query($connection, $sql) or die ("Failed Access to Table, check SQL");
                $nrows = mysqli_num_rows($query);
                if($nrows >0){
            ?>
            <form action="includes/deletecourses.inc.php" method="post">
                <table>
                <tr>
                <th>Course</th>
                <th>Professor</th>
                <th>Exam Running</th>
                <th>Delete</th>

                </tr>
                <?php
                for ($i = 0; $i<$nrows; $i++){
                    $result = mysqli_fetch_array($query);
                    echo "<tr>";
                    echo "<td>" . $result['coursesAsig'] . "</td>";
                    echo "<td>" . $result['usersName'] . "</td>";
                    echo "<td>" . $result['coursesExam_running'] . "</td>";
                    echo "<td><input type='checkbox' name='delete[]' value='" . $result['coursesAsig'] . "'></td>";
                    echo "</tr>";
                }
                ?>
                </table>
                <input type="submit" name="deletecourses" value="Delete Courses">
            </form>
            <?php
                }
                else {
                    echo "There are currently no courses in this faculty";
                }
            ?>
        </div>
        <?php
        if (isset($_GET['deleteerror'])){
            if ($_GET['deleteerror'] == "examrunning") {
                echo "<p>You cant delete Courses if they have currently Exams!</p>";
            }
            if ($_GET['deleteerror'] == "none") {
                echo "<p>Courses have been deleted!</p>";
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
