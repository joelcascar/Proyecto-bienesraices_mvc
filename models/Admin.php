<?php

namespace Model;

class Admin extends ActiveRecord
{
    // Conectarse a la base de datos
    protected static $tabla = "usuarios";
    protected static $columnasDB = ["id", "email", "password"];
    //atributos
    public $id;
    public $email;
    public $password;

    // Constructor
    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->email = $args["email"] ?? "";
        $this->password = $args["password"] ?? "";
    }

    public function validar()
    {
        if (!$this->email) {
            self::$errores[] = "ERROR: El email es obligatorio";
        }
        if (!$this->password) {
            self::$errores[] = "ERROR: El password es obligatorio";
        }
        return self::$errores;
    }

    public function existeUsuario()
    {
        // Realizar consulta en la base de datos
        $sql = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";
        $query = self::$db->query($sql);

        if (!$query->num_rows) {
            self::$errores[] = "ERROR: El email es incorrecto o no existe";
            return;
        }
        return $query;
    }

    public function comprobarPassword($query)
    {
        // obtenemos el password de la base de datos.
        $usuario = $query->fetch_object();
        $autenticado = password_verify($this->password, $usuario->password);
        if (!$autenticado) {
            self::$errores[] = "ERROR: El password es incorrecto";
        }
        return $autenticado;
    }

    public function autenticar()
    {
        // iniciar la sesion
        session_start();
        // Llenar el arreglo de SESSION
        $_SESSION["usuario"] = $this->email;
        $_SESSION["login"] = true;
        // redireccionar al usuario
        header("location: /admin");
    }
}
