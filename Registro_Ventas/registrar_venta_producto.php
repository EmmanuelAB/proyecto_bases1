<?php

    //Las siguientes dos lineas permite mostrar los errores ocurridos en la pagina
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require("../Base/CredencialesProyecto.php");
    $fecha = $_GET["fecha"];
    $cedula = $_GET["cedula"];
    $codigo = $_GET["cod"];
    $cantidad = $_GET["cant"];
    $tipocarro = $_GET["tipocarro"];

    $string_connection = "host=".$db_direction." dbname=".$db_name. " user=".$db_username. " password=".$db_password;
    $connection = pg_connect($string_connection) or die("No se pudo conectar".pg_last_error());
    $res1 = pg_query("select * from total($cantidad, $codigo, $tipocarro);");
    $res_p =  pg_fetch_array($res1, null, PGSQL_ASSOC);
    $total = $res_p["total"];
    $res = pg_query("insert into entradaexp(descripcion,codigoproducto, idtipocarro, fecha, cantidad, total, cedula)".
                     "values ('venta',$codigo,$tipocarro, '$fecha',$cantidad,$total, $cedula);");
    if($res){
        echo "<link rel='stylesheet' type='text/css' href='../Estilos/estilo_header_comun.css'>";
        echo '<link rel="stylesheet" type="text/css" href="../Estilos/titulo_pagina.css">';
        echo "<iframe src='../Plantillas/header_comun/header_comun.html'></iframe>";
        echo "<center><p id='titulo_pagina'>Registro exitoso!</p></center>";
    }
    pg_close($connection);
?>
