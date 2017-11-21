<?php
    //Las siguientes dos lineas permite mostrar los errores ocurridos en la pagina
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $codigo = $_GET["c_prod"];
    //$idcarro = $_GET["c_idtipo"];

    //Se importa el archivo php con los credenciales de la base
    require("../Base/CredencialesProyecto.php");

    //String de conexion
    $string_connection = "host=".$db_direction." dbname=".$db_name. " user=".$db_username. " password=".$db_password;
    $connection = pg_connect($string_connection) or die("No se pudo conectar".pg_last_error());

    //Consulta a ejecutar sobre la base
    $query = "DELETE FROM producto p WHERE p.codigo = $codigo";

    $resultado = pg_query($connection,$query);

    if($resultado){
        if (pg_affected_rows($resultado)){
            echo "<h1>Registro eliminado!</h1>";
        }
        else{
            echo "<h1>Fallo en la eliminacion!</h1>";
        }

    }
    else{
        echo "<h1>Fallo en la eliminacion!</h1>";
    }

    echo "<h2><a href='../Home/Home.html'>Regresar al home</a></h2>";

    pg_close($connection);
