<?php
    require("../../Base/CredencialesProyecto.php");
    $datos_conexion = "host=".$db_direction." dbname=".$db_name. " user=".$db_username. " password=".$db_password;
    $con = pg_connect($datos_conexion) or die ('No se ha podido conectar'. pg_last_error() );
    $res = pg_query("select codigo, nombre from producto;");
            while($registro = pg_fetch_array($res, null, PGSQL_ASSOC)){
                $codigo = $registro["codigo"];
                echo "<option value=$codigo>";
                echo  $registro["nombre"];
                echo "</option>";
            }
    pg_close($con);
?>
