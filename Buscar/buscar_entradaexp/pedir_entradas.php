<?php
    require("../../Base/CredencialesProyecto.php");
    $string_connection = "host=".$db_direction." dbname=".$db_name. " user=".$db_username. " password=".$db_password;
    $connection = pg_connect($string_connection) or die("No se pudo conectar".pg_last_error());
    $cedula = $_GET["c_cedula"];
    $res = pg_query(" select e.fecha, e.descripcion, e.cantidad,".
                    "        e.total, e.cedula, concat(c.nombre,' ',c.apellido1,' ',c.apellido2)".
                    " from entradaexp e join cliente c on e.cedula=c.cedula".
                    " where e.cedula=$cedula and e.codigoproducto is NULL;"); //Solo trabajos
    $campos = array("Fecha","Descripción","Cantidad","Total","CedulaCliente","Cliente","Pieza",
                    "Carro","PrecioUnitario");
    echo "<tr id='fila_titulo'>";
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
                    
//=========================================================================

    $res = pg_query("select e.fecha, e.descripcion, e.cantidad,
                            e.total, e.cedula, concat(c.nombre,' ',c.apellido1,' ',c.apellido2) as nombrecliente,
                            p.nombre, concat(t.marca,' ',t.modelo,' ',t.año) as carro , a.precio
                     from entradaexp e join cliente c on e.cedula=c.cedula
                                      join aplicapara a on a.codigoproducto = e.codigoproducto 
                                                           and a.idtipocarro = e.idtipocarro
                                      join tipocarro t on t.idtipocarro = e.idtipocarro
                                      join producto p on e.codigoproducto=p.codigo 
                     where e.cedula=$cedula;");
    while($registro = pg_fetch_array($res, null, PGSQL_ASSOC)){
        echo "<tr>";
        foreach($registro as $campo){
            echo "<td>$campo</td>";
        }
        echo "</tr>";
    }
    pg_close($connection);
?>
