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
	$consulta = mysql_query("select * from t_transporte where visible = 1;");
	
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
									<h3>Listado de vehiculos</h3>
									<form method="post" name="myform" action="Service_delete.php" onsubmit="return validacionBorrarServicio(this)">
                                            
                                        <div class="table-wrapper">
										    <table class="alt">
											     <thead>
												    <tr>
													    <th>Nro. Interno</th>
													    <th>Nro. Chasis</th>
													    <th>Patente</th>
													    <th>Marca</th>
													    <th>Modelo</th>
													    <th>Fecha Fabricacion</th>
												    </tr>
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

            <script>
				function volverHome() {
						window.location.replace("main.php");
				}
				
				function generarListado() {
						window.location.replace("ListarVehiculosPDF.php");
				}
			</script>


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