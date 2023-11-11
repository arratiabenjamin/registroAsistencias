<?php

    namespace Model;

    class User extends ActiveRecord{

        public $id;
        public $tipo;
        public $rut;
        public $password;
        public $tipoInicioSesion;
        
        public function __construct($args = [])
        {
            $this->id = $args['id'] ?? null;
            $this->tipo = $args['tipo'] ?? null;
            $this->rut = $args['rut'] ?? null;
            $this->password = $args['password'] ?? null;
            $this->tipoInicioSesion = $args['tipoInicioSesion'] ?? null;
        }

        public function validar(){
            if(!$this->tipo){
                static::$errores[] = 'El tipo de usuario es Obligatorio';
            }
            if(!$this->rut){
                static::$errores[] = 'El rut es Obligatorio';
            }
            if(!$this->password){
                static::$errores[] = 'El password es Obligatorio';
            }

            return static::$errores;
        }
        public function existeUsuario($rut){
            $query = "SELECT * FROM " . static::$tabla . " WHERE " . static::$columnasDB[0] . " = '" . $rut . "' LIMIT 1";
            $resultado = static::$DB->query($query);

            if(!$resultado->num_rows){
                static::$errores[] = 'Usuario inexistente';
                return;
            }

            return $resultado;

        }
        public function comprobarPassword($resultado){
            $user = $resultado->fetch_object();


            if($user->password_func){
                $auth = password_verify($this->password, $user->password_func);
                if(!$auth){
                    $auth = password_verify($this->password_func, $user->password_func);
                }
            }else{
                $auth = password_verify($this->password, $user->password_apod);
                if(!$auth){
                    $auth = password_verify($this->password_apod, $user->password_apod);
                }
            }
            
            if(!$auth){
                static::$errores[] = 'Password incorrecto';
            }

            return $auth;
        }
        public function autenticar(){
            session_start();
            //debugear($this);
            $_SESSION['usuario'] = $this->rut_func ?? $this->rut_apod;
            $_SESSION['tipo'] = $this->tipo;
            $_SESSION['tipoInicioSesion'] = $this->tipoInicioSesion;
            $_SESSION['login'] = true;
            
            // debugear($_SESSION);

            if($_SESSION['tipo'] === 'funcionario'){
                $user = $this::findRecordColumnEspecific($this->rut_func);
                $_SESSION['nombresApellidosUser'] = $user->nombres_func . " " . $user->apellidos_func;
                header('Location: /admin');
            }else if($_SESSION['tipo'] === 'App'){
                echo "Todo va Funcionando";
                exit;
            }else{
                if($this->tipoInicioSesion){
                    header('Location: /');
                }else{
                    $user = $this::findRecordColumnEspecific($this->rut_apod)[0];
                    $_SESSION['nombresApellidosUser'] = $user->nombres_apod . " " . $user->apellidos_apod;
                    header('Location: /apoderado');
                }    
            }
        }

    }