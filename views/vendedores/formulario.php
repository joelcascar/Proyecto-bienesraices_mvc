<fieldset>
<legend>Información General</legend>
    <label for="nombre">Nombre</label>
    <input type="text" name="vendedor[nombre]" id="nombre" placeholder="nombre del vendedor(a)" value="<?php echo s($vendedor->nombre); ?>">
    <label for="apellido">Apellido</label>
    <input type="text" name="vendedor[apellido]" id="nombre" placeholder="Apellido del vendedor(a)" value="<?php echo s($vendedor->apellido); ?>">
</fieldset>
<fieldset>
    <legend>Información extra</legend>
    <label for="telefono">telefono</label>
    <input type="text" name="vendedor[telefono]" id="nombre" placeholder="Telefono del vendedor(a)" value="<?php echo s($vendedor->telefono); ?>">
</fieldset>