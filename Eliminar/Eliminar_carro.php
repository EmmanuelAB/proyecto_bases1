<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registro eliminado</title>
</head>
<body>

    <?php

        //Las siguientes dos lineas permite mostrar los errores ocurridos en la pagina
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $placa = $_GET["c_plac"];

        //Se importa el archivo php con los credenciales de la base
        require("../Base/CredencialesProyecto.php");

        //String de conexion
        $string_connection = "host=".$db_direction." dbname=".$db_name. " user=".$db_username. " password=".$db_password;
        $connection = pg_connect($string_connection) or die("No se pudo conectar".pg_last_error());

        //Consulta a ejecutar sobre la base
        $query = "Delete From carro WHERE placa = '$placa'";

        $resultado = pg_query($connection,$query);

        if($resultado){
            if (pg_affected_rows($resultado)){
                echo "<link rel='stylesheet' type='text/css' href='../Estilos/estilo_header_comun.css'>";
                echo '<link rel="stylesheet" type="text/css" href="../Estilos/titulo_pagina.css">';
                echo '<link rel="stylesheet" type="text/css" href="../Estilos/estilo_formularios.css">';
                echo '<link rel="stylesheet" type="text/css" href="../Estilos/estilos_finales.css">';
                echo "<iframe src='../Plantillas/header_comun/header_comun.html'></iframe>";
                echo "<center><p id='titulo_pagina'>Registro Eliminado</p></center>";
            }
            else{
                echo "<h1>Fallo en la eliminacion!</h1>";
                echo "Dato introducido invalido";
            }

        }
        else{
            echo "<h1>Fallo en la eliminacion!</h1>";
        }

        pg_close($connection);
    ?>

</body>
</html>
