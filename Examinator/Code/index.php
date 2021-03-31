<?php
    include_once 'header.php'
?>
<section class="index-intro">
    <?php
        if (isset($_SESSION["useruid"])) {
            echo "<h1>Hello " . $_SESSION["userName"] . "!</h1>";
        }
        else {
            echo "<h1>Welcome!</h1>";
            echo "<p>Please <a href='login.php'>Log in</a> first</p>";

        }
    ?>
</section>

<?php
    include_once 'footer.php'
?>
