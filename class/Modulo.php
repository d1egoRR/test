<?php


require_once "MySQL.php";


class Modulo {

	private $_idModulo;
	private $_descripcion;
	private $_directorio;

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->_descripcion;
    }

    public function getDirectorio()
    {
        return $this->_directorio;
    }

	public static function obtenerPorIdPerfil($idPerfil) {

		$sql = "SELECT modulos.id_modulo, modulos.descripcion, modulos.directorio "
			 . "FROM modulos "
			 . "JOIN perfil_modulo ON perfil_modulo.id_modulo = modulos.id_modulo "
			 . "JOIN perfiles ON perfiles.id_perfil = perfil_modulo.id_perfil "
			 . "WHERE perfil_modulo.id_perfil = {$idPerfil}";

		$databse = new MySQL();
		$datos = $databse->consultar($sql);

		$listadoModulos = [];

		while ($registro = $datos->fetch_assoc()) {
			$modulo = new Modulo();
			$modulo->_idModulo = $registro["id_modulo"];
			$modulo->_descripcion = $registro["descripcion"];
			$modulo->_directorio = $registro["directorio"];
			$listadoModulos[] = $modulo;
    	}

    	return $listadoModulos;

	}


}


?>