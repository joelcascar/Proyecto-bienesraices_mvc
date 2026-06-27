<main class="contenedor seccion">
    <h1>Registrar Vendedor(a)</h1>
    <a href="/admin" class="boton-verde">Volver</a> <!-- html siempre buscara el archivo index, por eso no necesitamos definir el nombre del archivo (/admin/index.php) -->

    <?php
    // Imprimir los errores en la página
    foreach ($errores as $error) {
    ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php } ?>

    <!-- Para enviar archivos a traves del formulario utilizamos el atributo enctype="multipart/form-data -->
    <form method="post" action="/vendedores/crear" class="formulario">

        <?php include __DIR__ . "/formulario.php"; ?>
        <input type="submit" value="Registrar Vendedor" class="boton-verde">
    </form>
</main>