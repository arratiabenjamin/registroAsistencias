<?php 

    namespace MVC;

    class Router{
        public $rutasGET = [];
        public $rutasPOST = [];

        public function get($url, $fnAsoc){
            $this->rutasGET[$url] = $fnAsoc;
        }
        public function post($url, $fnAsoc){
            $this->rutasPOST[$url] = $fnAsoc;
        }

        //TERMINAR
        public function validarURL(){
            //Almacenar Sesion
            session_start();
            $auth = $_SESSION['login'] ?? null;

            //Rutas Protegidas
            $rutasProtegidas = ['/admin', 
                                '/admin/asistencias', '/admin/asistencia/crear', '/admin/asistencia/actualizar', '/admin/asistencia/eliminar',
                                '/admin/estudiantes', '/admin/estudiante/crear', '/admin/estudiante/actualizar', '/admin/estudiante/eliminar',
                                '/admin/cursos', '/admin/curso/crear', '/admin/curso/actualizar', '/admin/curso/eliminar',
                                '/admin/apoderados', '/admin/apoderado/crear', '/admin/apoderado/actualizar', '/admin/apoderado/eliminar',
                                '/admin/funcionarios', '/admin/funcionario/crear', '/admin/funcionario/actualizar', '/admin/funcionario/eliminar',
                                '/apoderado', '/apoderado/estudiante'];

            $urlActual = $_SERVER['PATH_INFO'] ?? $_SERVER['REDIRECT_URL'] ?? '/';
            $metodo = $_SERVER['REQUEST_METHOD'];

            //Proteger Rutas
            if(in_array($urlActual, $rutasProtegidas) && !$auth){
                header('Location: /');
            } else if($urlActual === '/' && $auth){
                if($_SESSION['tipo'] === 'funcionario'){
                    header('Location: /admin');
                }else{
                    header('Location: /apoderado');
                }
            } else if(in_array($urlActual, $rutasProtegidas) && $_SESSION['tipo'] != 'funcionario' && $urlActual != '/apoderado' && $urlActual != '/apoderado/estudiante'){
                header('Location: /apoderado');
            }

            //Guardar FuncAsoc
            if($metodo === 'GET'){
                //Asignar Funcion Asociada a la Ruta Actual.
                $fn = $this->rutasGET[$urlActual] ?? null;
            }else{
                $fn = $this->rutasPOST[$urlActual] ?? null;
            }

            //Verificacion
            if($fn){
                //LLamar a la Funcion Asociada
                call_user_func($fn, $this);
            } else {
                echo 'Url NO Encontrada';
            }
        }

        public function show($view, $datos, $style = '', $login = false){

            foreach( $datos as $key => $value ){
                $$key = $value;
            }
            $contenido = ob_get_clean(); //PRODUCE ERRORES - NO ENCONTRADA SU SOLUCION
            if(!$login){
                include_once __DIR__ . "/views/layout.php";
            }
            
            ob_start(); //PRODUCE ERRORES - NO ENCONTRADA SU SOLUCION
            include_once __DIR__ . "/views/$view.php";


        }
    }