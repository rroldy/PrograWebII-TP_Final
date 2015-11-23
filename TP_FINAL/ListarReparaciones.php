<!DOCTYPE HTML>
<!--
	Alpha by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)

-->

<?php
	session_start();


	
    if (!$_SESSION['id_rol']) {
		session_destroy();
		header('location:login.html');

	}

	if ($_SESSION['id_rol'] == 1 or $_SESSION['id_rol'] == 2 or $_SESSION['id_rol'] == 4){
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
		$consulta = mysql_query("	SELECT * FROM t_reparacion r
									INNER JOIN t_transporte t
									ON t.nro_chasis = t.nro_chasis
									INNER JOIN t_empleado e 
									on e.legajo = r.legajo
									where r.visible = 1
									GROUP by r.cod_reparacion;");
									
		if (!$consulta) {
			die('Consulta no válida: ' . mysql_error());
		} 
		
		$i = 0;
		$arrayReparaciones = array();		
		
		while ($row = mysql_fetch_assoc($consulta, MYSQL_ASSOC)) {
			$arrayReparaciones[$i]['cod_reparacion'] = $row['cod_reparacion'];
			$arrayReparaciones[$i]['patente'] = $row['patente'];
			$arrayReparaciones[$i]['marca'] = $row['marca'];
			$arrayReparaciones[$i]['modelo'] = $row['modelo'];
			$arrayReparaciones[$i]['legajo'] = $row['legajo'];
			$arrayReparaciones[$i]['nombre'] = $row['nombre'];
			$arrayReparaciones[$i]['apellido'] = $row['apellido'];
			$arrayReparaciones[$i]['id_tipo_repuesto'] = $row['id_tipo_repuesto'];
			$arrayReparaciones[$i]['fecha'] = $row['fecha'];
			$arrayReparaciones[$i]['costo'] = $row['costo'];
			$arrayReparaciones[$i]['km_unidad'] = $row['km_unidad'];
			$arrayReparaciones[$i]['repuesto'] = $row['repuesto'];
			$arrayReparaciones[$i]['finalizada'] = $row['finalizada'];
			
			//id_tipo_repuesto, fecha, costo, km_unidad, repuesto, finalizada, visible
			
			
			$i++;
			
		}
		mysql_free_result($consulta);	
		
		/*	
		foreach($arrayReparaciones as $reg) {
			echo $reg['cod_reparacion']."<br>"
			.$reg['patente']."<br>"
			.$reg['marca']."<br>"
			.$reg['modelo']."<br>"
			.$reg['legajo']."<br>"
			.$reg['nombre']."<br>"
			.$reg['apellido']."<br>"
			.$reg['id_tipo_repuesto']."<br>"
			.$reg['fecha']."<br>"
			.$reg['costo']."<br>"
			.$reg['km_unidad']."<br>"
			.$reg['repuesto']."<br>"
			.$reg['finalizada']."<br>";
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
						<h4>Listado de reparaciones</h4>
						<div class="table-wrapper">
						<?php
							print ("<table>
										<thead>
											<tr>
												<tr>
												<th align='left'>Codigo</th>
												<th align='left'>Transporte</th>
												<th align='left'>Mecanico</th>
												<th align='left'>Fecha</th>
												<th align='left'>Costo</th>
												<th align='left'>Km. Unidad</th>
												<th align='left'>Tipo repuesto</th>
												<th align='left'>Descripcion</th>
												<th align='left'>Estado</th>
											</tr>
										</thead>");
								$i = 0;	
							foreach($arrayReparaciones as $reg) {
							
								print ("<tbody>
											<tr>
												<td width ='5%'>".$reg["cod_reparacion"]."</td>
												<td width ='10%'>".$reg["patente"]."<br>".$reg["marca"]."<br>".$reg["modelo"]."</td>
												<td width ='10%'>".$reg["legajo"]."<br>".$reg["patente"]."<br>".$reg["apellido"].", ".$reg["nombre"]."</td>
												<td width ='15%'>".$reg["fecha"]."</td>
												<td width ='15%'>".$reg["costo"]."</td>
												<td width ='15%'>".$reg["km_unidad"]."</td>");
								if ($reg["id_tipo_repuesto"] == 1) {
									print ("<td width ='15%'> Interno </td>");	
								} else {
									print ("<td width ='15%'> Externo </td>");	
								}		
								print ("		<td width ='15%'>".$reg["repuesto"]."</td>");
												
								if ($reg["finalizada"] == 1) {
									print ("<td width ='15%'> Finalizada </td>");	
								} else {
									print ("<td width ='15%'> En curso </td>");	
								}
								
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
						window.location.replace("ListarReparacionesPDF.php");
				}
			</script>
	</body>
</html>

