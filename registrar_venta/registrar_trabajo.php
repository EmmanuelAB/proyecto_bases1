<?php 
    require("../base/credenciales.php");
    $fecha = $_GET["c_fecha"];
    $cedula = $_GET["c_cedula"];
    $descrip = $_GET["c_descrip"];
    $precio = $_GET["c_precio"];
    
    $con = pg_connect($datos_conexion) or die ('No se ha podido conectar'. pg_last_error() );
    $res = pg_query("insert into entradaexp(identradaexp, fecha , descripcion, cantidad, total, cedula)".
                    "values (41,'$fecha','$descrip',1,$precio,$cedula);"
                    );
    if($res){
        echo "Registro exitoso";
    }
    pg_close($con);
?>
