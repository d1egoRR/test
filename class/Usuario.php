<?php


require_once "MySQL.php";
require_once "Persona.php";
require_once "Perfil.php";


class Usuario extends Persona {

	private $_idUsuario;
	private $_username;
	private $_idPerfil;
	private $_estaLogueado;

    public $perfil;


    /**
     * @return mixed
     */
    public function getIdUsuario()
    {
        return $this->_idUsuario;
    }

    /**
     * @param mixed $_idUsuario
     *
     * @return self
     */
    public function setIdUsuario($_idUsuario)
    {
        $this->_idUsuario = $_idUsuario;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->_username;
    }

    /**
     * @param mixed $_username
     *
     * @return self
     */
    public function setUsername($_username)
    {
        $this->_username = $_username;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getIdPerfil()
    {
        return $this->_idPerfil;
    }

    /**
     * @param mixed $_idPerfil
     *
     * @return self
     */
    public function setIdPerfil($_idPerfil)
    {
        $this->_idPerfil = $_idPerfil;

        return $this;
    }

    public function estaLogueado()
    {
    	return $this->_estaLogueado;
    }

    public static function obtenerTodos() {
    	$sql = "SELECT personas.id_persona, personas.nombre, personas.apellido, "
             . "personas.fecha_nacimiento, usuarios.id_usuario, usuarios.username, "
             . "usuarios.id_perfil "
             . "FROM usuarios "
             . "JOIN personas ON personas.id_persona = usuarios.id_persona";

    	$database = new MySQL();
    	$datos = $database->consultar($sql);

    	$listadoUsuarios = [];

    	while ($registro = $datos->fetch_assoc()) {
    		$user = self::_crearUsuario($registro);
    		$listadoUsuarios[] = $user;
    	}


    	return $listadoUsuarios;
    }

    public static function login($username, $password) {
    	$sql = "SELECT personas.id_persona, personas.nombre, personas.apellido, "
             . "personas.fecha_nacimiento, usuarios.id_usuario, usuarios.username, "
             . "usuarios.id_perfil "
             . "FROM usuarios "
             . "JOIN personas ON personas.id_persona = usuarios.id_persona "
             . "WHERE username = '{$username}' and password = '{$password}' and personas.estado=1";

    	$database = new MySQL();
    	$datos = $database->consultar($sql);


    	if ($datos->num_rows > 0) {
    		$registro = $datos->fetch_assoc();
			$user = self::_crearUsuario($registro);
			$user->_estaLogueado = true;

    	} else {
    		$user = new Usuario();
    		$user->_estaLogueado = false;
    	}

		return $user;

    }

    public static function obtenerPorId($id) {
    	$sql = "SELECT personas.id_persona, personas.nombre, personas.apellido, "
             . "personas.fecha_nacimiento, usuarios.id_usuario, usuarios.username, "
             . "usuarios.id_perfil "
             . "FROM usuarios "
             . "JOIN personas ON personas.id_persona = usuarios.id_persona "
             . "WHERE id_usuario=" . $id;


        $database = new MySQL();
        $datos = $database->consultar($sql);

        if ($datos->num_rows == 0) {
        	return false;
        }

        $registro = $datos->fetch_assoc();
    	$usuario = self::_crearUsuario($registro);
		return $usuario;

    }

    private static function _crearUsuario($datos) {
    	$user = new Usuario();
		$user->_idUsuario = $datos["id_usuario"];
		$user->_idPersona = $datos["id_persona"];
		$user->_username = $datos["username"];
		$user->_idPerfil = $datos["id_perfil"];
		$user->_nombre = $datos["nombre"];
		$user->_apellido = $datos["apellido"];
		$user->_fechaNacimiento = $datos["fecha_nacimiento"];
        $user->perfil = Perfil::obtenerPorId($user->_idPerfil);

		return $user;
    }
}


?>