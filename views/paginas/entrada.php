<main class="contenedor seccion contenido-centrado">
    <h1>Guia para la decoración de tu hogar</h1>
    <picture>
        <img loading="lazy" width="200" height="300" src="/public/imagenes/<?php echo s($blog->imagen); ?>" alt="imagen de la propiedad">
    </picture>
    <p class="informacion-meta">
        Escrito el: <span><?php echo s($blog->fecha); ?></span> por: <span><?php echo s($blog->creador); ?></span>
    </p>
    <p><?php echo s($blog->contenido); ?></p>
    </div>
</main>