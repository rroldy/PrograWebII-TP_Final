<?php

	require_once("/dompdf/dompdf_config.inc.php");
    session_start();
	ob_start();

    if (!$_SESSION['id_rol']) {
		session_destroy();
		header('location:login.html');

	}

	if ($_SESSION['id_rol'] == 1 or $_SESSION['id_rol'] == 2){
		$rol = $_SESSION['id_rol'];
	}else{header('location:main.php');
    }


    $conexion = mysql_connect("localhost", "root", "");
	mysql_select_db("logistica");
	$consulta = mysql_query("select * from t_servicios where activo = 0 order by km;");
	
?>


<html>
	<head>
		<title>Sistema de control de Flota</title>
	</head>
	<body>
		 <h3>Calendario de Services</h3>						
                                            
                                       
										<table border= "1">
											     <thead>
												    <tr>
													    <th>Nro. Servicio</th>
													    <th>Kilometros</th>
													    <th>Descripcion</th>
												    </tr>
												    <tbody>
															<?php
    										                    while ($reg=mysql_fetch_array($consulta)){          								
          										                    echo "<tr>"
          										                             ."<th>".$reg["id_servicio"]."</th>"
          										                             ."<th>".$reg["km"]."</th>"
          										                             ."<th>".$reg["descripcion"]."</th>"
          										                         ."</tr>";
    										                    }
										                    ?>
										             </tbody>       
                                            </table>
	</body>
</html>

<?php
	$html = ob_get_clean();
	$dompdf = new DOMPDF();
	$dompdf->load_html($html);
   	$dompdf->render();
	$dompdf->stream("Calendario_Service.pdf");
?>