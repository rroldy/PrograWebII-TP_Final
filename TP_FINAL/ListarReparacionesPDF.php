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

<?php
	session_start();
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
			
			$i++;
		}
		mysql_free_result($consulta);	
		
	}
?>	


<html>
	<head>
		<title>Sistema de control de Flota</title>
	</head>
	<body>
		<!-- Main -->
		<?php
			print ("<table>
						<thead>
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
																	
			print ("</table>");
		?>	
	</body>
</html>

<?php
	$html = ob_get_clean();
	$dompdf = new DOMPDF();
	$dompdf->load_html($html);
	$dompdf->render();
	$dompdf->stream("Listado_Reparaciones.pdf");
?>