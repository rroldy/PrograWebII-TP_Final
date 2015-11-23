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
			<div class="12u">
				<!-- Form -->
				<section class="box">
					<h3>Consultar posiciones de un viaje</h3>
					<form method="post" name="frmConsultarPosiciones" onsubmit="return validar()" id="frmConsultarPosiciones" action="ConsultarPosiciones_display.php">
						<div class="row uniform 50%">
							<div class="4u 12u(mobilep)">
								Codigo viaje <input type="text" name="cod_viaje" id="cod_viaje" value="" placeholder="COD. VIAJE" />
							</div>
						</div>	
						<div class="row uniform 50%">
							<div class="row uniform">
								<div class="12u">
									<ul class="actions">
										<li><input type="submit" value="Buscar" /></li>
										<li><input type="button" value="Volver" class="alt" onclick="volverHome()"/></li> 
									</ul>
								</div>
							</div>
							<hr />
						</div>
					<form>
				</section>
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
			<script src="assets/validateForms/dist/jquery.validate.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>
			<script>
				function volverHome() {
					window.location.replace("main.php");
				}
				
				function validar() {
					var cod = document.getElementById("cod_viaje");
					
					if (!(cod.value)) {
						alert("Debe ingresar un codigo de viaje");
						return false;
					}
					
					return true;					
					//document.getElementById("frmConsultarPosiciones").submit();
				}
				
			</script>
	</body>
</html>