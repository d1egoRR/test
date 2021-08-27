<?php

require_once "MySQL.php";
require_once "Persona.php";


class Empleado extends Persona {

	private $_idEmpleado;
	private $_numeroLegajo;

	public function getIdEmpleado() {
		return $this->_idEmpleado;
	}

	public function getNumeroLegajo() {
		return $this->_numeroLegajo;
	}

	public function setNumeroLegajo($numeroLegajo) {
		$this->_numeroLegajo = $numeroLegajo;
	}

	public function guardar() {
		parent::guardar();

		$database = new MySQL();

		$sql = "INSERT INTO empleados "
		     . "(`id_empleado`, `id_persona`, `numero_legajo`) "
		     . "VALUES (NULL, {$this->_idPersona}, {$this->_numeroLegajo})";

		$database->insertar($sql);

	}

	public function actualizar() {
		parent::actualizar();

		$database = new MySQL();

		$sql = "UPDATE empleados SET numero_legajo = '{$this->_numeroLegajo}'"
             . "WHERE empleados.id_empleado = {$this->_idEmpleado}";


        $database->actualizar($sql);

	}

	public static function obtenerTodos($filtroEstado = 0, $filtroApellido = "") {
    	$sql = "SELECT personas.id_persona, personas.nombre, personas.apellido, "
             . "personas.fecha_nacimiento, empleados.id_empleado, empleados.numero_legajo "
             . "FROM empleados "
             . "JOIN personas ON personas.id_persona = empleados.id_persona";

        $where = "";

        if ($filtroEstado != 0) {
        	// $sql = $sql . " WHERE personas.estado = " . $filtroEstado;
        	$where = "WHERE personas.estado = " . $filtroEstado;
        }

        if ($filtroApellido != "") {

        	if ($where != "") {

        		$where .= " AND personas.apellido = '{$filtroApellido}'";

        	} else {

        		$where = "WHERE personas.apellido like '%{$filtroApellido}%'";

        	}
        }

        $sql = $sql . " " . $where;



    	$database = new MySQL();
    	$datos = $database->consultar($sql);

    	$listadoEmpleados = [];

    	while ($registro = $datos->fetch_assoc()) {
	    	$empleado = new Empleado();
			$empleado->_idEmpleado = $registro["id_empleado"];
			$empleado->_idPersona = $registro["id_persona"];
			$empleado->_numeroLegajo = $registro["numero_legajo"];
			$empleado->_nombre = $registro["nombre"];
			$empleado->_apellido = $registro["apellido"];
			$empleado->_fechaNacimiento = $registro["fecha_nacimiento"];
    		$listadoEmpleados[] = $empleado;
    	}


    	return $listadoEmpleados;
	}

    public static function obtenerPorId($id) {
    	$sql = "SELECT personas.id_persona, personas.nombre, personas.apellido, "
             . "personas.fecha_nacimiento, personas.id_sexo, personas.estado, empleados.id_empleado, "
             . "empleados.numero_legajo "
             . "FROM empleados "
             . "JOIN personas ON personas.id_persona = empleados.id_persona "
             . "WHERE id_empleado=" . $id;

        $database = new MySQL();
        $datos = $database->consultar($sql);

        // TODO: ver que pasa cuando no existe el empleado
        if ($datos->num_rows == 0) {
        	return false;
        }

        $registro = $datos->fetch_assoc();
    	$empleado = self::_crearEmpleado($registro);
		return $empleado;

    }

    public static function obtenerPorIdPersona($idPersona) {
    	$sql = "SELECT personas.id_persona, personas.nombre, personas.apellido, "
             . "personas.fecha_nacimiento, personas.id_sexo, personas.estado, empleados.id_empleado, "
             . "empleados.numero_legajo "
             . "FROM empleados "
             . "JOIN personas ON personas.id_persona = empleados.id_persona "
             . "WHERE empleados.id_persona=" . $idPersona;

        $database = new MySQL();
        $datos = $database->consultar($sql);

        // TODO: ver que pasa cuando no existe el empleado
        if ($datos->num_rows == 0) {
        	return false;
        }

        $registro = $datos->fetch_assoc();
    	$empleado = self::_crearEmpleado($registro);
		return $empleado;

    }

    public function eliminar() {

    	$sql = "DELETE FROM empleados WHERE id_empleado={$this->_idEmpleado}";
    	
    	$database = new MySQL();
        $database->eliminar($sql);

        parent::eliminar();

    }

    private static function _crearEmpleado($datos) {
    	$empleado = new Empleado();
		$empleado->_idEmpleado = $datos["id_empleado"];
		$empleado->_idPersona = $datos["id_persona"];
		$empleado->_nombre = $datos["nombre"];
		$empleado->_apellido = $datos["apellido"];
		$empleado->_idSexo = $datos["id_sexo"];
		$empleado->_estado = $datos["estado"];
		$empleado->_fechaNacimiento = $datos["fecha_nacimiento"];
		$empleado->_numeroLegajo = $datos["numero_legajo"];

		return $empleado;
    }


}



?>