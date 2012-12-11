<?php
	error_reporting(true);
	function db_connect(){
		mysql_connect('localhost', 'root', '');
		mysql_select_db('db-factura');
		
	}
	function datos(){
		$dato=mysql_connect('localhost', 'root', '');
		return $dato;
		
	}
?>