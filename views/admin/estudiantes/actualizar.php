<main id="main">
    <form class="form" action="/admin/estudiante/actualizar" method="POST">
        <legend class="tittle"> Actualizar Estudiante</legend>
        <!-- CAMPOS -->
        <div class="cont-campos">
            <h5> Rut:</h5>
            <input class="text-area" type="text" id="rut_estu" name="estudiante[rut_estu]" 
            value="<?php echo $estudiante->rut_estu?>"
            placeholder="12345678-9">
        </div>
        <div class="cont-campos">
            <h5> Rut Apoderado:</h5>
            <input class="text-area" type="text" id="rut_apod" name="estudiante[rut_apod]" placeholder="12345678-9" value="<?php echo $estudiante->rut_apod?>">
        </div>
        <div class="cont-campos">
            <h5> Nombre:</h5>
            <input class="text-area" type="text" id="nombre_estu" name="estudiante[nombres_estu]" placeholder="Nombres" value="<?php echo $estudiante->nombres_estu?>">
        </div>
        <div class="cont-campos">
            <h5> Apellido:</h5>
            <input class="text-area" type="text" id="apellido_estu" name="estudiante[apellidos_estu]" placeholder="Apellidos" value="<?php echo $estudiante->apellidos_estu?>">
        </div>
        
        <div class="cont-campos">
            <h5> Curso:</h5>
            <input type="text" class="text-area"
                    id="curso_estudiante" list="opciones"
                    placeholder="Seleccione un Curso"
                    autocomplete="off"
                    value="<?php foreach($cursos as $curso):?><?php if($estudiante->id_curso == $curso->id_curso):?><?php echo $curso->id_curso . ") " . $curso->grado_curso . $curso->letra_curso; ?><?php endif; ?><?php endforeach;?>"
                    name="estudiante[id_curso]"> 
                <!--List hace referencia al datalist-->
                <datalist id="opciones">
                    <?php foreach($cursos as $curso):?>
                        <option value="<?php echo $curso->id_curso . ") " . $curso->grado_curso . $curso->letra_curso; ?>">
                    <?php endforeach;?>
                </datalist>
        </div>
        
        <input type="hidden" name="id" value="<?php echo $estudiante->rut_estu?>">

        <!-- BOTON AGREGAR -->
        <div class="cont-boton">
            <input class="boton" type="submit" id="login_estudiante" value="Agregar">
        </div>
    </form>

    <script src="../../js/app.js"></script>
    <script src="../../js/filter.js"></script>
    
</main>
