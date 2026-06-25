<?php

namespace Model;

class ActiveRecord
{
    // Base de datos
    protected static $db;
    // atributos de la base de datos
    protected static $columnasDB = [];
    // nombre de la tabla
    protected static $tabla = "";

    // errores (validacion).
    protected static $errores = [];

    public $id;
    public $imagen;

    // definir la conexion a la base de datos
    public static function setDB($db)
    {
        self::$db = $db;
    }
    public function guardar(String $url = "")
    {
        if (!is_null($this->id)) {
            // actualizar una propiedad
            $this->actualizar($url);
        } else {
            // crear nueva propiedad
            $this->crear($url);
        }
    }

    public function crear(string $url)
    {
        //echo "Guardando en la base de datos";

        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        // Me devuelve todas las propiedades del arreglo asociativo
        //array_keys($atributos);
        // join me convierte un arreglo a String
        //$string = join(", ", array_keys($atributos));
        // array:values($atributo);
        //$string = join(", ", array_keys($atributos));
        /*   debuguear($string); */

        // Definimos la consulta SQL
        //$sql = "INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, creado, vendedores_id) VALUES ('$this->titulo', $this->precio, '$this->imagen', '$this->descripcion', $this->habitaciones, $this->wc, $this->estacionamiento, '$this->creado', $this->vendedores_id);";

        // Definimos la consulta SQL
        $sql = "INSERT INTO " . static::$tabla . " (";
        $sql .= join(", ", array_keys($atributos));
        $sql .= ") VALUES ('";
        $sql .= join("','", array_values($atributos));
        $sql .= "');";

        //debuguear($sql);

        // realizamos la consulta SQL
        $query = self::$db->query($sql);

        //debuguear($query);

        // Cuando se insertaron los datos correctamente
        if ($query) {
            // funcion para redireccionar al usuario
            header("location: /public/index.php/{$url}?resultado=1");
            // query string con dos o mas propiedad - valor
            //header("location: ./../index.php?resultado=1&numero=10");
        }
    }

    public function actualizar(string $url)
    {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();


        // Definir la consulta SQL
        $variables = [];
        foreach ($atributos as $p => $v) {
            $variables[] = "{$p} = '{$v}'";
        }
        $sql = "UPDATE " . static::$tabla . " SET ";
        $sql .= join(", ", $variables);
        $sql .= " WHERE id = '" . self::$db->escape_string($this->id) . "'";
        $sql .= " LIMIT 1";

        // Realizar la consulta SQL
        $query = self::$db->query($sql);
        // si el $query realizo bien la actualizacion redirecdiona a la persona
        if ($query) {
            // funcion para redireccionar al usuario
            header("location: /public/index.php/{$url}?resultado=2");
            // query string con dos o mas propiedad - valor
            //header("location: ./../index.php?resultado=1&numero=10");
        }
    }

    // Eliminar un registro
    public function eliminar(string $url = "")
    {
        //(debuguear("Eliminando ..." . $this->id);
        //Eliminar la propiedad
        //definir la consulta SQL
        $sql = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        //debuguear($sql);
        // Realizar la consulta SQL
        $query = self::$db->query($sql);
        // verificamos si la consulta se realizo correctamente
        if ($query) {
            $this->borrarImagen();
            header("location: /public/index.php/{$url}?resultado=3");
        }
    }

    // identifica y une los atributos de la base de datos
    public function atributos()
    {
        $atributos = [];
        foreach (static::$columnasDB as $columna) {
            if ($columna === "id") continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarAtributos()
    {
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach ($atributos as $p => $v) {
            $sanitizado[$p] = self::$db->escape_string($v);
        }
        return $sanitizado;
    }

    // metodo para subir las imagenes
    public function setImagen($imagen)
    {
        // Eliminar la imagen previa
        if (!is_null($this->id)) {
            $this->borrarImagen();
        }

        // asignar al atributo de imagen el nombre de la imagen
        if ($imagen) {
            $this->imagen = $imagen;
        }
    }

    // eliminar imagenes del disco duro
    public function borrarImagen()
    {
        //debuguear("eliminando imagen...");
        // comprobar si el archivo existe en el servidor
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if ($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }

    // metodo para devolver el arreglo de errores
    public static function getErrores()
    {
        return static::$errores;
    }

    // metodo para validar los datos
    public function validar()
    {
        static::$errores = [];
        return static::$errores;
    }

    // Listar todas las propiedades
    public static function all()
    {
        //echo "Consultando todas las propiedades";
        //exit;
        $sql = "SELECT * FROM " . static::$tabla;
        $query = self::consultaSQL($sql);
        //$query = self::$db->query($sql);
        //debuguear($query->fetch_assoc());
        return $query;
    }

    // Obtiene determinado numero de registros.
    public static function get($cantidad)
    {
        $sql = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;
        $query = self::consultaSQL($sql);
        return $query;
    }

    //Busca un registro por su id
    public static function find($id)
    {
        $sql = "SELECT * FROM " . static::$tabla . " WHERE id = {$id}";
        $query = self::consultaSQL($sql);
        return array_shift($query);
    }
    public static function consultaSQL($sql)
    {
        // consultar la base de datos
        $query = self::$db->query($sql);
        // iterar los resultados
        //debuguear($query->fetch_assoc());
        $array = [];
        while ($registro = $query->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }
        //debuguear($array);
        // liberar la memoria
        $query->free();
        // retornar los resultados del query
        return $array;
    }
    protected static function crearObjeto($registro)
    {
        $objeto = new static;
        //debuguear($objeto);
        foreach ($registro as $p => $v) {
            if (property_exists($objeto, $p)) {
                $objeto->$p = $v;
            }
        }
        //debuguear($objeto);
        return $objeto;
    }

    // Sincroniza el objeto en memoria con los cambios realizados por el susuario
    public function sincronizar($args = [])
    {
        foreach ($args as $p => $v) {
            if (property_exists($this, $p) && !is_null($v)) {
                $this->$p = $v;
            }
        }
    }
}
