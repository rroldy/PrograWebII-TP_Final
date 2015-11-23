<?php

session_start();
$id_servicio = $_POST['id_servicio'];
$km = $_POST['km'];
$descripcion = $_POST['descripcion'];


$conexion = mysql_connect("localhost", "root", "");
	
	if(!$conexion) {
		die('No pudo conectarse correctametne a la base de datos: ' . mysql_error());
	}
	
	if (!mysql_select_db("logistica", $conexion)) {
		die('No pudo ubicarse la base de datos que intenta usar: ' . mysql_error());
	}

	$up_servicio = mysql_query("update t_servicios set km = '".$km."', descripcion = '".$descripcion."' where id_servicio = ".$id_servicio.";");
	

	if (!$up_servicio) {
		die('Consulta no válida: ' . mysql_error());
	} else { 
		  
       //echo "Service modificado";
		header('location:main.php');
		
	} 

?>