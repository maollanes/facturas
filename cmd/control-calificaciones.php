<?php

	// Incluir SQL link
	include('sql_link.php');

	session_start();

	// Conexión con la base de datos
	db_connect();

	//Obtención de variables para hacer el update
echo	$id_materia = $_POST['id_materia'].'<br>'; 
echo	$matricula = $_POST['matricula'].'<br>';
echo	$unidad1 = $_POST['unidad1'].'<br>';
echo	$unidad2 = $_POST['unidad2'].'<br>';
echo	$unidad3 = $_POST['unidad3'].'<br>';
echo	$id_gru = $_POST['cmb_grupo'];
echo	$cmb_alum = $_POST['cmb_alum'];

	mysql_query ("UPDATE calificaciones SET unidad_1 = '$unidad1', unidad_2 = '$unidad2', unidad_3 = '$unidad3' WHERE matricula = '$matricula'") or die ("aqui"); 

	$_SESSION['matri'] = $matricula;
	$_SESSION['id_grupo'] = $id_gru;
	$_SESSION['cb_a'] = $cmb_alum;
	$_SESSION['back_edition'] = 1;

	header("Location: ../section/docentes/calificaciones.php");

?>