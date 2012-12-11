<?php
	include('../../cmd/sql_link.php'); //Base de Datos
	db_connect();

echo	$id_fact = $_GET['id_fac'];

	mysql_query("DELETE FROM facturas WHERE id_factura = '$id_fact'");

	header('location:misfacturas.php')
?>