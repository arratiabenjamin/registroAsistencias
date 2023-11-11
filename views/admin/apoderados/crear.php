<main>
    <div class="formulario">
        <h1>Ingreso Apoderado</h1>
        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>
        <form action="/admin/apoderado/crear" method="POST">
            <div class="ingresorut">
                <input type="text" id="rut" name="apoderado[rut_apoderado]" value="<?php echo $apoderado->rut_apoderado; ?>">
                <label for="rut">Rut del Apoderado </label>
            </div>
            <div class="ingresorut">
                <input type="text" id="rut" name="apoderado[nombre_apoderado]" value="<?php echo $apoderado->nombre_apoderado; ?>">
                <label for="rut">Nombre del Apoderado </label>
            </div>
            <div class="ingresorut">
                <input type="text" id="rut" name="apoderado[apellido_apoderado]" value="<?php echo $apoderado->apellido_apoderado; ?>">
                <label for="rut">Apellidos del Apoderado</label>
            </div>
            <div class="ingresorut">
                <input type="text" id="rut" name="apoderado[password_apoderado]">
                <label for="rut">Password de Apoderado</label>
            </div>

            <div class="enviar">
                <input type="submit" value="Enviar">
            </div>
        </form>
    </div>
</main>