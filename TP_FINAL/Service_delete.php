<?php

session_start();
$id_servicio = $_POST['id_servicio'];



$conexion = mysql_connect("localhost", "root", "");
	
	if(!$conexion) {
		die('No pudo conectarse correctametne a la base de datos: ' . mysql_error());
	}
	
	if (!mysql_select_db("logistica", $conexion)) {
		die('No pudo ubicarse la base de datos que intenta usar: ' . mysql_error());
	}

	$del_servicio = mysql_query("update t_servicios set activo =  '1' where id_servicio = ".$id_servicio.";");
	

	if (!$del_servicio) {
		die('Consulta no válida: ' . mysql_error());
	} else { 
		  
       //echo "Service Eliminado";
	   header('location:main.php');	
		
	} 

?>