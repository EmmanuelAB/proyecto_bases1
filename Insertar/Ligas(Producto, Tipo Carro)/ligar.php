<?php
    require("../../Base/CredencialesProyecto.php");
    $datos_conexion = "host=".$db_direction." dbname=".$db_name. " user=".$db_username. " password=".$db_password;

    $con = pg_connect($datos_conexion) or die ('No se ha podido conectar'. pg_last_error() );
    $carro = $_GET["c_carro"];
    $codigo = $_GET["c_repuesto"];
    $precio = $_GET["c_precio"];
    $cantidad = $_GET["c_cantidad"];
    $res = pg_query("insert into aplicapara".
                    "(idtipocarro, codigoproducto, precio, cantidad) values".
                    "($carro,$codigo,$precio,$cantidad);");
    if($res){
        echo "<link rel='stylesheet' type='text/css' href='../../Estilos/estilo_header_comun.css'>";
        echo '<link rel="stylesheet" type="text/css" href="../../Estilos/titulo_pagina.css">';
        echo "<iframe src='../../Plantillas/header_comun/header_comun.html'></iframe>";
        echo "<center><p id='titulo_pagina'>Inserción exitosa!</p></center>";
    }
    else{
        echo "<h1>Insercion fallida!</h1>";
    }
    pg_close($con);
?>
