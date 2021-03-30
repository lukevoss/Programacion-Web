<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
$v[1]=90;
$v[30]=7;
$v['e']=99;
$v['hola']=43;
foreach ($v as $i => $valor){
    echo "At $i its $valor<br>";
}
?>
</body>
</html>