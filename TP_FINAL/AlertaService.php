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

    $conexion = mysql_connect("localhost", "root", "");
	mysql_select_db("logistica");
	$consulta = mysql_query("SELECT t1.id_transporte, t1.kms, f_Service_x_Km(t1.kms, t1.id_transporte) q_service_falta, T2.descripcion from v_transportes_km t1 LEFT OUTER JOIN t_servicios t2 ON T2.id_servicio = f_Service_x_Km( t1.kms, t1.id_transporte)");
	
?>


<html>
	<head>
		<title>Sistema de control de Flota</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />

	</head>
	<body>
		<div id="page-wrapper">

			<!-- Header-->
				<?php include ('cabecera.html');?>
			 
			<!-- Main -->
			<div class="row">
						<div class="12u">

							<!-- Form -->
								<section class="box">
									<h3>Alerta de sevices</h3>
									<form method="post" name="myform" action="Service_delete.php" onsubmit="return validacionBorrarServicio(this)">
                                            
                                        <div class="table-wrapper">
										    <table class="alt">
											     <thead>
												    <tr>
													    <th>Nro. vhiculo</th>
													    <th>Kilometros actuales</th>
													    <th>Descripcion de service</th>
												    </tr>
												    <tbody>
															<?php
    										                    while ($reg=mysql_fetch_array($consulta)){
    										                       if($reg["q_service_falta"]!=0){         								
          										                       echo "<tr>"
          										                                ."<th>".$reg["id_transporte"]."</th>"
          										                                ."<th>".$reg["kms"]."</th>"
          										                                ."<th>".$reg["descripcion"]."</th>"
          										                            ."</tr>";
          										                   }          
    										                    }
										                    ?>
										             </tbody>       
                                            </table>
                                        </div>
                                    									
										
									
									
									</form>
									<hr />
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
			<script src="assets/js/main.js"></script>
			<script src="assets/js/validacionService.js"></script>
			

	</body>
</html>