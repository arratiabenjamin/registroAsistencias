<?php

    namespace Model;

    class Funcionario extends User{

        public $rut_func;
        public $nombres_func;
        public $apellidos_func;
        public $password_func;
        public $email_func;
        public $admin_func;
        
        protected static $tabla = 'funcionarios';
        protected static $columnasDB = ['rut_func', 'nombres_func', 'apellidos_func', 'password_func', 'email_func', 'admin_func' ];
        
        public function __construct($args = []){
            $this->tipo = $args['tipo'] ?? null;
            $this->rut_func = $args['rut_func'] ?? null;
            $this->nombres_func = $args['nombres_func'] ?? null;
            $this->apellidos_func = $args['apellidos_func'] ?? null;
            $this->password_func = $args['password_func'] ?? null;
            $this->email_func = $args['email_func'] ?? null;
            $this->admin_func = $args['admin_func'] ?? "0";
        }

        public function validar(){
            if(!$this->rut_func){
                self::$errores[] = 'El rut es Obligatorio.';
            }
            if(!$this->nombres_func){
                self::$errores[] = 'Los nombres son Obligatorios.';
            }
            if(!$this->apellidos_func){
                self::$errores[] = 'Los apellidos son Obligatorios.';
            }
            if(!$this->password_func){
                self::$errores[] = 'El password es Obligatorio.';
            }
            if($this->admin_func != "0" && $this->admin_func != "1"){
                self::$errores[] = 'Seleccione el tipo de privilegio.';
            }

            return self::$errores;
        }
    }