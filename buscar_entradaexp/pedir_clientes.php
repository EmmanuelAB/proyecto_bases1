<?php 
    require("../base/credenciales.php");
    $con = pg_connect($datos_conexion) or die ('No se ha podido conectar'. pg_last_error() );
    $res = pg_query("select nombre, apellido1, apellido2, c.cedula from cliente c ;");
            while($registro = pg_fetch_array($res, null, PGSQL_ASSOC)){
                $nom = $registro["nombre"]." ".
                       $registro["apellido1"]." ".
                       $registro["apellido2"]." ";
                echo "<option value='".$registro["cedula"]."'>";
                echo $nom;
                echo "</option>";
            }
    pg_close($con);
?>
