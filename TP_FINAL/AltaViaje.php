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
	
	$vehiculo = mysql_query("select nro_chasis, marca, modelo, patente, id_tipo from t_transporte where id_tipo = 1;");
	$arrayVehiculos = array();
	$i = 0;
	while ($row = mysql_fetch_assoc($vehiculo, MYSQL_ASSOC)) {
		$arrayVehiculos[$i]['nro_chasis'] = $row['nro_chasis'];
		$arrayVehiculos[$i]['marca'] = $row['marca'];
		$arrayVehiculos[$i]['modelo'] = $row['modelo'];
		$arrayVehiculos[$i]['patente'] = $row['patente'];
		$arrayVehiculos[$i]['id_tipo'] = $row['id_tipo'];
		
		$i++;
	}
	mysql_free_result($vehiculo);
	/*	
	foreach($arrayVehiculos as $reg) {
		echo $reg['nro_chasis']." ".$reg['marca']." ".$reg['modelo']." ".$reg['patente']." ".$reg['id_tipo']."<br>";
	}*/
	/*
	$arrlength = count($arrayVehiculos);

	for($x = 0; $x < $arrlength; $x++) {
		echo $arrayVehiculos[$x]['nro_chasis'];
		echo $arrayVehiculos[$x]['marca'];
		echo $arrayVehiculos[$x]['patente'];
		echo "<br>";
	}
  	*/
		
	$acoplado = mysql_query("select nro_chasis, marca, modelo, patente from t_transporte where id_tipo = 2;");
	$arrayAcoplados = array();
	$i=0;
	while ($row = mysql_fetch_assoc($acoplado, MYSQL_ASSOC)) {
		$arrayAcoplados[$i]['nro_chasis'] = $row['nro_chasis'];
		$arrayAcoplados[$i]['marca'] = $row['marca'];
		$arrayAcoplados[$i]['modelo'] = $row['modelo'];
		$arrayAcoplados[$i]['patente'] = $row['patente'];
		
		$i++;
		//echo $arrayAcoplados['nro_chasis']." ".$arrayAcoplados['marca']." ".$arrayAcoplados['modelo']." ".$arrayAcoplados['patente']."<br>";
	}
	mysql_free_result($acoplado);
	
	//print("Total filas: ".mysql_num_rows($acoplado)."<br>");
	//print("<br><br><br>");
	
	$chofer = mysql_query("select legajo, nombre, apellido from t_empleado where id_rol = 3;");
	$arrayChoferes = array();
	$i=0;
	while ($row = mysql_fetch_assoc($chofer, MYSQL_ASSOC))
	{
		$arrayChoferes[$i]['legajo'] = $row['legajo'];
		$arrayChoferes[$i]['nombre'] = $row['nombre'];
		$arrayChoferes[$i]['apellido'] = $row['apellido'];
		
		$i++;
		//echo $arrayChoferes['legajo']." ".$arrayChoferes['nombre']." ".$arrayChoferes['apellido']."<br>";
	}
	mysql_free_result($chofer);
	
	mysql_close($conexion);
	
	//print("Total filas: ".mysql_num_rows($chofer)."<br>");
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
	<body onload="ocultarCombos()">
		<div id="page-wrapper">
			<!-- Header-->
			<?php include ('cabecera.html');?>
			 
			<!-- Main -->
			<div class="row">
				<div class="12u">

					<!-- Form -->
					<section class="box">
					
					<h3>Alta de viaje</h3>
					
					<form method="post" action="AltaViaje_insert.php" onsubmit="return validar()" name="frmAltaViaje" id="frmAltaViaje">
						<div class="row uniform 50%">
							<h4>Datos de viaje</h4>
						</div>
						<div class="row uniform 50%">
							<div class="2u 12u(mobilep)">
								Cod. Viaje <input type="text" name="cod_viaje" id="cod_viaje" value="" placeholder="COD VIAJE" />
							</div>
							<div class="8u 12u(mobilep)">
								Cliente <input type="text" name="cliente" id="cliente" value="" placeholder="CLIENTE" />
							</div>
						</div>
						<div class="row uniform 50%">
							<div class="6u 12u(mobilep)">
								Origen <input type="text" name="origen" id="origen" value="" placeholder="ORIGEN" />
							</div>
							<div class="6u 12u(mobilep)">
								Destino <input type="text" name="destino" id="destino" value="" placeholder="DESTINO" />
							</div>
						</div>
						<div class="row uniform 50%">
							<h4>Datos de la Carga</h4>
						</div>	
						<div class="row uniform 50%">	
							<div class="6u 12u(mobilep)">
						     	Tipo de Carga <input type="text" name="tipo_carga" id="tipo_carga" value="" placeholder="TIPO CARGA" />
						     </div>
							<div class="6u 12u(mobilep)">
								Tipo viaje <input type="text" name="tipo_viaje" id="tipo_viaje" value="" placeholder="TIPO VIAJE" />
							</div>											
						</div>
						<div class="row uniform 50%">
							<h4>Datos Transporte</h4>
						</div>	
						<div class="row uniform 50%">	
							<div class="3u 12u(mobilep)">
								Vehiculo tractor
								<select name="vehiculo" id="vehiculo">
									<option value="">VEHICULO</option>;
										<?php
											foreach ($arrayVehiculos as $reg){          								
          										echo "<option value='".$reg["nro_chasis"]."'> "."patente: ".$reg["patente"]." | marca: ".$reg["marca"]." | modelo: ".$reg["modelo"]."</option>";          													
    										}
										?>
								</select>
							</div>
							<div class="3u 12u(mobilep)">
								Acoplado/s
								<select name="acoplado" id="acoplado">
									<option value="">ACOPLADO</option>;
										<?php
    										foreach ($arrayAcoplados as $reg){          								
												echo "<option value='".$reg["nro_chasis"]."'> "."patente: ".$reg["patente"]." | marca: ".$reg["marca"]." | modelo: ".$reg["modelo"]."</option>";
    											}
										?>
								</select>
								<button id="btnAcopladoMas" type="button" onclick="agregarAcoplado()"> + </button>
								<button id="btnAcopladoMenos" type="button" onclick="ocultarAcoplado()"> - </button> 
								<br>
								<select name="acoplado1" id="acoplado1">
									<option value="">ACOPLADO</option>;
										<?php
    										foreach ($arrayAcoplados as $reg){          								
          										echo "<option value='".$reg["nro_chasis"]."'> "."patente: ".$reg["patente"]." | marca: ".$reg["marca"]." | modelo: ".$reg["modelo"]."</option>";
    										}
										?>
								</select>
								<br>
								<select name="acoplado2" id="acoplado2">
									<option value="">ACOPLADO</option>;
										<?php
    										foreach ($arrayAcoplados as $reg){          								
          										echo "<option value='".$reg["nro_chasis"]."'> "."patente: ".$reg["patente"]." | marca: ".$reg["marca"]." | modelo: ".$reg["modelo"]."</option>";
    										}
										?>
								</select>
												
							</div>
							<div class="3u 12u(mobilep)">
								Chofer/es
								<select name="chofer" id="chofer">
									<option value="">CHOFER</option>;
										<?php
    										foreach ($arrayChoferes as $reg){          								
          										echo "<option value='".$reg["legajo"]."'> "."legajo: ".$reg["legajo"]." | ".$reg["apellido"].", ".$reg["nombre"]."</option>";          													
    										}
										?>
								</select>
								<button type="button" id="btnChoferMas" onclick="agregarChofer()"> + </button> 
								<button type="button" id="btnChoferMenos" onclick="ocultarChofer()"> - </button> 
								<br>
								<select name="chofer1" id="chofer1">
									<option value="">CHOFER</option>;
										<?php
    										foreach ($arrayChoferes as $reg){          								
          										echo "<option value='".$reg["legajo"]."'> "."legajo: ".$reg["legajo"]." | ".$reg["apellido"].", ".$reg["nombre"]."</option>";          													         													
    										}
										?>
								</select>
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
		<script>
			function volverHome() {
					window.location.replace("main.php");
			}
			function ocultarCombos () {
				document.getElementById("acoplado1").style.visibility = "hidden";
				document.getElementById("acoplado2").style.visibility = "hidden";
				document.getElementById("chofer1").style.visibility = "hidden";
			}
		</script>
		<script>
			function agregarAcoplado() {
				if (document.getElementById("acoplado1").style.visibility == "hidden")
				 	document.getElementById("acoplado1").style.visibility = "visible";
				else if (document.getElementById("acoplado2").style.visibility == "hidden")
					document.getElementById("acoplado2").style.visibility = "visible";
			}
			function ocultarAcoplado() {
				if (document.getElementById("acoplado2").style.visibility == "visible")
				 	document.getElementById("acoplado2").style.visibility = "hidden";
				else if (document.getElementById("acoplado1").style.visibility == "visible")
					document.getElementById("acoplado1").style.visibility = "hidden";
			}
			function agregarChofer() {
				if (document.getElementById("chofer1").style.visibility == "hidden")
				 	document.getElementById("chofer1").style.visibility = "visible";
			}
			function ocultarChofer() {
				if (document.getElementById("chofer1").style.visibility == "visible")
				 	document.getElementById("chofer1").style.visibility = "hidden";
			}
			
			function validar() {
				// Datos del viaje
				
				// Cod. viaje -> No puede ser vacio
				if (!validarCodigoViaje()) {
					alert("Codigo viaje: No puede ser vacio.");
					return false;
				}
			
				// Cliente -> No puede ser vacio
				if (!validarCliente()) {
					alert("Cliente: No puede ser vacio.");
					return false;
				}			
				
				// Origen -> No puede ser vacio
				if (!validarOrigen()) {
					alert("Origen: No puede ser vacio.");
					return false;
				}
				
				// Destino -> No puede ser vacio
				if (!validarDestino()) {
					alert("Destino: No puede ser vacio.");
					return false;
				}
				
				// Tipo Carga -> No puede ser vacio
				if (!validarTipoCarga()) {
					alert("Tipo de carga: No puede ser vacio.");
					return false;
				}
				
				// Tipo Viaje -> No puede ser vacio
				if (!validarTipoViaje()) {
					alert("Tipo de viaje: No puede ser vacio.");
					return false;
				}
				
				// Datos transporte - Validaciones
				
				// Vehiculo -> Debe seleccionarse obligatoriamente un vehiculo
				if (!validarVehiculo()) {
					alert("Vehiculo: Debe seleccionar al menos un vehiculo.");
					return false;
				}
				
				// Acoplado: Si se seleciona mas de un acoplado deben ser distintos entre ellos
				if (!validarAcoplado()) {
					alert("Acoplado: Ha seleccionado transportes iguales en las opciones de seleccion.");
					return false;
				}
				
				// Chofer: Debe seleccionarse un al menos un Chofer y puede estar duplicado
				if (!validarChofer()) {
					alert("Chofer: Debe seleccionar al menos un chofer.");
					return false;
				}
					
				if (!validarChoferDuplicado()) {
					alert("Chofer: Ha seleccionado dos choferes iguales en las opciones de seleccion.");	
					return false;
				}
								
				//document.getElementById("frmAltaViaje").submit();
				return true;
			
			}	
			
			function validarCodigoViaje() { 
				var cod_viaje = document.getElementById("cod_viaje").value;	
				if (cod_viaje != "")
					return true;
				else
					return false;
			}
			
			function validarCliente() { 
				var cliente = document.getElementById("cliente").value;	
				if (cliente != "")
					return true;
				else
					return false;
			}
			
			function validarOrigen() { 
				var origen = document.getElementById("origen").value;	
				if (origen != "")
					return true;
				else
					return false;
			}
			
			function validarDestino() { 
				var destino = document.getElementById("destino").value;	
				if (destino != "")
					return true;
				else
					return false;
			}
			
			function validarTipoCarga() { 
				var tipo_carga = document.getElementById("tipo_carga").value;	
				if (tipo_carga != "")
					return true;
				else
					return false;
			}
			
			function validarTipoViaje() { 
				var tipo_viaje = document.getElementById("tipo_viaje").value;	
				if (tipo_viaje != "")
					return true;
				else
					return false;
			}
			
			function validarVehiculo() { 
				var vehiculo = document.getElementById("vehiculo").value;	
				if (vehiculo != "")
					return true;
				else
					return false;
			}
			
			function validarAcoplado () {
				var acoplado = "";
				var acoplado1 ="";
				var acoplado2 ="";
				
				if 	(document.getElementById("acoplado").value != "") {
					acoplado = document.getElementById("acoplado").value;
				}
				
				// Si son visibles las opciones de seleccion de acoplado 1 y 2 se eligen como opcion a validar				
				
				if ((document.getElementById("acoplado1").style.visibility == "visible") &&
					(document.getElementById("acoplado1").value != "")) {
						acoplado1 = document.getElementById("acoplado1").value;
				}				
				if ((document.getElementById("acoplado2").style.visibility == "visible") &&
					 (document.getElementById("acoplado2").value != "") )  {
						acoplado2 = document.getElementById("acoplado2").value;
				}			
												
				if ( ((acoplado =="") && (acoplado1 =="")) && (acoplado2 =="") ) {
					return true; // Las 3 opciones de seleccion estan vacias
				}
				
				if (( acoplado !="") && (acoplado1 !="") ) { 		// Valido acoplado con acoplado1
					if (acoplado == acoplado1) {
							return false;
					}
				}
				
				if ( (acoplado != "" ) && (acoplado2 != "") ) {		// Valido acoplado con acoplado2
					if (acoplado == acoplado2) {
							return false;
					}
				}
				
				if ( (acoplado1 != "") && (acoplado2 != "" ) ) {	// Valido acoplado1 con acoplado2
					if (acoplado1 == acoplado2) {
							return false;
					}
				}
			
				return true;
			}
			
			function validarChofer() { 
				var chofer = document.getElementById("chofer").value;	
				if (chofer != "")
					return true;
				else
					return false;
			}
			
			function validarChoferDuplicado() {
				var chofer = document.getElementById("chofer").value;	
				var chofer1 = "";
				
				// Si es visible la opcion de seleccion de chofer 1 y se elige como opcion a validar				
				if ((document.getElementById("chofer1").style.visibility == "visible") &&
					(document.getElementById("chofer1").value != "")) {
						chofer1 = document.getElementById("chofer1").value;
				} 
				if (chofer1 == "")
					return true;
				
				if (chofer != chofer1)
					return true;
				else
					return false;
			}
			
		</script>
		
	</body>
</html>

