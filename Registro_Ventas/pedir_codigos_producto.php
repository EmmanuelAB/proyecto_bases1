<?php
    require("../Base/CredencialesProyecto.php");

    $string_connection = "host=".$db_direction." dbname=".$db_name. " user=".$db_username. " password=".$db_password;
    $connection = pg_connect($string_connection) or die("No se pudo conectar".pg_last_error());
    $tipocarro = $_GET["c_tipocarro"];
    $res = pg_query("select p.codigo, p.nombre 
                     from producto p join aplicapara a on p.codigo = a.codigoproducto
                                     join tipocarro t on t.idtipocarro = a.idtipocarro
                    where t.idtipocarro = $tipocarro
                    ;");

    while ($registro = pg_fetch_array($res, null, PGSQL_ASSOC)){
        $codigo = $registro["codigo"];
        $nombre = $registro["nombre"];
        echo "<option value='$codigo'>$nombre</option>";
    }

    pg_close($connection);
