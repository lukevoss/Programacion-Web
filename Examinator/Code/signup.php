<?php
    include_once 'header.php'
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

    
        


<?php
    include_once 'footer.php'
?>
