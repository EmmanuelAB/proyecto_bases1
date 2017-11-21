<?php

    require("../Base/CredencialesProyecto.php");
    $string_connection = "host=".$db_direction." dbname=".$db_name. " user=".$db_username. " password=".$db_password;
    $connection = pg_connect($string_connection) or die("No se pudo conectar".pg_last_error());
    $idcarro = $_GET["c_idcarro"];
    $porc = $_GET["c_porc"];
    $query = "select * from aumentar($idcarro, $porc.0);";
    $resultado = pg_query($query) or die('La consulta falló'.
              pg_last_error());
    if($resultado){
        echo "<link rel='stylesheet' type='text/css' href='../Estilos/estilo_header_comun.css'>";
        echo '<link rel="stylesheet" type="text/css" href="../Estilos/titulo_pagina.css">';
        echo '<link rel="stylesheet" type="text/css" href="../Estilos/estilos_finales.css">';
        echo "<iframe src='../Plantillas/header_comun/header_comun.html'></iframe>";
        echo "<center><p id='titulo_pagina'>Inserción exitosa!</p></center>";

    }
    else{
        echo "<h1>Insercion fallida!</h1>";
    }
    pg_close($connection);
?>
