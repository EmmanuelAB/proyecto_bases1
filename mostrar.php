<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"> 
    <title>Mostrando</title>
    <script>
        function revisar(){
            var combo_marcas = document.getElementById("marcas");
            var marca_elegida = combo_marcas.options[combo_marcas.selectedIndex].text;
            var combo_toyota = document.getElementById("toyota");
            var combo_nissan = document.getElementById("nissan");
            //alert("listo");
            if(marca_elegida=="Toyota"){
                combo_toyota.style.display = "inline-block";
                combo_nissan.style.display = "none";
            }
            else{
                combo_toyota.style.display = "none";
                combo_nissan.style.display = "inline-block";
            }
            
        }
    </script>
  </head>
  <body>
    <p onclick="revisar()">asdk</p>
    <select id="marcas" onclick="revisar()">
        <option>Toyota</option>
        <option>Nissan</option>
    </select>
    
    <select id="toyota" style="display:none;">
        <option>Corolla</option>
        <option>Starlet</option>
    </select>
    
    <select id="nissan" style="display:none;">
        <option>Sentra</option>
        <option>Qashqai</option>
    </select>
  </body>
  <footer>
  </footer>
</html>
