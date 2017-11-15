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
    $total = $cantidad * $precio;
    $res = pg_query("insert into entradaexp(codigoproducto, idtipocarro, fecha, cantidad, total, cedula)".
                     "values ($codigo,$tipocarro, '$fecha',$cantidad,$total, $cedula);");
    if($res){
        echo "<link rel='stylesheet' type='text/css' href='../Estilos/estilo_header_comun.css'>";
        echo '<link rel="stylesheet" type="text/css" href="../Estilos/titulo_pagina.css">';
        echo "<iframe src='../Plantillas/header_comun/header_comun.html'></iframe>";
        echo "<center><p id='titulo_pagina'>Registro exitoso!</p></center>";
    }
    pg_close($connection);
?>
