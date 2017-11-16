<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <?php
        if(isset($_GET["b_buscar"])){
            //Las siguientes dos lineas permite mostrar los errores ocurridos en la pagina
            error_reporting(E_ALL);
            ini_set('display_errors', 1);

            require("../../Base/CredencialesProyecto.php");

            $codigo = $_GET["c_cod"];

            $string_connection = "host=".$db_direction." dbname=".$db_name. " user=".$db_username. " password=".$db_password;
            $connection = pg_connect($string_connection) or die("No se pudo conectar".pg_last_error());

            //Consulta a ejecutar sobre la base
            $query = "Select * from producto where codigo = $codigo";
            $resultado = pg_query($connection,$query);
            echo $resultado;

            if(pg_num_rows($resultado) >= 1){
                echo "<link rel='stylesheet' type='text/css' href='../../Estilos/estilo_header_comun.css'>";
                echo '<link rel="stylesheet" type="text/css" href="../../Estilos/titulo_pagina.css">';
                echo '<link rel="stylesheet" type="text/css" href="../../Estilos/estilo_formularios.css">';                
                echo "<iframe src='../../Plantillas/header_comun/header_comun.html'></iframe>";
                echo "<center><p id='titulo_pagina'>Recuperación exitosa!</p></center>";
                $registro = pg_fetch_array($resultado, null, PGSQL_ASSOC);
                echo "<form action='Actualizar_producto(receive).php'>";
                echo "<table align='center'>";
                $atributos = array("codigo","nombre","tipo");
                foreach($atributos as $atributo){
                    echo "<tr>";
                    echo "<td>";
                    echo "<center>$atributo</center>";
                    $apagado=($atributo=="codigo")?"readonly":""; //para que no pueda editar el codigo
                    echo "<center><input $apagado type='text' value='" . $registro[$atributo] . "' name='c_$atributo'></center>";
                    echo "</td>";
                    echo "</tr>";
                }
                echo "<tr>";
                echo "<td>";
                echo "<center>";
                echo "<input type='submit' value='Actualizar'>";
                echo "</center>";
                echo "</td>";
                echo "</tr>";
                echo "</table>";
                echo "</form>";
            }
            else{
                echo "No hay un cliente con cedula: $cedula";
            }

            pg_close($connection);
        }
    ?>
</body>
</html>
