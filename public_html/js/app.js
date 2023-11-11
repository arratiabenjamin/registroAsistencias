/* Set the width of the side navigation to 250px and the left margin of the page content to 250px */
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
}

/* Set the width of the side navigation to 0 and the left margin of the page content to 0 */
function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft = "0";
}

/*MOSTRAR CONTRASEÑA*/
function mostrarContrasenia() {
  let contrasenia = document.getElementById("password");

  if (contrasenia.type == "password") {
    contrasenia.type = "text";
  } else {
    contrasenia.type = "password";
  }

}

function validarFormulario() {
  console.log('Formulario aceptado');

  let rut = document.getElementById("rut");
  let password = document.getElementById("password");
  let radioButtons = document.getElementsByName("tipo");
  console.log(radioButtons);
  let radioSeleccionado = true;

  let mensajeError = [];

  if (rut.value > 0 && password.value > 0) {
    for (let i = 0; i < radioButtons.length; i++) {
      if (radioButtons[i].checked) {
        radioSeleccionado = true;
        break;
      } else {
        radioSeleccionado = false;
      }
    }
  }

  if (!radioSeleccionado) {
    mensajeError.push('<h5 class="mensaje__error"> <i class="fa-solid fa-circle-exclamation"></i> Selecciona una opción </h5>');
  }

  error.innerHTML = mensajeError.join(' ');

  console.log(mensajeError);

  return mensajeError.length === 0;

}