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
	$ins_transporte = mysql_query("insert into t_transporte (id_transporte, nro_chasis, patente, id_tipo, marca, modelo, fecha_fabricacion)
		values ('".$idtransporte."','".$nrochasis ."','".$patente."','".$tipovehiculo."','".$marca."','".$modelo."','".$FechaFabrica."');");

	if (!$ins_transporte) {
		die('Consulta no válida: ' . mysql_error());
	} else { 
		  
 			if($tipovehiculo == '1'){
 				$ins_vehiculo = mysql_query("insert into t_vehiculo (nro_chasis, nro_motor) values ('".$nrochasis."','".$nro_motor."');");
 				if (!$ins_vehiculo) {
					die('Consulta no válida: ' . mysql_error());
				}else{
				//	echo "Vehiculo guardado";
				header('location:main.php');	
				}
 			}else{
 				$ins_acoplado = mysql_query("insert into t_acoplado (nro_chasis) values ('".$nrochasis."');");
 				if (!$ins_acoplado) {
					die('Consulta no válida: ' . mysql_error());
				}else{
				//	echo "Acoplado guardado";
				header('location:main.php');	
				}
 			}		
	} 
?>