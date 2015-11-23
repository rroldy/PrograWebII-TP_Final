<!DOCTYPE HTML>
<!--
	Alpha by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<?php
	session_start();
	$conexion = mysql_connect("127.0.0.1", "root", "");
					
	if(!$conexion) {
		die('No pudo conectarse correctametne a la base de datos: ' . mysql_error());
	} else {
		if (!mysql_select_db("logistica", $conexion)) {
			die('No pudo ubicarse la base de datos que intenta usar: ' . mysql_error());
		}
		/*$consulta = mysql_query("SELECT * 
								FROM t_reparacion where cod_reparacion='".$_POST['cod_reparacion']."'
								AND visible = 1;");
		*/
		
		$consulta = mysql_query("	SELECT * 
									FROM t_reparacion r 
									INNER JOIN t_transporte t ON t.nro_chasis = t.nro_chasis 
									INNER JOIN t_empleado e on e.legajo = r.legajo 
									INNER JOIN t_tipo_repuesto tr on tr.id_tipo = r.id_tipo_repuesto
									WHERE r.cod_reparacion = ".$_POST['cod_reparacion']." 
									AND finalizada = 0 
									AND disponible = 1 
									GROUP BY r.cod_reparacion"); 
		
		
		if (!$consulta) {
			die('Consulta no válida: ' . mysql_error());
		} 
		
		$numero_filas = mysql_num_rows($consulta);
		//echo $numero_filas;
		if ($numero_filas == 0 )
			header('location:ModificarReparacion.php');		// Si no hay reparacion disponible volvemos a la pagina anterior
		
		while ($row = mysql_fetch_assoc($consulta, MYSQL_ASSOC)) {
			/*
			$cod_reparacion = $row['cod_reparacion'];
			$nro_chasis = $row['nro_chasis'];
			$legajo = $row['legajo'];
			$id_tipo_repuesto = $row['id_tipo_repuesto'];
			$fecha = $row['fecha'];
			$costo = $row['costo'];
			$km_unidad = $row['km_unidad'];
			$repuesto = $row['repuesto'];
			$finalizada = $row['finalizada'];
			*/
			$cod_reparacion = $row['cod_reparacion'];
			$nro_chasis = $row['nro_chasis'];
			$patente = $row['patente'];
			$marca = $row['marca'];
			$modelo = $row['modelo'];
			$legajo = $row['legajo'];
			$nombre = $row['nombre'];
			$apellido = $row['apellido'];
			$tipo_repuesto = $row['descripcion'];
			$fecha = $row['fecha'];
			$costo = $row['costo'];
			$km_unidad = $row['km_unidad'];
			$repuesto = $row['repuesto'];
			$finalizada = $row['finalizada'];
			
		}
		mysql_free_result($consulta);	
		
		$boton_finalizar = "";		
		if ($finalizada == 0) {	// Boton que activa la opcion de finalizar la reparacion
			//$boton_finalizar .="<li><button type='button' value='finalizar' onclick='finalizarReparacion()'>Finalizar reparacion</button></li>";
			$boton_finalizar .="<li><input type='button' value='Finalizar reparacion' onclick='finalizarReparacion()'/></li>";
			$estado = "EN CURSO";
		} else {
			$estado = "FINALIZADA";
		}
	}
?>

<html>
	<head>
		<title>Sistema de control de Flota</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	<body>
		<div id="page-wrapper">

			<!-- Header-->
			<?php include ('cabecera.html');?>
			 
			<!-- Main -->
			<div class="row">
				<div class="12u">
							
					<section class="box">
						<div class="table-wrapper">
						
						<?php
							print (
								"<form method='post' action='ModificarReparacion_update.php' name='frmModificarReparacion' id='frmModificarReparacion'>
										<div class='row uniform 50%'>
											<h4>Datos de la reparaci&oacute;n</h4>
										</div>
										<div class='row uniform 50%'>
											<div class='2u 12u(mobilep)'>
												Cod. Reparaci&oacute;n <input type='text' STYLE='background-color:#708090; color:#FFFFFF;' name='cod_reparacion' id='cod_reparacion' value='".$cod_reparacion."' placeholder='COD REPARACION' readonly/>
											</div>
											<div class='2u 12u(mobilep)'>
												Estado <input type='text' STYLE='background-color:#708090; color:#FFFFFF;' name='estado_actual_reparacion' id='estado_actual_repraracion' value='".$estado."' placeholder='ESTADO' readonly/>
											</div>
										</div>
										<div class='row uniform 50%'>
											<div class='2u 12u(mobilep)'>
												Fecha <input type='text' name='fecha' id='fecha' value='".$fecha."' placeholder='FECHA(AAAA-MM-DD)' />
											</div>
											<div class='5u 12u(mobilep)'>
												Costo <input type='text' name='costo' id='costo' value='".$costo."' placeholder='COSTO' />
											</div>
											<div class='5u 12u(mobilep)'>
												Km. Unidad <input type='text' name='km_unidad' id='km_unidad' value='".$km_unidad."' placeholder='KM. UNIDAD' />
											</div>
										</div>
										<div class='row uniform 50%'>
											<h4>Datos del repuesto</h4>
										</div>		
										<div class='row uniform 50%'>	
											<div class='3u 12u(mobilep)'>
												Tipo repuesto <input type='text' STYLE='background-color:#708090; color:#FFFFFF;' name='tipo_repuesto' id='tipo_repuesto' value='".$tipo_repuesto."' placeholder='TIPO REPUESTO' readonly/> 
									
											</div>
											<div class='9u 12u(mobilep)'>
												Repuesto <input type='text' name='repuesto' id='repuesto' value='".$repuesto."' placeholder='DESCRIPCION' />
											</div>
										</div>
										<div class='row uniform 50%'>
											<h4>Unidad afectada / Mecanico asignado</h4>
										</div>
										
										<div class='row uniform 50%'>	
											<div class='6u 12u(mobilep)'>
												Transporte <input type='text' STYLE='background-color:#708090; color:#FFFFFF;' name='transporte' id='transporte' value='patente: ".$patente."  ||  marca: ".$marca."  ||  modelo: ".$modelo."' placeholder='TRANSPORTE' readonly/>
											</div>
											<div class='6u 12u(mobilep)'>
												Mecanico <input type='text' STYLE='background-color:#708090; color:#FFFFFF;' name='chofer' id='chofer' value='legajo: ".$legajo."  ||  Mecanico: ".$apellido.", ".$nombre."' placeholder='MECANICO' readonly/>
											</div>									
										</div>
										
										<input type='hidden' value='' name='estado' id='estado' />
										<input type='hidden' value='".$cod_reparacion."' name='cod_reparacion' id='cod_reparacion' />
										<input type='hidden' value='".$nro_chasis."' name='nro_chasis' id='nro_chasis' />
										<input type='hidden' value='".$legajo."' name='legajo' id='legajo' />
										<div class='row uniform'>
											<div class='12u'>
												<ul class='actions'>
													<!-- <li><button type='button' value='Guardar' onclick='modificarReparacion()'>Guardar cambios</button></li> -->
													<input type='button' value='Guardar cambios' onclick='modificarReparacion()'/></li>
													".$boton_finalizar."
													<!-- <li><button type='button' value='cancelar' onclick='cancelar()'>Cancelar</button></li> -->													
													<input type='button' value='Cancelar' class='alt' onclick='cancelar()'/></li>
												</ul>
											</div>
										</div>
								</form>");
						?>	
						</div>
						
					</section>				

                </div>
			</div>

			<!-- Footer -->
				<footer id="footer">

					<ul class="copyright">
						<li>Programacion Web II</li><li>Roldan - Sanchez - Rodriguez</li>
					</ul>
				</footer>

		</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/jquery.scrollgress.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>
			<script>
				function cancelar() {
					window.location.replace("ModificarReparacion.php");
				}
				
				function modificarReparacion() {
					document.getElementById("estado").setAttribute("value","modificarReparacion");
					document.getElementById("frmModificarReparacion").submit();
				}
				
				function finalizarReparacion() {
					document.getElementById("estado").setAttribute("value","finalizarReparacion");
					document.getElementById("frmModificarReparacion").submit();
				}
				
			</script>
	</body>
</html>