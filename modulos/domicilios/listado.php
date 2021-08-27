<?php


require_once "../../class/Domicilio.php";
require_once "../../class/Empleado.php";


$idPersona = $_GET['id_persona'];
$modulo = $_GET['modulo'];


switch ($modulo) {

	case 'empleados':
		$persona = Empleado::obtenerPorIdPersona($idPersona);
		break;

	case 'clientes':
		// $persona = Cliente::obtenerPorIdPersona($idPersona);
	    echo "viene de clientes";
	    exit;
		break;
	
	default:
		echo "Modulo no valido";
		exit;

}


$listadoDomicilios = Domicilio::obtenerPorIdPersona($idPersona);

//highlight_string(var_export($listadoDomicilios, true));


?>

<!DOCTYPE html>
<html>
<head>
	<title>Domicilios</title>
</head>
<body>

<?php require_once "../../menu.php"; ?>

<br>
<br>

<h2><?php echo $persona; ?></h2>

<br>
<br>

<table border="1">
	<tr>
		<th>Barrio</th>
		<th>Calle</th>
		<th>Altura</th>
		<th>Manzana</th>
		<th>Número Casa</th>
		<th>Torre</th>
		<th>Piso</th>
		<th>Accion</th>
	</tr>

	<?php foreach  ($listadoDomicilios as $domicilio): ?>

		<tr>
			<td>-</td>
			<td><?php echo $domicilio->getCalle(); ?></td>
			<td><?php echo $domicilio->getAltura(); ?></td>
			<td><?php echo $domicilio->getManzana(); ?></td>
			<td><?php echo $domicilio->getNumeroCasa(); ?></td>
			<td><?php echo $domicilio->getTorre(); ?></td>
			<td><?php echo $domicilio->getPiso(); ?></td>
			<td>
				Ver | Modificar
			</td>
		</tr>

	<?php endforeach ?>

</table>

</body>
</html>
