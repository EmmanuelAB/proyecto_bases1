<?php 
    require("../base/credenciales.php");
    $con = pg_connect($datos_conexion) or die ('No se ha podido conectar'. pg_last_error() );
    $cedula = $_GET["c_cedula"];
    //$res = pg_query("select e.fecha, e.descripcion, e.cantidad, e.total, p.nombre, a.precio, t.modelo ".
                    //"from entradaexp e join aplicapara a on e.codigoproducto=a.codigoproducto ".
                    //"                                       and ".
                    //"                                       e.idtipocarro = a.idtipocarro ".
                    //"                  join producto p on e.codigoproducto=p.codigo".
                    //"                  join tipocarro t on e.idtipocarro = t.idtipocarro ".
                    //"where e.cedula=$cedula ".
                    //"order by e.fecha desc");
    //$res = pg_query("select e.fecha, e.descripcion, e.cantidad, e.total".
                    //"from entradaexp e join aplicapara a on e.codigoproducto=a.codigoproducto ".
                    //"                                       and ".
                    //"                                       e.idtipocarro = a.idtipocarro ".
                    //"where e.cedula=$cedula ".
                    //"order by e.fecha desc");
    $res = pg_query(" select e.fecha, e.descripcion, e.cantidad,".
                    "        e.total, e.cedula, concat(c.nombre,' ',c.apellido1,' ',c.apellido2)".
                    " from entradaexp e join cliente c on e.cedula=c.cedula".
                    " where e.cedula=$cedula and e.codigoproducto is NULL;"); //Solo trabajos
    $campos = array("Fecha","TipoEntrada","Cantidad","Total","CedulaCliente","Cliente","Pieza",
                    "Carro","PrecioUnitario");
    echo "<tr id='cab'>";
    foreach($campos as $campo){
        echo "<td>$campo</td>";
    }
    echo "</tr>";
    while($registro = pg_fetch_array($res, null, PGSQL_ASSOC)){
        echo "<tr>";
        foreach($registro as $campo){
            echo "<td>";
            echo  $campo;
            echo "</td>";
        }
        echo "</tr>";
    }
   
                    //"        p.nombre, concat(t.marca,' ',t.modelo,' ',t.año) , a.precio".
                    //"        e.total, e.cedula, concat(c.nombre,' ',c.apellido1,' ',c.apellido2) ".
                    
//=========================================================================
    $res = pg_query("select e.fecha, e.descripcion, e.cantidad,".
                    "       e.total, e.cedula, concat(c.nombre,' ',c.apellido1,' ',c.apellido2),".
                    "       p.nombre, concat(t.marca,' ',t.modelo,' ',t.año) , a.precio ".
                    "from entradaexp e  join cliente c on e.cedula=c.cedula".
                    "                   join aplicapara a on a.codigoproducto = e.codigoproducto".
                    "                                    and a.idtipocarro = e.idtipocarro".
                    "                   join tipocarro t on t.idtipocarro = e.idtipocarro".
                    "                   join producto p on e.codigoproducto=p.codigo ".
                    " where e.cedula=$cedula;"); //Solo ventas
    $res = pg_query("select e.fecha, e.descripcion, e.cantidad,
        e.total, e.cedula, concat(c.nombre,' ',c.apellido1,' ',c.apellido2) as nombrecliente,
         p.nombre, concat(t.marca,' ',t.modelo,' ',t.año) as carro , a.precio
from entradaexp e join cliente c on e.cedula=c.cedula
                  join aplicapara a on a.codigoproducto = e.codigoproducto and a.idtipocarro = e.idtipocarro
                  join tipocarro t on t.idtipocarro = e.idtipocarro
                  join producto p on e.codigoproducto=p.codigo 
 where e.cedula=1234563;");
    while($registro = pg_fetch_array($res, null, PGSQL_ASSOC)){
        echo "<tr>";
        foreach($registro as $campo){
            echo "<td>";
            echo  $campo;
            echo "</td>";
        }
        echo "</tr>";
    }
    pg_close($con);
?>
