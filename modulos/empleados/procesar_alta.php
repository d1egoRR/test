<?php

require_once "../../class/Empleado.php";

$nombre = trim($_POST['txtNombre']);
$apellido = trim($_POST['txtApellido']);
$numeroLegajo = trim($_POST['txtNumeroLegajo']);
$fechaNacimiento = $_POST['txtFechaNacimiento'];
$sexo = $_POST['cboSexo'];


# validar longitud. Minimo 3 caracteres para nombre y apellido
# str_len()
# texto = "hola mundo"
# str_len($texto) ---> 10

if (strlen($nombre) < 3) {
	header("location: nuevo.php?error=nombre");
	exit;
}


if (strlen($apellido) < 3) {
	header("location: nuevo.php?error=apellido");
	exit;
}



$empleado = new Empleado();

$empleado->setNombre($nombre);
$empleado->setApellido($apellido);
$empleado->setNumeroLegajo($numeroLegajo);
$empleado->setFechaNacimiento($fechaNacimiento);
$empleado->setSexo($sexo);

$empleado->guardar();

header("location: listado.php");


?>