<?php
    $con = pg_connect("host=localhost dbname=repuestera2 user=postgres password=pepo123") or die ('No se ha podido conectar'. pg_last_error() );
    $marca = $_GET["marca"];
    $modelo = $_GET["modelo"];
    $año = $_GET["año"];
    $repuesto = $_GET["repuesto"];
    $res = pg_query("select distinct p.nombre, a.precio, a.cantidad
                     from tipocarro t join aplicapara a on t.idtipocarro = a.idtipocarro
                                      join producto p on p.codigo = a.codigoproducto
                     where t.marca = '$marca' 
                     and 
                     t.modelo='$modelo'
                     and
                     t.año = $año
                     and
                     p.nombre like '%$repuesto%'
                     ");
    echo "<tr id='cab'>";
    echo "<td>Repuesto</td>";
    echo "<td>Precio</td>";
    echo "<td>Cantidad</td>";
    echo "</tr>";
    while($registro = pg_fetch_array($res, null, PGSQL_ASSOC)){
        echo "<tr>";
        foreach($registro as $campo){
            echo "<td>".$campo."</td>";
        }
        echo "</tr>";
    }
            //echo "</select>";
    pg_close($con);
?>

