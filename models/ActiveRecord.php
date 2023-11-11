<?php

    namespace Model;

use DateTime;

    class ActiveRecord{

        //Statics Vars

        //DB
        protected static $DB;
        protected static $columnasDB = []; //Usado para Satinizar
        protected static $tabla = '';
        //Errores
        protected static $errores = [];

        public static function setDB($db){
            self::$DB = $db;
        }
        public static function getErrores(){
            return static::$errores;
        }

        //CRUD
        public function guardar($id = null){
            //Si no hay id o mejor dicho es Nulo significa que se actualiza
            if(is_null($id)){
                $this->crear();
            } else {
                $this->actualizar($id);
            }
        }
        public function crear(){

            $atributos = $this->sanitizarAtributos();
            $keys = join(', ', array_keys($atributos));
            $values = join("', '", array_values($atributos));
            //debugear($values);

            // Limpia los resultados anteriores, si los hubiera
            while (self::$DB->more_results()) {
                self::$DB->next_result();
                if ($result = self::$DB->store_result()) {
                    $result->free();
                }
            }

            $query = "CALL SP_INSERT(\"" . static::$tabla . "\", \"" . $keys . "\", \"" . $values . "\");";
            // debugear($query);
            $result = self::$DB->multi_query($query);

            if (!$result) {
                die('Error en la consulta: ' . self::$DB->error);
            }

            // Limpia los resultados
            do {
                if ($result = self::$DB->store_result()) {
                    $result->free();
                }
            } while (self::$DB->more_results() && self::$DB->next_result());

            header('Location: /admin');

        }
        public function actualizar($id){
            //Sanitizar
            $atributos = $this->sanitizarAtributos();
            $values = [];

            foreach($atributos as $key => $value){
                $values[] = "$key = '$value'";
            }

             // Limpia los resultados anteriores, si los hubiera
            while (self::$DB->more_results()) {
                self::$DB->next_result();
                if ($result = self::$DB->store_result()) {
                    $result->free();
                }
            }

            $query = "CALL SP_UPDATE(\"" . static::$tabla . "\", \"" . join(' ,', $values) . "\", \"" . static::$columnasDB[0] . "\", \"" . $id . "\");";

            $result = self::$DB->multi_query($query);

            if (!$result) {
                die('Error en la consulta: ' . self::$DB->error);
            }

            // Limpia los resultados
            do {
                if ($result = self::$DB->store_result()) {
                    $result->free();
                }
            } while (self::$DB->more_results() && self::$DB->next_result());

            header('Location: /admin');

        }

        public function eliminar($id){
            $resultado = true;
            if (strpos($id, "-")) {
                if(static::$tabla === 'estudiantes'){
                    $asistencias = Asistencia::findRecordColumnEspecific($this->rut_estu, 'rut_estu');
                    foreach($asistencias as $asistencia){
                        $asistencia->eliminar($asistencia->id_asis);
                    }
                } else if(static::$tabla === 'apoderados'){
                    $estudiantes = Estudiante::findRecordColumnEspecific($this->rut_apod, 'rut_apod');
                    foreach($estudiantes as $estudiante){
                        $asistencias = Asistencia::findRecordColumnEspecific($estudiante->rut_estu, 'rut_estu');
                        foreach($asistencias as $asistencia){
                            $asistencia->eliminar($asistencia->id_asis);
                        }
                        $estudiante->eliminar($estudiante->rut_estu);
                    }
                }
                //$query = "DELETE FROM " . static::$tabla . " WHERE " . static::$columnasDB[0] .  " = '" . self::$DB->escape_string($id) . "' LIMIT 1";
            } else {
                //$query = "DELETE FROM " . static::$tabla . " WHERE " . static::$columnasDB[0] .  " = " . self::$DB->escape_string($id) . " LIMIT 1";
            }

            // Limpia los resultados anteriores, si los hubiera
            while (self::$DB->more_results()) {
                self::$DB->next_result();
                if ($result = self::$DB->store_result()) {
                    $result->free();
                }
            }

            $query = "CALL SP_DELETE( \"" . static::$tabla . "\", \"" . static::$columnasDB[0] . "\", \"" . self::$DB->escape_string($id) . "\");";

            //debugear($query);

            if($this->admin_func != '1'){
                $result = self::$DB->multi_query($query);

                if (!$result) {
                    die('Error en la consulta: ' . self::$DB->error);
                }

                // Limpia los resultados
                do {
                    if ($result = self::$DB->store_result()) {
                        $result->free();
                    }
                } while (self::$DB->more_results() && self::$DB->next_result());

            }

            header('Location: /admin');

        }

        //Obtener Atributos
        public function atributos(){
            $atributos = [];
            foreach( static::$columnasDB as $columna ){
                if($columna === 'id_asis' or $columna === 'id_curso')continue;
                $atributos[$columna] = $this->$columna;
            }
            return $atributos;
        }
        //Sanitizar Datos
        public function sanitizarAtributos(){
            $atributos = $this->atributos();
            $sanitizado = [];
            foreach($atributos as $key => $value){
                $sanitizado[$key] = self::$DB->escape_string($value);
            }
            return $sanitizado;
        }

        //Recolectar Todos los Registros
        public static function all(){
            $query = "CALL SP_SELECT_ALL('" . static::$tabla . "');";
            $tabla = self::consultarSQL($query);
            return $tabla;
        }
        //Recolectar Cantidad Especifica de Registros
        public static function getLimit($limit){
            $query = "CALL SP_SELECT_LIMIT('" . static::$tabla . "', " . $limit . ");";
            // debugear($query);
            $tabla = self::consultarSQL($query);
            return $tabla;
        }

        //Buscar un Registro Especifico
        // public static function findRecord($id){
        //     $query = "SELECT * FROM " . static::$tabla . " WHERE " . static::$columnasDB[0] . " = '" . $id . "';";
        //     $tabla = self::consultarSQL($query);
        //     return array_shift($tabla);
        // }

        public static function findRecordColumnEspecific($value, $column = null){
            if(!$column){
                $column = static::$columnasDB[0];
            }
            // $query = "SELECT * FROM " . static::$tabla . " WHERE " . $column . " = '" . $value . "';";
            $query = "CALL SP_SELECT_COLUMN_ESPECIFIC( \"" . static::$tabla . "\", \"" . $column . "\", \"" . $value . "\");";
            // debugear($query);
            $tabla = self::consultarSQL($query);
            // debugear($tabla);
            // debugear($column);
            if($column != "rut_apod" && !$tabla[1]->id_asis ){
                return $tabla[0];
            }
            return $tabla;
        }

        public static function consultarSQL($query) {

            if (self::$DB->more_results()) {
                self::$DB->next_result();
                while (self::$DB->more_results() && self::$DB->next_result()) {
                    self::$DB->store_result();
                }
            }
            try{
                $tablas = self::$DB->query($query);
                $array = [];
                foreach($tablas as $tabla) {
                    $array[] = static::crearObjeto($tabla);
                }

                $tablas->free();

            }catch (\Throwable $th) {
                // Manejar la excepcion de acuerdo a tus necesidades
                //debugear($query);
                debugear($th);
            }

            return $array;
        }
        /*
        public static function consultarSQL($query) {
            try {
                //debugear("entrada al try");
                // Cerrar cualquier conjunto de resultados anterior
                if (self::$DB->more_results()) {
                    self::$DB->next_result();
                    while (self::$DB->more_results() && self::$DB->next_result()) {
                        self::$DB->store_result();
                    }
                }

                // Utilizar consulta preparada
                //debugear($query);
                $stmt = self::$DB->prepare($query);
                if ($stmt === false) {
                    throw new \Exception("Error preparing query: " . self::$DB->error);
                }

                //debugear("antes de ejecucion");
                // Ejecutar la consulta
                debugear($stmt->execute());
                if (!$stmt->execute()) {
                    debugear($query);
                    throw new \Exception("Error executing query: " . $stmt->error);
                }

                $array = [];
                $result = $stmt->get_result();
                // debugear($result);

                if ($result) {
                    while ($tabla = $result->fetch_assoc()) {
                        $array[] = static::crearObjeto($tabla);
                    }
                    $result->free();
                }
                // debugear($array);

                return $array;
            } catch (\Throwable $th) {
                // Manejar la excepción de acuerdo a tus necesidades
                debugear($query);
                debugear($th);
            }
        }
        */

        //Crear Objetos
        protected static function crearObjeto($tabla) {
            $obj = new static;

            foreach($tabla as $key => $value){
                if(property_exists($obj, $key)){
                    $obj->$key = $value;
                }
            }
            return $obj;

        }

        public function sincronizar($args = []) {
            //debugear($args);
            foreach($args as $key => $value){
                //debugear("pasa a foreach");
                //Si las propiedades Existen y valor no es nulo - El atributo tendra como valor "$value".
                if(property_exists($this, $key) && !is_null($value)) {
                    $this->$key = $value;
                }
            }
        }
    }