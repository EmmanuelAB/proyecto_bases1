<?php 
    require("../base/credenciales.php");
    
    $con = pg_connect($datos_conexion) or die ('No se ha podido conectar'. pg_last_error() );
    $res = pg_query("select concat(c.nombre,' ', c.apellido1) from cliente c ;");
            //echo "<select style='margin: 20px 10px;'>";
            while($registro = pg_fetch_array($res, null, PGSQL_ASSOC)){
                foreach($registro as $campo){
                    echo "<option value='$campo'>";
                    echo  $campo;
                    echo "</option>";
                }
            }
            //echo "</select>";
    pg_close($con);
?>
