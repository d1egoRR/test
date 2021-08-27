<?php

require_once "MySQL.php";



class Contacto {

	private $_idPersonaContacto;
	private $_idPersona;
	private $_idTipoContacto;
	private $_valor;

	private $_descripcion;

	public function getDescripcion() {
		return $this->_descripcion;
	}

	public function getValor() {
		return $this->_valor;
	}

	public function getIdPersonaContacto() {
		return $this->_idPersonaContacto;
	}

	public function getIdPersona() {
		return $this->_idPersona;
	}

	public function setIdPersona($idPersona) {
		$this->_idPersona = $idPersona;
	}

	public function setIdTipoContacto($idTipoContacto) {
		$this->_idTipoContacto = $idTipoContacto;
	}

	public function setValor($valor) {
		$this->_valor = $valor;
	}

	public static function obtenerPorIdPersona($idPersona) {
		$sql = "SELECT persona_contacto.id_persona_contacto, persona_contacto.id_persona, "
             . "persona_contacto.id_tipo_contacto, persona_contacto.valor, "
       		 . "tipo_contacto.descripcion "
			 . "FROM persona_contacto "
             . "INNER JOIN tipo_contacto ON tipo_contacto.id_tipo_contacto = persona_contacto.id_tipo_contacto "
             . "INNER JOIN personas ON personas.id_persona = persona_contacto.id_persona "
             . "WHERE personas.id_persona = {$idPersona}";

        $database = new MySQL();
        $datos = $database->consultar($sql);

    	$listadoContactos = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$contacto = new Contacto();
			$contacto->_idPersonaContacto = $registro["id_persona_contacto"];
			$contacto->_idPersona = $registro["id_persona"];
			$contacto->_idTipoContacto = $registro["id_tipo_contacto"];
			$contacto->_valor = $registro["valor"];
			$contacto->_descripcion = $registro["descripcion"];
    		$listadoContactos[] = $contacto;
    	}


    	return $listadoContactos;

	}

	public function guardar() {
		$sql = "INSERT INTO persona_contacto "
		     . "(id_persona_contacto, id_persona, id_tipo_contacto, valor) "
		     . "VALUES (NULL, {$this->_idPersona}, {$this->_idTipoContacto}, '{$this->_valor}')";

        $database = new MySQL();
        $idInsertado = $database->insertar($sql);

        $this->_idPersonaContacto = $idInsertado;
	}

	public function eliminar($idPersonaContacto) {
		$sql = "DELETE FROM persona_contacto WHERE id_persona_contacto=" . $idPersonaContacto;
        $database = new MySQL();
        $database->eliminar($sql);
	}

}


?>