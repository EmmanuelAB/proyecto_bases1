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

        $id_entrada = $_GET["ex_ide"];
        $cedula = $_GET["ex_ced"];
        $fecha = $_GET["ex_fec"];
        $codigo_producto = $_GET["ex_cod"];
        $cantidad = $_GET["ex_can"];
        $total = $_GET["ex_pre"];
        $descripcion = $_GET["ex_des"];

        //Se importa el archivo php con los credenciales de la base
        require("../Base/CredencialesProyecto.php");

        //String de conexion
        $string_connection = "host=".$db_direction." dbname=".$db_name. " user=".$db_username. " password=".$db_password;
        $connection = pg_connect($string_connection) or die("No se pudo conectar".pg_last_error());;

        //Consulta a ejecutar sobre la base
        $query = "Insert into entradaexp (identradaexp,cedula,Fecha, Descripcion, codigoproducto, cantidad, total) Values ($id_entrada,$cedula,$fecha,$descripcion,$codigo_producto,$cantidad,$total)";

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
