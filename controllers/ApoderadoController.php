<?php

    namespace Controllers;
    use MVC\Router;
    use Model\Asistencia;
    use Model\Estudiante;
    use Model\Apoderado;
    use Model\Funcionario;
    use Model\Curso;

    class ApoderadoController{
        public static function index(Router $router){
            $estudiantes = Estudiante::findRecordColumnEspecific($_SESSION['usuario'], 'rut_apod');
            // debugear($estudiantes);
            $asistencias = [];

            foreach($estudiantes as $estudiante){
                // debugear($estudiante);
                $asistencias[] = Asistencia::findRecordColumnEspecific($estudiante->rut_estu, 'rut_estu');
                // debugear($asistencias);
            }
            
            $router->show('apoderado/index', [
                'estudiantes' => $estudiantes,
                'asistencias' => $asistencias
            ], '../../css/apoderado');
        }

        public static function crear(Router $router){

            $apoderado = new Apoderado();
            $errores = Apoderado::getErrores();
            
            $asistencias = Asistencia::getLimit(5) ?? null;
            $estudiantes = Estudiante::getLimit(5) ?? null;
            $estudiantesAll = Estudiante::all() ?? null;
            $apoderados = Apoderado::getLimit(5) ?? null;
            $apoderadosAll = Apoderado::all() ?? null;
            $funcionarios = Funcionario::getLimit(5) ?? null;
            $cursos = Curso::all();

            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $_POST['apoderado']['password_apod'] = password_hash($_POST['apoderado']['password_apod'], PASSWORD_DEFAULT);
                $apoderado = new Apoderado($_POST['apoderado']);
                $errores = $apoderado->validar();
                if(empty($errores)){
                    $apoderado->guardar();
                }

            }

            $router->show( '/admin/index', [
                'apoderado' => $apoderado,
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

        public static function actualizar(Router $router){

            $apoderado = Apoderado::findRecordColumnEspecific($_GET['id'])[0] ?? Apoderado::findRecordColumnEspecific($_POST['id'])[0];
            $errores = Apoderado::getErrores();

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $_POST['apoderado']['password_apod'] = password_hash($_POST['apoderado']['password_apod'], PASSWORD_DEFAULT);
                $args = $_POST['apoderado'];
                $apoderado->sincronizar($args);
                $errores = $apoderado->validar();


                if (empty($errores)) {
                    $apoderado->guardar($_POST['id']);
                }

            }
            
            $router->show('admin/apoderados/actualizar', [
                'apoderado' => $apoderado,
                'errores' => $errores
            ], '../../css/funcionario');

        }

        public static function eliminar(){
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $idEntidad = $_POST['id'];
                //Validar ID

                if($idEntidad){
                    $entidad = $_POST['entidad'];
                    if(validarEntidad($entidad)){
                        $entidad = Apoderado::findRecordColumnEspecific($idEntidad)[0];
                        $entidad->eliminar($entidad->rut_apod);
                    }
                }
            }
        }
    }