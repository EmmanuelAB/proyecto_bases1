<?php
    require("../Base/CredencialesProyecto.php");

    $string_connection = "host=".$db_direction." dbname=".$db_name. " user=".$db_username. " password=".$db_password;
    $connection = pg_connect($string_connection) or die("No se pudo conectar".pg_last_error());
    $codigoproducto = $_GET["c_codigo"];
    $idtipocarro = $_GET["c_tipocarro"];
    $res = pg_query("select a.precio, t.modelo, t.año, p.nombre, a.cantidad
                     from producto p join aplicapara a on p.codigo = a.codigoproducto
                                     join tipocarro t on a.idtipocarro = t.idtipocarro
                     where a.codigoproducto = $codigoproducto and a.idtipocarro = $idtipocarro
                     ;");
    if(pg_num_rows($res)==1){
        while ($registro = pg_fetch_array($res, null, PGSQL_ASSOC)){
            echo $registro["precio"]." | ".$registro["nombre"]." ".$registro["modelo"].
            " ".$registro["año"]." | ".$registro["cantidad"]. " unids";
        }
    }else{
        echo "El repuesto no existe";
    }
    

    pg_close($connection);
