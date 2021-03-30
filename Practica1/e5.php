<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 5</title>
<style>
table{
    border-collapse: collapse;
    font-family: arial, sans-serif;
    width: 100%
}
td, th {
    border: 1px solid ;
    text-align: center;
    padding: 15px;
}
tr:nth-child(even){
background-color: gray;
}
</style>
</head>
<body>
<?php
define('TAM',10);
echo "<center>";
echo "<table border=2>";
$n = 1;
for ($i = 1; $i <= TAM; $i++)
{
    echo "<tr>";
    for ($j = 1; $j <= TAM; $j++)
    {
        echo "<td> $n </td>";
        $n++;
    }
    echo "</tr>";
}
echo "</center>";
echo "</table>";
?>   
</body>
</html>