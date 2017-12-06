<?php
    require("../../Base/CredencialesProyecto.php");
    $datos_conexion = "host=".$db_direction." dbname=".$db_name. " user=".$db_username. " password=".$db_password;
    $con = pg_connect($datos_conexion) or die ('No se ha podido conectar'. pg_last_error() );
    $res = pg_query("select * from tipocarro order by modelo;");
    $reg = pg_fetch_array($res, null, PGSQL_ASSOC);
    $modelo = $reg["modelo"];
    $menor = $reg["año"];
    $mayor = $reg["año"];
    $años = array();
    $ids = $reg["idtipocarro"];
	while($reg = pg_fetch_array($res, null, PGSQL_ASSOC)){
		if(strcmp($reg["modelo"], $modelo)){
			echo "<option value='$ids'>";
			echo $modelo." ";
				if(!strcmp($modelo,"D21 B 2pt")){
					//echo "yes <br>";
				}
			echo substr((string)$menor, -2,2)."-";
			echo substr((string)$mayor, -2,2)."" ;			
			echo "</option>";
			$modelo = $reg["modelo"];
			$menor = $reg["año"];
			$mayor = $reg["año"];
			$ids = $reg["idtipocarro"];
			$años = array();
		}
		else{
			$años[] = $reg["año"];
			$ids.="-".$reg["idtipocarro"];
			if($reg["año"] < $menor){
				$menor = $reg["año"];
			}
			if($mayor < $reg["año"]){
				$mayor = $reg["año"];
			}
		}
	}
    pg_close($con);
?>
