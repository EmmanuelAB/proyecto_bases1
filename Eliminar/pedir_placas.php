<?php
    require("../Base/CredencialesProyecto.php");

    $string_connection = "host=".$db_direction." dbname=".$db_name. " user=".$db_username. " password=".$db_password;
    $connection = pg_connect($string_connection) or die("No se pudo conectar".pg_last_error());

    $res = pg_query("select c.placa from carro c ;");

    while ($registro = pg_fetch_array($res, null, PGSQL_ASSOC)){
            $placa = $registro["placa"];
            echo "<option value='$placa'></option>";
    }

    pg_close($connection);