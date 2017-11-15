<?php 
    require("../Base/CredencialesProyecto.php");
    $fecha = $_GET["c_fecha"];
    $cedula = $_GET["c_cedula"];
    $descrip = $_GET["c_descrip"];
    $precio = $_GET["c_precio"];

    $string_connection = "host=".$db_direction." dbname=".$db_name. " user=".$db_username. " password=".$db_password;
    $connection = pg_connect($string_connection) or die("No se pudo conectar".pg_last_error());;
    $res = pg_query("insert into entradaexp(fecha , descripcion, cantidad, total, cedula)".
                    "values ('$fecha','$descrip',1,$precio,$cedula);");
    if($res){
        echo "<link rel='stylesheet' type='text/css' href='../Estilos/estilo_header_comun.css'>";
        echo '<link rel="stylesheet" type="text/css" href="../Estilos/titulo_pagina.css">';
        echo "<iframe src='../Plantillas/header_comun/header_comun.html'></iframe>";
        echo "<center><p id='titulo_pagina'>Registro exitoso!</p></center>";
    }
    pg_close($connection);
?>
