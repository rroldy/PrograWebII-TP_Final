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
						<div class="table-wrapper">
						
						<?php
							session_start();
							
							$legajo ="";
							if ( (isset($_POST["legajo"])) && ($_POST["legajo"] != NULL) ) {  
								$legajo = $_POST["legajo"];
							}
							
							$dni = "";
							if ( (isset($_POST["dni"])) && ($_POST["dni"] != NULL) ) {  
								$dni = $_POST["dni"];
							}
							
							$cuil = "";
							if ( (isset($_POST["cuil"])) && ($_POST["cuil"] != NULL) ) {  
								$cuil = $_POST["cuil"];
							}
							
							$nombre ="";
							if ( (isset($_POST["nombre"])) && ($_POST["nombre"] != NULL) ) {  
								$nombre = $_POST["nombre"];
							}
							
							$apellido ="";
							if ( (isset($_POST["apellido"])) && ($_POST["apellido"] != NULL) ) {  
								$apellido = $_POST["apellido"];
							}
							
							$parametros = "WHERE ";
							
							if ($legajo != "") {
								$parametros .= "legajo = ".$legajo." ";
							}	
							if ($dni != "") {
								if ($legajo != "") {
									$parametros .= "and dni = ".$dni." ";
								}
								else {  		
									$parametros .= "dni = ".$dni." ";
								}
							}	
							if ($cuil != "") {
								if ($dni != "" || $legajo != "") {
									$parametros .= "and cuil like '%".$cuil."%' ";
								}
								else { 
									$parametros .= "cuil like '%".$cuil."%' ";
								}
							}
							if ($nombre != "") {
								if ($cuil !="" || $dni !="" || $legajo != "") {
									$parametros .= "and nombre like '%".$nombre."%' ";
								} else { 
									$parametros .= "nombre like '%".$nombre."%' ";
								}
							}		
							if ($apellido != "" ) {
								if ($nombre !="" || $cuil !="" || $dni !="" || $legajo != "") { 
									$parametros .= "and apeliido like '%".$apellido."%' ";
								} else {
									$parametros .= "apeliido like '%".$apellido."%' ";
								}
							}
							
							//echo $parametros;
							
							
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
													FROM t_empleado
													".$parametros." 
													
													;");
							if (!$consulta) {
									die('Consulta no válida: ' . mysql_error());
							} 
							
							
							print ("<div class='12u'> ");
							print ("<!-- Form -->");
							print ("<section class='box'>");
							print ("<h3>Borrado de empleado</h3>");
							print ("<form method='post' action='BorrarEmpleado_delete.php'>");
							print ("<input type='hidden' id='legajo' name='legajo' value='".$legajo."'/>");
							print ("<table>
										<thead>
											<tr>
												<th>Legajo</th>
												<th>DNI</th>
												<th>CUIL</th>
												<th>Usuario</th>
												<th>Nombre</th>
												<th>Apellido</th>
												<th>Fecha Nac.</th>
											</tr>
										</thead>");
									
							while ($fila = mysql_fetch_assoc($consulta)) {
							
								print ("<tbody>
											<tr>
												<td id='legajo'>".$fila["legajo"]."</td>
												<td>".$fila["nro_doc"]."</td>
												<td>".$fila["cuil"]."</td>
												<td>".$fila["usuario"]."</td>
												<td>".$fila["nombre"]."</td>
												<td>".$fila["apellido"]."</td>
												<td>".$fila["fecha_nac"]."</td>
											</tr>									
										</tbody>");
							}
							mysql_free_result($consulta);
										
							print (		"<tfoot>
												<tr>
													
												</tr>
										</tfoot>
									</table>");
									
							print ("<div class='row uniform'>");
							print ("<div class='12u'>");
							print ("<ul class='actions'>");
							print ("<li><input type='submit' value='Borrar' /></li>");
							print ("<li><input type='button' class='alt' value='Cancelar' onclick='cancelar()'/></li>");
							print ("</ul>");
							print ("</div>");
							print ("</div>");
							print ("</form>");		
									
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
					window.location.replace("BorrarEmpleado.php");
				}
			</script>
	</body>
</html>