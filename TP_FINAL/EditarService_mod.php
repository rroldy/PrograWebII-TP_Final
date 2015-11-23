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

	$id_servicio = $_POST['id_servicio'];

    $conexion = mysql_connect("localhost", "root", "");
	mysql_select_db("logistica");
	
	$consulta = mysql_query("select * from t_servicios where id_servicio = '".$id_servicio."';");
	$resultado = mysql_fetch_array($consulta);

	$numero_filas = mysql_num_rows($consulta);
		if ($numero_filas == 0 )
			header('location:EditarService.php');
	
?>


<html>
	<head>
		<title>Sistema de control de Flota</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	<!-- Header-->
        <?php include ('cabecera.html');?>
			 
			<!-- Main -->
			<div class="row">
						<div class="12u">

							<!-- Form -->
								<section class="box">
									<h3>Editar de service</h3>
									<form method="post" name="myform" action="Servicio_update.php" onsubmit="return validacioninsertService(this)" >
																		
										<div class="row uniform 50%">

											<div class="3u 12u(mobilep)">																							
												Nro. de Service <input type="text" name="id_servicio" id="id_servicio" value="<?php echo $resultado['id_servicio'] ;?>" placeholder="NRO INTERNO" readonly  STYLE='background-color:#708090; color:#FFFFFF;'/>
											</div>
											<div class="3u 12u(mobilep)">
												Kilometros <input type="text" name="km" id="km" value="<?php echo $resultado['km'] ;?>" placeholder="Kilometros" />
											</div>
											
										</div>
									    
                                       	<div class="row uniform 50%">
											<div class="12u">
												<textarea name="descripcion" id="descripcion" placeholder="DETALLE DEL SERVICE" rows="6"><?php echo $resultado['descripcion'] ;?> </textarea>
											</div>
										</div>									
										
										<div class="row uniform">
											<div class="12u">
												<ul class="actions">
													<li><input type="submit" value="Guardar" /></li>
													<li><input type="button" value="Volver" class="alt" onclick="volverHome()"/></li>
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
			<script src="assets/js/validacionService.js"></script>

			<script>
				function volverHome() {
						window.location.replace("EditarService.php");
				}
			</script>	
			

	</body>
</html>