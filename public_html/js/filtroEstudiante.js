document.addEventListener('DOMContentLoaded', () => {
    const rut = document.querySelector("#rut");
    const nombres = document.querySelector("#nombresEstudiante");
    const apellidos = document.querySelector("#apellidosEstudiante");
    const curso = document.querySelector("#curso");
    const rutApoderado = document.querySelector("#rutApoderado");

    const estudiantes = document.querySelector("#estudiantes");
    const main = document.querySelector("#main");
    let sinExistencia;

    const datosBusqueda = {
        rut: '',
        nombres: '',
        apellidos: '',
        curso: '',
        rutApoderado: ''
    };

    console.log(estudiantes);

    const listaEstudiantes = [];

    // Itera a través de los elementos tr dentro del tbody
    for (const tr of estudiantes.children) {
        // Accede a las celdas (td) dentro de cada tr
        const cells = tr.children;

        // Crea un objeto para almacenar los datos de la fila
        const objetoFila = {
            rut: cells[0].textContent,
            nombres: cells[1].textContent,
            apellidos: cells[2].textContent,
            curso: cells[3].textContent,
            rutApoderado: cells[4].textContent,
        };

        // Agrega el objeto a la lista
        listaEstudiantes.push(objetoFila);
    }

    // Ahora, listaObjetos contiene los datos de cada fila como objetos
    console.log(listaEstudiantes);

    rut.addEventListener('input', () => {
        datosBusqueda.rut = rut.value;
        console.log("HELLO");
        filtrarEstudiantes();
    });
    nombres.addEventListener('input', () => {
        datosBusqueda.nombres = nombres.value;
        console.log("HELLO");
        filtrarEstudiantes();
    });
    apellidos.addEventListener('input', () => {
        datosBusqueda.apellidos = apellidos.value;
        console.log("HELLO");
        filtrarEstudiantes();
    });
    curso.addEventListener('input', () => {
        datosBusqueda.curso = curso.value;
        console.log("HELLO");
        filtrarEstudiantes();
    });
    rutApoderado.addEventListener('input', () => {
        datosBusqueda.rutApoderado = rutApoderado.value;
        console.log("HELLO");
        filtrarEstudiantes();
    });

    function filtrarEstudiantes() {
        //Funcion de Alto Nivel: Funcion que Ejecuta a Otra
        const estudiantes = listaEstudiantes.filter(filtrarRut)
                                    .filter(filtrarnombres)
                                    .filter(filtrarapellidos)
                                    .filter(filtrarCurso)
                                    .filter(filtrarRutApoderado);

        mostrarEstudiantes(estudiantes);
    }

    function filtrarRut(estudiante) {
        const {
            rut
        } = datosBusqueda;
        if (rut)return estudiante.rut.includes(rut);
        
        return estudiante
    }
    function filtrarnombres(estudiante) {
        const {
            nombres
        } = datosBusqueda;
        if (nombres) {
            let nombresBusqueda = nombres.split(' ');
            let nombresEstudiante = estudiante.nombres.split(' ');

            nombresBusqueda = nombresBusqueda.map(item => item.toLowerCase());
            nombresEstudiante = nombresEstudiante.map(item => item.toLowerCase());
            
            //console.log(nombresEstudiante);
            
            if(nombresEstudiante[0].includes(nombresBusqueda[0]) || nombresEstudiante[1].includes(nombresBusqueda[1]) || nombresEstudiante[1].includes(nombresBusqueda[0]) || nombresEstudiante[1].includes(nombresBusqueda[1])) return true;
            else return false;
        }
        return estudiante
    }
    function filtrarapellidos(estudiante) {
        const {
            apellidos
        } = datosBusqueda;
        if (apellidos) {
            let apellidosBusqueda = apellidos.split(' ');
            let apellidosEstudiante = estudiante.apellidos.split(' ');

            apellidosBusqueda = apellidosBusqueda.map(item => item.toLowerCase());
            apellidosEstudiante = apellidosEstudiante.map(item => item.toLowerCase());

            if(apellidosEstudiante[0].includes(apellidosBusqueda[0]) || apellidosEstudiante[0].includes(apellidosBusqueda[1]) || apellidosEstudiante[1].includes(apellidosBusqueda[0]) || apellidosEstudiante[1].includes(apellidosBusqueda[1])) return true;
            else return false;
        }
        return estudiante
    }
    function filtrarCurso(estudiante) {
        const {
            curso
        } = datosBusqueda;
        if (curso) return estudiante.curso.toLowerCase().includes(curso.toLowerCase());
    
        return estudiante
    }
    function filtrarRutApoderado(estudiante) {
        const {
            rutApoderado
        } = datosBusqueda;
        if (rutApoderado) return estudiante.rutApoderado.includes(rutApoderado);
        return estudiante
    }

    //funciones
    function mostrarEstudiantes(listaEstudiantes) {

        limpiarHTML();
        if(main.querySelector('p')){
            main.querySelector('p').textContent = '';
        }

        if (listaEstudiantes.length) {
            listaEstudiantes.forEach(estudiante => {
                const {
                    rut,
                    nombres,
                    apellidos,
                    curso,
                    rutApoderado
                } = estudiante;
                const estudianteHTML = document.createElement('tr');
                estudianteHTML.classList.add('row');

                const newEstudiante = `
                    <td class="cell pl">${rut}</td>
                    <td class="cell">${nombres}</td>
                    <td class="cell h">${apellidos}</td>
                    <td class="cell">${curso}</td>
                    <td class="cell">${rutApoderado}</td>
                    <td class="action cell">

                    <a href="/admin/estudiante/actualizar?id=${rut}">
                    <input class="btn-action actualizar" type="button" value="Editar" />
                </a>

                <form method="POST" action="estudiante/eliminar">
                    <input class="btn-action eliminar" type="submit" value="Eliminar" />
                    <input type="hidden" name="id" value="${rut}" />
                    <input type="hidden" name="entidad" value="estudiante" />
                </form>
                    </td>
            `;

            estudianteHTML.insertAdjacentHTML('beforeend', newEstudiante);

                estudiantes.appendChild(estudianteHTML);

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
        while (estudiantes.firstChild) {
            estudiantes.removeChild(estudiantes.firstChild);
        }
    }

    filtrarEstudiantes();

})