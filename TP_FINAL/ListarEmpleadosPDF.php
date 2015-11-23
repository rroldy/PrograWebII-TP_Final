<?php
	require_once("/dompdf/dompdf_config.inc.php");
	ob_start();
?>

<!DOCTYPE HTML>
<!--
	Alpha by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->

<html>
	<head>
		<title>Sistema de control de Flota</title>
	</head>
	<body>
		<div class="table-wrapper">
			<?php
				session_start();
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
							<tr>
								<th align='left'>Legajo</th>
								<th align='left'>DNI</th>
								<th align='left'>CUIL</th>
								<th align='left'>Usuario</th>
								<th align='left'>Nombre</th>
								<th align='left'>Apellido</th>
								<th align='left'>Fecha Nac.</th>
								<th align='left'>Direccion</th>
							</tr>");
										
				while ($fila = mysql_fetch_assoc($consulta)) {
					print ("<tr>
								<td width ='5%'>".$fila["legajo"]."</td>
								<td width ='15%'>".$fila["nro_doc"]."</td>
								<td width ='15%'>".$fila["cuil"]."</td>
								<td width ='15%'>".$fila["usuario"]."</td>
								<td width ='15%'>".$fila["nombre"]."</td>
								<td width ='15%'>".$fila["apellido"]."</td>
								<td width ='5%'>".$fila["fecha_nac"]."</td>
								<td width ='15%'>".$fila["direccion"]."</td>
							</tr>");
				}
				mysql_free_result($consulta);
											
				print ("</table>");
			?>
		</div>
	</body>
</html>

<?php
	$html = ob_get_clean();
	$dompdf = new DOMPDF();
	$dompdf->load_html($html);
	$dompdf->render();
	$dompdf->stream("Listado_Empleados.pdf");
?>