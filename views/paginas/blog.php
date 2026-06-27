<main class="contenedor seccion contenido-centrado">
    <h1>Nuestro Blog</h1>
    <?php foreach ($blogs as $blog) { ?>
        <article class="entrada-blog">
            <div class="imagen">
                <img loading="lazy" src="/imagenes/<?php echo s($blog->imagen); ?>" alt="Texto Entrada Blog">
            </div> <!-- imagen -->

            <div class="texto-entrada">
                <a href="/entrada">
                    <h4><?php echo s($blog->titulo); ?></h4>
                    <p class="informacion-meta">Escrito el: <span><?php echo s($blog->fecha); ?></span> por: <span><?php echo s($blog->creador); ?></span></p>
                    <p>
                        <?php echo s($blog->contenido); ?>
                    </p>
                </a>
            </div>
        </article> <!-- entrada -->
    <?php } ?>
</main>