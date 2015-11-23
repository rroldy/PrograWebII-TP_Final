<?php
    session_start();
	
	
	if(!$_SESSION['id_rol']) {
		session_destroy();
		header('location:login.html');
        echo "";

		session_destroy();
	}


	if ($_SESSION['id_rol'] == 1 or  $_SESSION['id_rol'] == 2){
		$rol = $_SESSION['id_rol'];
	}else{header('location:main.php');
    }


    $conexion = mysql_connect("localhost", "root", "");
	mysql_select_db("logistica");
	$consulta = mysql_query("SELECT po.cod_viaje, SUM(po.cant_combustible) su_comb, SUM(po.importe) su_importe from t_posicion as po group by po.cod_viaje");
	
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
									<h3>Consumo de combustible x viaje</h3>
									<form method="post" name="myform" action="Service_delete.php" onsubmit="return validacionBorrarServicio(this)">
                                            
                                        <div class="table-wrapper">
										    <table class="alt">
											     <thead>
												    <tr>
													    <th>Codigo de Viaje</th>
													    <th>Cant. Combustible</th>
													    <th>Importe Total</th>
												    </tr>
												    <tbody>
															<?php
    										                    while ($reg=mysql_fetch_array($consulta)){          								
          										                    echo "<tr>"
          										                             ."<th>".$reg["cod_viaje"]."</th>"
          										                             ."<th>".$reg["su_comb"]."</th>"
          										                             ."<th>".$reg["su_importe"]."</th>"
          										                         ."</tr>";
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