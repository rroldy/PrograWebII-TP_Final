<?php
	session_start();
	$conexion = mysql_connect("127.0.0.1", "root", "");
					
	if(!$conexion) {
		die('No pudo conectarse correctametne a la base de datos: ' . mysql_error());
	} else {
		if (!mysql_select_db("logistica", $conexion)) {
			die('No pudo ubicarse la base de datos que intenta usar: ' . mysql_error());
		}
	}	
	
	if ($_POST['estado'] =="modificarViaje") {	// Accion que modifica valores del viaje
												// Se puede modificar: Origen, destino, cliente, tipo carga, tipo viaje 
		$cod_viaje = $_POST['cod_viaje'];
		$cliente = $_POST['cliente'];
		$origen = $_POST['origen'];
		$destino = $_POST['destino'];
		$tipo_carga = $_POST['tipo_carga'];
		$tipo_viaje = $_POST['tipo_viaje'];
				
		$consulta = mysql_query("	UPDATE t_viaje 
									SET cliente = '".$cliente."',
										origen = '".$origen."',
										destino = '".$destino."',
										tipo_carga = '".$tipo_carga."',
										tipo_viaje = '".$tipo_viaje."'		
									WHERE cod_viaje = ".$cod_viaje.";");
									
		if (!$consulta) {
			die('Consulta no válida: ' . mysql_error());
		}	
		
		echo "Viaje modificado";
		
	}
	
	if ($_POST['estado'] =="finalizarViaje") {	// Accion para finalizar el viaje: libero los recursos asignados (vehiculo / acoplados / choferes)
												// Actualizo el estado del viaje en la BD (finalizado = 1)	
	
		$cod_viaje = $_POST['cod_viaje'];
		
		// Liberar transportes
		$consulta = mysql_query("	UPDATE t_transporte 
									SET disponible = 1
									WHERE nro_chasis IN (
											SELECT nro_chasis 
											FROM t_viaje_transporte
											WHERE cod_viaje = ".$cod_viaje.");");
									
		if (!$consulta) {
			die('Consulta no válida: ' . mysql_error());
		}
		//mysql_free_result($consulta);
		
		// Liberar choferes
		$consulta = mysql_query("	UPDATE t_chofer 
									SET disponible = 1
									WHERE legajo IN (
											SELECT legajo 
											FROM t_chofer_viaje
											WHERE cod_viaje = ".$cod_viaje.");");
		
		if (!$consulta) {
			die('Consulta no válida: ' . mysql_error());
		}
		//mysql_free_result($consulta);
		
		// Finalizo el viaje
		$consulta = mysql_query("	UPDATE t_viaje 
									SET finalizado = 1
									WHERE cod_viaje = ".$cod_viaje.";");
		
		if (!$consulta) {
			die('Consulta no válida: ' . mysql_error());
		}
		//mysql_free_result($consulta);
		
		
		echo "Viaje Finalizado <br>";
	}
	
	header('location:main.php');
?>