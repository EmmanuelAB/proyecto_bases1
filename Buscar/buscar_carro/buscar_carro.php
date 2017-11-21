<?php

    require("../../Base/CredencialesProyecto.php");
    $string_connection = "host=".$db_direction." dbname=".$db_name. " user=".$db_username. " password=".$db_password;
    $connection = pg_connect($string_connection) or die("No se pudo conectar".pg_last_error());
    $placa = $_GET["c_placa"];
    $query = "select *
              from carro ca join cliente cl on ca.cedula = cl.cedula
                            join tipocarro t on ca.idtipocarro = t.idtipocarro
              where ca.placa ilike '%$placa%'
              ;";
    $result = pg_query($query) or die('La consulta falló'.
              pg_last_error());
    // Imprimiendo los resultados en HTML
    $campos = array("Placa","IdTipoCarro","Cedula","Nombre","Apellido1","Apellido2",
                    "Teléfono1","Teléfono2","Dirección","Marca","Modelo","Año");
    echo "<tr id='fila_titulo'>";
    foreach($campos as $campo){
        echo "<td>$campo</td>";
    }
    while ($registro = pg_fetch_array($result, null, PGSQL_ASSOC)) {
        echo "<tr>";
        foreach ($registro as $campo) {
            echo "<td>$campo</td>";
        }
        echo "</tr>";
    }
    pg_close($connection);
?>
