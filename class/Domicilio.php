<?php


require_once "MySQL.php";



class Domicilio {

	private $_idDomicilio;
	private $_idPersona;
	private $_calle;
	private $_altura;
	private $_manzana;
	private $_numeroCasa;
	private $_torre;
	private $_piso;
	private $_observaciones;

	public function getCalle() {
		return $this->_calle;
	}

	public function getAltura() {
		return $this->_altura;
	}

	public function getManzana() {
		return $this->_manzana;
	}

	public function getNumeroCasa() {
		return $this->_numeroCasa;
	}

	public function getTorre() {
		return $this->_torre;
	}

	public function getPiso() {
		return $this->_piso;
	}

	public static function obtenerPorIdPersona($idPersona) {
		$sql = "SELECT * FROM domicilio WHERE id_persona=" . $idPersona;

		$database = new MySQL();
		$datos = $database->consultar($sql);

		$listadoDomicilios = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$domicilio = new Domicilio();
			$domicilio->_idDomicilio = $registro["id_domicilio"];
			$domicilio->_idPersona = $registro["id_persona"];
			$domicilio->_calle = $registro["calle"];
			$domicilio->_altura = $registro["altura"];
			$domicilio->_manzana = $registro["manzana"];
			$domicilio->_numeroCasa = $registro["numero_casa"];
			$domicilio->_torre = $registro["torre"];
			$domicilio->_piso = $registro["piso"];
			$domicilio->_observaciones = $registro["observaciones"];
    		$listadoDomicilios[] = $domicilio;
    	}


    	return $listadoDomicilios;
	}

}


?>