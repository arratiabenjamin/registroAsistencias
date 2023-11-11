<?php

namespace Model;

class Asistencia extends ActiveRecord
{

    public $id_asis;
    public $asistencia_asis;
    public $atraso_asis;
    public $fecha_asis;
    public $hora_asis;
    public $justificante_asis;
    public $rut_estu;
    public $rut_func;

    protected static $tabla = 'asistencias';
    protected static $columnasDB = ['id_asis', 'asistencia_asis', 'atraso_asis', 'fecha_asis', 'hora_asis', 'justificante_asis', 'rut_estu', 'rut_func'];

    public function __construct($args = [])
    {
        $this->id_asis = $args['id'] ?? null;
        $this->asistencia_asis = $args['asistencia'] ?? null;
        $this->atraso_asis = $args['atraso'] ?? null;
        $this->fecha_asis = $args['fecha'] ?? null;
        $this->hora_asis = $args['hora'] ?? null;
        $this->justificante_asis = $args['justificante'] ?? null;
        $this->rut_estu = $args['rut_estu'] ?? null;
        $this->rut_func = $args['rut_func'] ?? null;
    }

    public function validar()
    {
        if (!$this->rut_estu) {
            self::$errores[] = 'El rut del alumno es Obligatorio.';
        }
        if (!Estudiante::findRecordColumnEspecific($this->rut_estu)) {
            self::$errores[] = 'Rut Inexistente.';
        }

        return self::$errores;
    }
}
