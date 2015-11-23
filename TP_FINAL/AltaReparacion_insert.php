<?php
	session_start();
	$cod_reparacion = $_POST['cod_reparacion'];
	$fecha = date($_POST['fecha_reparacion']); 
	$costo = $_POST['costo']; 
	$km_unidad = $_POST['km_unidad'];
	$tipo_repuesto = $_POST['tipo_repuesto'];
	$repuesto = $_POST['repuesto'];
	$transporte = $_POST['transporte'];
	$mecanico = $_POST['mecanico'];
	/*
	echo $cod_reparacion."<br>"; 
	echo $fecha."<br>";
	echo $costo."<br>";	
	echo $km_unidad."<br>";
	echo $tipo_repuesto."<br>";
	echo $repuesto."<br>";
	echo $transporte."<br>"; 
	echo $mecanico."<br>";
	*/
	$conexion = mysql_connect("127.0.0.1", "root", "");
	
	if(!$conexion) {
		die('No pudo conectarse correctametne a la base de datos: ' . mysql_error());
	}
	
	if (!mysql_select_db("logistica", $conexion)) {
		die('No pudo ubicarse la base de datos que intenta usar: ' . mysql_error());
	}
	
	/** Almaceno la reparacion **/	
	$consulta = mysql_query("INSERT INTO t_reparacion (cod_reparacion, nro_chasis, legajo, id_tipo_repuesto, fecha, costo, km_unidad, 
														repuesto, finalizada, visible)
							values ('".$cod_reparacion."','".$transporte."',".$mecanico.",'".$tipo_repuesto."','".$fecha."',".$costo.",".$km_unidad.",	
									'".$repuesto."',0,1);");
	if (!$consulta) {
		die('Consulta no válida: ' . mysql_error());
	} 
	else { 
			//** Modifico el estado del transporte en la base de datos (reparacion = 1) **//
			if (modificaEstadoTransporte($transporte)) {
				echo "Transporte actualizado. <br>";
			} else {
				echo "Error actualizando datos del transporte. <br>";
				return false;
			}
	
			//** Modifico el estado del mecanico en la base de datos como no disponible (disponible = 0)**//
			
			if (modificaEstadoMecanico($mecanico)) {
				echo "Mecanico actualizado. <br>";
			} else {
				echo "Error actualizando datos del mecanico. <br>";
				return false;
			}
	
					
			//echo "Datos de la reparacion guardados";
			header('location:main.php');
	}
	
	function modificaEstadoTransporte ($nro_chasis) { 	// Modifica el estado del transporte, que es asignado a una reparacion
		$consulta = mysql_query("	UPDATE t_transporte 
									SET reparacion = 1 
									WHERE nro_chasis = '".$nro_chasis."';" );
		if (!$consulta) {
			die('Consulta no válida: ' . mysql_error());
			return false;
			
		} else { 
			return true;
		}
	}
	
	function modificaEstadoMecanico ($legajo) { 		// Modifica el estado del mecanico, ya que se lo asigna a una reparacion
		$consulta = mysql_query("	UPDATE t_mecanico 
									SET disponible = 0 
									WHERE legajo = '".$legajo."';" );
		if (!$consulta) {
			die('Consulta no válida: ' . mysql_error());
			return false;
			
		} else { 
			return true;
		}
	}
	
	
?>	