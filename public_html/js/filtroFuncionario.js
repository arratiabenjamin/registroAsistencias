document.addEventListener('DOMContentLoaded', () => {
    const rut = document.querySelector("#rut");
    const nombres = document.querySelector("#nombres");
    const apellidos = document.querySelector("#apellidos");
    const email = document.querySelector("#email");

    const funcionarios = document.querySelector("#funcionarios");
    const main = document.querySelector("#main");
    let sinExistencia;

    const datosBusqueda = {
        rut: '',
        nombres: '',
        apellidos: '',
        email: ''
    };

    console.log(funcionarios);

    const listaFuncionarios = [];

    // Itera a través de los elementos tr dentro del tbody
    for (const tr of funcionarios.children) {
        // Accede a las celdas (td) dentro de cada tr
        const cells = tr.children;

        // Crea un objeto para almacenar los datos de la fila
        const objetoFila = {
            rut: cells[0].textContent,
            nombres: cells[1].textContent,
            apellidos: cells[2].textContent,
            email: cells[3].textContent
        };

        // Agrega el objeto a la lista
        listaFuncionarios.push(objetoFila);
    }

    // Ahora, listaObjetos contiene los datos de cada fila como objetos
    console.log(listaFuncionarios);

    rut.addEventListener('input', () => {
        datosBusqueda.rut = rut.value;
        console.log("HELLO");
        filtrarFuncionarios();
    });
    nombres.addEventListener('input', () => {
        datosBusqueda.nombres = nombres.value;
        console.log("HELLO");
        filtrarFuncionarios();
    });
    apellidos.addEventListener('input', () => {
        datosBusqueda.apellidos = apellidos.value;
        console.log("HELLO");
        filtrarFuncionarios();
    });
    email.addEventListener('input', () => {
        datosBusqueda.email = email.value;
        console.log("HELLO");
        filtrarFuncionarios();
    });

    function filtrarFuncionarios() {
        //Funcion de Alto Nivel: Funcion que Ejecuta a Otra
        const funcionarios = listaFuncionarios.filter(filtrarRut)
                                    .filter(filtrarnombres)
                                    .filter(filtrarapellidos)
                                    .filter(filtrarEmail);

        mostrarFuncionarios(funcionarios);
    }

    function filtrarRut(funcionario) {
        const {
            rut
        } = datosBusqueda;
        if (rut) {
            return funcionario.rut.includes(rut);
        }
        return funcionario
    }
    function filtrarnombres(funcionario) {
        const {
            nombres
        } = datosBusqueda;
        if (nombres) {
            let nombresBusqueda = nombres.split(' ');
            let nombresFuncionario = funcionario.nombres.split(' ');

            nombresBusqueda = nombresBusqueda.map(item => item.toLowerCase());
            nombresFuncionario = nombresFuncionario.map(item => item.toLowerCase());
            
            if(nombresFuncionario[1]){
                if(nombresFuncionario[0].includes(nombresBusqueda[0]) || nombresFuncionario[0].includes(nombresBusqueda[1]) || nombresFuncionario[1].includes(nombresBusqueda[0]) || nombresFuncionario[1].includes(nombresBusqueda[1])) return true;
                else return false;
            }else{
                if(nombresFuncionario[0].includes(nombresBusqueda[0]) || nombresFuncionario[0].includes(nombresBusqueda[1])) return true;
                else return false;
            }

        }
        return funcionario
    }
    function filtrarapellidos(funcionario) {
        const {
            apellidos
        } = datosBusqueda;
        if (apellidos) {
            let apellidosBusqueda = apellidos.split(' ');
            let apellidosFuncionario = funcionario.apellidos.split(' ');

            apellidosBusqueda = apellidosBusqueda.map(item => item.toLowerCase());
            apellidosFuncionario = apellidosFuncionario.map(item => item.toLowerCase());

            if(apellidosFuncionario[1]){
                if(apellidosFuncionario[0].includes(apellidosBusqueda[0]) || apellidosFuncionario[0].includes(apellidosBusqueda[1]) || apellidosFuncionario[1].includes(apellidosBusqueda[0]) || apellidosFuncionario[1].includes(apellidosBusqueda[1])) return true;
                else return false;
            }else{
                if(apellidosFuncionario[0].includes(apellidosBusqueda[0]) || apellidosFuncionario[0].includes(apellidosBusqueda[1])) return true;
                else return false;
            }
            
        }
        return funcionario
    }
    function filtrarEmail(funcionario) {
        const {
            email
        } = datosBusqueda;
        if (email) {
            return funcionario.email.includes(email);
        }
        return funcionario
    }

    //funciones
    function mostrarFuncionarios(listaFuncionarios) {

        limpiarHTML();
        if(main.querySelector('p')){
            main.querySelector('p').textContent = '';
        }

        if (listaFuncionarios.length) {
            listaFuncionarios.forEach(funcionario => {
                const {
                    rut,
                    nombres,
                    apellidos,
                    email
                } = funcionario;
                const funcionarioHTML = document.createElement('tr');
                funcionarioHTML.classList.add('row');

                const newFuncionario = `
                    <td class="cell pl">${rut}</td>
                    <td class="cell">${nombres}</td>
                    <td class="cell h">${apellidos}</td>
                    <td class="cell h">${email}</td>
                    <td class="action cell">

                    <a href="/admin/funcionario/actualizar?id=${rut}">
                    <input class="btn-action actualizar" type="button" value="Editar" />
                </a>

                <form method="POST" action="funcionario/eliminar">
                    <input class="btn-action eliminar" type="submit" value="Eliminar" />
                    <input type="hidden" name="id" value="${rut}" />
                    <input type="hidden" name="entidad" value="funcionario" />
                </form>
                    </td>
            `;

            funcionarioHTML.insertAdjacentHTML('beforeend', newFuncionario);

                funcionarios.appendChild(funcionarioHTML);

            })
        } else {
            if(sinExistencia){
                main.removeChild(sinExistencia);
            }
            sinExistencia = document.createElement('p');
            sinExistencia.textContent = 'Ningun Asistencia Cumple con esas Caracteristicas, Intente con Otras Caracteristicas.';
            main.appendChild(sinExistencia);
        }

    }

    function limpiarHTML() {
        while (funcionarios.firstChild) {
            funcionarios.removeChild(funcionarios.firstChild);
        }
    }

    filtrarFuncionarios();

})