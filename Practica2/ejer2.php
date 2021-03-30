<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php
error_reporting(E_ALL);
$submit = $_POST['submit'];
if(isset($submit)){
    print("<h1>Survey. Registered vote</h1>\n");
    $connection = mysqli_connect("localhost", "cursophp", "", "lindavista")
    or die ("failed connecting to Database");
    $instruction = "select votos1, votos2 from votos";
    $query = mysqli_query($connection, $instruction) 
    or die ("Error while selecting data");
    $result = mysqli_fetch_array($query);
    $vote_yes = $result['votos1'];
    $vote_no = $result['votos2'];
    $vote = $_POST['vote'];
    if ($vote == 'Yes')
        $vote_yes = $vote_yes + 1;
    elseif ($vote == 'No')
        $vote_no = $vote_no +1;
    $update_votes = "update votos set votos1=$vote_yes, votos2=$vote_no";
    $actualisation = mysqli_query($connection, $update_votes)
    or die ("The Database could not be updated");
    mysqli_close($connection);
    print("<p> Your vote has bees registered, Thank you!\n </p>");
    print("To see results click <a href='ejer2-results.php'>here</a>\n</p>");
}
else 
{
?>
    <h1>Survey about rising Hous prices</h1>
    <p> Do you think house prices are rising?</p>
    <form action = "ejer2.php" method="POST">
        <input type ="radio" name = "vote" value="Yes" checked>Yes<br>
        <input type ="radio" name = "vote" value="No">No <br>
        <br>
        <input type ="submit" name = "submit" value="vote">
    </form>
    <p>Click <a href="ejer2-result.php"> Here</a> to see results</p>
<?php
}
?>
</body>
</html>