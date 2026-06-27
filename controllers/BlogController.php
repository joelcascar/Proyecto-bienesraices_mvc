<?php

namespace Controllers;


use Model\Blog;
use MVC\Router;
// Importamos el driver del manager de imagenes.
use Intervention\Image\Drivers\Gd\Driver;
// Importamos el manejador de imagenes y el alias se va a llamr image
use Intervention\Image\ImageManager as Image;

class BlogController
{
    public static function crear(Router $router)
    {
        try {

            $blog = new Blog;
            $errores = Blog::getErrores();

            if ($_SERVER["REQUEST_METHOD"] === "POST") {

                // Instanciamos la clase Propiedad
                $blog = new Blog($_POST["blog"]);
                // Generar un nombre unico 
                $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
                $imagen = NULL;
                // comprobamos que si existe una imagen la crea y la redimensiona.
                if ($_FILES["blog"]["tmp_name"]["imagen"]) {
                    // Configuramos el manager de imagenes con el drive por defecto.
                    $manager = Image::usingDriver(Driver::class); // el Driver::class me asignara el driver por defecto.
                    // Leemos la imagen
                    $imagen = $manager->decode($_FILES['blog']['tmp_name']['imagen']);
                    // Cambiamos el tamaño de la imagen
                    $imagen->cover(800, 600); // Primero pone el tamaño de la imgen, despues lo coloca en el centro y corta el exceso.
                    // Asignamos el nombre mediante el método setImagen()
                    $blog->setImagen($nombreImagen); // vamos a agregar el nombre de la imagen a la instancia actual ($propiedad).
                }
                // Llamamos al metodo validar()
                $errores = $blog->validar();


                if (empty($errores)) {
                    /* Subida de archivos */
                    // Crear carpeta
                    if (!is_dir(CARPETA_IMAGENES)) {
                        mkdir(CARPETA_IMAGENES);
                    }
                    if ($_FILES["blog"]["tmp_name"]["imagen"]) {
                        //guardar la imagen en el servidor
                        $imagen->save(CARPETA_IMAGENES . $nombreImagen);
                    }

                    // Llamamos al metodo guardar
                    $blog->guardar("/admin");
                }
            };

            $router->render("blogs/crear", [
                "blog" => $blog,
                "errores" => $errores
            ]);
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public static function actualizar(Router $router)
    {
        $id = validarORedireccionar("/bienesraicesMVC/public/index.php/admin/blogs");
        $blog = Blog::find($id);
        $errores = Blog::getErrores();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
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
            if ($_FILES["blog"]["tmp_name"]["imagen"]) {
                // crear imagen y cambiarle el tamaño con Intervention/image
                $image = Image::make($_FILES["blog"]["tmp_name"]["imagen"])->fit(800, 600);
                // asignamos el nombre de la imagen al metodo setImagen 
                $blog->setImagen($nombreImagen);
            }
            if (empty($errores)) {

                if ($_FILES["blog"]["tmp_name"]["imagen"]) {
                    // almacenar la imagen 
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }
                $blog->guardar("admin/blogs");
            }
        }

        $router->render("blogs/actualizar", [
            "blog" => $blog,
            "errores" => $errores
        ]);
    }

    public static function eliminar()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $id = $_POST["id"];
            // validamos que el id sea de tipo int
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if ($id) {
                $tipo = $_POST["tipo"];
                if (validarTipoContenido($tipo)) {
                    $blog = Blog::find($id);
                    $blog->eliminar("admin/blogs");
                }
            }
        }
    }
}
