<?php
	session_start();
	$usuario = $_POST['usuario'];
	$password = $_POST['password'];
	$legajo = $_POST['legajo']; 
	$dni = $_POST['dni']; 
	$cuil = $_POST['cuil'];
	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
	$fecha_nac = date($_POST['fecha_nac']); 
	$direccion = $_POST['direccion'];
	$localidad = $_POST['localidad'];
	$provincia = $_POST['provincia'];
	$pais = $_POST['pais'];
	$cp = $_POST['codigo_postal'];
	$tipo_usuario = $_POST['tipo_usuario'];
	/*
	echo $usuario." "; 
	echo $password." ";
	echo $legajo." ";	
	echo $dni." ";
	echo $cuil." ";
	echo $nombre." ";
	echo $apellido." ";
	echo $fecha_nac." ";
	echo $direccion." ";
	echo $localidad." ";
	echo $provincia." ";
	echo $pais." ";
	echo $cp." ";
	echo $tipo_usuario;*/
		
	$conexion = mysql_connect("127.0.0.1", "root", "");
	
	if(!$conexion) {
		die('No pudo conectarse correctametne a la base de datos: ' . mysql_error());
	}
	
	if (!mysql_select_db("logistica", $conexion)) {
		die('No pudo ubicarse la base de datos que intenta usar: ' . mysql_error());
	}
							
	// Actualizo empleado
	$consulta = mysql_query("UPDATE t_empleado
							SET  usuario = '".$usuario."', 
								 legajo = ".$legajo.", 
								 tipo_doc = 'DNI', 
								 nro_doc = ".$dni.", 
								 cuil = '".$cuil."', 
								 nombre = '".$nombre."', 
								 apellido = '".$apellido."', 
								 fecha_nac = '".$fecha_nac."', 
								 direccion = '".$direccion."', 
								 localidad = '".$localidad."', 
								 provincia = '".$provincia."', 
								 pais = '".$pais."', 
								 codigo_postal = ".$cp.", 
								 password = '".$password."'
							WHERE legajo = ".$legajo.";
							");
		
	if (!$consulta) {
		die('Consulta no válida: ' . mysql_error());
	} 
	else { 
			if ($tipo_usuario == 3) {	// El empleado es chofer, guardo tipo y numero de licencia
				//$tipo_licencia = $_POST['categoria'];
				$numero_licencia = $_POST['nro_licencia'];
				
				//echo $tipo_licencia." ".$numero_licencia;
				$consulta = mysql_query("UPDATE t_chofer 
										SET numero_licencia = '".$numero_licencia."'
										WHERE legajo = ".$legajo.";
										");
			
				if (!$consulta) {
					die('Consulta no válida: ' . mysql_error());
				} else { 
					echo "Licencia modificada. <br>";
				}	
			}
			
			if ($tipo_usuario == 4) { // El empleado es mecanico, guardo numero matricula
				$numero_matricula = $_POST['nro_matricula'];
				
				//echo $numero_matricula;
				$consulta = mysql_query("UPDATE t_mecanico 
										SET matricula = '".$numero_matricula."'
										WHERE legajo = ".$legajo.";");
				
				if (!$consulta) {
					die('Consulta no válida: ' . mysql_error());
				} else { 
					echo "Matricula modificada. <br>";
				}
			}
			//echo "Empleado modificado";
			 header('location:main.php');
	} 
	
?>