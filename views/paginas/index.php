<main class="contenedor seccion">
    <h1>Mas Sobre Nosotros</h1>
    <?php include __DIR__ . "/iconos.php"; ?>
</main>
<section class="seccion contenedor">
    <h2>Casas y Depas en Ventas</h2>
    <?php
    include __DIR__ . "/listado.php";
    ?>

    <div class="alinear-derecha">
        <a href="/public/index.php/propiedades" class="boton-verde">Ver todas</a>
    </div>
</section>

<section class="imagen-contacto">
    <h2>Encuentra la casa de tus sueños</h2>
    <p>Llena el formulario de contacto y un asesor se pondra en contacto contigo a la brevedad</p>
    <a href="/public/index.php/contacto" class="boton-amarillo-chico">Contactanos</a>
</section>

<div class="contenedor seccion seccion-inferior">
    <section class="blog">
        <h3>Nuestro blog</h3>
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
    </section>

    <section class="testimoniales">
        <h3>Testimoniales</h3>
        <div class="testimonial">
            <blockquote>
                El personal se comporto de una excelente forma, muy buena atencion y la casa que me ofrecieron cumple con todas mis expectativas,
            </blockquote>
            <p>Joel Castellanos</p>
        </div>
    </section>
</div>