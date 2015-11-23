<!DOCTYPE HTML>

<?php

	session_start();


	
    if (!$_SESSION['id_rol']) {
		session_destroy();
		header('location:login.html');

	}

	if ($_SESSION['id_rol'] == 1 or $_SESSION['id_rol'] == 2 or $_SESSION['id_rol'] == 4){
		$rol = $_SESSION['id_rol'];
	}else{header('location:main.php');




	$conexion = mysql_connect("localhost", "root", "");
	mysql_select_db("logistica");
	
	$mecanico = mysql_query("	SELECT matricula, e.legajo, nombre, apellido 
								FROM t_empleado e 
								INNER JOIN t_mecanico m on m.legajo = e.legajo 
								WHERE id_rol = 4 
								AND m.disponible = 1
								AND e.visible = 1; ");
	
	$arrayMecanicos = array();
	$i = 0;
	while ($row = mysql_fetch_assoc($mecanico, MYSQL_ASSOC)) {
		$arrayMecanicos[$i]['matricula'] = $row['matricula'];
		$arrayMecanicos[$i]['legajo'] = $row['legajo'];
		$arrayMecanicos[$i]['nombre'] = $row['nombre'];
		$arrayMecanicos[$i]['apellido'] = $row['apellido'];
	
		$i++;
	}
	mysql_free_result($mecanico);
	/*	
	foreach($arrayMecanicos as $reg) {
		echo $reg['matricula']." ".$reg['legajo']." ".$reg['nombre']." ".$reg['apellido']." <br>";
	}*/
			
	$transporte = mysql_query("	SELECT nro_chasis, marca, modelo, patente 
								FROM t_transporte
								WHERE visible = 1
								AND reparacion = 0;");
								
	$arrayTransportes = array();
	$i=0;
	while ($row = mysql_fetch_assoc($transporte, MYSQL_ASSOC)) {
		$arrayTransportes[$i]['nro_chasis'] = $row['nro_chasis'];
		$arrayTransportes[$i]['marca'] = $row['marca'];
		$arrayTransportes[$i]['modelo'] = $row['modelo'];
		$arrayTransportes[$i]['patente'] = $row['patente'];
		
		$i++;
	}
	mysql_free_result($transporte);
	/*
	foreach($arrayTransportes as $reg) {
		echo $reg['nro_chasis']." ".$reg['marca']." ".$reg['modelo']." ".$reg['patente']." <br>";
	}*/
		
	mysql_close($conexion);
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
	<body onload="setCombos()">
		<div id="page-wrapper">
			<!-- Header-->
			<?php include ('cabecera.html');?>	
			 
			<!-- Main -->
			<div class="row">
				<div class="12u">

					<!-- Form -->
					<section class="box">
					
					<h3>Alta de reparaci&oacute;n</h3>
					
					<form method="post" action="AltaReparacion_insert.php" onsubmit="return validar()" name="frmAltaReparacion" id="frmAltaReparacion">
						<div class="row uniform 50%">
							<h4>Datos de la reparaci&oacute;n</h4>
						</div>
						<div class="row uniform 50%">
							<div class="2u 12u(mobilep)">
								Cod. Reparaci&oacute;n <input type="text" name="cod_reparacion" id="cod_reparacion" value="" placeholder="COD. REPARACION" />
							</div>
						</div>
						<div class="row uniform 50%">
							
							<div class="2u 12u(mobilep)">
								Fecha <input type="text" name="fecha_reparacion" id="fecha_reparacion" value="" placeholder="FECHA(AAAA-MM-DD)" />
							</div>
							<div class="2u 12u(mobilep)">
								Costo <input type="text" name="costo" id="costo" value="" placeholder="COSTO" />
							</div>
							<div class="2u 12u(mobilep)">
								Km. Unidad <input type="text" name="km_unidad" id="km_unidad" value="" placeholder="KM. UNIDAD" />
							</div>
						</div>
						<div class="row uniform 50%">
							<h4>Datos del repuesto</h4>
						</div>	
						<div class="row uniform 50%">	
							<div class="3u 12u(mobilep)">
								Tipo repuesto 
								<select name="tipo_repuesto" id="tipo_repuesto">
									<option value="">TIPO</option>
									<option value="1"> Interno </option>          													
    								<option value="2"> Extreno </option>          													
    							</select>
							</div>
							<div class="9u 12u(mobilep)">
						     	Repuesto <input type="text" name="repuesto" id="repuesto" value="" placeholder="DESCRIPCION" />
						     </div>
						</div>
						<div class="row uniform 50%">
							<h4>Unidad afectada / Mecanico asignado</h4>
						</div>
						<div class="row uniform 50%">	
							<div class="6u 12u(mobilep)">
								Transporte
								<select name="transporte" id="transporte">
									<option value="">TRANSPORTE</option>;
										<?php
											foreach ($arrayTransportes as $reg){          								
          										echo "<option value='".$reg["nro_chasis"]."'> "."patente: ".$reg["patente"]." | marca: ".$reg["marca"]." | modelo: ".$reg["modelo"]."</option>";          													
    										}
										?>
								</select>
							</div>
							
							<div class="6u 12u(mobilep)">
								Mecanico
								<select name="mecanico" id="mecanico">
									<option value="">MECANICO</option>;
										<?php
    										foreach ($arrayMecanicos as $reg){          								
          										echo "<option value='".$reg["legajo"]."'> "."legajo: ".$reg["legajo"]."  || Matricula: ".$reg["matricula"]."  ||  ".$reg["apellido"].", ".$reg["nombre"]."</option>";          													
    										}
										?>
								</select>
							</div>									
						</div>	

						<div class="row uniform">
							<div class="12u">
								<ul class="actions">
									<li><input type="submit" value="Guardar" /></li> 
									<li><input type="button" value="Cancelar" class="alt" onclick="cancelar()" /></li>
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
		<script>
			function setCombos () {
				document.getElementById("tipo_repuesto").selectedIndex = "0";
				document.getElementById("transporte").selectedIndex = "0";
				document.getElementById("mecanico").selectedIndex = "0";
			}
		</script>
		<script>
			function cancelar() {
					window.location.replace("main.php");
			}
								
			function validar() {
				// Datos reparacion - Validaciones
				
				// Cod Reparacion -> No puede ser vacio
				if (!validarCodigoReparacion()) {
					alert("Cod. Reparacion: No puede ser vacio.");
					return false;
				}
				
				// Fecha reparacion: Debe respetar el formato (aaaa-MM-dd)
				if (!validarFechaReparacion()) {
					alert("Fecha: Formato incorrecto (aaaa-MM-dd).");
					return false;
				}
				
				// Costo: NO puede ser vacio y debe ser numerico
				if (!validarCosto()) {
					alert("Costo: No puede ser vacio y debe ser numerico.");
					return false;
				}
					
				if (!validarKilometrosUnidad()) {
					alert("Km Unidad: No puede ser vacio y debe ser numerico.");	
					return false;
				}

				if (!validarDescripcion()) {
					alert("Repuesto: No puede ser vacio.");	
					return false;
				}
				
				if (!validarTipoRepuesto()) {
					alert("Tipo repuesto: Debe seleccionar un tipo de repuesto.");	
					return false;
				}		
				
				if (!validarTransporte()) {
					alert("Transporte: Debe seleccionar un transporte.");	
					return false;
				}
				
				if (!validarMecanico()) {
					alert("Mecanico: Debe seleccionar un mecanico.");	
					return false;
				}
				
				//document.getElementById("frmAltaReparacion").submit();
				return true;
			
			}	
			
			function validarCodigoReparacion() { 
				var cod = document.getElementById("cod_reparacion").value;	
				if (cod != "")
					return true;
				else
					return false;
			}
			
			function validarFechaReparacion () {
				var fecha = document.getElementById('fecha_reparacion').value;
				var RegExp = /\d{4}-((0[1-9]|[1-9])|1[012])-((0[1-9]|[1-9])|[12][0-9]|3[01])/;
				var dtArray = fecha.match(RegExp);

				if (dtArray == null) 
					return false;
				else {
					var a = fecha.substring(0, 4); 	
					var m = fecha.substring(5, 7);		
					var d = fecha.substring(8, 10);	
										
					// año
					if ( (a < "1900") || (a > "2050") ) {
						return false;
					}
					// mes 
					if ((m < "01") || (m > "12")) {
						return false;
					
					}
					// dia
					if ((d < "01") || (d > "31")) {	
						return false;
					}
					return true;
				}
					
			}
				
			
			function validarCosto () {
				var costo = document.getElementById("costo").value;	
				if ( (costo == "") || (isNaN(costo)) )
					return false;
				else
					return true;
			}
			
			function validarKilometrosUnidad() { 
				var km = document.getElementById("km_unidad").value;	
				if ( (km == "") || (isNaN(km)) )
					return false;
				else
					return true;
			}
			
			function validarDescripcion() { 
				var desc = document.getElementById("repuesto").value;	
				if ( (desc == "") )
					return false;
				else
					return true;
			}
			
			function validarTipoRepuesto() {
				if (document.getElementById("tipo_repuesto").selectedIndex == "0")
					return false;
				else	
					return true;	
			}
			
			function validarTransporte() {
				if (document.getElementById("transporte").selectedIndex == "0")
					return false;
				else	
					return true;	
			}
			
			function validarMecanico() {
				if (document.getElementById("mecanico").selectedIndex == "0")
					return false;
				else	
					return true;	
			}
			
		</script>
		
	</body>
</html>