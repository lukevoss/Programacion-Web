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
if ($path = opendir('fotos'))
{
    echo "<table border=1>";
	echo "<tr>";
	$i=0;
    while (($image = readdir($path)) !== false)
    {
        if (($image != '.' && $image != '..')){
            $imgType = pathinfo($image, PATHINFO_EXTENSION);
            if (($imgType == 'jpg') || ($imgType == 'png')|| ($imgType == 'gif')|| ($imgType == 'bmp'))
            {
                if ($i % 4 == 0)
                {
                    echo "</tr>";
                    echo "<tr>";
                }  
                $i++;
                echo "<td>";
                echo "<a href='fotos/$image'><img src='fotos/$image' width=100 heigth=100>
                </a>";
                echo "</td>";
            }
            
        }
    }
    echo "</tr>";
	echo "</table>";
	
}
closedir($path);

?> 
</body>
</html>