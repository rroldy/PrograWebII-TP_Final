<?php
	session_start();
	$legajo = $_POST['legajo']; 
	
	echo $legajo." ";	
	
	/* Borrar empleado.
		1) Hacer un update en la tabla de empleados, y poner al registro como no visible */
		
	$conexion = mysql_connect("127.0.0.1", "root", "");
	
	if(!$conexion) {
		die('No pudo conectarse correctametne a la base de datos: ' . mysql_error());
	}
	
	if (!mysql_select_db("logistica", $conexion)) {
		die('No pudo ubicarse la base de datos que intenta usar: ' . mysql_error());
	}
							
	// Elimino empleado (update de campo visible = 0)
	
	$consulta = mysql_query("UPDATE t_empleado 
							SET visible = 0
							WHERE legajo = ".$legajo.";");
		
	if (!$consulta) {
		die('Consulta no válida: ' . mysql_error());
	} 
	else { 
			//echo "Empleado eliminado";
			header('location:main.php');
	} 
?>