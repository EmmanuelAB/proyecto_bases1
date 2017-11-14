<?php
    require("../Base/CredencialesProyecto.php");
    $fecha = $_GET["fecha"];
    $cedula = $_GET["cedula"];
    $codigo = $_GET["cod"];
    $cantidad = $_GET["cant"];
    $tipocarro = $_GET["tipocarro"];

    $string_connection = "host=".$db_direction." dbname=".$db_name. " user=".$db_username. " password=".$db_password;
    $connection = pg_connect($string_connection) or die("No se pudo conectar".pg_last_error());

    $precio = pg_query("select a.precio from aplicapara a where a.codigoproducto = $codigo and a.idtipocarro = $tipocarro");
    $res = pg_query("insert into entradaexp(codigoproducto, idtipocarro, fecha, cantidad, total, cedula)".
        "values ($codigo,$tipocarro, '$fecha',$cantidad,$cantidad*$precio, $cedula);"
    );
    if($res){
        echo "Registro exitoso";
    }
    pg_close($connection);
?>