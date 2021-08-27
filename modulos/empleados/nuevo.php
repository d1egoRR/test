<?php

require_once "../../class/Sexo.php";


$mensaje = "";

if (isset($_GET["error"])) {

	switch($_GET["error"]) {

		case "nombre":
		    $mensaje = "El nombre no debe estar vacio y debe tener minimo 3 caracteres";
		    break;

		case "apellido":
		    $mensaje = "Error de apellido";
		    break;

	}

}

$listadoSexo = Sexo::obtenerTodos();

?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<?php require_once "../../menu.php"; ?>

	<br><br>

	<?php echo $mensaje; ?>

	<br><br>

	<form method="POST" action="procesar_alta.php">

		Nombre: <input type="text" name="txtNombre">
		<br><br>

		Apellido: <input type="text" name="txtApellido">
		<br><br>

		Numero Legajo: <input type="text" name="txtNumeroLegajo">
		<br><br>

		Fecha Nacimiento: <input type="date" name="txtFechaNacimiento">
		<br><br>

		Sexo:
		<select name="cboSexo">
		    <option value="NULL">---Seleccionar---</option>

		    <?php foreach ($listadoSexo as $sexo): ?>

		    	<option value="<?php echo $sexo->getIdSexo(); ?>">
		    		<?php echo $sexo->getDescripcion(); ?>
		    	</option>

		    <?php endforeach ?>

		</select>
		<br><br>

		<input type="submit" name="Guardar">
		
	</form>

</body>
</html>