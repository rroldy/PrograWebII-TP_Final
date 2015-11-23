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
		$consulta = mysql_query("SELECT * 
								FROM t_viaje where cod_viaje='".$_POST['cod_viaje']."';");
		if (!$consulta) {
			die('Consulta no válida: ' . mysql_error());
		} 
			
		$numero_filas = mysql_num_rows($consulta);
		//echo $numero_filas;
		if ($numero_filas == 0 )
			header('location:ModificarViaje.php');		// Si no hay viaje con ese codig volvemos a la pagina anterior	
		
		while ($row = mysql_fetch_assoc($consulta, MYSQL_ASSOC)) {
			$cod_viaje = $row['cod_viaje'];
			$cliente = $row['cliente'];
			$tipo_carga = $row['tipo_carga'];
			$origen = $row['origen'];
			$destino = $row['destino'];
			$tipo_viaje = $row['tipo_viaje'];
			$finalizado = $row['finalizado'];
						
		}
		mysql_free_result($consulta);	
		
		$boton_finalizar = "";		
		if ($finalizado == 0) {	// Boton que activa la opcion de finalizar el viaje
			$boton_finalizar .="<li><input type='button' value='Finalizar viaje' onclick='finalizarViaje()'/> </li>";
			$estado = "EN CURSO";
		} else {
			$estado = "FINALIZADO";
		}
		
		// Busco los transportes asociados al viaje:
		
		// Vehiculo
		$consulta = mysql_query("	SELECT t.patente, t.marca, t.modelo 
									FROM t_transporte t
									INNER JOIN t_viaje_transporte vt
									ON t.nro_chasis = vt.nro_chasis
									WHERE vt.cod_viaje = '".$_POST['cod_viaje']."'
									AND t.id_tipo = 1;");

		while ($row = mysql_fetch_assoc($consulta, MYSQL_ASSOC)) {
			$vehiculo_patente = $row['patente'];
			$vehiculo_marca = $row['marca'];
			$vehiculo_modelo = $row['modelo'];
		}
		
		mysql_free_result($consulta);	
		
		// Acoplados
		$consulta = mysql_query("	SELECT t.patente, t.marca, t.modelo 
									FROM t_transporte t
									INNER JOIN t_viaje_transporte vt
									ON t.nro_chasis = vt.nro_chasis
									WHERE vt.cod_viaje = '".$_POST['cod_viaje']."'
									AND t.id_tipo = 2;");

		$arrayAcoplados = array();
		$i = 0;
		
		while ($row = mysql_fetch_assoc($consulta, MYSQL_ASSOC)) {
			$arrayAcoplados[$i]['patente'] = $row['patente'];
			$arrayAcoplados[$i]['marca'] = $row['marca'];
			$arrayAcoplados[$i]['modelo'] = $row['modelo'];
				
			$i++;
		}
		mysql_free_result($consulta);
		
		$texto_acoplado ="";
		if ( !empty($arrayAcoplados)) {
			$texto_acoplado .= "	<div class='6u 12u(mobilep)'>
									Acoplado/s ";
									
			foreach ($arrayAcoplados as $reg){          								
          		$texto_acoplado .= "<input type='text'STYLE='background-color:#708090; color:#FFFFFF;'  name='acoplado' id='acoplado' value='patente: ".$reg['patente']."  ||  marca: ".$reg['marca']."  ||  modelo: ".$reg['modelo']."' placeholder='ACOPLADO' readonly/>";
    		}
											
			$texto_acoplado .= "</div>";
		}	

		// t_chofer_viaje <-> t_empleado
		// Busco el/los chofer/res asociados al viaje	
		$consulta = mysql_query("	SELECT e.nombre, e.apellido, e.legajo 
									FROM t_empleado e
									INNER JOIN t_chofer_viaje cv
									ON e.legajo = cv.legajo
									WHERE cv.cod_viaje = '".$_POST['cod_viaje']."';");

		$arrayChoferes = array();
		$i = 0;	
		
		while ($row = mysql_fetch_assoc($consulta, MYSQL_ASSOC)) {
			$arrayChoferes[$i]['nombre'] = $row['nombre'];
			$arrayChoferes[$i]['apellido'] = $row['apellido'];
			$arrayChoferes[$i]['legajo'] = $row['legajo'];
				
			$i++;
		}
		mysql_free_result($consulta);	
				
		$texto_chofer ="<div class='row uniform 50%'>
							<div class='6u 12u(mobilep)'>
								Chofer/res";
	
		foreach ($arrayChoferes as $reg){
			$texto_chofer .="<input type='text' STYLE='background-color:#708090; color:#FFFFFF;' name='chofer' id='chofer' value='legajo: ".$reg['legajo']."  ||  Chofer: ".$reg['apellido'].", ".$reg['nombre']."' placeholder='CHOFER' readonly/>";
		}
		
		$texto_chofer .="	</div>
						</div>";
		
		
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
								"<form method='post' action='ModificarViaje_update.php' name='frmModificarViaje' id='frmModificarViaje'>
										<div class='row uniform 50%'>
											<h4>Datos de viaje</h4>
										</div>
										<div class='row uniform 50%'>
											<div class='2u 12u(mobilep)'>
												Cod. Viaje <input type='text' STYLE='background-color:#708090; color:#FFFFFF;' name='cod_viaje' id='cod_viaje' value='".$cod_viaje."' placeholder='COD VIAJE' readonly/>
											</div>
											<div class='2u 12u(mobilep)'>
												Estado <input type='text' STYLE='background-color:#708090; color:#FFFFFF;' name='estado_actual_viaje' id='estado_actual_viaje' value='".$estado."' placeholder='ESTADO' readonly/>
											</div>
											<div class='8u 12u(mobilep)'>
												Cliente <input type='text' name='cliente' id='cliente' value='".$cliente."' placeholder='CLIENTE' />
											</div>
											</div>
											<div class='row uniform 50%'>
												<div class='6u 12u(mobilep)'>
													Origen <input type='text' name='origen' id='origen' value='".$origen."' placeholder='ORIGEN' />
												</div>
											<div class='6u 12u(mobilep)'>
												Destino <input type='text' name='destino' id='destino' value='".$destino."' placeholder='DESTINO' />
											</div>
										</div>
										<div class='row uniform 50%'>
											<h4>Datos de la Carga</h4>
										</div>	
										<div class='row uniform 50%'>	
											<div class='6u 12u(mobilep)'>
												Tipo de Carga <input type='text' name='tipo_carga' id='tipo_carga' value='".$tipo_carga."' placeholder='TIPO CARGA' />
											</div>
											<div class='6u 12u(mobilep)'>
												Tipo viaje <input type='text' name='tipo_viaje' id='tipo_viaje' value='".$tipo_viaje."' placeholder='TIPO VIAJE' />
											</div>											
										</div>
										<div class='row uniform 50%'>
											<h4>Datos Transporte</h4>
										</div>	
										<div class='row uniform 50%'>	
											<div class='6u 12u(mobilep)'>
												Vehiculo tractor
												<input type='text' STYLE='background-color:#708090; color:#FFFFFF;' name='vehiculo' id='vehiculo' value='patente: ".$vehiculo_patente."  ||  marca: ".$vehiculo_marca."  ||  modelo: ".$vehiculo_modelo."' placeholder='VEHICULO' readonly/>
											</div>
											".$texto_acoplado."
										</div>
										".$texto_chofer."
										<input type='hidden' value='' name='estado' id='estado' />
										<input type='hidden' value='".$cod_viaje."' name='cod_viaje' id='cod_viaje' />
										<div class='row uniform'>
											<div class='12u'>
												<ul class='actions'>
													<!--
													<li><button type='button' value='Guardar' onclick='modificarViaje()'>Guardar cambios</button></li>
													-->
													<li><input type='button' value='Guardar cambios' onclick='modificarViaje()'/> </li>
													".$boton_finalizar."
													<!--
													<li><button type='button' value='cancelar' onclick='cancelar()'>Cancelar</button></li>
													-->													
													<li><input type='button' value='Cancelar' class='alt' onclick='cancelar()'/> </li>
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
					window.location.replace("ModificarViaje.php");
				}
				
				function modificarViaje() {
					document.getElementById("estado").setAttribute("value","modificarViaje");
					document.getElementById("frmModificarViaje").submit();
					//return true;
				}
				
				function finalizarViaje() {
					document.getElementById("estado").setAttribute("value","finalizarViaje");
					document.getElementById("frmModificarViaje").submit();
					//return true;
				}
				
			</script>
	</body>
</html>