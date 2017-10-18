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
                //var tag = combos[i];
                //alert("a");
                //alert(combos[i].id);
                if(combos[i].id == marca_elegida){
                    combos[i].style.display = "inline-block";
                }
                else{
                    combos[i].style.display = "none";
                }
            }
            //alert("j");            
        }
    </script>
  </head>
  <body>
    <select id="marcas" onclick="revisar()">
        <option>Toyota</option>
        <option>Nissan</option>
        <option>Honda</option>        
    </select>
    
    <select id="Toyota" class="c1" style="display:none;">
        <option>Corolla</option>
        <option>Starlet</option>
    </select>
    
    <select id="Nissan" class="c1" style="display:none;">
        <option>Sentra</option>
        <option>Qashqai</option>
    </select>
    <select id="Honda" class="c1" style="display:none;">
        <option>Civic</option>
        <option>CR-V</option>
    </select>
  </body>
  <footer>
  </footer>
</html>
