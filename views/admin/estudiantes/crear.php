<main>
    <div class="formulario">
        <h1>Ingreso Estudiante</h1>
        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>
        <form action="/admin/estudiante/crear" method="POST">
            <div class="ingresorut">
                <input type="text" id="rut" name="estudiante[rut_estudiante]" value="<?php echo $estudiante->rut_estudiante?>">
                <label for="rut">Ingrese Rut estudiante</label>
            </div>
            <div class="ingresorut">
                <input type="text" id="rut" name="estudiante[rut_apoderado]" value="<?php echo $estudiante->rut_apoderado?>">
                <label for="rut">Ingrese Rut Apoderado</label>
            </div>
            <div class="ingresorut">
                <input type="text" id="rut" name="estudiante[nombres_estudiante]" value="<?php echo $estudiante->nombre_estudiante?>">
                <label for="rut">Ingrese Nombre de Estudiante</label>
            </div>
            <div class="ingresorut">
                <input type="text" id="rut" name="estudiante[apellidos_estudiante]" value="<?php echo $estudiante->apellidos_estudiante?>">
                <label for="rut">Ingrese Apellidos de Estudiante</label>
            </div>
            <div class="ingresorut">
                <input type="text" id="rut" name="estudiante[curso_estudiante]" value="<?php echo $estudiante->curso_estudiante?>">
                <label for="rut">Ingrese Curso de Estudiante</label>
            </div>

            <div class="enviar">
                <input type="submit" value="Enviar">
            </div>
        </form>
    </div>
</main>
