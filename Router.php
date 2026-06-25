<?php

namespace MVC;

class Router
{

    public $rutasGET = [];
    public $rutasPOST = [];
    public function get($url, $fn)
    {
        $this->rutasGET[$url] = $fn;
    }
    public function post($url, $fn)
    {
        $this->rutasPOST[$url] = $fn;
    }
    public function comprobarRutas()
    {
        session_start();
        $auth = $_SESSION["login"] ?? null;
        // Arreglo de rutas protegidas
        $rutasProtegidas = ["/admin", "/propiedades/crear", "/propiedades/actualizar", "/propiedades/eliminar", "/vendedores/crear", "/vendedores/actualizar", "/vendedores/eliminar", "/admin/blogs", "/admin/blogs/crear", "/admin/blogs/actualizar", "/admin/blogs/eliminar"];
        $urlActual = $_SERVER["PATH_INFO"] ?? "/";
        $metodo = $_SERVER["REQUEST_METHOD"];
        if ($metodo === "GET") {
            $fn = $this->rutasGET[$urlActual] ?? null;
        } else {
            $fn = $this->rutasPOST[$urlActual] ?? null;
        }
        // Proteger las rutas 
        if (in_array($urlActual, $rutasProtegidas) && !$auth) {
            header("location: /public/index.php/");
        }
        if ($fn) {
            // La URL existe y hay una funcion asociada.
            call_user_func($fn, $this);
        } else {
            echo "Pagina no encotrada";
        }
    }

    // Muestra una vista
    public function render($view, $datos = [])
    {

        foreach ($datos as $p => $v) {
            $$p = $v;
        };

        ob_start(); // Almacena en memoria durante un momento...
        include __DIR__ . "/views/{$view}.php";
        $contenido = ob_get_clean(); // devuelve lo que esta guarddo y lo elimina.
        include __DIR__ . "/views/layout.php";
    }
}
