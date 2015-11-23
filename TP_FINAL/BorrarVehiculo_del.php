<?php

session_start();
$idtransporte = $_POST['idtransporte'];

$conexion = mysql_connect("localhost", "root", "");

	
	if(!$conexion) {
		die('No pudo conectarse correctametne a la base de datos: ' . mysql_error());
	}
	
	if (!mysql_select_db("logistica", $conexion)) {
		die('No pudo ubicarse la base de datos que intenta usar: ' . mysql_error());
	}

	
 	$baja_transporte = mysql_query("update t_transporte set visible = '0' WHERE id_transporte = ".$idtransporte);


 	if (!$baja_transporte) {
		die('Consulta no válida: ' . mysql_error());
	} else { 		   		
 		//echo "El vehiculo ha sido dado de baja";
 		header('location:main.php');
 	}	

	
?>