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

        $codigo = $_GET["c_codigo"];
        $nombre = $_GET["c_nombre"];
        $tipo = $_GET["c_tipo"];

        //Se importa el archivo php con los credenciales de la base
        //String de conexion
        require("../../Base/CredencialesProyecto.php");
        $string_connection = "host=".$db_direction." dbname=".$db_name. " user=".$db_username. " password=".$db_password;
        $connection = pg_connect($string_connection) or die("No se pudo conectar".pg_last_error());
        //Consulta a ejecutar sobre la base
        $query = "update producto set 
                    tipo = '$tipo',
                    nombre = '$nombre'
                    where codigo = $codigo;";

        $resultado = pg_query($connection,$query);

        if($resultado){
            echo "<link rel='stylesheet' type='text/css' href='../../Estilos/estilo_header_comun.css'>";
            echo '<link rel="stylesheet" type="text/css" href="../../Estilos/titulo_pagina.css">';
            echo "<iframe src='../../Plantillas/header_comun/header_comun.html'></iframe>";
            echo "<center><p id='titulo_pagina'>Actualización exitosa!</p></center>";
        }
        else{
            echo "<h1>Actualizacion fallida!</h1>";
        }

        pg_close($connection);
    ?>
</body>
</html>
