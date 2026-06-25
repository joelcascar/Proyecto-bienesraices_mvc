<?php
namespace Controllers;

use Model\Blog;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Image;

class BlogController{
    public static function blog(Router $router){
        $blogs = Blog::all();
        $resultado = $_GET["resultado"] ?? null;
        $router->render("blogs/blog",[
            "blogs"=>$blogs,
            "resultado"=>$resultado
        ]);
    }

    public static function crear(Router $router){
        try{

            $blog = new Blog;
            $errores = Blog::getErrores();
    
            if($_SERVER["REQUEST_METHOD"] === "POST"){
               
                // Instanciamos la clase Propiedad
                $blog = new Blog($_POST["blog"]);
                // Generar un nombre unico 
                $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
    
                // comprobamos que si existe una imagen la crea y la redimensiona.
                if($_FILES["blog"]["tmp_name"]["imagen"]){
                    // crear imagen y cambiarle el tamaño con Intervention/image
                    $image = Image::make($_FILES["blog"]["tmp_name"]["imagen"])->fit(800,600);
                    // asignamos el nombre de la imagen al metodo setImagen 
                    $blog->setImagen($nombreImagen);
                }        
                // Llamamos al metodo validar()
                $errores = $blog->validar();
           
           
                if(empty($errores)){
                    /* Subida de archivos */
                    // Crear carpeta
                    if(!is_dir(CARPETA_IMAGENES)){
                        mkdir(CARPETA_IMAGENES);
                    }
                    //guardar la imagen en el servidor
                    $image->save(CARPETA_IMAGENES . $nombreImagen); 
    
                    // Llamamos al metodo guardar
                    $blog->guardar("admin/blogs");
                }
            };
    
            $router->render("blogs/crear",[
                "blog"=>$blog,
                "errores"=>$errores
            ]);
        } catch(\Throwable $th){
            echo $th;
        }
    }

    public static function actualizar(Router $router){
        $id = validarORedireccionar("/bienesraicesMVC/public/index.php/admin/blogs");
        $blog = Blog::find($id);
        $errores = Blog::getErrores();

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            // asignar los atributos
            $args = $_POST["blog"];
            //debuguear($args);
            $blog->sincronizar($args);
            // llamamos al metodo validar().
            $errores = $blog->validar();

            // subida de archivos
            // Generar un nombre unico 
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
            // comprobamos que si existe una imagen la crea y la redimensiona.
            if($_FILES["blog"]["tmp_name"]["imagen"]){
                // crear imagen y cambiarle el tamaño con Intervention/image
                $image = Image::make($_FILES["blog"]["tmp_name"]["imagen"])->fit(800,600);
                // asignamos el nombre de la imagen al metodo setImagen 
                $blog->setImagen($nombreImagen);
            }
            if(empty($errores)){

                if($_FILES["blog"]["tmp_name"]["imagen"]){
                    // almacenar la imagen 
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }
                $blog->guardar("admin/blogs");
            }
        }

        $router->render("blogs/actualizar", [
            "blog"=>$blog,
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
                    $blog = Blog::find($id);
                    $blog->eliminar("admin/blogs");
                }
            }
        }
    }
}