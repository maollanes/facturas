<?php

    mysql_connect('localhost', 'root', '') or die(mysql_error());           // Conexion al servidor MySQL
    mysql_select_db('db-control') or die(mysql_error());                       // Seleccion de base de datos

    // Obtiene el valor de 'data'
    $nombre = $_REQUEST['nombre'];
    $paterno = $_REQUEST['paterno'];
    $materno = $_REQUEST['materno'];
    $mes = $_REQUEST['mes'];
    $dia = $_REQUEST['dia'];
    $anio = $_REQUEST['anio'];
    $pass = $_REQUEST['pass'];
    $email = $_REQUEST['email'];
    $pais = $_REQUEST['pais'];
    $ciudad = $_REQUEST['ciudad'];

    mysql_query("INSERT INTO usuarios (usuario,nombre,ap_paterno,ap_materno,f_mes,f_dia,f_ano,password,email,pais,ciudad) VALUES ('$email','$nombre','$paterno','$materno','$mes','$dia','$anio','$pass','$email','$pais','$ciudad')");

    // Define un documento XML
    header('Content-Type: text/xml');
    echo "<?xml version='1.0' encoding='ISO-8859-1' standalone='yes'?>\n";
    echo "<Response>\n";
    echo "<Value>Se guardaron los datos correctamente.</Value>\n";
    echo "</Response>\n";
?>
