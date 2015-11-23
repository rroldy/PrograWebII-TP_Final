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
		
	}
?>	

<html>
	<head>
		<title>Sistema de control de Flota</title>
	</head>
	<body>
				
				<?php
					print ("<table border='1'>
								<thead>
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
																	
					print ("</table>");
				?>	
	</body>
</html>

<?php
	$html = ob_get_clean();
	$dompdf = new DOMPDF();
	$dompdf->load_html($html);
	$dompdf->render();
	$dompdf->stream("Listado_Viajes.pdf");
?>