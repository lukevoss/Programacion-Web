<html lang="en">

<head>
    <TITLE>Consulta de noticias</TITLE>
    <link REL="stylesheet" TYPE="text/css" HREF="style.css">
    <?PHP
    // Incluir bibliotecas de funciones
    //include ("lib/fecha.php");
    ?>

</head>

<body>
<h1> Consulta de noticias </h1>
<?php
    //connectar con base de datos
    $connexion = mysqli_connect("localhost", "cursophp","", "lindavista")
    or die ("No se puede connectar");

    //enviar consulta
    $instruction = "select * from noticias order by fecha desc";
    $consulta = mysqli_query($connexion,$instruction) or die ("Fallo en la consulta");

    //monstrar resultos
    $nfilas = mysqli_num_rows($consulta);
    if ($nfilas > 0){
        print ("<TABLE>\n");
        print ("<TR>\n");
        print ("<TH>Titulo</TH>\n");
        print ("<TH>Texto</TH>\n");
        print ("<TH>Categoria</TH>\n");
        print ("<TH>Fecha</TH>\n");
        print ("<TH>Imagen</TH>\n");
        print ("</TR>\n");

        while($resultado = mysqli_fetch_array($consulta))
        {
            
            print("<tr>\n");
            print("<td>" . $resultado['titulo'] . "</td>\n");
            print("<td>" . $resultado['texto'] . "</td>\n");
            print("<td>" . $resultado['categoria'] . "</td>\n");
            print("<td>" . $resultado['fecha'] . "</td>\n");

            if ($resultado['imagen'] != "")
                print("<td> <a target= '_blank' HREF='img/" . $resultado['imagen'] . 
                    "'><img border = '0' src='img/ico-fichero.gif' alt= 'Imagen Asociada'></a></td>\n");
            else 
                print ("<TD>&nbsp;</TD>\n");
            print("</tr>\n");
        }
        print("</table>\n");
    }
    else 
        print("No hay noticias disponible");

    mysqli_close ($connexion);
?>
</body>
</html>