<?php

require_once "../../class/Empleado.php";

$id_empleado = $_POST["txtIdEmpleado"];
$nombre = $_POST['txtNombre'];
$apellido = $_POST['txtApellido'];
$numeroLegajo = $_POST['txtNumeroLegajo'];
$fechaNacimiento = $_POST['txtFechaNacimiento'];
$sexo = $_POST['cboSexo'];


$empleado = Empleado::obtenerPorId($id_empleado);

$empleado->setNombre($nombre);
$empleado->setApellido($apellido);
$empleado->setNumeroLegajo($numeroLegajo);
$empleado->setFechaNacimiento($fechaNacimiento);
$empleado->setSexo($sexo);

$empleado->actualizar();

header("location: listado.php");


?>