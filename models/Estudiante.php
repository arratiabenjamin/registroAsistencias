<?php

    namespace Model;

    class Estudiante extends ActiveRecord{
        
        public $rut_estu;
        public $nombres_estu;
        public $apellidos_estu;
        public $id_curso;
        public $rut_apod;

        protected static $tabla = 'estudiantes';
        protected static $columnasDB = ['rut_estu', 'nombres_estu', 'apellidos_estu', 'id_curso', 'rut_apod'];

        public function __construct($args = []){
            $this->rut_estu = $args['rut_estu'] ?? null;
            $this->rut_apod = $args['rut_apod'] ?? null;
            $this->nombres_estu = $args['nombres_estu'] ?? null;
            $this->apellidos_estu = $args['apellidos_estu'] ?? null;
            $this->id_curso = $args['id_curso'] ?? null; 
        }

        public function validar(){
            if(!$this->rut_estu){
                self::$errores[] = 'El rut del estudiante es Obligatorio.';
            }
            if(!$this->rut_apod){
                self::$errores[] = 'El rut del apoderado es Obligatorio.';
            }
            if(!$this->nombres_estu){
                self::$errores[] = 'Los nombres son Obligatorios.';
            }
            if(!$this->apellidos_estu){
                self::$errores[] = 'Los apellidos son Obligatorios.';
            }
            if(!$this->id_curso){
                self::$errores[] = 'El curso es Obligatorio.';
            }
            if(!Apoderado::findRecordColumnEspecific($this->rut_apod)){
                self::$errores[] = 'Rut Inexistente.';
            }

            return self::$errores;
        }
    }
