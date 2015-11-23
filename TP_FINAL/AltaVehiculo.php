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


    $conexion = mysql_connect("localhost", "root", "");
	mysql_select_db("logistica");
	$consulta = mysql_query("select * from t_tipo_transporte");
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
									<h3>Alta de vehiculo</h3>
									<form method="post" name="myform" action="AltaVehiculo_insert.php" onsubmit="return validacionEditarVehiculo(this)">
								
										<div class="row uniform 50%">
											<div class="3u 12u(mobilep)">
												Interno <input type="text" name="idtransporte" id="idtransporte" value="" placeholder="NRO INTERNO" />
											</div>
											<div class="3u 12u(mobilep)">
												Patente <input type="text" name="patente" id="patente" value="" placeholder="PATENTE" />
											</div>
										</div>
										<div class="row uniform 50%">	
											<div class="5u 12u(mobilep)">
												Nro. Chasis <input type="text" name="nrochasis" id="nrochasis" value="" placeholder="NRO CHASIS" />
											</div>
											<div class="2u 12u(mobilep)">
                                        		Tipo de Vehiculo
												<select name="tipovehiculo" id="tipovehiculo">
													<option value="">TIPO DE VEHICULO</option>;
													<?php
    													while ($reg=mysql_fetch_array($consulta)){          								
          													echo "<option value='".$reg["id_tipo"]."'>".$reg["descripcion"]."</option>";
    													}
													?>
												</select>												
											</div>
											<div class="5u 12u(mobilep)">
												Nro. Motor <input type="text" name="nro_motor" id="nro_motor" value="" placeholder="NRO MOTOR" />
											</div>	
										</div>	
										<div class="row uniform 50%">
											<div class="5u 12u(mobilep)">
											     	Marca <input type="text" name="marca" id="marca" value="" placeholder="MARCA" />
											     </div>
											<div class="5u 12u(mobilep)">
												Modelo <input type="text" name="modelo" id="modelo" value="" placeholder="MODELO" />
											</div>
											<div class="2u 12u(mobilep)">
												Fecha de Fabricacion <input type="date" name="FechaFabrica" id="FechaFabrica">
											</div>	
										</div>
										<div class="row uniform">
											<div class="12u">
												<ul class="actions">
													<li><input type="submit" value="Guardar" /></li>
													<li><input type="reset" value="Reset" class="alt" /></li>
												</ul>
											</div>
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
			<script src="assets/js/validacionVehiculo.js"></script>
	</body>
			

	</body>
</html>