document.addEventListener('DOMContentLoaded', () => {
    const id = document.querySelector("#id");
    const rutEstudiante = document.querySelector("#rutEstudiante");
    const nombresApellidos = document.querySelector("#nombresApellidos");
    const curso = document.querySelector("#curso");
    const fecha = document.querySelector("#fecha");
    const horaMin = document.querySelector("#horaMin");
    const horaMax = document.querySelector("#horaMax");

    const asistencias = document.querySelector("#asistencias");
    const main = document.querySelector("#main");
    let sinExistencia;

    const datosBusqueda = {
        id: '',
        rutEstudiante: '',
        nombresApellidos: '',
        curso: '',
        fecha: '',
        horaMin: '',
        horaMax: ''
    };

    console.log(asistencias);

    const listaAsistencias = [];

    // Itera a través de los elementos tr dentro del tbody
    for (const tr of asistencias.children) {
        // Accede a las celdas (td) dentro de cada tr
        const cells = tr.children;
        
        const nombresApellidos = cells[4].innerHTML.split("<br>");
        
        // Crea un objeto para almacenar los datos de la fila
        const objetoFila = {
            id: cells[0].textContent,
            fecha: cells[1].textContent,
            hora: cells[2].textContent,
            rutEstudiante: cells[3].textContent,
            nombresApellidos: nombresApellidos[0] + "<br>" + nombresApellidos[1],
            curso: cells[5].textContent,
            comentario: cells[6].textContent
        };
        
        // Agrega el objeto a la lista
        listaAsistencias.push(objetoFila);
    }

    // Ahora, listaObjetos contiene los datos de cada fila como objetos
    console.log(listaAsistencias);

    id.addEventListener('input', () => {
        datosBusqueda.id = id.value;
        console.log("HELLO");
        filtrarAsistencia();
    });
    rutEstudiante.addEventListener('input', () => {
        datosBusqueda.rutEstudiante = rutEstudiante.value;
        console.log("HELLO");
        filtrarAsistencia();
    });
    nombresApellidos.addEventListener('input', () => {
        datosBusqueda.nombresApellidos = nombresApellidos.value;
        console.log("HELLO");
        filtrarAsistencia();
    });
    curso.addEventListener('input', () => {
        datosBusqueda.curso = curso.value;
        console.log("HELLO");
        filtrarAsistencia();
    });
    fecha.addEventListener('input', () => {
        datosBusqueda.fecha = fecha.value;
        console.log("HELLO");
        filtrarAsistencia();
    });
    horaMin.addEventListener('input', () => {
        datosBusqueda.horaMin = horaMin.value;
        console.log("HELLO");
        filtrarAsistencia();
    });
    horaMax.addEventListener('input', () => {
        datosBusqueda.horaMax = horaMax.value;
        console.log("HELLO");
        filtrarAsistencia();
    });

    function filtrarAsistencia() {
        //Funcion de Alto Nivel: Funcion que Ejecuta a Otra
        const asistencias = listaAsistencias.filter(filtrarId)
                                    .filter(filtrarRutEstudiante)
                                    .filter(filtrarNombresApellidos)
                                    .filter(filtrarCurso)
                                    .filter(filtrarFecha)
                                    .filter(filtrarHoraMin)
                                    .filter(filtrarHoraMax);

        mostrarAsistencias(asistencias);
    }

    function filtrarId(asistencia) {
        const {
            id
        } = datosBusqueda;
        if (id) return asistencia.id.includes(id);
        return asistencia
    }
    function filtrarRutEstudiante(asistencia) {
        const {
            rutEstudiante
        } = datosBusqueda;
        if (rutEstudiante) return asistencia.rutEstudiante.includes(rutEstudiante);
        return asistencia
    }
    function filtrarNombresApellidos(asistencia) {
        const {
            nombresApellidos
        } = datosBusqueda;
        if (nombresApellidos) return asistencia.nombresApellidos.toLowerCase().includes(nombresApellidos.toLowerCase());
        return asistencia
    }
    function filtrarCurso(asistencia) {
        const {
            curso
        } = datosBusqueda;
        if (curso) return asistencia.curso.includes(curso);
        return asistencia
    }
    function filtrarComentario(asistencia) {
        const {
            comentario
        } = datosBusqueda;
        if (comentario) return asistencia.comentario.includes(comentario);
        return asistencia
    }
    function filtrarFecha(asistencia) {
        const {
            fecha
        } = datosBusqueda;
        if (fecha) {
            datos = asistencia.fecha.split('-');

            if(fecha === datos[1] || fecha === datos[1] + '/' + datos[2]) return true;
            return asistencia.fecha === fecha;
        }
        return asistencia
    }
    function filtrarHoraMin(asistencia) {
        const {
            horaMin
        } = datosBusqueda;
        if (horaMin) {

            let datosAsistencia = asistencia.hora.split(':');
            console.log("Obtenida:" +datosAsistencia);
            let datosBusqueda = horaMin.split(':');
            console.log("Buscada: "+datosBusqueda);

            let horaAsistencia = parseFloat(datosAsistencia[0]+"."+datosAsistencia[1]);
            let horaBuscada = parseFloat(datosBusqueda[0]+"."+datosBusqueda[1]);
            console.log(horaAsistencia);

            return horaAsistencia >= horaBuscada;


            // if(hora.length === 1 || hora[1] === ''){
            //     if(horaBuscada.getHours() <= horaAsistencia.getHours()) return true;
            //     else return false;
            // }else if(hora.length === 2 && hora[1] != ''){
            //     horaBuscada.setMinutes(parseInt(hora[1]));
            //     if(horaBuscada.getTime() <= horaAsistencia.getTime()) return true;
            //     else return false;
            // }

        }
        return asistencia
    }
    function filtrarHoraMax(asistencia) {
        const {
            horaMax
        } = datosBusqueda;
        if (horaMax) {

            let datosAsistencia = asistencia.hora.split(':');
            console.log("Obtenida:" +datosAsistencia);
            let datosBusqueda = horaMax.split(':');
            console.log("Buscada: "+datosBusqueda);

            let horaAsistencia = parseFloat(datosAsistencia[0]+"."+datosAsistencia[1]);
            let horaBuscada = parseFloat(datosBusqueda[0]+"."+datosBusqueda[1]);
            console.log(horaAsistencia);

            return horaAsistencia <= horaBuscada;


        }
        return asistencia
    }

    //funciones
    function mostrarAsistencias(listaAsistencias) {

        limpiarHTML();
        if(main.querySelector('p')){
            main.querySelector('p').textContent = '';
        }

        if (listaAsistencias.length) {
            listaAsistencias.forEach(asistencia => {
                const {
                    id,
                    fecha,
                    hora,
                    rutEstudiante,
                    nombresApellidos,
                    curso,
                    comentario
                } = asistencia;
                
                console.log(asistencia)
                const nuevaHora = hora.split(':');
                const asistenciaHTML = document.createElement('tr');
                
                let nuevaFecha = fecha.split('-');
                
                asistenciaHTML.classList.add('row');

                const newAsistencia = `
                    <td class="cell pl">${id}</td>
                    <td class="cell">${nuevaFecha[1] + '/' + nuevaFecha[2]}</td>
                    <td class="cell h">${nuevaHora[0] + ':' + nuevaHora[1]}</td>
                    <td class="cell">${rutEstudiante}</td>
                    <td class="cell">${nombresApellidos}</td>
                    <td class="cell">${curso}</td>
                    <td class="cell">${comentario}</td>
                    <td class="action cell">

                        <a href="/admin/asistencia/actualizar?id=${id}">
                            <input class="btn-action actualizar" type="button" value="Editar" />
                        </a>

                        <form method="POST" action="asistencia/eliminar">
                            <input class="btn-action eliminar" type="submit" value="Eliminar" />
                            <input type="hidden" name="id" value="${id}" />
                            <input type="hidden" name="entidad" value="asistencia" />
                        </form>
                    </td>
            `;

            asistenciaHTML.insertAdjacentHTML('beforeend', newAsistencia);

                asistencias.appendChild(asistenciaHTML);

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
        while (asistencias.firstChild) {
            asistencias.removeChild(asistencias.firstChild);
        }
    }

    filtrarAsistencia();

})