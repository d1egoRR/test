<?php

require_once "Modulo.php";
require_once "MySQL.php";


class Perfil {

	private $_idPerfil;
	private $_descripcion;
	private $_listadoModulos;

	public function getModulos() {
		return $this->_listadoModulos;
	}

	public static function obtenerPorId($idPerfil) {
		$sql = "SELECT * FROM perfiles WHERE id_perfil={$idPerfil}";

		$database = new MySQL();
		$datos = $database->consultar($sql);

		$registro = $datos->fetch_assoc();

		$perfil = new Perfil();
		$perfil->_idPerfil = $registro["id_perfil"];
		$perfil->_descripcion = $registro["descripcion"];
		$perfil->_listadoModulos = Modulo::obtenerPorIdPerfil($perfil->_idPerfil);

		return $perfil;

	}

}


?>