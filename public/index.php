<?php
require_once __DIR__ . "/../includes/app.php";

use MVC\Router;
use Controllers\BlogController;
use Controllers\LoginController;
use Controllers\PropiedadController;
use Controllers\VendedorController;
use Controllers\PaginaController;

try {
    $router = new Router();

    // CRUD propiedades
    $router->get("/admin", [PropiedadController::class, "index"]); // en los corchetes primero busca la clase y despues el método.
    $router->get("/propiedades/crear", [PropiedadController::class, "crear"]);
    $router->post("/propiedades/crear", [PropiedadController::class, "crear"]);
    $router->get("/propiedades/actualizar", [PropiedadController::class, "actualizar"]);
    $router->post("/propiedades/actualizar", [PropiedadController::class, "actualizar"]);
    $router->post("/propiedades/eliminar", [PropiedadController::class, "eliminar"]);

    // CRUD vendedores
    $router->get("/vendedores/crear", [VendedorController::class, "crear"]);
    $router->post("/vendedores/crear", [VendedorController::class, "crear"]);
    $router->get("/vendedores/actualizar", [VendedorController::class, "actualizar"]);
    $router->post("/vendedores/actualizar", [VendedorController::class, "actualizar"]);
    $router->post("/vendedores/eliminar", [VendedorController::class, "eliminar"]);

    // rutas para las paginas de los usuarios
    $router->get("/", [PaginaController::class, "index"]);
    $router->get("/nosotros", [PaginaController::class, "nosotros"]);
    $router->get("/propiedades", [PaginaController::class, "propiedades"]);
    $router->get("/propiedad", [PaginaController::class, "propiedad"]);
    $router->get("/blog", [PaginaController::class, "blog"]);
    $router->get("/entrada", [PaginaController::class, "entrada"]);
    $router->get("/contacto", [PaginaController::class, "contacto"]);
    $router->post("/contacto", [PaginaController::class, "contacto"]);

    // CRUD de Blog
    $router->get("/admin/blogs", [BlogController::class, "blog"]);
    $router->get("/admin/blogs/crear", [BlogController::class, "crear"]);
    $router->post("/admin/blogs/crear", [BlogController::class, "crear"]);
    $router->get("/admin/blogs/actualizar", [BlogController::class, "actualizar"]);
    $router->post("/admin/blogs/actualizar", [BlogController::class, "actualizar"]);
    $router->post("/admin/blogs/eliminar", [BlogController::class, "eliminar"]);

    // Login y autenticacion
    $router->get("/login", [LoginController::class, "login"]);
    $router->post("/login", [LoginController::class, "login"]);
    $router->get("/logout", [LoginController::class, "logout"]);


    $router->comprobarRutas();
} catch (\Throwable $th) {
    echo $th;
}
