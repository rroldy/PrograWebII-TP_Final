<!DOCTYPE HTML>

<?php
  
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
									<h3>Alta de Service</h3>
									<form method="post" name="myform" action="AltaService_insert.php" onsubmit="return validacioninsertService(this)">
								
										<div class="row uniform 50%">
											<div class="3u 12u(mobilep)">
											     	KM <input type="text" name="km" id="km" value="" placeholder="KILOMETROS" />
											</div>
										
										</div>

										<div class="row uniform 50%">
											<div class="12u">
												<textarea name="descripcion" id="descripcion" placeholder="DETALLE DEL SERVICE" rows="6"></textarea>
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
			<script src="assets/js/validacionService.js"></script>
	</body>
			

	</body>
</html>