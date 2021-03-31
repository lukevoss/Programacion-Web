<?php
    include_once 'header.php'
?>
<section class="index-intro">
    <?php
        if (isset($_SESSION["useruid"])) {
            echo "<h1>Hello " . $_SESSION["useruid"] . "!</h1>";
        }
    ?>
</section>
<?php
    include_once 'footer.php'
?>
