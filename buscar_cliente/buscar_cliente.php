<?php 
    require("../base/credenciales.php");
    $con = pg_connect($datos_conexion) or die ('No se ha podido conectar'. pg_last_error() );
    $nombre = $_GET["c_nom"];
    $query = "select * 
              from cliente c
              where c.nombre ilike '%$nombre%'
              ;";
    $result = pg_query($query) or die('La consulta falló'.
              pg_last_error());
    // Imprimiendo los resultados en HTML
    $campos = array("Cedula","Nombre","Apellido1","Apellido2","Teléfono1", "Teléfono2","Dirección");
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
    pg_close($con);
?>
