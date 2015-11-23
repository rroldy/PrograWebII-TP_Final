<?php
	session_start();
	$cod_viaje = $_POST['cod_viaje'];
	$cliente = $_POST['cliente']; 
	$origen = $_POST['origen']; 
	$destino = $_POST['destino'];
	$tipo_carga = $_POST['tipo_carga'];
	$tipo_viaje = $_POST['tipo_viaje'];
	$vehiculo = $_POST['vehiculo'];
	
	// Valores del acoplado
	 
	if (isset($_POST['acoplado']))
		$acoplado = $_POST['acoplado'];
	else
		$acoplado = "";
		
	if (isset($_POST['acoplado1']))			
		$acoplado1 = $_POST['acoplado1'];
	else
		$acoplado1 = "";
		
	if (isset($_POST['acoplado2']))			
		$acoplado2 = $_POST['acoplado2'];
	else
		$acoplado2 = "";
		
	$chofer = $_POST['chofer'];
	
	if (isset($_POST['chofer1']))			
		$chofer1 = $_POST['chofer1'];
	else
		$chofer1 = "";
	
	/*
	echo $cod_viaje."<br>"; 
	echo $cliente."<br>";
	echo $origen."<br>";	
	echo $destino."<br>";
	echo $tipo_viaje."<br>";
	echo $tipo_carga."<br>";
	echo $vehiculo."<br>"; 
	echo $acoplado."<br>";
	echo $acoplado1."<br>";
	echo $acoplado2."<br>";
	echo $chofer."<br>";
	echo $chofer1." <br>";*/
		
	$conexion = mysql_connect("127.0.0.1", "root", "");
	
	if(!$conexion) {
		die('No pudo conectarse correctametne a la base de datos: ' . mysql_error());
	}
	
	if (!mysql_select_db("logistica", $conexion)) {
		die('No pudo ubicarse la base de datos que intenta usar: ' . mysql_error());
	}
	
	//** Informacion relativa al viaje **//
	
	$consulta = mysql_query("INSERT INTO t_viaje (cod_viaje, tipo_carga, origen, destino, cliente, tipo_viaje, finalizado)
							values ('".$cod_viaje."','".$tipo_carga."','".$origen."','".$destino."','".$cliente."','".$tipo_viaje."', 0);");
		
	if (!$consulta) {
		die('Consulta no válida: ' . mysql_error());
	} 
	else { 
			//** Informacion relativa al transporte **//
			
			//** Vehiculo ** // 
			if (asignaViajeTransporte($cod_viaje, $vehiculo)) {
				echo "Vehiculo guardado. <br>";
				if (actualizarEstadoTransporte($vehiculo)) {
					echo "Estado del vehiculo guardado. <br>";
				}
				
			} else {
				echo "Error guardando vehiculo. <br>";
				return false;
			}
	
			//** Acoplado/s ** // 
			
			if ($acoplado != "") {
				if (asignaViajeTransporte($cod_viaje, $acoplado)) {
					echo "Acoplado guardado. <br>";
					if (actualizarEstadoTransporte($acoplado)) {
						echo "Estado del acoplado guardado. <br>";
					}
				} else {
					echo "Error guardando acoplado. <br>";
					return false;
				}	
			}
			
			if ($acoplado1 != "") {
				if (asignaViajeTransporte($cod_viaje, $acoplado1)) {
					echo "Acoplado1 guardado. <br>";
					if (actualizarEstadoTransporte($acoplado1)) {
						echo "Estado del acoplado1 guardado. <br>";
					}
				} else {
					echo "Error guardando acoplado1. <br>";
					return false;
				}
			}
							
			if ($acoplado2 != "") {
				if (asignaViajeTransporte($cod_viaje, $acoplado2)) {
					echo "Acoplado2 guardado. <br>";
					if (actualizarEstadoTransporte($acoplado2)) {
						echo "Estado del acoplado2 guardado. <br>";
					}
				} else {
					echo "Error guardando acoplado2. <br>";
					return false;
				}
			}
					
			//** Chofer/es ** //
			
			if (asignaViajeChofer($cod_viaje, $chofer)) {
					echo "Chofer guardado. <br>";
					if (actualizarEstadoChofer($chofer)) {
						echo "Estado del chofer guardado. <br>";
					}
				} else {
					echo "Error guardando chofer. <br>";
			}		
			
			if ($chofer1 != "") {
				if (asignaViajeChofer($cod_viaje, $chofer1)) {
					echo "Chofer1 guardado. <br>";
					if (actualizarEstadoChofer($chofer1)) {
						echo "Estado del chofer1 guardado. <br>";
					}
				} else {
					echo "Error guardando chofer1. <br>";
				}	
			}
		
			echo "Datos del viaje guardados";
	} 
	
	function asignaViajeTransporte ($cod_viaje, $transporte) { 		// Relaciona el vehiculo/acoplado con el viaje
		$consulta = mysql_query("INSERT INTO t_viaje_transporte (cod_viaje, nro_chasis) 
										values ('".$cod_viaje."','".$transporte."');" );
		if (!$consulta) {
			die('Consulta no válida: ' . mysql_error());
			return false;
			
		} else { 
			return true;
		}
	}
	
	function actualizarEstadoTransporte($transporte) {
		$consulta = mysql_query("UPDATE t_transporte 
								SET disponible = 0
								WHERE nro_chasis = '".$transporte."';" );
		if (!$consulta) {
			die('Consulta no válida: ' . mysql_error());
			return false;
			
		} else { 
			return true;
		}
	
	}
	
	function asignaViajeChofer($cod_viaje, $chofer) {						// Relaciona el chofer con el viaje
		$consulta = mysql_query("INSERT INTO t_chofer_viaje (cod_viaje, legajo) 
								values ('".$cod_viaje."',".$chofer.");" );
		if (!$consulta) {
			die('Consulta no válida: ' . mysql_error());
			return false;
			
		} else { 
			return true;
		}
	}
	
	function actualizarEstadoChofer($chofer) {
		$consulta = mysql_query("UPDATE t_chofer 
								SET disponible = 0
								WHERE legajo = ".$chofer.";" );
		if (!$consulta) {
			die('Consulta no válida: ' . mysql_error());
			return false;
			
		} else { 
			return true;
		}
	
	}
?>