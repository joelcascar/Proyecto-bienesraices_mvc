<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar sesión</h1>
    <?php foreach ($errores as $error): ?>
        <div class="alerta error ">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>
    <form method="POST" class="formulario" action="/login">
        <fieldset>
            <legend>Email y Password</legend>
            <label for="email">Email</label>
            <input type="email" id="email" name="usuarios[email]" placeholder="Tu email" value="<?php echo s($auth->email); ?>">
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="usuarios[password]" placeholder="Tu contraseña">
        </fieldset>
        <input type="submit" value="Iniciar sesion" class="boton boton-verde">
    </form>
</main>