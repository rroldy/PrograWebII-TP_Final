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

	$idtransporte = $_POST['idtransporte'];

    $conexion = mysql_connect("localhost", "root", "");
	mysql_select_db("logistica");
	
	$consulta = mysql_query("select * from t_tipo_transporte");
	$consulta2 = mysql_query("select * from t_transporte INNER join t_tipo_transporte on t_tipo_transporte.id_tipo = t_transporte.id_tipo where id_transporte = ".$idtransporte);
	$consulta3 = mysql_query("select * from t_transporte INNER JOIN t_vehiculo on t_transporte.nro_chasis = t_vehiculo.nro_chasis where id_transporte = ".$idtransporte);
	
	$resultado2 = mysql_fetch_array($consulta2);
	$resultado3 = mysql_fetch_array($consulta3);

     $numero_filas = mysql_num_rows($consulta2);
		if ($numero_filas == 0 ){
				header('location:EditarVehiculo.php');
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

							<!-- Form -->
								<section class="box">
									<h3>Editar de vehiculo</h3>
									<form method="post" name="myform" action="Vehiculo_update.php" onsubmit="return validacionEditarVehiculo(this)" >
																		
										<div class="row uniform 50%">

											<div class="3u 12u(mobilep)">																							
												Interno <input type="text" name="idtransporte" id="idtransporte" value="<?php echo $resultado2['id_transporte'] ;?>" placeholder="NRO INTERNO" readonly STYLE='background-color:#708090; color:#FFFFFF;'/>
											</div>
											<div class="3u 12u(mobilep)">
												Patente <input type="text" name="patente" id="patente" value="<?php echo $resultado2['patente'] ;?>" placeholder="PATENTE" />
											</div>
											
										</div>
										<div class="row uniform 50%">	
											<div class="5u 12u(mobilep)">
												Nro. Chasis <input type="text" name="nrochasis" id="nrochasis" value="<?php echo $resultado2['nro_chasis'] ;?>" placeholder="NRO CHASIS" readonly STYLE='background-color:#708090; color:#FFFFFF;'/>
											</div>
											<div class="2u 12u(mobilep)">
                                        		Tipo de Vehiculo <input type="text" name="tipovehiculo" id="tipovehiculo" value="<?php echo $resultado2['descripcion'] ;?>" placeholder="NRO CHASIS" readonly STYLE='background-color:#708090; color:#FFFFFF;'/>                                 		
											</div>
											<div class="5u 12u(mobilep)">
												Nro. Motor <input type="text" name="nro_motor" id="nro_motor" value="<?php echo $resultado3['nro_motor'] ;?>" placeholder="NO TIENE MOTOR" readonly STYLE='background-color:#708090; color:#FFFFFF;' />
											</div>	
										</div>	
										<div class="row uniform 50%">
											<div class="5u 12u(mobilep)">
											     	Marca <input type="text" name="marca" id="marca" value="<?php echo $resultado2['marca'] ;?>" placeholder="MARCA" />
											     </div>
											<div class="5u 12u(mobilep)">
												Modelo <input type="text" name="modelo" id="modelo" value="<?php echo $resultado2['modelo'] ;?>" placeholder="MODELO" />
											</div>
											<div class="2u 12u(mobilep)">
												Fecha de Fabricacion <input type="date" value="<?php echo $resultado2['fecha_fabricacion'] ;?>" name="FechaFabrica" id="FechaFabrica">
											</div>	
										</div> 
										
										<div class="row uniform">
											<div class="12u">
												<ul class="actions">
													<li><input type="submit" value="Guardar" /></li>
													<li><input type="button" value="Volver" class="alt" onclick="volver()"/></li>
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

		<script>
				function volver() {
						window.location.replace("EditarVehiculo.php");
				}
		</script>		

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/jquery.scrollgress.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
			<script src="assets/js/validacionVehiculo.js"></script>
			

	</body>
</html>