<?php

    require("../../Base/CredencialesProyecto.php");
    $string_connection = "host=".$db_direction." dbname=".$db_name. " user=".$db_username. " password=".$db_password;
    $connection = pg_connect($string_connection) or die("No se pudo conectar".pg_last_error());
    $marca = $_GET["marca"];
    $modelo = $_GET["modelo"];
    $ano = $_GET["año"];
    $repuesto = $_GET["repuesto"];
    $res = pg_query("select distinct p.nombre, p.precio, p.cantidad
                     from tipocarro t join aplicapara a on t.idtipocarro = a.idtipocarro
                                      join producto p on p.codigo = a.codigoproducto
                     where t.marca = '$marca' 
                     and 
                     t.modelo='$modelo'
                     and
                     t.año = $ano
                     and
                     p.nombre ilike '%$repuesto%'
                     ");
    $campos = array("Repuesto","Precio","Cantidad");
    echo "<tr id='fila_titulo'>";
    foreach($campos as $campo){
        echo "<td>$campo</td>";
    }
    echo "</tr>";
    while($registro = pg_fetch_array($res, null, PGSQL_ASSOC)){
        echo "<tr>";
        foreach($registro as $campo){
            echo "<td>".$campo."</td>";
        }
        echo "</tr>";
    }
    pg_close($connection);
?>

