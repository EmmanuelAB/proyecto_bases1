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

            $placa= $_GET["ca_placa"];
            $tipo_carro = $_GET["ca_idtipocarro"];
            $cedula_cliente = $_GET["ca_cedula"];

            //Se importa el archivo php con los credenciales de la base
            require("../../Base/CredencialesProyecto.php");

            //String de conexion
            $string_connection = "host=".$db_direction." dbname=".$db_name. " user=".$db_username. " password=".$db_password;
            $connection = pg_connect($string_connection) or die("No se pudo conectar".pg_last_error());
            //Consulta a ejecutar sobre la base
            $query = "update carro set 
                         placa = '$placa',
                         idtipocarro = $tipo_carro,
                         cedula = $cedula_cliente
                         where placa = '$placa';";

            $resultado = pg_query($connection,$query);

            if($resultado){
                echo "<link rel='stylesheet' type='text/css' href='../../Estilos/estilo_header_comun.css'>";
                echo '<link rel="stylesheet" type="text/css" href="../../Estilos/titulo_pagina.css">';
                echo '<link rel="stylesheet" type="text/css" href="../../Estilos/estilo_formularios.css">';
                echo '<link rel="stylesheet" type="text/css" href="../../Estilos/estilos_finales.css">';
                echo "<iframe src='../../Plantillas/header_comun/header_comun.html'></iframe>";
                echo "<center><p id='titulo_pagina'>Actualización exitosa!</p></center>";

            }
            else{
                echo "<h1>Actualización fallida!</h1>";
            }

            pg_close($connection);
        ?>
    </body>
</html>
