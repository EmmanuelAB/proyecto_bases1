<?php 
    require("../base/credenciales.php");
    $con = pg_connect($datos_conexion) or die ('No se ha podido conectar'. pg_last_error() );

    $cedula = $_GET["c_ced"];
    $nombre = $_GET["c_nom"];
    $apellido1 = $_GET["c_ap1"];
    $apellido2 = $_GET["c_ap2"];
    $telefono1 = $_GET["c_tel1"];
    $telefono2 = $_GET["c_tel2"];
    $direccion = $_GET["c_dir"];
    $cedula = intval($cedula);
    $telefono1 = intval($telefono1); 
    $telefono2 =  intval($telefono2);
    $query = "insert into cliente (cedula, nombre, apellido1, apellido2, telefono1, telefono2, direccion)
              values ($cedula,'$nombre','$apellido1','$apellido2',$telefono1,$telefono2, '$direccion')
              ";
    $result = pg_query($query) or die('La consulta falló'.
              pg_last_error());
           
    echo "<p style='color: white;background-color:green; text-align:center; padding:15px;'>INSERCIÓN EXITOSA</p> <br>";
    $result =  pg_query("select * from cliente");
    // Imprimiendo los resultados en HTML
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
