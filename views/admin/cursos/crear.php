<main>
    <div class="formulario">
        <h1>Ingreso Curso</h1>
        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>
        <form action="/admin/curso/crear" method="POST">
            <div class="ingresorut">
                <input type="text" id="rut" name="curso[rut_apoderado]" value="<?php echo $curso->rut_apoderado?>">
                <label for="rut">Ingrese Rut Apoderado</label>
            </div>
            <div class="ingresorut">
                <input type="text" id="rut" name="curso[nombres_curso]" value="<?php echo $curso->nombre_curso?>">
                <label for="rut">Ingrese Nombre de Curso</label>
            </div>

            <div class="enviar">
                <input type="submit" value="Enviar">
            </div>
        </form>
    </div>
</main>
