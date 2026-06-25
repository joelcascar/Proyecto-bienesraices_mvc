<main class="contenedor seccion">
    <h1>Contacto</h1>

    <?php
    if ($mensaje): ?>
        <p class="alerta exito"><?php echo s($mensaje); ?></p>
    <?php endif; ?>
    <picture>
        <source srcset="/public/build/img/destacada3.webp" type="image/webp">
        <img loading="lazy" width="200" height="300" src="/public/build/img/destacada3.jpg" alt="imagen Contacto">
    </picture>

    <h2>Llene el formulario de Contacto</h2>
    <form class="formulario" action="/public/index.php/contacto" method="POST">
        <fieldset>
            <legend>Informacion Personal</legend>
            <label for="nombre">Nombre</label>
            <input id="nombre" type="text" placeholder="Tu Nombre" name="contacto[nombre]" required>

            <label for="mensaje">Mensaje</label>
            <textarea id="mensaje" name="contacto[mensaje]" required></textarea>
        </fieldset>

        <fieldset>
            <legend>Informacion sobre Propiedad</legend>

            <label for="tipo">vende o compra</label>
            <select name="contacto[tipo]" id="tipo" required>
                <option disabled selected>--Selecciona--</option>
                <option value="compra">Compra</option>
                <option value="venta">Vende</option>
            </select>

            <label for="presupuesto">Precio o Presupuesto</label>
            <input type="number" placeholder="Tu precio o Presupuesto" id="presupuesto" name="contacto[presupuesto]" required>
        </fieldset>

        <fieldset>
            <legend>Contacto</legend>
            <p>Como desea ser contactado</p>
            <div class="forma-contacto">
                <label for="opcion-telefono">Telefono</label>
                <input type="radio" value="telefono" id="opcion-telefono" name="contacto[contacto]" required>
                <label for="opcion-email">E-mail</label>
                <input type="radio" value="email" id="opcion-email" name="contacto[contacto]" required>
            </div>
            <div id="contacto"></div>
        </fieldset>
        <input type="submit" value="Enviar" class="boton-verde">
    </form>
</main>