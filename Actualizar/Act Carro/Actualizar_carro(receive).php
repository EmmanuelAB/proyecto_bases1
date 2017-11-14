<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
    <body>
        <?php
            //Las siguientes dos lineas permite mostrar los errores ocurridos en la pagina
            error_reporting(E_ALL);
            ini_set('display_errors', 1);

            $placa= $_GET["ca_Placa"];
            $tipo_carro = $_GET["ca_TipoCarro"];
            $cedula_cliente = $_GET["ca_CedulaCliente"];

            //Se importa el archivo php con los credenciales de la base
            require("../../Base/CredencialesProyecto.php");

            //String de conexion
            $string_connection = "host=".$db_direction." dbname=".$db_name. " user=".$db_username. " password=".$db_password;
            $connection = pg_connect($string_connection) or die("No se pudo conectar".pg_last_error());
            //Consulta a ejecutar sobre la base
            $query = "update".' "Carro"'.' set 
                                "Placa"'. "= $placa".',
                                "TipoCarro"'. "= $tipo_carro".',
                                "CedulaCliente"'. "= $cedula_cliente".
                          ' where "Placa"'."= $placa;";

            $resultado = pg_query($connection,$query);

            if($resultado){
                echo "<h1>Actualizacion exitosa!</h1>";
            }
            else{
                echo "<h1>Actualizacion fallida!</h1>";
            }

            echo "<h2><a href='../../Home/Home.html'>Regresar al home</a></h2>";
            pg_close($connection);
        ?>
    </body>
</html>