<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Insertar Producto</title>
</head>
<body>
    <?php

        //Las siguientes dos lineas permite mostrar los errores ocurridos en la pagina
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $nombre = $_GET["p_nom"];
        $tipo = $_GET["p_tipo"];

        //Se importa el archivo php con los credenciales de la base
        require("../Base/CredencialesProyecto.php");

        //String de conexion
        $string_connection = "host=".$db_direction." dbname=".$db_name. " user=".$db_username. " password=".$db_password;
        $connection = pg_connect($string_connection) or die("No se pudo conectar".pg_last_error());;

        //Consulta a ejecutar sobre la base
        $query = "Insert into producto (nombre,tipo) Values ('$nombre',$tipo)";

        $resultado = pg_query($connection,$query);

        if($resultado){
            echo "<h1>Insercion exitosa!</h1>";
        }
        else{
            echo "<h1>Insercion fallida!</h1>";
        }

        echo "<h2><a href='../Home/Home.html'>Regresar al home</a></h2>";

        pg_close($connection);
    ?>
</body>
</html>