<?php

    namespace Controllers;

    use DateTime;
    use MVC\Router;
    use Model\Asistencia;
    use Model\Estudiante;
    use Model\Apoderado;
    use Model\Funcionario;
    use Model\Curso;

    class AsistenciaController{
        public static function index(Router $router){   
            $asistencias = Asistencia::all();

            $router->show( '/admin/asistencias', [
                "asistencias" => $asistencias
            ], '../../css/funcionario' );
        }

        public static function crear(Router $router){

            $asistencia = new Asistencia();
            $errores = Asistencia::getErrores();
            
            
            $asistencias = Asistencia::getLimit(5) ?? null;
            $estudiantes = Estudiante::getLimit(5) ?? null;
            $estudiantesAll = Estudiante::all() ?? null;
            $apoderados = Apoderado::getLimit(5) ?? null;
            $apoderadosAll = Apoderado::all() ?? null;
            $funcionarios = Funcionario::getLimit(5) ?? null;
            $cursos = Curso::all();

            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                date_default_timezone_set('America/Santiago');
                $fecha = new DateTime();
                $_POST['asistencia']['fecha'] = $fecha->format("Y-m-d");
                $_POST['asistencia']['hora'] = $fecha->format("H:i");
                $asistencia = new Asistencia($_POST['asistencia']);
                $errores = $asistencia->validar();
                if(empty($errores)){
                    $asistencia->guardar();
                }
            }

            $router->show( '/admin/index', [
                'asistencia' => $asistencia,
                'errores' => $errores,
                'asistencias' => $asistencias,
                'estudiantes' => $estudiantes,
                'estudiantesAll' => $estudiantesAll,
                'apoderados' => $apoderados,
                'apoderadosAll' => $apoderadosAll,
                'funcionarios' => $funcionarios,
                'cursos' => $cursos
            ], '../../css/funcionario' );

        }

        public static function crearRIFD(){

            $asistencia = new Asistencia();
            $errores = Asistencia::getErrores();
            $valores = [];

            date_default_timezone_set('America/Santiago');
            $fecha = new DateTime();
            $valores['hora'] = $fecha->format("H:i:s");
            $valores['fecha'] = $fecha->format("Y-m-d");
            $valores['rut_func'] = "12345678-9";
            $valores['rut_estu'] = $_POST["rut_estudiante"] ?? $_GET["rut_estudiante"];
            $asistencia = new Asistencia($valores);
            $errores = $asistencia->validar();
            $validacion = self::validarHorarioAsistencia(strtotime($asistencia->hora_asis));
            //var_dump($validacion);
            //var_dump($asistencia);
            //echo "<pre>";
            //var_dump($_GET);
            //echo "</pre>";
            //debugear($validacion);
            if($validacion) $asistencia->guardar();

        }

        public static function actualizar(Router $router){

            $asistencia = Asistencia::findRecordColumnEspecific($_GET['id']) ?? Asistencia::findRecordColumnEspecific($_POST['id']);
            $errores = Asistencia::getErrores();

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $args = $_POST['asistencia'];
                $asistencia->sincronizar($args);
                $errores = $asistencia->validar();

                if (empty($errores)) {
                    $asistencia->guardar($_POST['id']);
                }

            }
            
            $router->show('admin/asistencias/actualizar', [
                'asistencia' => $asistencia,
                'errores' => $errores
            ], '../../css/funcionario');

        }

        public static function eliminar(Router $router){
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $idEntidad = $_POST['id'];
                //Validar ID

                if($idEntidad){
                    $entidad = $_POST['entidad'];
                    if(validarEntidad($entidad)){
                        $entidad = Asistencia::findRecordColumnEspecific($idEntidad);
                        $entidad->eliminar($entidad->id_asis);
                    }
                }
            }
        }

        public static function validarHorarioAsistencia($hora){

            if($hora >= strtotime("08:40") && $hora <= strtotime("10:00")) return true;
            else if($hora >= strtotime("10:25") && $hora <= strtotime("11:45")) return true;
            else if($hora >= strtotime("12:05") && $hora <= strtotime("13:25")) return true;
            else if($hora >= strtotime("14:05") && $hora <= strtotime("15:25")) return true;
            else if($hora >= strtotime("15:45")) return true;
            //else if($hora >= strtotime("15:45") && $hora <= strtotime("16:20")) return true;
            else return false;
            
        }

    }
