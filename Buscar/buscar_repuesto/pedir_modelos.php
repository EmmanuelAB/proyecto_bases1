<?php
    require("../../Base/CredencialesProyecto.php");
    $string_connection = "host=".$db_direction." dbname=".$db_name. " user=".$db_username. " password=".$db_password;
    $connection = pg_connect($string_connection) or die("No se pudo conectar".pg_last_error());
    $marca = $_GET["marca"];
    $res = pg_query("select distinct modelo from tipocarro t where t.marca = '$marca' ;");
            echo "<select style='margin: 20px 10px;'>";
            echo "<option>-Modelos-</option>";
            while($registro = pg_fetch_array($res, null, PGSQL_ASSOC)){
                foreach($registro as $campo){
                    echo "<option value='$campo'>";
                    echo  $campo;
                    echo "</option>";
                }
            }
            echo "</select>";
    pg_close($connection);
?>
