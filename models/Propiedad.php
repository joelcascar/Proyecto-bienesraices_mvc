<?php
namespace Model;
class Propiedad extends ActiveRecord{
   protected static $tabla = "propiedades";
   // atributos de la base de datos
   protected static $columnasDB = ["id", "titulo", "precio", "imagen", "descripcion", "habitaciones", "wc", "estacionamiento", "creado", "vendedores_id"];

   public $id;
   public $titulo;
   public $precio;
   public $imagen;
   public $descripcion;
   public $habitaciones;
   public $wc;
   public $estacionamiento;
   public $creado;
   public $vendedores_id;

   public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->titulo = $args["titulo"] ?? "";
        $this->precio = $args["precio"] ?? "";
        $this->imagen = $args["imagen"] ?? "";
        $this->descripcion = $args["descripcion"] ?? "";
        $this->habitaciones = $args["habitaciones"] ?? "";
        $this->wc = $args["wc"] ?? "";
        $this->estacionamiento = $args["estacionamiento"] ?? "";
        $this->creado = date("Y-m-d");
        $this->vendedores_id = $args["vendedores_id"] ?? "";
    }

    // metodo para validar los datos
    public function validar(){
        if(!$this->titulo){
            self::$errores[] = "El Titulo no debe quedar vacio";
        }
    
        if(!$this->precio){
            self::$errores[] = "El Precio es Obligatorio";
        }
        if(strlen($this->descripcion) < 1 || strlen($this->descripcion) > 200){
            self::$errores[] = "La Descripcion es Obligatoria y debe tener menos de 50 caracteres";
        }
        if(!$this->habitaciones){
            self::$errores[] = "El numero de habitaciones es obligatorio";
        }
        if(!$this->wc){
            self::$errores[] = "El numero de baños es obligatorio";
        }
        if(!$this->estacionamiento){
            self::$errores[] = "El numero de lugares de estacionamiento es obligatorio";
        }
        if(!$this->vendedores_id){
            self::$errores[] = "Elige un vendedor";
        }
        if(!$this->imagen){
            self::$errores[] = "La imagen es obligatoria";
        }
        return self::$errores;
    }
}
