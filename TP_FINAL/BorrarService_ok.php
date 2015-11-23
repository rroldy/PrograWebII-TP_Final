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
									<h3>Borrar Service</h3>
									<form method="post" name="myform" action="Service_delete.php" onsubmit="return validacionBorrarServicio(this)">
									
									
										<input  type="hidden" name="id_servicio" id="id_servicio" value="<?php echo $id_servicio; ?>" placeholder="NRO DE SERVICIO" />
										
                                       <div class="table-wrapper">
										    <table class="alt">
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
                                        </div>

										<div class="row uniform">
											<div class="12u">
												<ul class="actions">
													<li><input type="submit" value="Confirmar" /></li>	
													<li><input type="button" value="Cancelar" class="alt" onclick="volverHome()"/></li>												
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
						window.location.replace("main.php");
				}
	</script>				
			

	</body>
</html>