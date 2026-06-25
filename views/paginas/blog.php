<main class="contenedor seccion contenido-centrado">
    <h1>Nuestro Blog</h1>
    <?php foreach ($blogs as $blog): ?>
        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <img loading="lazy" width="200" height="300" src="/public/imagenes/<?php echo $blog->imagen; ?>" alt="Texto Entrada Blog">
                </picture>
            </div>
            <div class="texto-entrada">
                <a href="/public/index.php/entrada?id=<?php echo $blog->id; ?>">
                    <h4><?php echo $blog->titulo; ?></h4>
                    <p class="informacion-meta">Escrito el: <span><?php echo $blog->fecha; ?></span> por: <span><?php echo $blog->creador; ?></span></p>
                    <p><?php echo $blog->contenido; ?></p>
                </a>
            </div>
        </article>
    <?php endforeach; ?>
</main>