<?php

require_once "../../class/Empleado.php";



if (isset($_GET["cboFiltroEstado"])) {
	$filtroEstado = $_GET["cboFiltroEstado"];
} else {
	$filtroEstado = 1; // ACTIVOS
}

if (isset($_GET["txtApellido"])) {
	$filtroApellido = $_GET["txtApellido"];
} else {
	$filtroApellido = "";
}



$lista = Empleado::obtenerTodos($filtroEstado, $filtroApellido);

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<?php require_once "../../menu.php"; ?>

<br>
<br>

<a href="nuevo.php">NUEVO EMPLEADO</a>

<br>
<br>

<form method="GET">
    <label>Estado: </label>
	<select name='cboFiltroEstado'>
		<option value="0">Todos</option>
		<option value="1">Activos</option>
		<option value="2">Inactivos</option>
	</select>

	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

	<label>Apellido</label>
	<input type="text" name="txtApellido">

	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

	<input type="submit" value="Filtrar">
</form>

<br>
<br>

<table border="1">
	<tr>
		<th>ID Empleado</th>
		<th>Numero Legajo</th>
		<th>Nombre</th>
		<th>Apellido</th>
		<th>Fecha Nacimiento</th>
		<th>Contactos</th>
		<th>Domicilios</th>
		<th>Acciones</th>
	</tr>

	<?php foreach  ($lista as $empleado): ?>

		<tr>
			
			<td><?php echo $empleado->getIdEmpleado(); ?></td>
			<td><?php echo $empleado->getNumeroLegajo(); ?></td>
			<td><?php echo $empleado->getNombre(); ?></td>
			<td><?php echo $empleado->getApellido(); ?></td>
			<td><?php echo $empleado->getFechaNacimiento(); ?></td>
			<td>
				<a href="../contactos/contactos.php?id_persona=<?php echo $empleado->getIdPersona(); ?>"> Ver </a>
			</td>
			<td>
				<a href="../domicilios/listado.php?id_persona=<?php echo $empleado->getIdPersona(); ?>&modulo=empleados">
				    Ver
				</a>
			</td>
			<td>
			    <a href="modificar.php?id_empleado=<?php echo $empleado->getIdEmpleado(); ?>"> Modificar </a> | 
			    <a href="eliminar.php?id_empleado=<?php echo $empleado->getIdEmpleado(); ?>"> Eliminar </a>
			</td>

		</tr>

	<?php endforeach ?>

</table>

</body>
</html>
