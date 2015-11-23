<?php

session_start();
$km = $_POST['km'];
$descripcion = $_POST['descripcion'];


$conexion = mysql_connect("localhost", "root", "");	
	if(!$conexion) {
		die('No pudo conectarse correctametne a la base de datos: ' . mysql_error());
	}	
	if (!mysql_select_db("logistica", $conexion)) {
		die('No pudo ubicarse la base de datos que intenta usar: ' . mysql_error());
	}

	$ins_service = mysql_query("insert into t_servicios (km, descripcion)
		values ('".$km."','".$descripcion."');");

	if (!$ins_service) {
		die('Consulta no válida: ' . mysql_error());
	} else { 
		//echo "Nuevo service guardado";
		header('location:main.php');
	}

?>