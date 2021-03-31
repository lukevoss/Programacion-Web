<?php
    include_once 'header.php'
?>

    <section class = "login-form">
        <h1>Log In</h2>
        <div class="login-form-form">
            <form action="includes/login.inc.php" method="post">
                <input type="text" name="uid" placeholder="Username/Email">
                <input type="password" name="pwd" placeholder="Passwort">
                <button type="submit" name="submit">Log In</button>
            </form>
        </div>
        <?php
        if (isset($_GET['error'])){
            if ($_GET['error'] == "emptyinput") {
                echo "<p>Fill in all fields!</p>";
            }
            elseif ($_GET['error'] == "wrongusername") {
                echo "<p>The Username or Email you entered doesn't exist!</p>";
            }
            elseif ($_GET['error'] == "wrongpassword") {
                echo "<p>Wrong Password, please try again!</p>";
            }
            elseif ($_GET['error'] == "stmtfailed") {
                echo "<p> Something went wrong, try again!</p>";
            }
        }
        ?>
    </section>


<?php
    include_once 'footer.php'
?>

