<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"> 
    <title>Combos de base</title>
    <script>
        function revisar(){
            //document.f1.provincia.options[i].value=mis_provincias[i]
            var c = document.getElementById("marca");
            
            var a = document.getElementById("año"); 
             
            if(c.options[c.selectedIndex].value=="Honda"){
                a.style.display = "none";
            }
            else{
                a.style.display = "inline-block";
            }
            //alert("Listo");
        }
    </script>
<!--
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
-->
  
  </head>
  <body>
  <?php
    function main(){
        $con = pg_connect("host=localhost 
                           dbname=repuestera
                           user=postgres
                           password=pepo123")
                           or die('No se ha podido conectar'
                           . pg_last_error() );
                           
        poner_combo("marca"); 
        poner_combo("modelo");
        poner_combo("año");
        pg_close($con);
    }
                    
    function poner_combo($atributo){
        $q_marcas = "select distinct $atributo from tipocarro;";
        $res = pg_query($q_marcas);
        //<select id="combo">
            //<option value="Repuesto">Repuesto</option>
        //echo '<form name="form_'.$atributo.'">';
        echo "<select id='$atributo' style='margin: 20px 10px;' onchange='revisar()' name='$atributo'>"; 
        while($registro = pg_fetch_array($res, null, PGSQL_ASSOC)){
            foreach($registro as $campo){
                echo "<option value='$campo'>";
                echo  $campo;
                echo "</option>";
            }
        }
        echo "</select>";
        //echo "</form>";
    }
    
    main();
  ?>
  </body>
  <footer>
  </footer>
</html>


