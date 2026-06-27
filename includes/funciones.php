<?php

define("TEMPLATES_URL", __DIR__ . "/templates");
define("FUNCIONES_URL", __DIR__ . "funciones.php");
define("CARPETA_IMAGENES", $_SERVER["DOCUMENT_ROOT"] . "/imagenes/");

function incluirTemplates(string $nombre, bool $inicio = false)
{
    include TEMPLATES_URL . "/{$nombre}.php";
}

function estaAutenticado()
{
    session_start();

    if (!$_SESSION["login"]) {
        header("location: ./../index.php");
    }
}

function debuguear($variable)
{
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / sanitiza el HTML 
function s($html)
{
    $s = htmlspecialchars($html);
    return $s;
}

// Validar tipo de contenido
function validarTipoContenido($tipo)
{
    $tipos = ["vendedor", "propiedad", "blog"];
    return in_array($tipo, $tipos);
}

// Muestra los mensajes
function mostrarNotificacion($codigo)
{
    $mensaje = "";
    switch ($codigo) {
        case 1:
            $mensaje = "Creado Correctamente";
            break;
        case 2:
            $mensaje = "Actualizado Correctamente";
            break;
        case 3:
            $mensaje = "Eliminado Correctamente";
            break;
        default:
            false;
            break;
    }
    return $mensaje;
}

function validarORedireccionar(string $url)
{
    // Validar URL por ID valido
    $id = $_GET["id"];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if (!$id) {
        header("location: {$url}");
    }
    return $id;
}
