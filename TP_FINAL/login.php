<?php
	// Redirecciona segun el usuario logueado

	session_start();

	$user = $_POST['usuario']; 
	$password = $_POST['password']; 

	

	$conexion = mysql_connect("localhost", "root", "");
	mysql_select_db("logistica");
	$consulta = mysql_query("select * from t_empleado where password ='".$password."' and usuario = '".$user."';");

	$cant_result = mysql_num_rows($consulta);

	if ($cant_result ==0) {
	
		header('location:login.html');

	} else {

		$fila = mysql_fetch_assoc($consulta);
		
		$_SESSION['id_rol']= $fila['id_rol'];
		$_SESSION['usuario'] = $fila['usuario'];

		header('location:main.php');	

	}
?>
