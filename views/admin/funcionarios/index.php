<main id="main">
<table class="table">
            <h2 class="tab-title">Funcionarios</h2>
        <tbody>
          <tr class="header row">
                    <th class="cell pl">Rut</th>
                    <th class="cell">Nombres</th>
                    <th class="cell">Apellidos</th>
                    <th class="cell">Email</th>
                    <th class="cell act">Acciones</th>
                </tr>
        <tbody id="funcionarios">
                <?php foreach ($funcionarios as $funcionario) : ?>
                    <tr class="row">
                        <td class="cell pl"><?php echo $funcionario->rut_func ?></td>
                        <td class="cell"><?php echo $funcionario->nombres_func ?></td>
                        <td class="cell h"><?php echo $funcionario->apellidos_func ?></td>
                        <td class="cell"><?php echo $funcionario->email_func ?></td>
                        <td class="action cell">

                            <a href="/admin/funcionario/actualizar?id=<?php echo $funcionario->rut_func; ?>">
                                <input class="btn-action actualizar" type="button" value="Editar" />
                            </a>

                            <form method="POST" action="<?php echo $_SERVER['PATH_INFO'] == '/admin' ? 'admin/funcionario/eliminar' : 'funcionario/eliminar' ?>">
                                <input class="btn-action eliminar" type="submit" value="Borrar" />
                                <input type="hidden" name="id" value="<?php echo $funcionario->rut_func; ?>" />
                                <input type="hidden" name="entidad" value="asistencia" />
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
        </tbody>
        </tbody>
        </table>
    <script src="../js/filtroFuncionario.js"></script>
    <script src="../js/filter.js"></script>
</main>