<?php 

    namespace Controllers;
    use MVC\Router;
    use Model\Asistencia;
    use Model\Estudiante;
    use Model\Apoderado;
    use Model\Funcionario;
    use Model\Curso;

    class CursoController{
        public static function index(Router $router){   
            $cursos = Curso::all();

            $router->show( '/admin/cursos', [
                "cursos" => $cursos
            ], '../css/funcionario' );
        }
        
        public static function crear(Router $router){

            $curso = new curso();
            $errores = Curso::getErrores();
            
            $asistencias = Asistencia::getLimit(5) ?? null;
            $estudiantes = Curso::getLimit(5) ?? null;
            $estudiantesAll = Curso::all() ?? null;
            $apoderados = Apoderado::getLimit(5) ?? null;
            $apoderadosAll = Apoderado::all() ?? null;
            $funcionarios = Funcionario::getLimit(5) ?? null;
            $cursos = Curso::getLimit(5) ?? null;
            $cursosAll = Curso::all();

            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $curso = new curso($_POST['curso']);
                $errores = $curso->validar();
                if(empty($errores)){
                    $curso->guardar();
                }
            }

            $router->show( '/admin/index', [
                'curso' => $curso,
                'errores' => $errores,
                'asistencias' => $asistencias,
                'estudiantes' => $estudiantes,
                'estudiantesAll' => $estudiantesAll,
                'apoderados' => $apoderados,
                'apoderadosAll' => $apoderadosAll,
                'funcionarios' => $funcionarios,
                'cursos' => $cursos,
                'cursosAll' => $cursosAll
            ], '../../css/funcionario' );

        }
        
        public static function actualizar(Router $router){

            $curso = Curso::findRecordColumnEspecific($_GET['id']) ?? Curso::findRecordColumnEspecific($_POST['id']);
            $errores = Curso::getErrores();

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $args = $_POST['curso'];
                //debugear("hola");
                $curso->sincronizar($args);
                $errores = $curso->validar();

                if (empty($errores)) {
                    $curso->guardar($curso->id_curso);
                }

            }
            
            $router->show('admin/cursos/actualizar', [
                'curso' => $curso,
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
                        $entidad = Curso::findRecordColumnEspecific($idEntidad);
                        $entidad->eliminar($entidad->id_curso);
                    }
                }
            }
        }
    }
