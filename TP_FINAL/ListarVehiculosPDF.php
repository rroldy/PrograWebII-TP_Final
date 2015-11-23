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
	$consulta = mysql_query("select * from t_transporte where visible = 1;");
	
?>


<html>
	<head>
		<title>Sistema de control de Flota</title>
	</head>
	<body>
		 <h3>Listado de vehiculos</h3>						
                                            
                                       
										    <table border="1">
											     <thead>
												    <tr>
													    <th>Nro. Interno</th>
													    <th>Nro. Chasis</th>
													    <th>Patente</th>
													    <th>Marca</th>
													    <th>Modelo</th>
													    <th>Fecha Fabricacion</th>
												    </tr>
												  </thead>
												    <tbody>
															<?php
    										                    while ($reg=mysql_fetch_array($consulta)){          								
          										                    echo "<tr>"
          										                             ."<th>".$reg["id_transporte"]."</th>"
          										                             ."<th>".$reg["nro_chasis"]."</th>"
          										                             ."<th>".$reg["patente"]."</th>"
          										                             ."<th>".$reg["marca"]."</th>"
          										                             ."<th>".$reg["modelo"]."</th>"
          										                             ."<th>".$reg["fecha_fabricacion"]."</th>"
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
	$dompdf->stream("Listado_Vehiculos.pdf");
?>