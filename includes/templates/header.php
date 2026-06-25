<?php
if (!isset($_SESSION)) {
    session_start();
}
$auth = $_SESSION["login"] ?? false;
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta char set="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raíces</title>
    <link rel="stylesheet" href="/build/css/app.css">
</head>

<body>
    <header class="header <?php echo ($inicio) ? "inicio" : ""; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="index.php">
                    <img loading="lazy" src="/build/img/logo.svg" alt="Logotipo de Bienes Raices">
                </a>

                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="icono menu responsive">
                </div>
                <div class="derecha">
                    <img class="dark-mode-boton" loading="lazy" width="200" height="300" src="/bienesraices/build/img/dark-mode.svg" alt="icono dark mode">
                    <nav class="navegacion">
                        <?php if ($auth) { ?>
                            <a href="/admin/index.php">Admin</a>
                        <?php } ?>
                        <a href="nosotros.php">Nosotros</a>
                        <a href="anuncios.php">Anuncios</a>
                        <a href="blog.php">Blog</a>
                        <a href="contacto.php">Contacto</a>
                        <?php if ($auth): ?>
                            <a href="/bienesraices/cerrar-sesion.php">Cerrar Sesión</a>
                        <?php elseif (!$auth): ?>
                            <a href="/bienesraices/login.php">Iniciar Sesión</a>
                        <?php endif; ?>
                    </nav>
                </div>
            </div>
            <?php if ($inicio) { ?>
                <h2>Venta de Casas y Departamentos Exclusivos de Lujo</h2>
            <?php } ?>
        </div>
    </header>