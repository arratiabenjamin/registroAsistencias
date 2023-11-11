<?php

    namespace Controllers;
    use MVC\Router;
    use Model\Funcionario;
    use Model\Apoderado;
    use Model\Estudiante;
    use Model\Asistencia;
    use Controllers\ApoderadoController;

    class LoginController{

        public static function login(Router $router){

            $errores = [];
            

            if( $_SERVER['REQUEST_METHOD'] === 'POST'){
                
                $user = $_POST;

                if( $user['tipo'] === 'funcionario' ){
                    $rut = $user['rut'];
                    $password = $user['password'];
                    $user = [];
                    $user['tipo'] = 'funcionario';
                    $user['rut_func'] = $rut;
                    $user['nombres_func'] = ' ';
                    $user['apellidos_func'] = ' ';
                    $user['password_func'] = $password;
                    $user['email_func'] = ' ';
                    $user['admin_func'] = '0';
                    $auth = new Funcionario($user);
                }else{
                    $rut = $user['rut'];
                    $password = $user['password'];
                    $user = [];
                    $user['rut_apod'] = $rut;
                    $user['nombres_apod'] = ' ';
                    $user['apellidos_apod'] = ' ';
                    $user['password_apod'] = $password;
                    $user['tipoInicioSesion'] = $tipoInicioSesion ?? null;
                    $auth = new Apoderado($user);
                }

                $errores = $auth->validar();

                if(empty($errores)){
                    
                    $resultado = $auth->existeUsuario($user['rut_func'] ?? $user['rut_apod']);

                    if(!$resultado){
                        if( $user['tipo'] === 'funcionario' ){
                            $errores = Funcionario::getErrores();
                        }else{
                            $errores = Apoderado::getErrores();
                        }
                    } else {

                        $autenticacion = $auth->comprobarPassword($resultado);

                        if($autenticacion){
                            $_SESSION['admin'] = Funcionario::findRecordColumnEspecific($user['rut_func'])->admin_func;
                            
                            $auth->autenticar();
                        }else{
                            if( $user['tipo'] === 'funcionario' ){
                                $errores = Funcionario::getErrores();
                            }else{
                                $errores = Apoderado::getErrores();
                            }
                        }
                    }
                }
            }

            $router->show( 'auth/login', [
                'errores' => $errores
            ], '../css/login', true );
        }

        public static function loginApp(){
            if($_SERVER["REQUEST_METHOD"] === "POST"){
                $errores = [];
                
                $user = $_POST;
                
                $user['nombres_apod'] = ' ';
                $user['apellidos_apod'] = ' ';
                
                $apoderado = new Apoderado($user);
                
                $errores = $apoderado->validar();
                
                if (empty($errores)) {
                
                    $resultado = $apoderado->existeUsuario($user['rut_apod']);
                
                    if (!$resultado) {
                        $errores = Apoderado::getErrores();
                    } else {
                        $autenticacion = $apoderado->comprobarPassword($resultado);
                
                        if ($autenticacion) {
                            session_start();
                            $apoderado->tipo = "App";
                            $apoderado->autenticar();
                        } else {
                            $errores = Apoderado::getErrores();
                        }
                    }
                }
                
                echo $errores[0];
            }else{
                $rut_apod = $_GET["rut_apod"];

                $estudiantes = Estudiante::findRecordColumnEspecific($rut_apod, 'rut_apod');
                $asistencias = [];
                
                foreach($estudiantes as $estudiante){
                    $asistencias["estudiantes"][] = $estudiante;
                    $asistencias["asistencias"][] = Asistencia::findRecordColumnEspecific($estudiante->rut_estu, 'rut_estu');
                }
                
                while ($row = mysqli_fetch_object($resultado)) {
                    $asistencias[] = $row;
                }
                
                echo json_encode($asistencias);
            }
        }

        public static function logout(Router $router){
            session_start();
            $_SESSION = [];
            header('Location: /');
        }
    
    }
