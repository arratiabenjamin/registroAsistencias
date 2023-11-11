<main id="main">

    <?php if ($errores) : ?>

        <div id="errores" style="display: grid; grid-template-columns: auto auto;">
            <?php foreach ($errores as $error) : ?>
                <p class="error" style="background-color: red; border-radius: .5rem; padding: 1rem; color: white; margin-left: .5rem;   "><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <table class="table">
        <h2 class="tab-title">Asistencias</h2>

        <!-- Nueva Tabla -->
        <tbody>
            <tr class="header row">
                <th class="cell pl">N° </th>
                <th class="cell">Fecha</th>
                <th class="cell h">Hora</th>
                <th class="cell">Rut Estudiante</th>
                <th class="cell">Nombre Estudiante</th>
                <th class="cell">Curso</th>
                <th class="cell">Comentario</th>
                <th class="cell act">Acciones </th>
            </tr>
            <?php foreach ($asistencias as $asistencia) : ?>
                <tr class="row">
                    <!-- Info Varia -->
                    <td class="cell pl"><?php echo $asistencia->id_asis ?></td>
                    <td class="cell"><?php echo $asistencia->fecha_asis ?></td>
                    <td class="cell h"><?php echo $asistencia->hora_asis ?></td>
                    <td class="cell"><?php echo $asistencia->rut_estu ?></td>

                    <!-- Nombre y Curso Estudiante -->
                    <?php foreach ($estudiantesAll as $estudiante) : ?>
                        <?php if ($estudiante->rut_estu == $asistencia->rut_estu) : ?>
                            <td class="cell"><?php echo $estudiante->nombres_estu . "<br>" . $estudiante->apellidos_estu ?></td>
                            <td class="cell"><?php echo $estudiante->id_curso ?></td>
                        <?php endif; ?>
                    <?php endforeach; ?>

                    <!-- Comentario -->
                    <td class="cell"><?php echo $asistencia->comentario_asis == "" ? "N/A" : $asistencia->comentario_asis ?></td>

                    <!-- Acciones -->
                    <td class="action cell">

                        <a href="/admin/asistencia/actualizar?id=<?php echo $asistencia->id_asis; ?>">
                            <input class="btn-action actualizar" type="button" value="Editar" />
                        </a>

                        <form method="POST" action="admin/asistencia/eliminar">
                            <input class="btn-action eliminar" type="submit" value="Borrar" />
                            <input type="hidden" name="id" value="<?php echo $asistencia->id_asis; ?>" />
                            <input type="hidden" name="entidad" value="asistencia" />
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>


        <!-- Antigua Tabla -->
        <!--
        <tbody>
            <tr class="header row">
                <th class="cell pl">ID </th>
                <th class="cell">Fecha</th>
                <th class="cell h">Hora</th>
                <th class="cell">Rut Estudiante</th>
                <th class="cell">Rut Funcionario</th>
                <th class="cell act">Acciones </th>
            </tr>
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

                        <form method="POST" action="admin/asistencia/eliminar">
                            <input class="btn-action eliminar" type="submit" value="Borrar" />
                            <input type="hidden" name="id" value="<?php echo $asistencia->id_asis; ?>" />
                            <input type="hidden" name="entidad" value="asistencia" />
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        -->
    </table>
    <a href="/admin/asistencias" class="viewAll">Ver todos</a>


    <?php if ($_SESSION['admin'] == '1') : ?>

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

                            <form method="POST" action="admin/estudiante/eliminar">
                                <input class="btn-action eliminar" type="submit" value="Borrar" />
                                <input type="hidden" name="id" value="<?php echo $estudiante->rut_estu; ?>" />
                                <input type="hidden" name="entidad" value="estudiante" />
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="/admin/estudiantes" class="viewAll">Ver todos</a>

        <table class="table">
            <h2 class="tab-title">Cursos</h2>
            <tbody>
                <tr class="header row">
                    <th class="cell pl">N°</th>
                    <th class="cell">Grado y Letra</th>
                    <th class="cell">N° Sala</th>
                    <th class="cell act">Acciones</th>
                </tr>
                <?php foreach ($cursos as $curso) : ?>
                    <tr class="row">
                        <td class="cell pl"><?php echo $curso->id_curso ?></td>
                        <td class="cell"><?php echo $curso->grado_curso . $curso->letra_curso ?></td>
                        <td class="cell"><?php echo $curso->numero_sala ?></td>
                        <td class="action cell">

                            <a href="/admin/curso/actualizar?id=<?php echo $curso->id_curso; ?>">
                                <input class="btn-action actualizar" type="button" value="Editar" />
                            </a>

                            <form method="POST" action="admin/curso/eliminar">
                                <input class="btn-action eliminar" type="submit" value="Borrar" />
                                <input type="hidden" name="id" value="<?php echo $curso->id_curso; ?>" />
                                <input type="hidden" name="entidad" value="asistencia" />
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="/admin/cursos" class="viewAll">Ver todos</a>

        <table class="table">
            <h2 class="tab-title">Apoderados</h2>
            <tbody>
                <tr class="header row">
                    <th class="cell pl">Rut</th>
                    <th class="cell">Nombres</th>
                    <th class="cell">Apellidos</th>
                    <th class="cell act">Acciones</th>
                </tr>
                <?php foreach ($apoderados as $apoderado) : ?>
                    <tr class="row">
                        <td class="cell pl"><?php echo $apoderado->rut_apod ?></td>
                        <td class="cell"><?php echo $apoderado->nombres_apod ?></td>
                        <td class="cell h"><?php echo $apoderado->apellidos_apod ?></td>
                        <td class="action cell">

                            <a href="/admin/apoderado/actualizar?id=<?php echo $apoderado->rut_apod; ?>">
                                <input class="btn-action actualizar" type="button" value="Editar" />
                            </a>

                            <form method="POST" action="admin/apoderado/eliminar">
                                <input class="btn-action eliminar" type="submit" value="Borrar" />
                                <input type="hidden" name="id" value="<?php echo $apoderado->rut_apod; ?>" />
                                <input type="hidden" name="entidad" value="asistencia" />
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="/admin/apoderados" class="viewAll">Ver todos</a>

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

                            <form method="POST" action="admin/funcionario/eliminar">
                                <input class="btn-action eliminar" type="submit" value="Borrar" />
                                <input type="hidden" name="id" value="<?php echo $funcionario->rut_func; ?>" />
                                <input type="hidden" name="entidad" value="asistencia" />
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="/admin/funcionarios" class="viewAll">Ver todos</a>

    <?php endif; ?>

    <script src="../../js/app.js"></script>

</main>