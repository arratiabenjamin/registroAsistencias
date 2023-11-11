<main id="main">

    <form class="form" action="/admin/asistencia/actualizar" method="POST">
        <legend class="tittle"> Actualizar Asistencia</legend>
        <!-- CAMPOS -->
        <div class="cont-campos">
            <h5>Rut estudiante:</h5>
            <input class="text-area" type="text" id="rut_estu" name="asistencia[rut_estu]" value="<?php echo $asistencia->rut_estu;?>" placeholder="12345678-9">
        </div>
        <div class="cont-campos">
            <h5>Comentario:</h5>
            <input class="text-area" type="text" id="comentario_asis" name="asistencia[comentario_asis]" value="<?php echo $asistencia->comentario_asis;?>" placeholder="Intento de Fuga (Opcional)">
        </div>
        <input type="hidden" name="id" value="<?php echo $asistencia->id_asis;?>">

        <!-- BOTON AGREGAR -->
        <div class="cont-boton">
            <input class="boton" type="submit" id="asistencia" value="Agregar">
        </div>
    </form>

    <script src="../../js/app.js"></script>
    <script src="../../js/filter.js"></script>

</main>