<!DOCTYPE HTML>


<?php
	session_start();



    if (!$_SESSION['id_rol']) {
		session_destroy();
		header('location:login.html');

	}

	if ($_SESSION['id_rol'] == 1 or $_SESSION['id_rol'] == 2){
		$rol = $_SESSION['id_rol'];
	}else{header('location:main.php');
    }


	$conexion = mysql_connect("127.0.0.1", "root", "");
					
	if(!$conexion) {
		die('No pudo conectarse correctametne a la base de datos: ' . mysql_error());
	} else {
		if (!mysql_select_db("logistica", $conexion)) {
			die('No pudo ubicarse la base de datos que intenta usar: ' . mysql_error());
		}
		// Armo listado de Viajes
		$consulta = mysql_query("SELECT * 
								FROM t_viaje;");
		if (!$consulta) {
			die('Consulta no válida: ' . mysql_error());
		} 
		
		$i = 0;
		$arrayViajes = array();
		
		while ($row = mysql_fetch_assoc($consulta, MYSQL_ASSOC)) {
			$arrayViajes[$i]['cod_viaje'] = $row['cod_viaje'];
			$arrayViajes[$i]['cliente'] = $row['cliente'];
			$arrayViajes[$i]['tipo_carga'] = $row['tipo_carga'];
			$arrayViajes[$i]['origen'] = $row['origen'];
			$arrayViajes[$i]['destino'] = $row['destino'];
			$arrayViajes[$i]['tipo_viaje'] = $row['tipo_viaje'];
			$arrayViajes[$i]['finalizado'] = $row['finalizado'];
			
			$i++;
			
		}
		mysql_free_result($consulta);	
		/*	
		foreach($arrayViajes as $reg) {
			echo $reg['cod_viaje']." ".$reg['cliente']." ".$reg['tipo_carga']." ".$reg['origen']." ".$reg['destino']." ".$reg['tipo_viaje']." ".$reg['finalizado']."<br>";
		}*/
		
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
						<h4>Listado de viajes</h4>
						<div class="table-wrapper">
						<form method="post" action="ListarViajes1.php" name="frmBajaViaje" id="frmBajaViaje">
						<?php
							print ("<table>
										<thead>
											<tr>
												<tr>
												<th align='left'>Codigo</th>
												<th align='left'>Cliente</th>
												<th align='left'>Tipo de carga</th>
												<th align='left'>Origen</th>
												<th align='left'>Destino</th>
												<th align='left'>Tipo viaje</th>
												<th align='left'>Estado</th>
											</tr>
										</thead>");
								$i = 0;	
							foreach($arrayViajes as $reg) {
							
								print ("<tbody>
											<tr>
												<td width ='5%'>".$reg["cod_viaje"]."</td>
												<td width ='10%'>".$reg["cliente"]."</td>
												<td width ='10%'>".$reg["tipo_carga"]."</td>
												<td width ='15%'>".$reg["origen"]."</td>
												<td width ='15%'>".$reg["destino"]."</td>
												<td width ='15%'>".$reg["tipo_viaje"]."</td>");
												
								if ($reg["finalizado"] == 1) {
									print ("<td width ='15%'> Finalizado </td>");	
								} else {
									print ("<td width ='15%'> En curso </td>");	
								}
								print ("<input type='hidden' name='cod' value='".$reg["cod_viaje"]."'/>");
								
								print ("	</tr>									
										</tbody>");
										
								$i++;		
							}
																	
							print (		"<tfoot>
												<tr>
													
												</tr>
										</tfoot>
									</table>");
						?>	
										
						</form>				
										
						</div>
						
						<div class="row uniform 50%">
							<div class="row uniform">
								<div class="12u">
									<ul class="actions">
										<li><input type="button" value="Volver" class="alt" onclick="volverHome()"/></li>
										<li><input type="button" value="Generar listado" onclick="generarListado()"/></li>											
									</ul>
								</div>
							</div>
							<hr />
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
						window.location.replace("main.php");
				}
				
				function generarListado() {
						window.location.replace("ListarViajesPDF.php");
				}
			</script>
	</body>
</html>

