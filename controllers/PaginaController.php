<?php

namespace Controllers;

use Model\Blog;
use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginaController
{
    public static function index(Router $router)
    {
        $propiedades = Propiedad::get(3);
        $blogs = Blog::get(2);
        $inicio = true;
        $router->render("paginas/index", [
            "propiedades" => $propiedades,
            "inicio" => $inicio,
            "blogs" => $blogs
        ]);
    }
    public static function nosotros(Router $router)
    {
        $router->render("paginas/nosotros", []);
    }
    public static function propiedades(Router $router)
    {
        $propiedades = Propiedad::all();
        $router->render("paginas/propiedades", [
            "propiedades" => $propiedades
        ]);
    }
    public static function propiedad(Router $router)
    {
        $id = validarORedireccionar("/propiedades");
        $propiedad = Propiedad::find($id);
        $router->render("paginas/propiedad", [
            "propiedad" => $propiedad
        ]);
    }
    public static function blog(Router $router)
    {
        try {
            $blogs = Blog::all();
            $router->render("paginas/blog", [
                "blogs" => $blogs
            ]);
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    public static function entrada(Router $router)
    {
        $id = validarORedireccionar("/blog");
        $blog = Blog::find($id);
        $router->render("paginas/entrada", [
            "blog" => $blog
        ]);
    }
    public static function contacto(Router $router)
    {
        $mensaje = null;
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $resultados = $_POST["contacto"];
            // crear una instancia de PHPMailer
            $mail = new PHPMailer();
            // configurar SMTP
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Port = 2525;
            $mail->Username = 'a60a068729aa58';
            $mail->Password = '32399c6e84be21';
            $mail->SMTPSecure = "tls";
            // configurar el contenido del mail
            $mail->setFrom("admin@bienesraices.com");
            $mail->addAddress("admin@bienesraices.com", "BienesRaices.com");
            $mail->Subject = "Tienes un nuevo Mensaje";
            //habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = "UTF-8";

            // Definir el contenido
            $contenido = "<html>";
            $contenido .= "<p>Tienes un nuevo mensaje</p>";
            $contenido .= "<p> Nombre: {$resultados["nombre"]} </p>";
            //Enviar de forma condicional algunos campos de email o telefono
            if ($resultados["contacto"] === "telefono") {
                $contenido .= "<p> Eligio ser contactado por teléfono </p>";
                $contenido .= "<p> Telefono: {$resultados["telefono"]} </p>";
                $contenido .= "<p> Fecha: {$resultados["fecha"]} </p>";
                $contenido .= "<p> Hora: {$resultados["hora"]} </p>";
            } else {
                // Es email, entonces agregamos el campo de email
                $contenido .= "<p> Eligio ser contactado por email </p>";
                $contenido .= "<p> Email: {$resultados["email"]} </p>";
            }
            $contenido .= "<p> Mensaje: {$resultados["mensaje"]} </p>";
            $contenido .= "<p> compra o venta: {$resultados["tipo"]} </p>";
            $contenido .= "<p> Presupuesto o Precio: $ {$resultados["presupuesto"]} </p>";
            $contenido .= "</html>";
            $mail->Body = $contenido;
            $mail->AltBody = "Esto es texto alternaitvo sin HTML";
            //Enviar el email
            if ($mail->send()) {
                $mensaje = "Mensaje enviado Correctamente";
            } else {
                $mensaje = "El mensaje no se pudo enviar...";
            }
        }
        $router->render("paginas/contacto", [
            "mensaje" => $mensaje
        ]);
    }
}
