<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Login </title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://kit.fontawesome.com/2c52b9817b.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Krub:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="../css/login.css">
</head>

<body>
    <div class="contenedor-general">
    <form class="form" action="/" method="POST">
        
        <!--MUESTRA LOS MENSAJES DE ERRORES-->
        <div id="error">
            <?php foreach($errores as $error): ?>
                
                <h5 class="mensaje__error"> <i class="fa-solid fa-circle-exclamation"></i><?php echo $error; ?></h5>
            <?php endforeach; ?>
        </div>
        <legend class="tittle"> Inicia Sesión </legend>
        <!--CAMPOS-->
        <div class="cont-campos">
            <i id="user__login" class="fa-solid fa-user"></i>
            <input class="text-area" type="text" id="rut" name="rut" placeholder="12345678-9"> 
        </div>

        <div class="cont-campos">          
            <i id="user__password" class="fa-solid fa-lock"></i>
            <input class="text-area" type="password" id="password" name="password" placeholder="Contraseña">
            <i class="fa-solid fa-eye" onclick="mostrarContrasenia()" id="view__password"></i>
        </div>

        <!-- RADIO-BUTTON -->
        <div class="cont-radio">
            <input class="radio__input outline" type="radio" name="tipo" value="funcionario" id="funcionario">
            <label class="radio__label" for="funcionario"> Funcionario</label>
            <span class="espacio"></span>
            <input class="radio__input outline" type="radio" name="tipo" value="apoderado" id="apoderado">
            <label class="radio__label" for="apoderado"> Apoderado</label>
        </div>
        <!-- BOTON LOGIN -->
        <input class="boton outline" onclick="return validarFormulario()" type="submit" id="login" value="Ingresar">    
    </form>

    <div class="lateral">
        <div class="lateral__apod"> 
            <h2 class="white" id="ingreso__tittle"> ¡Bienvenido! </h2> 
            <h3 class="white" id="ingreso__subtittle"> Sigue los pasos para ingresar. </h3>
            <ul class="white">
                <li class="mb"> Ingresa tu rut, sin puntos y con guión</li>
                <li class="mb"> Utiliza la contraseña otorgada por tu institución</li>
                <li> Selecciona tu rol dentro de la institución </li>
            </ul>
        </div>
            <div  id="contacto">
                <h3 id="h3__contacto">Si aun no tienes una cuenta contacta la </h3>
                <a id="a__contacto" href="https://insucodos.cl/" target="_blank">institución</a>
            </div>
    </div>
</div>
<script src="../js/app.js"></script>
</body>

</html>