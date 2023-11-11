<main id="main">
    <form class="form" action="/admin/apoderado/actualizar" method="POST">
        <legend class="tittle"> Actualizar Apoderado</legend>
        <!-- CAMPOS -->
        <div class="cont-campos">
            <h5> Rut:</h5>
            <input class="text-area" type="text" id="rut_apod" name="apoderado[rut_apod]" placeholder="12345678-9" value="<?php echo $apoderado->rut_apod; ?>">
        </div>
        <div class="cont-campos">
            <h5> Nombre:</h5>
            <input class="text-area" type="text" id="nombres_apod" name="apoderado[nombres_apod]" placeholder="Nombre" value="<?php echo $apoderado->nombres_apod; ?>">
        </div>
        <div class="cont-campos">
            <h5> Apellido:</h5>
            <input class="text-area" type="text" id="apellidos_apod" name="apoderado[apellidos_apod]" placeholder="Apellido" value="<?php echo $apoderado->apellidos_apod; ?>">
        </div>
        <div class="cont-campos">
            <h5> Contraseña:</h5>
            <input class="text-area" type="text" id="password_apod" name="apoderado[password_apod]" placeholder="*********">
        </div>
        <input type="hidden" name="id" value="<?php echo $apoderado->rut_apod;?>">

        <!-- BOTON AGREGAR -->
        <div class="cont-boton">
            <input class="boton" type="submit" id="login_apoderado" value="Agregar">
        </div>
    </form>

    <script src="../../js/app.js"></script>
    <script src="../../js/filter.js"></script>
</main>