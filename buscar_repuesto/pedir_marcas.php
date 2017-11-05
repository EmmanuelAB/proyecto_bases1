<?php
    require("../base/credenciales.php");
    $con = pg_connect($datos_conexion) or die ('No se ha podido conectar'. pg_last_error() );
    $res = pg_query("select distinct marca from tipocarro;");
            echo "<select style='margin: 20px 10px;'>";
            echo "<option>-Marcas-</option>";
            while($registro = pg_fetch_array($res, null, PGSQL_ASSOC)){
                foreach($registro as $campo){
                    echo "<option value='$campo'>";
                    echo  $campo;
                    echo "</option>";
                }
            }
            echo "</select>";
            
    pg_close($con);
?>
