<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Results</title>
    <LINK REL="stylesheet" TYPE="text/css" HREF="style.css">
</head>
<body>

<h1> Survey Results</h1>

<?php
    $connection = mysqli_connect("localhost", "cursophp", "", "lindavista")
    or die ("Error: Connection to Database failed");
    $instruction = "select * from votos";
    $query = mysqli_query($connection, $instruction)
    or die ("Error: Failed to call instruction to Database");
    $result = mysqli_fetch_array($query);
    $vote_yes = $result['votos1'];
    $vote_no = $result['votos2'];
    $total_votes = $vote_yes + $vote_no;
    //Show Data
    print("<table>\n");
    print("<tr> \n");
    print("<th>Answer</th>\n");
    print("<th>Votes</th>\n");
    print("<th>Percentage</th>\n");
    print("</tr>\n");
    $percentageNo = round(($vote_no/$total_votes)*100, 2);
    $percentageYes = round(($vote_yes/$total_votes)*100, 2);
    print("<tr>\n");
    print("<td>Yes</td>\n");
    print("<td>$vote_yes</td>\n");
    print("<td>$percentageYes</td>\n");
    print("</tr>\n");

    print("<tr>\n");
    print("<td>Yes</td>\n");
    print("<td>$vote_no</td>\n");
    print("<td>$percentageNo</td>\n");
    print("</tr>\n");

    print("</table>\n");

    print("<p>Number of Total Votes: $total_votes\n");
    print("<p><a href = 'ejer2.php'> Go Back to Voting</a></p>\n");
    mysqli_close($connection);
?>
    
</body>
</html>