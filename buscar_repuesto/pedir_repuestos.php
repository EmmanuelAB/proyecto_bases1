<?php
    $con = pg_connect("host=localhost dbname=repuestera2 user=postgres password=pepo123") or die ('No se ha podido conectar'. pg_last_error() );
    $marca = $_GET["marca"];
    $modelo = $_GET["modelo"];
    $año = $_GET["año"];
    $res = pg_query("select distinct p.nombre
                     from tipocarro t join aplicapara a on t.idtipocarro = a.idtipocarro
                                      join producto p on p.codigo = a.codigoproducto
                     where t.marca = '$marca' 
                     and 
                     t.modelo='$modelo'
                     and
                     t.año = $año;");
            while($registro = pg_fetch_array($res, null, PGSQL_ASSOC)){
                foreach($registro as $campo){
                    echo "<option value='$campo'>";
                    echo  $campo;
                    echo "</option>";
                }
            }
            //echo "</select>";
    pg_close($con);
?>
