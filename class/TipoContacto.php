<?php

require_once "MySQL.php";



class TipoContacto {

	private $_idTipoContacto;
	private $_descripcion;

	public function getIdTipoContacto() {
		return $this->_idTipoContacto;
	}

	public function getDescripcion() {
		return $this->_descripcion;
	}


	public static function obtenerTodos()
	{
		$sql = "SELECT * FROM tipo_contacto";
		$database = new MySQL();
		$datos = $database->consultar($sql);

    	$listadoTipoContactos = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$tipoContacto = new TipoContacto();
			$tipoContacto->_idTipoContacto = $registro["id_tipo_contacto"];
			$tipoContacto->_descripcion = $registro["descripcion"];
    		$listadoTipoContactos[] = $tipoContacto;
    	}


    	return $listadoTipoContactos;

	}

}



?>