<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<style>
table{
    border-collapse: collapse;
    font-family: arial, sans-serif;
}
th, td{
    border: 1px solid black;
    text-align: center;
    padding: 15px;
}
</style>
</head>
<body>
<?php
define ('TAM', 4);
function potencia($a, $b){
    $result = pow($a, $b);
    return $result;
}
echo "<center>";
echo "<table>";
for ($i = 1; $i <= TAM; $i++)
{
    echo "<tr>";
    for ($j = 1; $j <= TAM; $j++){
        echo "<td>" . potencia($i, $j) . "</td>";
    }
    echo "</tr>";
}
echo "</table>";
echo "</center>";

?>
</body>
</html>