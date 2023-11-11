<main id="main">
<table class="table">
            <h2 class="tab-title">Apoderados</h2>
        <tbody>
          <tr class="header row">
                    <th class="cell pl">Rut</th>
                    <th class="cell">Nombres</th>
                    <th class="cell">Apellidos</th>
                    <th class="cell act">Acciones</th>
                </tr>
        <tbody id="apoderados">
                <?php foreach ($apoderados as $apoderado) : ?>
                    <tr class="row">
                        <td class="cell pl"><?php echo $apoderado->rut_apod ?></td>
                        <td class="cell"><?php echo $apoderado->nombres_apod ?></td>
                        <td class="cell h"><?php echo $apoderado->apellidos_apod ?></td>
                        <td class="action cell">

                            <a href="/admin/apoderado/actualizar?id=<?php echo $apoderado->rut_apod; ?>">
                                <input class="btn-action actualizar" type="button" value="Editar" />
                            </a>

                            <form method="POST" action="<?php echo $_SERVER['PATH_INFO'] == '/admin' ? 'admin/apoderado/eliminar' : 'apoderado/eliminar' ?>">
                                <input class="btn-action eliminar" type="submit" value="Borrar" />
                                <input type="hidden" name="id" value="<?php echo $apoderado->rut_apod; ?>" />
                                <input type="hidden" name="entidad" value="asistencia" />
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
        </tbody>
        </tbody>
        </table>
    <script src="../js/filtroApoderado.js"></script>
    <script src="../js/filter.js"></script>
</main>