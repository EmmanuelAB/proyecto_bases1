<?php 
    $con = pg_connect("host=localhost 
                       dbname=repuestera
                       user=postgres
                       password=pepo123")
                       or die('No se ha podido conectar'
                       . pg_last_error() );

    $nombre = $_GET["c_nom"];
    $query = "select * 
              from cliente c
              where c.nombre ilike '%$nombre%'
              ;";
    $result = pg_query($query) or die('La consulta falló'.
              pg_last_error());
    // Imprimiendo los resultados en HTML
    echo "<p style='color: white;background-color:gray; text-align:center; padding:15px;'>RESULTADOS</p> <br>";

    echo "<center><table>\n";
    while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
        echo "\t<tr>\n";
        foreach ($line as $col_value) {
            echo "\t\t<td style='border: 1px solid black; padding: 7px;'>$col_value</td>\n";
        }
        echo "\t</tr>\n";
    }
    echo "</table></center>\n";
    pg_free_result($result);
    pg_close($con);
?>
