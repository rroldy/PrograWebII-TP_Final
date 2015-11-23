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
	<body onload="ocultarHiddens()">
		<div id="page-wrapper">

			<!-- Header-->
			<?php include ('cabecera.html');?>
			 
			<!-- Main -->
			<div class="row">
						<div class="12u">

							<!-- Form -->
								<section class="box">
									<h3>Alta de empleado</h3>
									<form method="post" action="AltaEmpleado_insert.php" id="frmEmpleado" name="frmEmpleado" onsubmit="return validar()">
										<div class="row uniform 50%">
											<div class="4u 12u(mobilep)">
												Legajo <input type="text" name="legajo" id="legajo" value="" placeholder="LEGAJO" />
											</div>
										</div>
										<div class="row uniform 50%">
											<div class="4u 12u(mobilep)">
												Usuario <input type="text" name="usuario" id="usuario" value="" placeholder="USUARIO" />
											</div>
											<div class="4u 12u(mobilep)">
												Password<input type="password" name="password" id="password" value="" placeholder="PASSWORD" />
											</div>
										</div>
										<div class="row uniform 50%">
											<div class="4u 12u(mobilep)">
												DNI<input type="text" name="dni" id="dni" value="" placeholder="DNI" />
											</div>
											<div class="4u 12u(mobilep)">
												CUIL<input type="text" name="cuil" id="cuil" value="" placeholder="CUIL" />
											</div>
										</div>	
										<div class="row uniform 50%">
											<div class="6u 12u(mobilep)">
											   	Nombre <input type="text" name="nombre" id="nombre" value="" placeholder="NOMBRE" />
											</div>
											<div class="6u 12u(mobilep)">
												Apellido<input type="text" name="apellido" id="apellido" value="" placeholder="APELLIDO" />
											</div>
											<div class="3u 12u(mobilep)">
												Fecha de nacimiento <input type="text" name="fecha_nac" id="fecha_nac" placeholder='FECHA NAC. (AAAA-MM-DD)'>
											</div>
											<div class="5u 12u(mobilep)">
												Direccion<input type="text" name="direccion" id="direccion"  placeholder="DIRECCION" >
											</div>
											<div class="4u 12u(mobilep)">
												Localidad<input type="text" name="localidad" id="localidad"  placeholder="LOCALIDAD" >
											</div>
											<div class="3u 12u(mobilep)">
												Provincia <input type="text" name="provincia" id="provincia" placeholder="PROVINCIA">
											</div>
											<div class="5u 12u(mobilep)">
												Pais<input type="text" name="pais" id="pais"  placeholder="PAIS" >
											</div>
											<div class="4u 12u(mobilep)">
												Codigo Postal<input type="text" name="codigo_postal" id="codigo_postal"  placeholder="CODIGO POSTAL" >
											</div>
										</div>

										<div class="row uniform 50%">
											<div class="4u">
												<div class="select-wrapper">
													<select name="tipo_usuario" id="tipo_usuario" placeholder="" onchange="mostrarHiddens()">
														<option value="0">- TIPO DE USUARIO -</option> 
														<option value="1"> 1 - Administrador </option>
														<option value="2"> 2 - Supervisor </option>
														<option value="3"> 3 - Chofer </option>
														<option value="4"> 4 - Mecanico </option>												
													</select>												
												</div>
											</div>
											<div class="4u">
												<div class="select-wrapper" id="tipo_licencia"> 
													<select name="categoria" id="categoria" placeholder="">
														<option value="0">- TIPO DE LICENCIA -</option>
														<option value="1"> C - Camión sin acoplado ni semiacoplado </option>
														<option value="2">  E.1 - Camiones articulados, con acoplado o semiacoplado</option>
														<option value="3">  E.2 - Maquinaria especial no agrícola</option>
													</select>												
												</div>
											</div>
											
											<div class="4u 12u(mobilep)" id="numero_licencia">
													<input type="text" name="nro_licencia" id="nro_licencia"  placeholder="NRO. LICENCIA" >
											</div>	
											
											<div class="4u 12u(mobilep)" id="numero_matricula"> 
													<input type="text" name="nro_matricula" id="nro_matricula"  placeholder="NRO. MATRICULA" >
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
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>
						
			<script>
				function ocultarHiddens() {
					document.getElementById("tipo_usuario").selectedIndex = 0;
					document.getElementById("categoria").selectedIndex = 0;
					document.getElementById('tipo_licencia').style.visibility = 'hidden';
					document.getElementById('numero_licencia').style.visibility = 'hidden';	
					document.getElementById('numero_matricula').style.visibility = 'hidden';
				}
			
				function mostrarHiddens() {
					var div = document.getElementById('tipo_licencia');
					var div1 = document.getElementById('numero_licencia');
					var div2 = document.getElementById('numero_matricula');
		
					if (document.getElementById("tipo_usuario").selectedIndex == 3) {
						div.style.visibility = 'visible';
						div1.style.visibility = 'visible';
						div2.style.visibility = 'hidden';
						
					} else if(document.getElementById("tipo_usuario").selectedIndex == 4) {
						div2.style.visibility = 'visible';
						div.style.visibility = 'hidden';
						div1.style.visibility = 'hidden';
					
					} else {
						div.style.visibility = 'hidden';
						div1.style.visibility = 'hidden';
						div2.style.visibility = 'hidden';
					}	
					
				}
			</script>
			
			<script>
				function volverHome() {
					window.location.replace("main.php");
				}
									
				function validar() {
					// Datos empleado - Validaciones
					
					// Legajo -> No puede ser vacio / numerico
					if (!validarLegajo()) {
						alert("Legajo: No puede ser vacio y debe ser numerico.");
						return false;
					}
					
					// Usuario -> No puede ser vacio
					if (!validarUsuario()) {
						alert("Usuario: No puede ser vacio.");
						return false;
					}
					
					// Password: No puede ser vacio / mas de 7 caracteres
					if (!validarPassword()) {
						alert("Password: No puede ser vacio y debe contener mas de 7 caracteres.");
						return false;
					}
					
					// DNI: No puede ser vacio / numerico 
					if (!validarDNI()) {
						alert("DNI: No puede ser vacio y debe ser numerico.");
						return false;
					}
					
					// CUIL: No puede ser vacio 
					if (!validarCUIL()) {
						alert("CUIL: No puede ser vacio.");
						return false;
					}
					
					// Nomnbre: No puede ser vacio 
					if (!validarNombre()) {
						alert("Nombre: No puede ser vacio.");
						return false;
					}
					
					// Apellido: No puede ser vacio 
					if (!validarApellido()) {
						alert("Apellido: No puede ser vacio.");
						return false;
					}
					
					//Debe respetar el formato (aaaa-MM-dd)
					if (!validarFechaNacimiento()) {
						alert("Fecha nacimiento: Formato incorrecto (aaaa-MM-dd).");
						return false;
					}
					
					// Costo: NO puede ser vacio y debe ser numerico
					if (!validarDireccion()) {
						alert("Direccion: No puede ser vacia.");
						return false;
					}
					
					// Localidad: NO puede ser vacia				
					if (!validarLocalidad()) {
						alert("Localidad: No puede ser vacia.");	
						return false;
					}

					// Provincia: NO puede ser vacia	
					if (!validarProvincia()) {
						alert("Provincia: No puede ser vacia.");	
						return false;
					}
					
					//Pais: NO puede ser vacio
					if (!validarPais()) {
						alert("Pais: No puede ser vacio.");	
						return false;
					}		
					
					// Codigo postal: NO puede ser vacio y debe ser numerico
					if (!validarCodigoPostal()) {
						alert("Codigo postal: No puede ser vacio y debe ser numerico.");	
						return false;
					}
										
					//document.getElementById("frmEmpleado").submit();
					return true;
				
				}	
				
				function validarLegajo() { 
					var legajo = document.getElementById("legajo").value;	
					if ((legajo == "") || (isNaN(legajo)) )
						return false;
					else
						return true;
				}
				
				function validarUsuario() { 
					var cod = document.getElementById("usuario").value;	
					if (cod != "")
						return true;
					else
						return false;
				}
				
				function validarPassword() { 
					var pass = document.getElementById("password").value;	
					if ((pass == "") || (pass.length < 7) )
						return false;
					else
						return true;
				}
				
				function validarDNI() { 
					var dni = document.getElementById("dni").value;	
					if ((dni == "") || (isNaN(dni)) )
						return false;
					else
						return true;
				}
				
				function validarCUIL() { 
					var cuil = document.getElementById("cuil").value;	
					if (cuil == "")
						return false;
					else
						return true;
				}
				
				function validarNombre() { 
					var nombre = document.getElementById("nombre").value;	
					if (nombre == "")
						return false;
					else
						return true;
				}
				
				function validarApellido() { 
					var apellido = document.getElementById("apellido").value;	
					if (apellido == "")
						return false;
					else
						return true;
				}
				
				function validarFechaNacimiento () {
					var fecha = document.getElementById('fecha_nac').value;
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
					
				
				function validarDireccion () {
					var dir = document.getElementById("direccion").value;	
					if (dir == "")
						return false;
					else
						return true;
				}
				
				function validarLocalidad() { 
					var localidad = document.getElementById("localidad").value;	
					if (localidad == "")
						return false;
					else
						return true;
				}
				
				function validarProvincia() { 
					var prov = document.getElementById("provincia").value;	
					if (prov == "") 
						return false;
					else
						return true;
				}
				
				function validarPais() {
					var pais = document.getElementById("pais").value;	
					if ( (pais == "") )
						return false;
					else
						return true;
				}
				
				function validarCodigoPostal() {
					var codigo_postal = document.getElementById("codigo_postal").value;	
					if ( (codigo_postal == "")  || (isNaN(codigo_postal)) ) 
						return false;
					else
						return true;	
				}
			</script>

	</body>
</html>