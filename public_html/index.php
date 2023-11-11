<?php

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header("Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token");
        
    //Llamando al app.php
    require_once __DIR__ . '/../includes/app.php';

    //Llamar Clases a Usar
    use MVC\Router;
    use Controllers\AsistenciaController;
    use Controllers\EstudianteController;
    use Controllers\ApoderadoController;
    use Controllers\CursoController;
    use Controllers\FuncionarioController;
    use Controllers\LoginController;

    //Creacion de Router
    $router = new Router();

    //Admin
    $router->get('/admin', [FuncionarioController::class, 'index']);

    //Mostrar todos los Registros de Entidades.
    $router->get('/admin/asistencias', [FuncionarioController::class, 'asistencias']);
    $router->get('/admin/estudiantes', [FuncionarioController::class, 'estudiantes']);
    $router->get('/admin/cursos', [FuncionarioController::class, 'cursos']);
    $router->get('/admin/apoderados', [FuncionarioController::class, 'apoderados']);
    $router->get('/admin/funcionarios', [FuncionarioController::class, 'funcionarios']);

    //Apoderado
    $router->get('/apoderado', [ApoderadoController::class, 'index']);

    //ModificarEntidades
    //Asistencias
    $router->get('/admin/asistencia/crear', [AsistenciaController::class, 'crear']);
    
    $router->post('/2y10PSEZOT6haGLMFTEuNF1ZrG8CCgL6EocpADhPOTETzAHKtqiO', [AsistenciaController::class, 'crearRIFD']);
    $router->get('/2y10PSEZOT6haGLMFTEuNF1ZrG8CCgL6EocpADhPOTETzAHKtqiO', [AsistenciaController::class, 'crearRIFD']);
    
    $router->post('/admin/asistencia/crear', [AsistenciaController::class, 'crear']);
    $router->get('/admin/asistencia/actualizar', [AsistenciaController::class, 'actualizar']);
    $router->post('/admin/asistencia/actualizar', [AsistenciaController::class, 'actualizar']);
    $router->post('/admin/asistencia/eliminar', [AsistenciaController::class, 'eliminar']);
    //Estudiantes
    $router->get('/admin/estudiante/crear', [EstudianteController::class, 'crear']);
    $router->post('/admin/estudiante/crear', [EstudianteController::class, 'crear']);
    $router->get('/admin/estudiante/actualizar', [EstudianteController::class, 'actualizar']);
    $router->post('/admin/estudiante/actualizar', [EstudianteController::class, 'actualizar']);
    $router->post('/admin/estudiante/eliminar', [EstudianteController::class, 'eliminar']);
    //Cursos
    $router->get('/admin/curso/crear', [CursoController::class, 'crear']);
    $router->post('/admin/curso/crear', [CursoController::class, 'crear']);
    $router->get('/admin/curso/actualizar', [CursoController::class, 'actualizar']);
    $router->post('/admin/curso/actualizar', [CursoController::class, 'actualizar']);
    $router->post('/admin/curso/eliminar', [CursoController::class, 'eliminar']);
    //Apoderados
    $router->get('/admin/apoderado/crear', [ApoderadoController::class, 'crear']);
    $router->post('/admin/apoderado/crear', [ApoderadoController::class, 'crear']);
    $router->get('/admin/apoderado/actualizar', [ApoderadoController::class, 'actualizar']);
    $router->post('/admin/apoderado/actualizar', [ApoderadoController::class, 'actualizar']);
    $router->post('/admin/apoderado/eliminar', [ApoderadoController::class, 'eliminar']);
    //Funcionarios
    $router->get('/admin/funcionario/crear', [FuncionarioController::class, 'crear']);
    $router->post('/admin/funcionario/crear', [FuncionarioController::class, 'crear']);
    $router->get('/admin/funcionario/actualizar', [FuncionarioController::class, 'actualizar']);
    $router->post('/admin/funcionario/actualizar', [FuncionarioController::class, 'actualizar']);
    $router->get('/admin/funcionario/actualizar1', [FuncionarioController::class, 'actualizar1']);
    $router->post('/admin/funcionario/actualizar1', [FuncionarioController::class, 'actualizar1']);
    $router->post('/admin/funcionario/eliminar', [FuncionarioController::class, 'eliminar']);

    //Login - Autenticacion
    $router->get('/', [LoginController::class, 'login'], true);
    $router->post('/', [LoginController::class, 'login'], true);
    
    $router->get('/2y10PSEZOT6haGLMFTEuNF1ZrG8CCgL6EocpADhPOTETzAFTAi6O', [LoginController::class, 'loginApp'], true);
    $router->post('/2y10PSEZOT6haGLMFTEuNF1ZrG8CCgL6EocpADhPOTETzAFTAi6O', [LoginController::class, 'loginApp'], true);
    
    $router->get('/logout', [LoginController::class, 'logout'], true);

    $router->validarURL();
