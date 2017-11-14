<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Actualizacion Carros</title>
</head>
    <body>
        <?php
            if(isset($_GET["b_buscar"])){
                //Las siguientes dos lineas permite mostrar los errores ocurridos en la pagina
                error_reporting(E_ALL);
                ini_set('display_errors', 1);

                require("../../Base/CredencialesProyecto.php");

                $placa = $_GET["ca_placa"];

                $string_connection = "host=".$db_direction." dbname=".$db_name. " user=".$db_username. " password=".$db_password;
                $connection = pg_connect($string_connection) or die("No se pudo conectar".pg_last_error());

                //Consulta a ejecutar sobre la base
                $query = 'Select * from'.'"Carro"'.'where "Placa"'."=$placa";
                $resultado = pg_query($connection,$query);


                if(pg_num_rows($resultado) >= 1){
                    echo "<h1>Vehiculo encontrado!</h1>";
                    $registro = pg_fetch_array($resultado, null, PGSQL_ASSOC);
                    echo "<form action='Actualizar_carro(receive).php'>";
                    echo "<table align='center'>";
                    $atributos = array("Placa","TipoCarro","CedulaCliente");
                    foreach($atributos as $atributo){
                        echo "<tr>";
                        echo "<td>";
                        echo "<center>$atributo</center>";
                        echo "<center><input type='text' value='" . $registro[$atributo] . "' name='ca_$atributo'></center>";
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
                    echo "No hay un carro con placa: $placa";
                }
                pg_close($connection);
            }
        ?>
    </body>
</html>