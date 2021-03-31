<?php
    include_once 'header.php'
?>

<?php
if(isset($_SESSION["userid"]) && $_SESSION["userpos"]==="Admin"){
?>
    <section class="signup-form">
        <h2>Sign Up User</h2>
        <div class="signup-form-form">
            <form action="includes/signup.inc.php" method="post">
                <input type="text" name="name" placeholder="Full name">
                <input type="text" name="email" placeholder="Email">
                <input type="text" name="uid" placeholder="Username">
                <input type="password" name="pwd" placeholder="Password">
                <input type="password" name="pwdrepeat" placeholder="Repeat password">
                <select name="position" id="position">
                    <option value="student" selected>Student</option>
                    <option value="professor" selected>Professor</option>
                    <option value="admin" selected>Admin</option>
                </select>
                <button type="submit" name="submit">Sign Up</button>
            </form>
        </div>
        <?php
        if (isset($_GET['error'])){
            if ($_GET['error'] == "emptyinput") {
                echo "<p>Fill in all fields!</p>";
            }
            /*elseif ($_GET['error'] == "invaliduid") {
                echo "<p> Choose a proper username!</p>";
            }*/
            elseif ($_GET['error'] == "invalidemail") {
                echo "<p>Choose a proper Email!</p>";
            }
            elseif ($_GET['error'] == "pwddontmatch") {
                echo "<p> Passwords don't match!</p>";
            }
            elseif ($_GET['error'] == "stmtfailed") {
                echo "<p> Something went wrong, try again!</p>";
            }
            elseif ($_GET['error'] == "usernametaken") {
                echo "<p>Username already taken!</p>";
            }
            elseif ($_GET['error'] == "none") {
                echo "<p>User is signed up!</p>";
            }
        }
        ?>
    </section>
    

    <section class="delete-form">
        <h2> Delete User</h2>
        <div class="delete-form-form">
            <?php
                require_once 'includes/dbh.inc.php';
                $sql = "select * from users where usersID <> " . $_SESSION['userid'] . " order by usersName asc;";
                $query = mysqli_query($connection, $sql) or die ("Failed Access to Table, check SQL");
                $nrows = mysqli_num_rows($query);
                if($nrows >0){
            ?>
            <form action="includes/delete.inc.php" method="post">
                <table>
                <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Username</th>
                <th>Password</th>
                <th>Position</th>
                <th>Delete</th>
                </tr>
                <?php
                for ($i = 0; $i<$nrows; $i++){
                    $result = mysqli_fetch_array($query);
                    echo "<tr>";
                    echo "<td>" . $result['usersId'] . "</td>";
                    echo "<td>" . $result['usersName'] . "</td>";
                    echo "<td>" . $result['usersEmail'] . "</td>";
                    echo "<td>" . $result['usersUid'] . "</td>";
                    echo "<td>" . $result['usersPwd'] . "</td>";
                    echo "<td>" . $result['usersPos'] . "</td>";
                    echo "<td><input type='checkbox' name='delete[]' value='" . $result['usersId'] . "'></td>";
                    echo "</tr>";
                }
                ?>
                </table>
                <input type="submit" name="deleteuser" value="Delete Users">
            </form>
            <?php
                }
                else {
                    echo "There are currently no users other than you";
                }
            ?>
        </div>
        <?php
        if (isset($_GET['deleteerror'])){
            if ($_GET['deleteerror'] == "none") {
                echo "<p>Users have been deleted!</p>";
            }
        }
        ?>
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
