<?php

require_once "configs.php";

require_once "class/Usuario.php";


session_start();

if (isset($_SESSION['usuario'])) {
	$usuario = $_SESSION['usuario'];
} else {
	header("location: /programacion_3/gestion_usuarios/form_login.php?error=" . MENSAJE_CODE);
	exit;
}


$listadoModulos = $usuario->perfil->getModulos();


?>

<?php foreach ($listadoModulos as $modulo): ?>

	<a href="/programacion_3/gestion_usuarios/modulos/<?php echo $modulo->getDirectorio(); ?>/listado.php">
	    <?php echo $modulo->getDescripcion(); ?>
    </a> | 

<?php endforeach ?>

<a href="/programacion_3/gestion_usuarios/cerrar_sesion.php">Cerrar Sesion</a>

