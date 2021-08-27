<?php

require_once "configs.php";


$mensaje = "";

if (isset($_GET['error'])) {
	$error = $_GET['error'];

	if ($error == ERROR_LOGIN_CODE) {

		$mensaje = ERROR_LOGIN_MENSAJE;

	} else if ($error == MENSAJE_CODE) {

		$mensaje = MENSAJE_NECESITA_LOGIN;
		
	}

}

?>



<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<h3><?php echo $mensaje; ?></h3>

	<br>
	<br>

	<form method="POST" action="modulos/usuarios/procesar_login.php">
		Usuername: <input type="text" name="txtUsername">
		<br><br>
		Password: <input type="text" name="txtPassword">
		<br><br>
		<input type="submit" value="Iniciar sesion">
	</form>

</body>
</html>