<?php
if (!isset($_SESSION)) {
    session_start();
}
$auth = $_SESSION["login"] ?? false;
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raíces</title>
    <link rel="stylesheet" href="/public/build/css/app.css">
</head>

<body>
    <header class="header <?php echo $inicio ? "inicio" : ""; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/public/index.php">
                    <img loading="lazy" src="/public/build/img/logo.svg" alt="Logotipo de Bienes Raices">
                </a>

                <div class="mobile-menu">
                    <img src="/public/build/img/barras.svg" alt="icono menu responsive">
                </div>
                <div class="derecha">
                    <img class="dark-mode-boton" loading="lazy" width="200" height="300" src="/public/build/img/dark-mode.svg" alt="icono dark mode">
                    <nav class="navegacion">
                        <?php if ($auth) { ?>
                            <a href="/public/index.php/admin">Admin</a>
                        <?php } ?>
                        <a href="/public/index.php/nosotros">Nosotros</a>
                        <a href="/public/index.php/propiedades">Anuncios</a>
                        <a href="/public/index.php/blog">Blog</a>
                        <a href="/public/index.php/contacto">Contacto</a>
                        <?php if ($auth): ?>
                            <a href="/public/index.php/logout">Cerrar Sesión</a>
                        <?php elseif (!$auth): ?>
                            <a href="/public/index.php/login">Iniciar Sesión</a>
                        <?php endif; ?>
                    </nav>
                </div>
            </div>
            <?php if ($inicio) { ?>
                <h2>Venta de Casas y Departamentos Exclusivos de Lujo</h2>
            <?php } ?>
        </div>
    </header>

    <?php echo $contenido; ?>

    <footer class="footer seccion">
        <div class="contenedor contenedor-footer">
            <nav class="navegacion">
                <a href="/public/index.php/nosotros">Nosotros</a>
                <a href="/public/index.php/propiedades">Anuncios</a>
                <a href="/public/index.php/blog">Blog</a>
                <a href="/public/index.php/contacto">Contacto</a>
            </nav>
        </div>
        <p class="copyright">Todos los derechos reservados <?php echo date("Y"); ?> &copy;</p>
    </footer>
    <script src="/public/build/js/bundle.min.js"></script>
</body>

</html>