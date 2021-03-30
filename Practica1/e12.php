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
echo "Result: ";
if ($_POST["conversion"] == 1)
{
    echo $_POST["amount"]/166.386;
    echo " Euros";
}
else
{
    echo $_POST["amount"]/180.386;
    echo " Dolar";
}
?>
</body>
</html>