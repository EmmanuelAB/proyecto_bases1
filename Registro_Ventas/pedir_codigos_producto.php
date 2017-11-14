<?php
    require("../Base/CredencialesProyecto.php");

    $string_connection = "host=".$db_direction." dbname=".$db_name. " user=".$db_username. " password=".$db_password;
    $connection = pg_connect($string_connection) or die("No se pudo conectar".pg_last_error());

    $res = pg_query("select p.codigo from producto p ;");

    $registro = pg_fetch_array($res, null, PGSQL_ASSOC);
    $nom = $registro["codigo"];
    echo "<option>$nom</option>";
    pg_close($connection);