<main id="main">
    <form class="form" action="/admin/funcionario/actualizar" method="POST">
        <legend class="tittle"> Actualizar Funcionario</legend>
        <!-- CAMPOS -->
        <div class="cont-campos">
            <h5>Rut:</h5>
            <input class="text-area" type="text" id="rut_func" name="funcionario[rut_func]" placeholder="12345678-9" value="<?php echo $funcionario->rut_func; ?>">
        </div>
        <div class="cont-campos">
            <h5>Nombre:</h5>
            <input class="text-area" type="text" id="nombres_func" name="funcionario[nombres_func]" placeholder="Nombre" value="<?php echo $funcionario->nombres_func; ?>">
        </div>
        <div class="cont-campos">
            <h5>Apellido:</h5>
            <input class="text-area" type="text" id="apellidos_func" name="funcionario[apellidos_func]" placeholder="Apellido" value="<?php echo $funcionario->apellidos_func; ?>">
        </div>
        <div class="cont-campos">
            <h5> Contraseña:</h5>
            <input class="text-area" type="text" id="password_func" name="funcionario[password_func]" placeholder="*********">
        </div>
        <div class="cont-campos">
            <h5> Email:</h5>
            <input class="text-area" type="email" id="email_func" name="funcionario[email_func]" placeholder="example@email.com" value="<?php echo $funcionario->email_func; ?>">
        </div>
        <div class="cont-campos">
            <h5> Admin:</h5>
            <input type="radio" name="funcionario[admin_func]" id="1" value="1"> si
            <input type="radio" name="funcionario[admin_func]" id="0" value="0"> no
        </div>
        <input type="hidden" name="id" value="<?php echo $funcionario->rut_func;?>">

        <!-- BOTON AGREGAR -->
        <div class="cont-boton">
            <input class="boton" type="submit" id="login_funcionario" value="Agregar">
        </div>
    </form>

    <script src="../../js/app.js"></script>
    <script src="../../js/filter.js"></script>

</main>