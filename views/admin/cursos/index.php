<main id="main">
<table class="table">
    <h2 class="tab-title">Cursos</h2>
    <tbody>
        <tr class="header row">
            <th class="cell pl">ID</th>
            <th class="cell">Grado y Letra</th>
            <th class="cell">No Sala</th>
            <th class="cell act">Acciones </th>
        </tr>
    <tbody id="cursos">
        <?php foreach ($cursos as $curso) : ?>
            <tr class="row">
                <td class="cell pl"><?php echo $curso->id_curso ?></td>
                <td class="cell"><?php echo $curso->grado_curso . $curso->letra_curso ?></td>
                <td class="cell"><?php echo $curso->numero_sala ?></td>
                <td class="action cell">

                    <a href="/admin/curso/actualizar?id=<?php echo $curso->rut_estu; ?>">
                        <input class="btn-action actualizar" type="button" value="Editar" />
                    </a>

                    <form method="POST" action="<?php echo $_SERVER['PATH_INFO'] == '/admin' ? 'admin/curso/eliminar' : 'curso/eliminar' ?>">
                        <input class="btn-action eliminar" type="submit" value="Borrar" />
                        <input type="hidden" name="id" value="<?php echo $curso->rut_estu; ?>" />
                        <input type="hidden" name="entidad" value="curso" />
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    </tbody>
</table>
    <script src="../js/filtroCurso.js"></script>
    <script src="../js/filter.js"></script>
</main>