<!DOCTYPE HTML>
<!--
	Alpha by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<?php
	$cod_viaje = $_POST['cod_viaje'];
	session_start();
	$conexion = mysql_connect("127.0.0.1", "root", "");
					
	if(!$conexion) {
		die('No pudo conectarse correctametne a la base de datos: ' . mysql_error());
	} else {
		if (!mysql_select_db("logistica", $conexion)) {
			die('No pudo ubicarse la base de datos que intenta usar: ' . mysql_error());
		}
		$consulta = mysql_query("SELECT * 
								FROM t_posicion where cod_viaje='".$cod_viaje."';");
		if (!$consulta) {
			die('Consulta no válida: ' . mysql_error());
		} 
		
		$numero_filas = mysql_num_rows($consulta);
		//echo $numero_filas;
		if ($numero_filas == 0 )
			header('location:ConsultarPosiciones.php');		// Si no hay coordenadas volvemos a la pagina anterior
		
		$arrayPosiciones = array();
		$i = 0;
		
		while ($row = mysql_fetch_assoc($consulta, MYSQL_ASSOC)) {
			$arrayPosiciones[$i]['cod_qr'] = $row['cod_qr'];
			$arrayPosiciones[$i]['cod_viaje'] = $row['cod_viaje'];
			$arrayPosiciones[$i]['lugar'] = $row['lugar'];
			$arrayPosiciones[$i]['cant_combustible'] = $row['cant_combustible'];
			$arrayPosiciones[$i]['importe'] = $row['importe'];
			$arrayPosiciones[$i]['fecha'] = date('d/m/Y',strtotime($row['fecha']));
			$arrayPosiciones[$i]['lat'] = $row['lat'];
			$arrayPosiciones[$i]['lng'] = $row['lng'];
			
			$i++;			
		}
		mysql_free_result($consulta);	
		
		// Armado del mapa de coordenadas:
		
		$mapa = "<script>
					var map = new GMaps({
					el: '#map',
					lat: -28.416097,
					lng: -63.616672,
					zoom: 5
					//var argentina = new google.maps.LatLng(-38.416097, -63.616672);
				});";
		//".$arrayPosiciones[$ind]['lugar']."
		for ($ind=0; $ind < count($arrayPosiciones); $ind++) {
			$x = $arrayPosiciones[$ind]['lat'];
			$y = $arrayPosiciones[$ind]['lng'];
			$lugar = $arrayPosiciones[$ind]['lugar'];
			$fecha = $arrayPosiciones[$ind]['fecha'];
			$mapa.= "map.addMarker({
							lat: ".$x.",
							lng: ".$y.",
							title: '".$lugar."',
							infoWindow: {
								
								content: '<p>".$lugar."<br>".$fecha."</p>'
							}
							
					});";
		}
		
		$mapa.= "</script>";
						
		// Busco los transportes asociados al viaje:
		
		// Vehiculo
		$consulta = mysql_query("	SELECT t.nro_chasis, t.patente, t.marca, t.modelo 
									FROM t_transporte t
									INNER JOIN t_viaje_transporte vt
									ON t.nro_chasis = vt.nro_chasis
									WHERE vt.cod_viaje = '".$cod_viaje."'
									AND t.id_tipo = 1;");

		while ($row = mysql_fetch_assoc($consulta, MYSQL_ASSOC)) {
			$vehiculo_nro_chasis = $row['nro_chasis'];
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
									WHERE vt.cod_viaje = '".$cod_viaje."'
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
									WHERE cv.cod_viaje = '".$cod_viaje."';");

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
		<script src="http://maps.google.com/maps/api/js?sensor=true"></script>
		<script src="assets/js/gmaps.js"></script>
		<style type="text/css">
			#map {
				 width: 650px;
				height: 350px;
			}
		</style>
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
								"<form method='post' action='ConsultarPosiciones2.php' name='frmConsultarPosiciones' id='frmConsultarPosiciones'>
										<div class='row uniform 50%'>
											<h4>Datos de viaje</h4>
										</div>
										<div class='row uniform 50%'>
											<div class='2u 12u(mobilep)'>
												Cod. Viaje <input type='text' STYLE='background-color:#708090; color:#FFFFFF;' name='cod_viaje' id='cod_viaje' value='".$cod_viaje."' placeholder='COD VIAJE' readonly/>
											</div>
										</div>	
										<div class='row uniform 50%'>
											<h4>Posiciones registradas</h4>
										</div>	
										
											<table>
												<thead>
													<tr>
														<th align='left'>Lugar</th>
														<th align='left'>Combustible</th>
														<th align='left'>Importe</th>
														<th align='left'>Fecha</th>
													</tr>
												</thead>
												<tbody>");
						
							foreach($arrayPosiciones as $reg) {
								print ("			<tr>
														<td>".$reg["lugar"]."</td>
														<td>".$reg["cant_combustible"]." lts.</td>
														<td>".$reg["importe"]." $</td>
														<td>".$reg["fecha"]."</td>
													</tr>");	
							}
							print ("			</tbody>
											</table>
										
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
										<div class='row uniform 50%'>
											<div class='6u 12u(mobilep)'>
												<div class='row uniform'>
													<h4>Mapa de coordenadas</h4> <br>
												</div>
												<div class='row uniform'>
													<div id='map'></div>
												</div>
											</div>
											<div class='6u 12u(mobilep)'>
												<div class='row uniform'>
													<h4>Vehiculo tractor: codigo QR</h4> <br>
												</div>
												<div class='row uniform'>
													<img src='qr.php?id=".$vehiculo_nro_chasis."' />
												</div>
											</div>											
										</div>
										
										<div class='row uniform'>
											<div class='12u'>
												<ul class='actions'>
													<li><input type='button' value='Volver' class='alt' onclick='volverHome()'/></li> 													
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
				function volverHome() {
					window.location.replace("ConsultarPosiciones.php");
				}
			</script>
			<?php echo $mapa; ?>
				
	</body>
</html>