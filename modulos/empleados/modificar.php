<?php

require_once "../../class/Empleado.php";
require_once "../../class/Sexo.php";

$listadoSexo = Sexo::obtenerTodos();

$id_empleado = $_GET["id_empleado"];

$empleado = Empleado::obtenerPorId($id_empleado);


?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<?php require_once "../../menu.php"; ?>

	<br><br>

	<form method="POST" action="procesar_modificacion.php">

		<input type="hidden" name="txtIdEmpleado" value="<?php echo $id_empleado; ?>">

		Nombre: <input type="text" name="txtNombre" value="<?php echo $empleado->getNombre(); ?>">
		<br><br>

		Apellido: <input type="text" name="txtApellido" value="<?php echo $empleado->getApellido(); ?>">
		<br><br>

		Numero Legajo: <input type="text" name="txtNumeroLegajo" value="<?php echo $empleado->getNumeroLegajo(); ?>">
		<br><br>

		Fecha Nacimiento: <input type="date" name="txtFechaNacimiento" value="<?php echo $empleado->getFechaNacimiento(); ?>">
		<br><br>

		Sexo:
		<select name="cboSexo">
		    <option value="NULL">---Seleccionar---</option>

		    <?php foreach ($listadoSexo as $sexo): ?>

		    	<?php

		    	$selected = "";

		    	if ($sexo->getIdSexo() == $empleado->getIdSexo()) {
		    		$selected = "SELECTED";
		    	}

		    	?>

		    	<option <?php echo $selected; ?> value="<?php echo $sexo->getIdSexo(); ?>">
		    		<?php echo $sexo->getDescripcion(); ?>
		    	</option>

		    <?php endforeach ?>

		</select>
		<br><br>

		<input type="submit" name="Guardar" value="Actualizar">
		
	</form>

</body>
</html>