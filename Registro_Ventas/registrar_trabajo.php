<?php 
    require("../Base/CredencialesProyecto.php");
    $fecha = $_GET["c_fecha"];
    $cedula = $_GET["c_cedula"];
    $descrip = $_GET["c_descrip"];
    $precio = $_GET["c_precio"];

    $string_connection = "host=".$db_direction." dbname=".$db_name. " user=".$db_username. " password=".$db_password;
    $connection = pg_connect($string_connection) or die("No se pudo conectar".pg_last_error());;
    $res = pg_query("insert into entradaexp(identradaexp, fecha , descripcion, cantidad, total, cedula)".
                    "values (41,'$fecha','$descrip',1,$precio,$cedula);");
    if($res){
        echo "Registro exitoso";
    }
    pg_close($con);
?>
