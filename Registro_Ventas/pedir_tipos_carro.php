<?php
    require("../Base/CredencialesProyecto.php");

    $string_connection = "host=".$db_direction." dbname=".$db_name. " user=".$db_username. " password=".$db_password;
    $connection = pg_connect($string_connection) or die("No se pudo conectar".pg_last_error());

    $res = pg_query("select t.idtipocarro, t.marca, t.modelo, t.año from tipocarro t ;");

    while ($registro = pg_fetch_array($res, null, PGSQL_ASSOC)){
        $modelo = $registro["modelo"];
        $marca = $registro["marca"];
        $año = $registro["año"];
        $tipo = $registro["idtipocarro"];
        echo "<option value='$tipo'>$marca $modelo $año</option>";
    }

    pg_close($connection);
