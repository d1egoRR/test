<?php

require_once "MySQL.php";


class Sexo {

	private $_idSexo; 
	private $_descripcion;

    /**
     * @return mixed
     */
    public function getIdSexo()
    {
        return $this->_idSexo;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->_descripcion;
    }

	public static function obtenerTodos() {

    	$sql = "SELECT * FROM sexo";

    	$database = new MySQL();
    	$datos = $database->consultar($sql);

    	$listadoSexo = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$sexo = new Sexo();
			$sexo->_idSexo = $registro["id_sexo"];
			$sexo->_descripcion = $registro["descripcion"];
    		$listadoSexo[] = $sexo;
    	}


    	return $listadoSexo;

	}
}


?>