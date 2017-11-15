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

        $cedula = $_GET["c_cedula"];
        $nombre = $_GET["c_nombre"];
        $apellido1 = $_GET["c_apellido1"];
        $apellido2 = $_GET["c_apellido2"];
        $telefono1 = $_GET["c_telefono1"];
        $telefono2 = $_GET["c_telefono2"];
        $direccion = $_GET["c_direccion"];

        //Se importa el archivo php con los credenciales de la base
        //String de conexion
        require("../../Base/CredencialesProyecto.php");
        $string_connection = "host=".$db_direction." dbname=".$db_name. " user=".$db_username. " password=".$db_password;
        $connection = pg_connect($string_connection) or die("No se pudo conectar".pg_last_error());
        //Consulta a ejecutar sobre la base
        $query = "update cliente set 
                    cedula = $cedula,
                    nombre = '$nombre',
                    apellido1 = '$apellido1',
                    apellido2 = '$apellido2',
                    telefono1 = $telefono1,
                    telefono2 =  $telefono2,
                    direccion = '$direccion' where cedula = $cedula";

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
