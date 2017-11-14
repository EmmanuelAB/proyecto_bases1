<?php 
    require("../../Base/CredencialesProyecto.php");
    $string_connection = "host=".$db_direction." dbname=".$db_name. " user=".$db_username. " password=".$db_password;
    $connection = pg_connect($string_connection) or die("No se pudo conectar".pg_last_error());
    $res = pg_query("select nombre, apellido1, apellido2, c.cedula from cliente c ;");
            while($registro = pg_fetch_array($res, null, PGSQL_ASSOC)){
                $nom = $registro["nombre"]." ".
                       $registro["apellido1"]." ".
                       $registro["apellido2"]." ";
                echo "<option value='".$registro["cedula"]."'>";
                echo $nom;
                echo "</option>";
            }
    pg_close($connection);
?>
