<?php

require_once "../../class/Usuario.php";


$lista = Usuario::obtenerTodos();

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<?php require_once "../../menu.php"; ?>

<br><br>

<table border="1">
	<tr>
		<th>ID Usuario</th>
		<th>Username</th>
		<th>Nombre</th>
		<th>Apellido</th>
		<th>Fecha Nacimiento</th>
	</tr>

	<?php foreach  ($lista as $usuario): ?>

		<tr>
			
			<td><?php echo $usuario->getIdUsuario(); ?></td>
			<td><?php echo $usuario->getUsername(); ?></td>
			<td><?php echo $usuario->getNombre(); ?></td>
			<td><?php echo $usuario->getApellido(); ?></td>
			<td><?php echo $usuario->getFechaNacimiento(); ?></td>

		</tr>

	<?php endforeach ?>

</table>

</body>
</html>