<?php
namespace Model;
class Blog extends ActiveRecord{
    protected static $tabla = "blogs";
    protected static $columnasDB = ["id", "titulo", "contenido", "imagen", "fecha", "creador"];
    public $id;
    public $titulo;
    public $contenido;
    public $imagen;
    public $fecha;
    public $creador;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->titulo = $args["titulo"] ?? "";
        $this->contenido = $args["contenido"] ?? "";
        $this->imagen = $args["imagen"] ?? "";
        $this->fecha = date("Y/m/d");
        $this->creador = $args["creador"] ?? "";
   } 

   public function validar(){
    if(!$this->titulo){
        self::$errores[] = "El titulo es obligatorio";
    }
    if(!$this->contenido){
        self::$errores[] = "La descripcion es obligatoria";
    }
    if(!$this->imagen){
        self::$errores[] = "La imagen es obligatoria";
    }
    if(!$this->creador){
        self::$errores[] = "El Autor del blog es obligatorio";
    }

    return self::$errores;
   }
}