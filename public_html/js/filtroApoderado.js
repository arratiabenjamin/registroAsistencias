document.addEventListener('DOMContentLoaded', () => {
    const rut = document.querySelector("#rut");
    const nombres = document.querySelector("#nombres");
    const apellidos = document.querySelector("#apellidos");
    const apoderados = document.querySelector("#apoderados");
    const main = document.querySelector("#main");
    let sinExistencia;

    const datosBusqueda = {
        rut: '',
        nombres: '',
        apellidos: ''
    };

    console.log(apoderados);

    const listaApoderados = [];

    // Itera a través de los elementos tr dentro del tbody
    for (const tr of apoderados.children) {
        // Accede a las celdas (td) dentro de cada tr
        const cells = tr.children;

        // Crea un objeto para almacenar los datos de la fila
        const objetoFila = {
            rut: cells[0].textContent,
            nombres: cells[1].textContent,
            apellidos: cells[2].textContent
        };

        // Agrega el objeto a la lista
        listaApoderados.push(objetoFila);
    }

    // Ahora, listaObjetos contiene los datos de cada fila como objetos
    console.log(listaApoderados);

    //Evento se activa por cada cambio de input
    rut.addEventListener('input', () => {
        datosBusqueda.rut = rut.value;
        console.log("HELLO");
        filtrarApoderados();
    });
    nombres.addEventListener('input', () => {
        datosBusqueda.nombres = nombres.value;
        console.log("HELLO");
        filtrarApoderados();
    });
    apellidos.addEventListener('input', () => {
        datosBusqueda.apellidos = apellidos.value;
        console.log("HELLO");
        filtrarApoderados();
    });

    //Aplica los filtros
    function filtrarApoderados() {
        //Funcion de Alto Nivel: Funcion que Ejecuta a Otra
        const apoderados = listaApoderados.filter(filtrarRut)
                                    .filter(filtrarnombres)
                                    .filter(filtrarapellidos);

        mostrarApoderados(apoderados);
    }

    //Filtros
    function filtrarRut(apoderado) {
        const {
            rut
        } = datosBusqueda;
        if (rut) return apoderado.rut.includes(rut);
        return apoderado
    }
    function filtrarnombres(apoderado) {
        const {
            nombres
        } = datosBusqueda;
        if (nombres) {
            let nombresBusqueda = nombres.split(' ');
            let nombresApoderado = apoderado.nombres.split(' ');

            nombresBusqueda = nombresBusqueda.map(item => item.toLowerCase());
            nombresApoderado = nombresApoderado.map(item => item.toLowerCase());

            if(nombresApoderado[1]){
                if(nombresApoderado[0].includes(nombresBusqueda[0]) || nombresApoderado[0].includes(nombresBusqueda[1]) || nombresApoderado[1].includes(nombresBusqueda[0]) || nombresApoderado[1].includes(nombresBusqueda[1])) return true;
                else return false;
            }else{
                if(nombresApoderado[0].includes(nombresBusqueda[0]) || nombresApoderado[0].includes(nombresBusqueda[1])) return true;
                else return false;            
            }
            
            
        }
        return apoderado
    }
    function filtrarapellidos(apoderado) {
        const {
            apellidos
        } = datosBusqueda;
        if (apellidos) {
            let apellidosBusqueda = apellidos.split(' ');
            let apellidosApoderado = apoderado.apellidos.split(' ');

            apellidosBusqueda = apellidosBusqueda.map(item => item.toLowerCase());
            apellidosApoderado = apellidosApoderado.map(item => item.toLowerCase());

            if(apellidosApoderado[1]){
                if(apellidosApoderado[0].includes(apellidosBusqueda[0]) || apellidosApoderado[0].includes(apellidosBusqueda[1]) || apellidosApoderado[1].includes(apellidosBusqueda[0]) || apellidosApoderado[1].includes(apellidosBusqueda[1])) return true;
                else return false;
            }else{
                if(apellidosApoderado[0].includes(apellidosBusqueda[0]) || apellidosApoderado[0].includes(apellidosBusqueda[1])) return true;
                else return false;            
            }
        }
        return apoderado
    }


    //funciones
    function mostrarApoderados(listaApoderados) {

        limpiarHTML();
        if(main.querySelector('p')){
            main.querySelector('p').textContent = '';
        }

        if (listaApoderados.length) {
            listaApoderados.forEach(apoderado => {
                const {
                    rut,
                    nombres,
                    apellidos
                } = apoderado;
                const apoderadoHTML = document.createElement('tr');
                apoderadoHTML.classList.add('row');

                const newApoderado = `
                    <td class="cell pl">${rut}</td>
                    <td class="cell">${nombres}</td>
                    <td class="cell h">${apellidos}</td>
                    <td class="action cell">

                    <a href="/admin/apoderado/actualizar?id=${rut}">
                    <input class="btn-action actualizar" type="button" value="Editar" />
                </a>

                <form method="POST" action="apoderado/eliminar">
                    <input class="btn-action eliminar" type="submit" value="Eliminar" />
                    <input type="hidden" name="id" value="${rut}" />
                    <input type="hidden" name="entidad" value="apoderado" />
                </form>
                    </td>
            `;

            apoderadoHTML.insertAdjacentHTML('beforeend', newApoderado);

                apoderados.appendChild(apoderadoHTML);

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
        while (apoderados.firstChild) {
            apoderados.removeChild(apoderados.firstChild);
        }
    }

    //Al cargar por completo el documento se filtra
    //para mostrar de cierta forma los registros
    filtrarApoderados();

})