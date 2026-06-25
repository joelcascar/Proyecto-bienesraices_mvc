<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
// Importamos el driver del manager de imagenes.
use Intervention\Image\Drivers\Gd\Driver;
// Importamos el manejador de imagenes y el alias se va a llamr image
use Intervention\Image\ImageManager as Image;

class PropiedadController
{
    public static function index(Router $router)
    {

        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();
        $resultado = $_GET["resultado"] ?? null;
        $router->render("propiedades/admin", [
            "propiedades" => $propiedades,
            "vendedores" => $vendedores,
            "resultado" => $resultado
        ]);
    }
    public static function crear(Router $router)
    {
        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();
        //Arreglo con mensajes de errores
        $errores = Propiedad::getErrores();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Instanciamos la clase Propiedad
            $propiedad = new Propiedad($_POST["propiedad"]);
            // Generar un nombre unico 
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            $imagen = NULL;
            // comprobamos que si existe una imagen la crea y la redimensiona.
            if ($_FILES["propiedad"]["tmp_name"]["imagen"]) {
                // Configuramos el manager de imagenes con el drive por defecto.
                $manager = Image::usingDriver(Driver::class); // el Driver::class me asignara el driver por defecto.
                // Leemos la imagen
                $imagen = $manager->decode($_FILES['propiedad']['tmp_name']['imagen']);
                // Cambiamos el tamaño de la imagen
                $imagen->cover(800, 600); // Primero pone el tamaño de la imgen, despues lo coloca en el centro y corta el exceso.
                // Asignamos el nombre mediante el método setImagen()
                $propiedad->setImagen($nombreImagen); // vamos a agregar el nombre de la imagen a la instancia actual ($propiedad).
            }
            // Llamamos al metodo validar()
            $errores = $propiedad->validar();


            if (empty($errores)) {
                /* Subida de archivos */
                // Crear carpeta
                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }
                if ($_FILES["propiedad"]["tmp_name"]["imagen"]) {
                    //guardar la imagen en el servidor
                    $imagen->save(CARPETA_IMAGENES . $nombreImagen);
                }

                // Llamamos al metodo guardar
                $propiedad->guardar("admin");
            }
        }

        $router->render("propiedades/crear", [
            "propiedad" => $propiedad,
            "vendedores" => $vendedores,
            "errores" => $errores
        ]);
    }
    public static function actualizar(Router $router)
    {

        $id = validarORedireccionar("/bienesraicesMVC/public/index.php");
        $propiedad = Propiedad::find($id);
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();
        // Metodo POST para actualizar
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // asignar los atributos
            $args = $_POST["propiedad"];
            //debuguear($args);
            $propiedad->sincronizar($args);
            // llamamos al metodo validar().
            $errores = $propiedad->validar();

            // subida de archivos
            // Generar un nombre unico 
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
            $imagen = NULL;
            // comprobamos que si existe una imagen la crea y la redimensiona.
            if ($_FILES["propiedad"]["tmp_name"]["imagen"]) {
                // Configuramos el manager de imagenes con el drive por defecto.
                $manager = Image::usingDriver(Driver::class); // el Driver::class me asignara el driver por defecto.
                // Leemos la imagen
                $imagen = $manager->decode($_FILES['propiedad']['tmp_name']['imagen']);
                // Cambiamos el tamaño de la imagen
                $imagen->cover(800, 600); // Primero pone el tamaño de la imgen, despues lo coloca en el centro y corta el exceso.
                // Asignamos el nombre mediante el método setImagen()
                $propiedad->setImagen($nombreImagen); // vamos a agregar el nombre de la imagen a la instancia actual ($propiedad).
            }
            if (empty($errores)) {

                if ($_FILES["propiedad"]["tmp_name"]["imagen"]) {
                    // almacenar la imagen 
                    $imagen->save(CARPETA_IMAGENES . $nombreImagen);
                }
                $propiedad->guardar("admin");
            }
        }

        $router->render("propiedades/actualizar", [
            "propiedad" => $propiedad,
            "vendedores" => $vendedores,
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
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar("admin");
                }
            }
        }
    }
}
