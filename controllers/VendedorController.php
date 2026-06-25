<?php

namespace Controllers;
use MVC\Router;
use Model\Vendedor;

class VendedorController{
    public static function crear(Router $router){
        $vendedor = new Vendedor;
        $errores = Vendedor::getErrores();

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            // Crear una nueva instancia
            $vendedor = new Vendedor($_POST["vendedor"]);

            // Validar que no haya campos vacios
            $errores = $vendedor->validar();

            //no hay errores
            if(empty($errores)){
                $vendedor->guardar("admin");
            }
        }

        $router->render("vendedores/crear",[
            "vendedor"=>$vendedor,
            "errores"=>$errores
        ]);
    }

    public static function actualizar(Router $router){
        $id = validarORedireccionar("/bienesraicesMVC/public/index.php");
        $vendedor = Vendedor::find($id);
        $errores = Vendedor::getErrores();
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            //asignar los valores
            $args = $_POST["vendedor"];
            
            // sincronizamos los datos del objeto con los datos que el usuario ingreso
            $vendedor->sincronizar($args);
            
            // validamos el nuevo objeto
            $errores = $vendedor->validar();

            // si no hay errores actualizamos el campo
            if(empty($errores)){
                // actualizamos los datos del objeto en la base de datos
                $vendedor->guardar("admin");
            }
        }

        $router->render("vendedores/actualizar", [
            "vendedor"=>$vendedor,
            "errores"=>$errores
        ]);
    }

    public static function eliminar(){
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $id = $_POST["id"];
            // validamos que el id sea de tipo int
            $id = filter_var($id, FILTER_VALIDATE_INT); 
            if($id){
    
                $tipo = $_POST["tipo"];
                if(validarTipoContenido($tipo)){
                    $vendedor = Vendedor::find($id);
                    $vendedor->eliminar("admin");
                }
            }
        }
    } 
}