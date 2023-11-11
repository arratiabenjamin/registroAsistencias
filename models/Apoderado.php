<?php

    namespace Model;

    class Apoderado extends User{
        
        public $rut_apod;
        public $nombres_apod;
        public $apellidos_apod;
        public $password_apod;
        public $tipoInicioSesion;

        protected static $tabla = 'apoderados';
        protected static $columnasDB = ['rut_apod', 'nombres_apod', 'apellidos_apod', 'password_apod'];

        public function __construct($args = [])
        {
            $this->rut_apod = $args['rut_apod'] ?? null;
            $this->nombres_apod = $args['nombres_apod'] ?? null;
            $this->apellidos_apod = $args['apellidos_apod'] ?? null;
            $this->password_apod = $args['password_apod'] ?? null;
            $this->tipoInicioSesion = $args['tipoInicioSesion'] ?? null;
        }

        public function validar(){
            if(!$this->rut_apod){
                self::$errores[] = 'El Rut es Obligatorio.';
            }
            if(!$this->nombres_apod){
                self::$errores[] = 'Los nombres son Obligatorios.';
            }
            if(!$this->apellidos_apod){
                self::$errores[] = 'Los apellidos son Obligatorios.';
            }
            if(!$this->password_apod){
                self::$errores[] = 'El password es Obligatorio.';
            }

            return self::$errores;
        }
    }