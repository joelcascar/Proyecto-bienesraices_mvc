<main class="contenedor seccion">
    <h1>Registrar Vendedor(a)</h1>
    <a href="/public/index.php/admin" class="boton boton-amarillo-chico">Volver</a>
    <?php foreach ($errores as $error) { ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php } ?>
    <form class="formulario" method="POST" action="/public/index.php/vendedores/crear">
        <?php include __DIR__ . "/formulario.php" ?>
        <input type="submit" value="Registrar vendedor(a)" class="boton boton-amarillo-chico">
    </form>
</main>