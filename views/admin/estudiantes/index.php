<main id="main">
<table class="table">
    <h2 class="tab-title">Estudiantes</h2>
    <tbody>
        <tr class="header row">
            <th class="cell pl">Rut</th>
            <th class="cell">Nombres</th>
            <th class="cell">Apellidos</th>
            <th class="cell">Curso</th>
            <th class="cell">Rut Apoderado</th>
            <th class="cell act">Acciones</th>
        </tr>
    <tbody id="estudiantes">
        <?php foreach ($estudiantes as $estudiante) : ?>
            <tr class="row">
                <td class="cell pl"><?php echo $estudiante->rut_estu ?></td>
                <td class="cell"><?php echo $estudiante->nombres_estu ?></td>
                <td class="cell h"><?php echo $estudiante->apellidos_estu ?></td>
                <td class="cell"><?php echo $estudiante->id_curso ?></td>
                <td class="cell"><?php echo $estudiante->rut_apod ?></td>
                <td class="action cell">

                    <a href="/admin/estudiante/actualizar?id=<?php echo $estudiante->rut_estu; ?>">
                        <input class="btn-action actualizar" type="button" value="Editar" />
                    </a>

                    <form method="POST" action="<?php echo $_SERVER['PATH_INFO'] == '/admin' ? 'admin/estudiante/eliminar' : 'estudiante/eliminar' ?>">
                        <input class="btn-action eliminar" type="submit" value="Borrar" />
                        <input type="hidden" name="id" value="<?php echo $estudiante->rut_estu; ?>" />
                        <input type="hidden" name="entidad" value="estudiante" />
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    </tbody>
</table>
    <script src="../js/filtroEstudiante.js"></script>
    <script src="../js/filter.js"></script>
</main>