<?php
    require("../base/credenciales.php");
    $con = pg_connect($datos_conexion) or die ('No se ha podido conectar'. pg_last_error() );
    $res = pg_query("select idtipocarro, modelo, año from tipocarro;");
            while($registro = pg_fetch_array($res, null, PGSQL_ASSOC)){
                $id = $registro["idtipocarro"];
                echo "<option value=$id>";
                echo  $registro["modelo"]." ".$registro["año"];
                echo "</option>";
            }
    pg_close($con);
?>