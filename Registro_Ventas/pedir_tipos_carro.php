<?php
    require("../Base/CredencialesProyecto.php");

    $string_connection = "host=".$db_direction." dbname=".$db_name. " user=".$db_username. " password=".$db_password;
    $connection = pg_connect($string_connection) or die("No se pudo conectar".pg_last_error());

    $res = pg_query("select t.idtipocarro from tipocarro t ;");

    $registro = pg_fetch_array($res, null, PGSQL_ASSOC);
    $nom = $registro["tipocarro"];
    echo "<option>$nom</option>";
    pg_close($connection);