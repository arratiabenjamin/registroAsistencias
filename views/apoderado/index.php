<main id="main">
    <?php foreach ($estudiantes as $estudiante) : ?>
        <h2><?php echo $estudiante->nombres_estu . " " . $estudiante->apellidos_estu . " / " . $estudiante->rut_estu ?></h2>
        <table class="table">
            <tbody>
                <tr class="header row">
                    <th class="cell pl">N° </th>
                    <th class="cell pl">Asistencia</th>
                    <th class="cell pl">Atraso</th>
                    <th class="cell">Fecha</th>
                    <th class="cell h">Hora</th>
                    <th class="cell h">Justificante</th>
                </tr>
                <?php $i = 0; ?>
                <?php foreach ($asistencias as $asistencia) : ?>
                    <?php if ($asistencia->rut_estu === $estudiante->rut_estu) : ?>
                        <?php $i += 1; ?>
                        <tr class="row">
                            <td class="cell pl"><?php echo $i ?></td>
                            <td class="cell pl"><?php echo $asistencia->asistencia_asis == "1" ? "Si" : "No" ?></td>
                            <td class="cell pl"><?php echo $asistencia->atraso_asis == "1" ? "Si" : "No" ?></td>
                            <td class="cell"><?php echo $asistencia->fecha_asis ?></td>
                            <td class="cell h"><?php echo $asistencia->hora_asis ?></td>
                            <td class="cell"><?php echo $asistencia->justificante_asis == "" ? "N/A" : $asistencia->justificante?></td>
                        </tr>
                    <?php endif; ?>
                    <?php if(is_array($asistencia)): ?>
                        <?php $i = count($asistencia); ?>
                        <?php foreach ($asistencia as $a) : ?>
                            <?php if ($a->rut_estu === $estudiante->rut_estu) : ?>
                                <tr class="row">
                                    <td class="cell pl"><?php echo $i ?></td>
                                    <td class="cell pl"><?php echo $a->asistencia_asis == "1" ? "Si" : "No" ?></td>
                                    <td class="cell pl"><?php echo $a->atraso_asis == "1" ? "Si" : "No" ?></td>
                                    <td class="cell"><?php echo $a->fecha_asis ?></td>
                                    <td class="cell h"><?php echo $a->hora_asis ?></td>
                                    <td class="cell h"><?php echo $a->justificante_asis == "" ? "N/A" : $a->justificante_asis ?></td>
                                </tr>
                            <?php $i -= 1; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endforeach; ?>
        <div class="cont__printBtn">
            <button id="printBtn"><span>Generar informe</span><i class="fa-solid fa-file-pdf"></i></button>
        </div>
</main>

<script src="../js/imprimirPdf.js"></script>
<script src="../js/app.js"></script>