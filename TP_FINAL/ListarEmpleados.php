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
						<h4>Listado de empleados</h4>
						<div class="table-wrapper">
						
						<?php
							
							$conexion = mysql_connect("127.0.0.1", "root", "");
						
							if(!$conexion) {
								die('No pudo conectarse correctametne a la base de datos: ' . mysql_error());
							}
							if (!mysql_select_db("logistica", $conexion)) {
								die('No pudo ubicarse la base de datos que intenta usar: ' . mysql_error());
							}
							// Armo listado de empleados
							$consulta = mysql_query("SELECT usuario, legajo, tipo_doc, nro_doc, cuil, nombre, apellido, fecha_nac, direccion, localidad, 
															provincia, pais, codigo_postal, id_rol, password 
													FROM 	t_empleado
													WHERE 	visible = 1;");
							if (!$consulta) {
									die('Consulta no válida: ' . mysql_error());
							} 
							
							print ("<table>
										<thead>
											<tr>
												<tr>
												<th align='left'>Legajo</th>
												<th align='left'>DNI</th>
												<th align='left'>CUIL</th>
												<th align='left'>Usuario</th>
												<th align='left'>Nombre</th>
												<th align='left'>Apellido</th>
												<th align='left'>Fecha Nac.</th>
												<th align='left'>Direccion</th>
											</tr>
										</thead>");
									
							while ($fila = mysql_fetch_assoc($consulta)) {
							
								print ("<tbody>
											<tr>
												<td width ='5%'>".$fila["legajo"]."</td>
												<td width ='10%'>".$fila["nro_doc"]."</td>
												<td width ='10%'>".$fila["cuil"]."</td>
												<td width ='15%'>".$fila["usuario"]."</td>
												<td width ='15%'>".$fila["nombre"]."</td>
												<td width ='15%'>".$fila["apellido"]."</td>
												<td width ='5%'>".$fila["fecha_nac"]."</td>
												<td width ='15%'>".$fila["direccion"]."</td>
											</tr>									
										</tbody>");
							}
							mysql_free_result($consulta);
										
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
						window.location.replace("ListarEmpleadosPDF.php");
				}
			</script>
	</body>
</html>