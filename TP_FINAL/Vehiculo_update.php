<?php

session_start();
$idtransporte = $_POST['idtransporte'];
$patente = $_POST['patente'];
$nrochasis = $_POST['nrochasis'];
$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$FechaFabrica = date($_POST['FechaFabrica']);
$tipovehiculo = $_POST['tipovehiculo'];
$nro_motor = $_POST['nro_motor'];


$conexion = mysql_connect("localhost", "root", "");
	
	if(!$conexion) {
		die('No pudo conectarse correctametne a la base de datos: ' . mysql_error());
	}
	
	if (!mysql_select_db("logistica", $conexion)) {
		die('No pudo ubicarse la base de datos que intenta usar: ' . mysql_error());
	}

	$up_transporte = mysql_query("update t_transporte set patente = '".$patente."', marca = '".$marca."', modelo = '".$modelo."', fecha_fabricacion = '".$FechaFabrica."' where id_transporte = ".$idtransporte.";");
	

	if (!$up_transporte) {
		die('Consulta no válida: ' . mysql_error());
	} else { 
		  
       //echo "Vehiculo guardado";
	 header('location:main.php');
		
	} 

?>