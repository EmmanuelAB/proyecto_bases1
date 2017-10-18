<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"> 
    <title>Mostrando</title>
    <script>
        function revisar(){
            var combo_marcas = document.getElementById("marcas");
            var combos = document.getElementsByClassName("c1");
            var marca_elegida = combo_marcas.options[combo_marcas.selectedIndex].text;
            //alert(marca_elegida);
            for(i=0 ; i<combos.length ; i++){
                combos[i].style.display = (combos[i].id == marca_elegida)?"inline-block":"none";
            }
            //alert("fin rev1");
            //alert("j");            
        }
        
        function revisar2(){
            
            var combo_marcas = document.getElementById("marcas");
            var marca_elegida = combo_marcas.options[combo_marcas.selectedIndex].text;
            var combo_modelos = document.getElementById(marca_elegida);//combo de los toyotas
            var modelo_elegido = combo_modelos.options[combo_modelos.selectedIndex].text;
            //alert(modelo_elegido);
            //alert(marca_elegida); //modelo elegido es corolla 
            var combos_años = document.getElementsByClassName("c2");
            for(i=0 ; i<combos_años.length ; i++){
                combos_años[i].style.display = (combos_años[i].id == modelo_elegido)?"inline-block":"none";
            }
            
            //alert("j");            
        }
    </script>
  </head>
  <body>
    <center>
    <?php
        $con = pg_connect("host=localhost dbname=repuestera user=postgres password=pepo123") or die ('No se ha podido conectar'. pg_last_error() );
        $marcas = array();
        $modelos = array();
        $años = array();
        //para cada marca poner un combo con los modelos de esa marca
        function poner_combo_marcas(){
            $res = pg_query("select distinct marca from tipocarro;");
            echo "<select id='marcas' style='margin: 20px 10px;' onchange='revisar()' >"; 
            echo "<option>-Marcas-</option>";
            while($registro = pg_fetch_array($res, null, PGSQL_ASSOC)){
                foreach($registro as $campo){
                    $GLOBALS["marcas"][] = $campo;
                    echo "<option value='$campo'>";
                    echo  $campo;
                    echo "</option>";
                }
            }
            echo "</select>";
        }   
        
        function poner_combos_modelos(){
                foreach($GLOBALS["marcas"] as $marca){ //campo es cada nombre de marca
                    $modelos = pg_query("select distinct modelo from tipocarro t where t.marca='$marca';");
                    echo "<select id='$marca' style='display: none; margin: 20px 10px;' class='c1' onchange='revisar2()'>"; 
                    echo "<option>-Modelos-</option>";
                    while($reg = pg_fetch_array($modelos, null, PGSQL_ASSOC)){
                        foreach($reg as $mod){
                            $GLOBALS["modelos"][] = $mod;
                            echo "<option value='$mod'>";
                            echo  $mod;
                            echo "</option>";
                        }
                    }
                    echo "</select>";
                }
        }
        
        function poner_combos_años(){
                //echo $GLOBALS["modelos"][0];
                foreach($GLOBALS["modelos"] as $modelo){ //campo es cada nombre de marca
                    $años = pg_query("select distinct año from tipocarro t where t.modelo='$modelo';");
                    echo "<select id='$modelo' style='display: none; margin: 20px 10px;' class='c2'>"; 
                    echo "<option>-Años-</option>";
                    while($reg = pg_fetch_array($años, null, PGSQL_ASSOC)){
                        foreach($reg as $año){
                            echo "<option value='$año'>";
                            echo  $año;
                            echo "</option>";
                        }
                    }
                    echo "</select>";
                }
                //echo "done";
        }
        
        function main(){
            poner_combo_marcas();
            poner_combos_modelos();
            poner_combos_años();
            //$q_modelos = "select distinct modelo from tipocarro t where t.marca = $marca;"
        }
        
        main();
            
        pg_close($con);
    ?>
    </center>
  </body>
  <footer>
  </footer>
</html>
