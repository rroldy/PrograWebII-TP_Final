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
	
	if ($_POST['estado'] =="modificarReparacion") {	// Accion que modifica valores de la reparacion
													// Se puede modificar: fecha, costo, km_unidad, tipo repuesto, repuesto
		
		//echo $_POST['estado'];
		
		$cod_reparacion = $_POST['cod_reparacion'];
		$fecha = $_POST['fecha'];
		$costo = $_POST['costo'];
		$km_unidad = $_POST['km_unidad'];
		$repuesto = $_POST['repuesto'];
				
		$consulta = mysql_query("	UPDATE t_reparacion 
									SET fecha = '".$fecha."',
										costo = '".$costo."',
										km_unidad = '".$km_unidad."',
										repuesto = '".$repuesto."'		
									WHERE cod_reparacion = ".$cod_reparacion.";");
									
		if (!$consulta) {
			die('Consulta no válida: ' . mysql_error());
		}	
		
		echo "Reparacion modificada";
		
	}
	
	if ($_POST['estado'] =="finalizarReparacion") {	// Accion para finalizar reparacion: libero los recursos asignados (transporte / mecanico)
													// Actualizo el estado de la reparacion en la BD (finalizada = 1)	
		
		echo $_POST['estado'];
		
		
		$nro_chasis = $_POST['nro_chasis'];
		$legajo = $_POST['legajo'];
		$cod_reparacion = $_POST['cod_reparacion'];
		
		//echo $nro_chasis. "<br>";
		//echo $legajo. "<br>";
		//echo $cod_reparacion. "<br>";
		
		
		// Liberar transporte
		$consulta = mysql_query("	UPDATE t_transporte 
									SET reparacion = 0
									WHERE nro_chasis = '".$nro_chasis."';");
									
		if (!$consulta) {
			die('Consulta no válida: ' . mysql_error());
		}
		//mysql_free_result($consulta);
		
		// Liberar mecanico
		$consulta = mysql_query("	UPDATE t_mecanico 
									SET disponible = 1
									WHERE legajo = ".$legajo.";");
		
		if (!$consulta) {
			die('Consulta no válida: ' . mysql_error());
		}
		//mysql_free_result($consulta);
		
		// Finalizo la reparacion
		$consulta = mysql_query("	UPDATE t_reparacion 
									SET finalizada = 1
									WHERE cod_reparacion = '".$cod_reparacion."';");
		
		if (!$consulta) {
			die('Consulta no válida: ' . mysql_error());
		}
		//mysql_free_result($consulta);
		
		
		echo "Reparacion finalizada <br>";
				
	}
	
	header('location:main.php');
?>