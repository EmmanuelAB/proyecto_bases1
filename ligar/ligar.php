<?php
    require("../base/credenciales.php");
    $con = pg_connect($datos_conexion) or die ('No se ha podido conectar'. pg_last_error() );
    $carro = $_GET["c_carro"];
    $codigo = $_GET["c_repuesto"];
    $precio = $_GET["c_precio"];
    $cantidad = $_GET["c_cantidad"];
    $res = pg_query("insert into aplicapara".
                    "(idtipocarro, codigoproducto, precio, cantidad) values".
                    "($carro,$codigo,$precio,$cantidad);");
    if($res){
        echo "Exito";
    }
    else{
        echo "Error en la insercion";
    }
    pg_close($con);
?>
