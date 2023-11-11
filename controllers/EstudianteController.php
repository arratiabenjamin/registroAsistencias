<?php 

    namespace Controllers;
    use MVC\Router;
    use Model\Asistencia;
    use Model\Estudiante;
    use Model\Apoderado;
    use Model\Funcionario;
    use Model\Curso;

    class EstudianteController{
        public static function index(Router $router){   
            $estudiantes = Estudiante::all();

            $router->show( '/admin/estudiantes', [
                "estudiantes" => $estudiantes
            ], '../css/funcionario' );
        }
        
        public static function crear(Router $router){

            $estudiante = new Estudiante();
            $errores = Estudiante::getErrores();
            
            $asistencias = Asistencia::getLimit(5) ?? null;
            $estudiantes = Estudiante::getLimit(5) ?? null;
            $estudiantesAll = Estudiante::all() ?? null;
            $apoderados = Apoderado::getLimit(5) ?? null;
            $apoderadosAll = Apoderado::all() ?? null;
            $funcionarios = Funcionario::getLimit(5) ?? null;
            $cursos = Curso::all();

            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $_POST['estudiante']['id_curso'] = explode(')', $_POST['estudiante']['id_curso'])[0];
                $estudiante = new Estudiante($_POST['estudiante']);
                $errores = $estudiante->validar();
                if(empty($errores)){
                    $estudiante->guardar();
                }
            }

            $router->show( '/admin/index', [
                'estudiante' => $estudiante,
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

            $estudiante = Estudiante::findRecordColumnEspecific($_GET['id']) ?? Estudiante::findRecordColumnEspecific($_POST['id']);
            $cursos = Curso::all();
            $errores = Estudiante::getErrores();

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $_POST['estudiante']['id_curso'] = explode(')', $_POST['estudiante']['id_curso'])[0];
                $args = $_POST['estudiante'];
                //debugear("hola");
                $estudiante->sincronizar($args);
                $errores = $estudiante->validar();

                if (empty($errores)) {
                    $estudiante->guardar($estudiante->rut_estu);
                }

            }
            
            $router->show('admin/estudiantes/actualizar', [
                'estudiante' => $estudiante,
                'cursos' => $cursos,
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
                        $entidad = Estudiante::findRecordColumnEspecific($idEntidad);
                        $entidad->eliminar($entidad->rut_estu);
                    }
                }
            }
        }
    }
