<main class="contenedor seccion">
    <h1>Administrador de Blogs</h1>
    <?php
    if ($resultado) {
        $mensaje = mostrarNotificacion(intval($resultado));
        if ($mensaje) { ?>
            <p class="alerta exito-blog"><?php echo s($mensaje); ?></p>
    <?php }
    } ?>
    <a href="/public/index.php/admin" class="boton boton-azul">Volver</a>
    <a href="/public/index.php/admin/blogs/crear" class="boton boton-azul">Nuevo Blog</a>
    <table class="propiedades">
        <thead class="blog">
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Creado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!-- Obtener los datos de la base de datos -->
            <?php foreach ($blogs as $blog): ?>
                <tr>
                    <td><?php echo $blog->id; ?></td>
                    <td><?php echo $blog->titulo; ?></td>
                    <td> <img src="/public/imagenes/<?php echo $blog->imagen; ?>" alt="imagen propiedad" class="imagen-tabla"> </td>
                    <td><?php echo $blog->fecha; ?></td>
                    <td>
                        <form method="POST" class="w-100" action="/public/index.php/admin/blogs/eliminar">
                            <input type="hidden" name="id" value="<?php echo $blog->id; ?>">
                            <input type="hidden" name="tipo" value="blog">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="/public/index.php/admin/blogs/actualizar?id=<?php echo $blog->id ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>