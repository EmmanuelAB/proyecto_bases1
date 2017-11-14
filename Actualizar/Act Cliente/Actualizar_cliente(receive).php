<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <?php
        //Las siguientes dos lineas permite mostrar los errores ocurridos en la pagina
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $cedula = $_GET["c_Cedula"];
        $nombre = $_GET["c_Nombre"];
        $apellido1 = $_GET["c_Apellido1"];
        $apellido2 = $_GET["c_Apellido2"];
        $telefono1 = $_GET["c_Telefono1"];
        $telefono2 = $_GET["c_Telefono2"];
        $direccion = $_GET["c_Direccion"];

        //Se importa el archivo php con los credenciales de la base
        //String de conexion
    require("/var/www/html/ConectDB/Proyecto Taller/CredencialesProyecto.php");

    $string_connection = "host=".$db_direction." dbname=".$db_name. " user=".$db_username. " password=".$db_password;
        $connection = pg_connect($string_connection) or die("No se pudo conectar".pg_last_error());
        //Consulta a ejecutar sobre la base
        $query = 'update'.' "Cliente" '.'set 
                    "Cedula"' . "= $cedula".',
                    "Nombre"'."= '$nombre'".',
                    "Apellido1"'."= '$apellido1'".',
                    "Apellido2"'."= '$apellido2'".',
                    "Telefono1"'. "= $telefono1".',
                    "Telefono2"'."=  $telefono2".',
                    "Direccion"'."= '$direccion'".' where "Cedula"'."= $cedula";

        $resultado = pg_query($connection,$query);

        if($resultado){
            echo "<h1>Actualizacion exitosa!</h1>";
        }
        else{
            echo "<h1>Actualizacion fallida!</h1>";
        }

        echo "<h2><a href='../../Home/Home.html'>Regresar al home</a></h2>";

        pg_close($connection);
    ?>
</body>
</html>
