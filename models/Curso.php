<?php

namespace Model;

class Curso extends ActiveRecord
{

    public $id_curso;
    public $grado_curso;
    public $letra_curso;
    public $numero_sala;

    protected static $tabla = 'cursos';
    protected static $columnasDB = ['id_curso', 'grado_curso', 'letra_curso', 'numero_sala'];

    public function __construct($args = [])
    {
        $this->id_curso = $args['id_curso'] ?? null;
        $this->grado_curso = $args['grado_curso'] ?? null;
        $this->letra_curso = $args['letra_curso'] ?? null;
        $this->numero_sala = $args['numero_sala'] ?? null;
    }

    public function validar(){
        if(!$this->grado_curso){
            self::$errores[] = 'El Grado del Curso es Obligatorio.';
        }
        if(!$this->letra_curso){
            self::$errores[] = 'La Letra del Curso es Obligatoria.';
        }
        if(!$this->numero_sala){
            self::$errores[] = 'El Numero de Sala es Obligatorio.';
        }

        return self::$errores;
    }
    
}
