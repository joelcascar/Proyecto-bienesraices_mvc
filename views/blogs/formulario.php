<fieldset>
    <legend>Informacion General</legend>
    <label for="titulo">TITULO</label>
    <input type="text" name="blog[titulo]" id="titulo" placeholder="Titulo Blog" value="<?php echo s($blog->titulo); ?>">
    <label for="contenido">DESCRIPCIÓN</label>
    <textarea name="blog[contenido]" id="contenido"><?php echo s($blog->contenido); ?></textarea>
    <label for="imagen">IMAGEN</label>
    <input type="file" id="imagen" accept="image/jpeg, image/png" name="blog[imagen]">
    <?php if ($blog->imagen): ?>
        <img src="/public/imagenes/<?php echo $blog->imagen; ?>" class="imagen-small">
    <?php endif; ?>
    <label for="creador">AUTOR</label>
    <input type="text" placeholder="Autor" id="creador" name="blog[creador]" value="<?php echo s($blog->creador); ?>">
</fieldset>