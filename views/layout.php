<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" data-purpose="Layout StyleSheet" title="Web Awesome" href="/css/app-wa-9a55d8748fd46de7b7977d9ee8dee7a4.css?vsn=d">

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/all.css">

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/sharp-solid.css">

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/sharp-regular.css">

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/sharp-light.css">

    <title>Insuco2 Asistencias</title>
    <link rel="shortcut icon" type="image/png" href="../img/logoInsuco2.jpg">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Krub:wght@200;400;700&display=swap" rel="stylesheet">
    <link rel="preload" href="<?php echo $style; ?>.css">
    <link rel="stylesheet" href="<?php echo $style; ?>.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Krub:wght@200;400;700&display=swap" rel="stylesheet" />


</head>

<body>
    <!-- elemento para abrir el sidenav -->
    <div class="contenedor__menu" id="sideNavBtn">
        <a onclick="openNav()"><i class="fa-solid fa-bars"></i></a>
    </div>
    

    <?php if($_SERVER['REDIRECT_URL'] != "/admin" && $_SESSION['admin']): ?>
        <div class="contenedor__menu">
            <a onclick="openMenuFilter()"><i id="icono__filtrar" class="fa-solid fa-filter-list "></i></a>
        </div>

        <nav id="menuFilter" class="menuFilter">
            <a href="/admin" class=>Inicio <i class="fa-solid fa-house"></i></a>
            <p class="filter">Filtro</p>
            <a href="javascript:void(0)" class="closebtn" onclick="closeMenuFilter()">&times;</a>

            <?php if ($asistencias) { ?>
                <form id="buscador">
                    <div class="buscadooor">
                        <label class="titulo__busc" for="id">ID</label>
                        <input class="input__busc" type="number" placeholder="ID de Asistencia" id="id">
                    </div>
                    <div class="buscadooor">
                        <label class="titulo__busc" for="rutEstudiante">Rut Estudiante</label>
                        <input class="input__busc" type="text" placeholder="Rut del Estudiante" id="rutEstudiante">
                    </div>
                    <div class="buscadooor">
                        <label class="titulo__busc" for="nombresApellidos">Nombre/Apellido </label>
                        <label class="titulo__busc" for="nombresApellidos">Estudiante</label>
                        <input class="input__busc" type="text" placeholder="EJ: Fernando" id="nombresApellidos">
                    </div>
                    <div class="buscadooor">
                        <label class="titulo__busc" for="curso">Curso</label>
                        <input class="input__busc" type="text" placeholder="EJ: 4F" id="curso">
                    </div>
                    <div class="buscadooor">
                        <label class="titulo__busc" for="fecha">Fecha Asistencia</label>
                        <input class="input__busc" type="text" placeholder="EJ: 06/04 (mes/dia) / 08 (mes)" id="fecha">
                    </div>
                    <div class="buscadooor">
                        <label class="titulo__busc" for="horaMin">Hora Min Asistencia</label>
                        <input class="input__busc" type="text" placeholder="EJ: 08:40" id="horaMin">
                    </div>
                    <div class="buscadooor">
                        <label class="titulo__busc" for="horaMax">Hora Max Asistencia</label>
                        <input class="input__busc" type="text" placeholder="EJ: 10:00" id="horaMax">
                    </div>
                </form>
            <?php } else if ($estudiantes) { ?>
                <form id="buscador">
                    <div class="buscadooor">
                        <label class="titulo__busc" for="rut">Rut Estudiante</label>
                        <input class="input__busc" type="text" placeholder="Rut del Estudiante" id="rut">
                    </div>
                    <div class="buscadooor">
                        <label class="titulo__busc" for="nombresEstudiante">Nombres</label>
                        <input class="input__busc" type="text" placeholder="Fernando" id="nombresEstudiante">
                    </div>
                    <div class="buscadooor">
                        <label class="titulo__busc" for="apellidos">Apellidos</label>
                        <input class="input__busc" type="text" placeholder="Hernandez Soto" id="apellidosEstudiante">
                    </div>
                    <div class="buscadooor">
                        <label class="titulo__busc" for="curso">Curso</label>
                        <input class="input__busc" type="text" placeholder="4F" id="curso">
                    </div>
                    <div class="buscadooor">
                        <label class="titulo__busc" for="rutApoderado">Rut Apoderado</label>
                        <input class="input__busc" type="text" placeholder="12345678-9" id="rutApoderado">
                    </div>
                </form>
            <?php } else if ($apoderados) { ?>
                <form id="buscador">
                    <div class="buscadooor">
                        <label class="titulo__busc" for="rut">Rut</label>
                        <input class="input__busc" type="text" placeholder="Rut Apoderado 12345678-9" id="rut">
                    </div>
                    <div class="buscadooor">
                        <label class="titulo__busc" for="nombres">Nombres</label>
                        <input class="input__busc" type="text" placeholder="EJ: Fernando Ignacio" id="nombres">
                    </div>
                    <div class="buscadooor">
                        <label class="titulo__busc" for="apellidos">Apellidos</label>
                        <input class="input__busc" type="text" placeholder="EJ: Hernandez Soto" id="apellidos">
                    </div>
                </form>
            <?php } else if ($funcionarios){ ?>
                <form id="buscador">
                    <div class="buscadooor">
                        <label class="titulo__busc" for="rut">Rut</label>
                        <input class="input__busc" type="text" placeholder="Rut Apoderado 12345678-9" id="rut">
                    </div>
                    <div class="buscadooor">
                        <label class="titulo__busc" for="nombres">Nombres</label>
                        <input class="input__busc" type="text" placeholder="EJ: Fernando Ignacio" id="nombres">
                    </div>
                    <div class="buscadooor">
                        <label class="titulo__busc" for="apellidos">Apellidos</label>
                        <input class="input__busc" type="text" placeholder="EJ: Hernandez Soto" id="apellidos">
                    </div>
                    <div class="buscadooor">
                        <label class="titulo__busc" for="email">Email</label>
                        <input class="input__busc" type="text" placeholder="EJ: email@email.com" id="email">
                    </div>
                </form>
            <?php } ?>
            <a href="/logout" class="botonN">Logout <i class="fa-solid fa-right-from-bracket"></i></a>
        </nav>
    <?php endif; ?>

    <nav id="mySidenav" class="sidenav">
        <p class="bienvenida__tittle">  Bienvenido/a <br> <?php echo $_SESSION["nombresApellidosUser"]?>  <i class="fa-solid fa-hand-wave"></i> </p>
        <a href="/admin" class="title">Inicio</a>
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

        <?php if ($_SESSION['admin'] == '1') { ?>
            <button class="bm" onclick="document.getElementById('modal').showModal();">Agregar Asistencia</button>
            <dialog id="modal">
                <form class="form" action="/admin/asistencia/crear" method="POST">
                    <legend class="tittle"> Agregar Asistencia</legend>
                    <!-- CAMPOS -->
                    <div class="cont-campos">
                        <h5>Rut Estudiante:</h5>
                        <input type="text" class="text-area"
                                id="rut_estu" list="listaEstudiantes"
                                name="asistencia[rut_estu]"
                                placeholder="12345678-9 o Ignacio 4F"
                                autocomplete="off">
                            <!--List hace referencia al datalist-->
                            <datalist id="listaEstudiantes">
                                <?php foreach($estudiantesAll as $estudiante):?>
                                            <option value="<?php echo $estudiante->rut_estu; ?>"
                                                    label="<?php echo $estudiante->nombres_estu . " " . $estudiante->apellidos_estu . " - " . $estudiante->id_curso; ?>">
                                <?php endforeach;?>
                            </datalist>
                    </div>
                    
                    <div class="cont-campos">
                        <h5>Comentario:</h5>
                        <input class="text-area" type="text" id="comentario_asis" name="asistencia[comentario_asis]" placeholder="Intento de Fuga (Opcional)">
                    </div>
                    <input type="hidden" value="<?php echo $_SESSION['usuario']; ?>" name="asistencia[rut_func]">

                    <!-- BOTON AGREGAR -->
                    <div class="cont-boton">
                        <input class="boton" type="submit" id="asistencia" value="Agregar">
                    </div>
                </form>
                <button onclick="document.getElementById('modal').close();">Cerrar</button>
            </dialog>

            <button class="bm" onclick="document.getElementById('modal2').showModal();">Agregar Estudiante</button>
            <dialog id="modal2">
                <form class="form" action="/admin/estudiante/crear" method="POST">
                    <legend class="tittle"> Agregar Estudiante</legend>
                    <!-- CAMPOS -->
                    <div class="cont-campos">
                        <h5> Rut:</h5>
                        <input class="text-area" type="text" id="rut_estu" name="estudiante[rut_estu]" placeholder="12345678-9">
                    </div>
                    
                    <div class="cont-campos">
                        <h5>Rut Apoderado:</h5>
                        <input type="text" class="text-area"
                                id="rut_apod" list="listaApoderados"
                                name="estudiante[rut_apod]"
                                placeholder="12345678-9 o Soledad Zu���iga"
                                autocomplete="off">
                            <!--List hace referencia al datalist-->
                            <datalist id="listaApoderados">
                                <?php foreach($apoderadosAll as $apoderado):?>
                                            <option value="<?php echo $apoderado->rut_apod; ?>"
                                                    label="<?php echo $apoderado->nombres_apod . " " . $apoderado->apellidos_apod; ?>">
                                <?php endforeach;?>
                            </datalist>
                    </div>
                            
                    <div class="cont-campos">
                        <h5> Nombres:</h5>
                        <input class="text-area" type="text" id="nombre_estu" name="estudiante[nombres_estu]" placeholder="Nombre">
                    </div>
                    <div class="cont-campos">
                        <h5> Apellidos:</h5>
                        <input class="text-area" type="text" id="apellido_estu" name="estudiante[apellidos_estu]" placeholder="Apellido">
                    </div>
                    
                    <div class="cont-campos">
                        <h5> Curso:</h5>
                        <input type="text" class="text-area"
                                id="curso_estudiante" list="opciones"
                                name="estudiante[id_curso]"
                                placeholder="Seleccione un Curso"
                                autocomplete="off"
                            <!--List hace referencia al datalist-->
                            <datalist id="opciones">
                                <?php foreach($cursos as $curso):?>
                                    <option value="<?php echo $curso->id_curso . ") " . $curso->grado_curso . $curso->letra_curso; ?>">
                                <?php endforeach;?>
                            </datalist>
                    </div>
                    
                    <!-- Input Curso Antiguo  -->
                    <!--
                    <div class="cont-campos">
                        <h5> Curso:</h5>
                        <input class="text-area" type="text" id="curso_estu" name="estudiante[id_curso]" placeholder="1A">
                    </div>
                    -->
                    
                    <!-- BOTON AGREGAR -->
                    <div class="cont-boton">
                        <input class="boton" type="submit" id="login_estu" value="Agregar">
                    </div>
                </form>
                <button onclick="document.getElementById('modal2').close();">Cerrar</button>
            </dialog>

            <button class="bm" onclick="document.getElementById('modal3').showModal();">Agregar Curso</button>
            <dialog id="modal3">
                <form class="form" action="/admin/curso/crear" method="POST">
                    <legend class="tittle"> Agregar curso</legend>
                    <!-- CAMPOS -->
                            
                    <div class="cont-campos">
                        <h5>Grado:</h5>
                        <input class="text-area" type="text" id="grado_curso" name="curso[grado_curso]" placeholder="Grado - Ej: 3">
                    </div>
                    <div class="cont-campos">
                        <h5>Letra:</h5>
                        <input class="text-area" type="text" id="letra_curso" name="curso[letra_curso]" placeholder="Letra - Ej: F">
                    </div>
                    <div class="cont-campos">
                        <h5>N° de Sala:</h5>
                        <input class="text-area" type="text" id="numero_sala" name="curso[numero_sala]" placeholder="Numero - Ej: 14">
                    </div>
                    
                    
                    <!-- BOTON AGREGAR -->
                    <div class="cont-boton">
                        <input class="boton" type="submit" id="login_estu" value="Agregar">
                    </div>
                </form>
                <button onclick="document.getElementById('modal2').close();">Cerrar</button>
            </dialog>

            <button class="bm" onclick="document.getElementById('modal4').showModal();">Agregar Apoderado</button>
            <dialog id="modal4">
                <form class="form" action="/admin/apoderado/crear" method="POST">
                    <legend class="tittle"> Agregar Apoderado</legend>
                    <!-- CAMPOS -->
                    <div class="cont-campos">
                        <h5> Rut:</h5>
                        <input class="text-area" type="text" id="rut_apod" name="apoderado[rut_apod]" placeholder="12345678-9">
                    </div>
                    <div class="cont-campos">
                        <h5> Nombre:</h5>
                        <input class="text-area" type="text" id="nombre_apod" name="apoderado[nombres_apod]" placeholder="Nombre">
                    </div>
                    <div class="cont-campos">
                        <h5> Apellido:</h5>
                        <input class="text-area" type="text" id="apellido_apod" name="apoderado[apellidos_apod]" placeholder="Apellido">
                    </div>
                    <div class="cont-campos">
                        <h5> Contraseña:</h5>
                        <input class="text-area" type="text" id="contraseña_apod" name="apoderado[password_apod]" placeholder="*********">
                    </div>
                    <!-- BOTON AGREGAR -->
                    <div class="cont-boton">
                        <input class="boton" type="submit" id="login_apod" value="Agregar">
                    </div>
                </form>
                <button onclick="document.getElementById('modal3').close();">Cerrar</button>
            </dialog>

            <button class="bm" onclick="document.getElementById('modal5').showModal();">Agregar Funcionario</button>
            <dialog id="modal5">
                <form class="form" action="/admin/funcionario/crear" method="POST">
                    <legend class="tittle"> Agregar Funcionario</legend>
                    <!-- CAMPOS -->
                    <div class="cont-campos">
                        <h5>Rut:</h5>
                        <input class="text-area" type="text" id="rut_func" name="funcionario[rut_func]" placeholder="12345678-9">
                    </div>
                    <div class="cont-campos">
                        <h5>Nombres:</h5>
                        <input class="text-area" type="text" id="nombres_func" name="funcionario[nombres_func]" placeholder="Nombres">
                    </div>
                    <div class="cont-campos">
                        <h5>Apellidos:</h5>
                        <input class="text-area" type="text" id="apellidos_func" name="funcionario[apellidos_func]" placeholder="Apellidos">
                    </div>
                    <div class="cont-campos">
                        <h5> Contraseña:</h5>
                        <input class="text-area" type="text" id="contraseña_func" name="funcionario[password_func]" placeholder="*********">
                    </div>
                    <div class="cont-campos">
                        <h5> Email:</h5>
                        <input class="text-area" type="email" id="email_func" name="funcionario[email_func]" placeholder="example@email.com">
                    </div>
                    <div class="cont-campos">
                        <h5> Admin:</h5>
                        <input type="radio" name="funcionario[admin_func]" id="1" value="1"> si
                        <input type="radio" name="funcionario[admin_func]" id="0" value="0"> no
                    </div>
                    <!-- BOTON AGREGAR -->
                    <div class="cont-boton">
                        <input class="boton" type="submit" id="login_func" value="Agregar">
                    </div>
                </form>
                <button onclick="document.getElementById('modal4').close();">Cerrar</button>
            </dialog>
        <?php } else if ($_SESSION['admin'] === '0') { ?>
            <button class="bm" onclick="document.getElementById('modal').showModal();">Agregar Asistencia</button>
            <dialog id="modal">
                <form class="form" action="/admin/asistencia/crear" method="POST">
                    <legend class="tittle"> Agregar Asistencia</legend>
                    <!-- CAMPOS -->
                    <div class="cont-campos">
                        <h5> Rut estudiante:</h5>
                        <input class="text-area" type="text" id="rut_estu" name="asistencia[rut_estu]" placeholder="12345678-9">
                    </div>
                    <input type="hidden" value="<?php echo $_SESSION['usuario']; ?>" name="asistencia[rut_func]">

                    <!-- BOTON AGREGAR -->
                    <div class="cont-boton">
                        <input class="boton" type="submit" id="asistencia" value="Agregar">
                    </div>
                </form>
                <button onclick="document.getElementById('modal').close();">Cerrar</button>
            </dialog>
        <?php } ?>

        <a href="/logout" class="botonN">Logout <i class="fa-solid fa-right-from-bracket"></i></a>
    </nav>

    <?php echo $contenido; ?>

</body>

</html>