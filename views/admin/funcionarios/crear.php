<main>
    <div class="formulario">
        <h1>Ingreso Funcionario</h1>
        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>
        <form action="/admin/funcionario/crear" method="POST">
            <div class="ingresorut">
                <input type="text" id="rut" name="funcionario[rut_func]" value="<?php echo $funcionario->rut_func; ?>">
                <label for="rut">Rut del Funcionario </label>
            </div>
            <div class="ingresorut">
                <input type="text" id="rut" name="funcionario[nombre_func]" value="<?php echo $funcionario->nombre_func; ?>">
                <label for="rut">Nombre del Funcionario</label>
            </div>
            <div class="ingresorut">
                <input type="text" id="rut" name="funcionario[apellido_func]" value="<?php echo $funcionario->apellido_func; ?>">
                <label for="rut">Apellido de Funcionario</label>
            </div>
            <div class="ingresorut">
                <input type="text" id="rut" name="funcionario[password_func]" require>
                <label for="rut">Password de Funcionario</label>
            </div>
            <div class="ingresorut">
                <input type="text" id="rut" name="funcionario[email_func]" value="<?php echo $funcionario->email_func; ?>">
                <label for="rut">Email de Funcionario</label>
            </div>
            <div class="ingresorut">
                <input type="text" id="rut" name="funcionario[admin_func]" placeholder="0 - 1 (0 = no / 1 = si)" require>
                <label for="rut">Admin de Funcionario</label>
            </div>

            <div class="enviar">
                <input type="submit" value="Enviar">
            </div>
        </form>
    </div>
</main>
