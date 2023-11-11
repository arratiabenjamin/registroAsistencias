<main id="main">
    <table class="table">
        <h2 class="tab-title">Asistencias</h2>
        
        <!-- Nueva Tabla -->
        <tbody>
            <tr class="header row">
                <th class="cell pl">ID </th>
                <th class="cell">Fecha</th>
                <th class="cell h">Hora</th>
                <th class="cell">Rut Estudiante</th>
                <th class="cell">Nombre Estudiante</th>
                <th class="cell">Curso</th>
                <th class="cell">Comentario</th>
                <th class="cell act">Acciones </th>
            </tr>
        <tbody id="asistencias">
            <?php foreach ($asistencias as $asistencia) : ?>
                <tr class="row">
                    <!-- Info Varia -->
                    <td class="cell pl"><?php echo $asistencia->id_asis ?></td>
                    <td class="cell"><?php echo $asistencia->fecha_asis ?></td>
                    <td class="cell h"><?php echo $asistencia->hora_asis ?></td>
                    <td class="cell"><?php echo $asistencia->rut_estu ?></td>
                    
                    <!-- Nombre y Curso Estudiante -->
                    <?php foreach ($estudiantes as $estudiante) : ?>
                        <?php if($estudiante->rut_estu == $asistencia->rut_estu): ?>
                            <td class="cell"><?php echo $estudiante->nombres_estu . "<br>" . $estudiante->apellidos_estu ?></td>
                            <td class="cell"><?php echo $estudiante->id_curso ?></td>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    
                    <!-- Comentario -->
                    <td class="cell"><?php echo $asistencia->justificante_asis ? $asistencia->justificante_asis : "N/A" ?></td>
                    
                    <!-- Acciones -->
                    <td class="action cell">

                        <a href="/admin/asistencia/actualizar?id=<?php echo $asistencia->id_asis; ?>">
                            <input class="btn-action actualizar" type="button" value="Editar" />
                        </a>

                        <form method="POST" action="<?php echo $_SERVER['PATH_INFO'] == '/admin' ? 'admin/asistencia/eliminar' : 'asistencia/eliminar' ?>">
                            <input class="btn-action eliminar" type="submit" value="Borrar" />
                            <input type="hidden" name="id" value="<?php echo $asistencia->id_asis; ?>" />
                            <input type="hidden" name="entidad" value="asistencia" />
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        </tbody>
    </table>
    
    <!--Antigua-->
    <!--
    <table class="table" id="tabla_asiss">
        <h2 class="tab-title">Asistencias</h2>
        <tbody>
            <tr class="header row" id="columnas">
                <th class="cell pl">ID </th>
                <th class="cell">Fecha</th>
                <th class="cell h">Hora</th>
                <th class="cell">Rut Estudiante</th>
                <th class="cell">Rut Funcionario</th>
                <th class="cell act">Acciones </th>
            </tr>
        <tbody id="asistencias">

            <?php foreach ($asistencias as $asistencia) : ?>
                <tr class="row">
                    <td class="cell pl"><?php echo $asistencia->id_asis ?></td>
                    <td class="cell"><?php echo $asistencia->fecha_asis ?></td>
                    <td class="cell h"><?php echo $asistencia->hora_asis ?></td>
                    <td class="cell"><?php echo $asistencia->rut_estu ?></td>
                    <td class="cell"><?php echo $asistencia->rut_func ?></td>
                    <td class="action cell">

                        <a href="/admin/asistencia/actualizar?id=<?php echo $asistencia->id_asis; ?>">
                            <input class="btn-action actualizar" type="button" value="Editar" />
                        </a>

                        <form method="POST" action="asistencia/eliminar">
                            <input class="btn-action eliminar" type="submit" value="Borrar" />
                            <input type="hidden" name="id" value="<?php echo $asistencia->id_asis; ?>" />
                            <input type="hidden" name="entidad" value="asistencia" />
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>

        </tbody>
        </tbody>
    </table>
    -->
    
    <script src="../js/filtrosAsistencia.js"></script>
    <script src="../js/filter.js"></script>
</main>