<?php

namespace MVC;

class Router
{

    public $rutasGET = [];
    public $rutasPOST = [];

    // Llenamos el arreglo de rutas de tipo Get con su función.
    public function get($url, $fn)
    {
        $this->rutasGET[$url] = $fn;
    }
    // Llenamos el arrelgo de rutas POST con su función
    public function post($url, $fn)
    {
        $this->rutasPOST[$url] = $fn;
    }
    // Este método valida si las rutas existen en este router y que soporten metodos POST o GET
    public function comprobarRutas()
    {
        // session_start();
        // $auth = $_SESSION["login"] ?? null;
        // Arreglo de rutas protegidas
        // $rutasProtegidas = ["/admin", "/propiedades/crear", "/propiedades/actualizar", "/propiedades/eliminar", "/vendedores/crear", "/vendedores/actualizar", "/vendedores/eliminar", "/admin/blogs", "/admin/blogs/crear", "/admin/blogs/actualizar", "/admin/blogs/eliminar"];
        // Leemos la ruta despues del index. ejempl;o: /propiedades/crear
        $urlActual = $_SERVER["PATH_INFO"] ?? "/";
        // obtenemos si la ruta es post o get.
        $metodo = $_SERVER["REQUEST_METHOD"];
        if ($metodo === "GET") {
            // obtenemos la función de la ruta actual de tipo GET.
            $fn = $this->rutasGET[$urlActual] ?? null;
        } else {
            // obtenemos la función de la ruta actual de tipo POST.
            $fn = $this->rutasPOST[$urlActual] ?? null;
        }
        // Proteger las rutas 
        // if (in_array($urlActual, $rutasProtegidas) && !$auth) {
        //     header("location: /public/index.php/");
        // }
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
            $$p = $v; // el doble $ significa me crea una variable con el nombre del valor de $p, pero no piede el valor.
        };

        ob_start(); // Almacena en memoria durante un momento...
        include __DIR__ . "/views/{$view}.php";
        $contenido = ob_get_clean(); // devuelve lo que esta guardado y lo elimina.
        include __DIR__ . "/views/layout.php";
    }
}
