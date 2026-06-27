<?php

namespace Controllers;

use MVC\Router;
use Model\Admin;

class LoginController
{
    public static function login(Router $router)
    {
        $auth = '';
        $errores = [];
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $auth = new Admin($_POST["usuarios"]);

            $errores = $auth->validar();

            if (empty($errores)) {
                // Verificar si el email existe
                $query = $auth->existeUsuario();
                if (!$query) {
                    $errores = Admin::getErrores();
                } else {
                    // verificar si el password es correcto
                    $autenticado = $auth->comprobarPassword($query);
                    if ($autenticado) {
                        // autenticar al usuario
                        $auth->autenticar();
                    } else {
                        $errores = Admin::getErrores();
                    }
                }
            }
        }
        $router->render("auth/login", [
            "errores" => $errores,
            "auth" => $auth
        ]);
    }
    public static function logout()
    {
        session_start();
        $_SESSION = [];
        header("location: /");
    }
}
