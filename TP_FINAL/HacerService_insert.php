<?php

session_start();
$id_servicio = $_POST['id_servicio'];
$idtransporte = $_POST['idtransporte'];


$conexion = mysql_connect("localhost", "root", "");	
	if(!$conexion) {
		die('No pudo conectarse correctametne a la base de datos: ' . mysql_error());
	}	
	if (!mysql_select_db("logistica", $conexion)) {
		die('No pudo ubicarse la base de datos que intenta usar: ' . mysql_error());
	}

	$ins_service = mysql_query("insert into t_servrealizados (id_servreal, id_transporte, id_servicio)
		values ( NULL, '".$idtransporte."','".$id_servicio."');");

	if (!$ins_service) {
		die('Consulta no válida: ' . mysql_error());
	} else { 
		//echo "service guardado";
		header('location:main.php');
	}

?>