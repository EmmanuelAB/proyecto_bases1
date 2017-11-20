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

        $placa = $_GET["ca_plac"];
        $tipocarro = $_GET["ca_tipo"];
        $ceulacliente = $_GET["ca_cedcl"];

        //Se importa el archivo php con los credenciales de la base
        require("../Base/CredencialesProyecto.php");

        //String de conexion
        $string_connection = "host=".$db_direction." dbname=".$db_name. " user=".$db_username. " password=".$db_password;
        $connection = pg_connect($string_connection) or die("No se pudo conectar".pg_last_error());;

        //Consulta a ejecutar sobre la base
        $query = "Insert into carro (placa,idtipocarro,cedula) Values ('$placa',$tipocarro,$ceulacliente)";

        $resultado = pg_query($connection,$query);

        if($resultado){
            echo "<link rel='stylesheet' type='text/css' href='../Estilos/estilo_header_comun.css'>";
            echo '<link rel="stylesheet" type="text/css" href="../Estilos/titulo_pagina.css">';
            echo '<link rel="stylesheet" type="text/css" href="../Estilos/estilos_finales.css">';
            echo "<iframe src='../Plantillas/header_comun/header_comun.html'></iframe>";
            echo "<center><p id='titulo_pagina'>Inserción exitosa!</p></center>";

        }
        else{
            echo "<h1>Insercion fallida!</h1>";
        }

        pg_close($connection);
    ?>
</body>
</html>
