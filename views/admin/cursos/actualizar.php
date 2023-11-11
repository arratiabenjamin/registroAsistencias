<main id="main">
    <form class="form" action="/admin/curso/actualizar" method="POST">
        <legend class="tittle"> Actualizar Curso</legend>
        <!-- CAMPOS -->
        
        <div class="cont-campos">
            <h5>Grado:</h5>
            <input class="text-area" type="text" id="grado_curso" name="curso[grado_curso]" placeholder="Grado - Ej: 3" value="<?php echo $curso->grado_curso;?>">
        </div>
        <div class="cont-campos">
            <h5>Letra:</h5>
            <input class="text-area" type="text" id="letra_curso" name="curso[letra_curso]" placeholder="Letra - Ej: F" value="<?php echo $curso->letra_curso;?>">
        </div>
        <div class="cont-campos">
            <h5>N° de Sala:</h5>
            <input class="text-area" type="text" id="numero_sala" name="curso[numero_sala]" placeholder="Numero - Ej: 14" value="<?php echo $curso->numero_sala;?>">
        </div>
        
        <input type="hidden" name="id" value="<?php echo $curso->id_curso;?>">

        <!-- BOTON AGREGAR -->
        <div class="cont-boton">
            <input class="boton" type="submit" id="login_estudiante" value="Agregar">
        </div>
    </form>

    <script src="../../js/app.js"></script>
    <script src="../../js/filter.js"></script>
    
</main>
