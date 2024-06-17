import { paginas, tablaPaginacion } from '../../herramientas/paginacion.js';

document.addEventListener("DOMContentLoaded", function() {
    // Agregar eventos después de cargar el DOM
    try {
        document.getElementById('Empresa').addEventListener('change', filtro);
        document.getElementById('Genero').addEventListener('change', filtro);
        document.getElementById('FechaDesde').addEventListener('change', filtro);
        document.getElementById('FechaHasta').addEventListener('change', filtro);
        document.getElementById('variedad').addEventListener('change', filtro);
        document.getElementById('pulsar').addEventListener('click', filtroOcultar);
        document.getElementById('limpiar').addEventListener('click', filtroLimpiar);
    } catch (error) {
        console.error("Error al configurar los eventos:", error);
    }

    function filtro() {
        try {
            // Obtener valores de los filtros
            let searchEmpresa = document.getElementById('Empresa').value;
            let searchGenero = document.getElementById('Genero').value;
            let searchFechaDesde = document.getElementById('FechaDesde').value;
            let searchFechaHasta = document.getElementById('FechaHasta').value;
            let searchletiedad = document.getElementById('variedad').value;

            let table = document.getElementById('myTable');
            let rows = table.getElementsByTagName('tr');

            // Iterar sobre las filas de la tabla y aplicar filtros
            for (let i = 1; i < rows.length; i++) {
                let cells = rows[i].getElementsByTagName('td');
                let empresa = cells[1].textContent;
                let genero = cells[2].textContent;
                let fecha = cells[3].textContent;
                let variedad = cells[4].textContent;
                let shouldDisplay = true;

                // Convertir la fecha de la fila y las fechas de filtro a objetos Date
                let rowDate = new Date(fecha);
                let filterDateDesde = searchFechaDesde ? new Date(searchFechaDesde) : null;
                let filterDateHasta = searchFechaHasta ? new Date(searchFechaHasta) : null;

                // Aplicar filtros de empresa, género, fechas y variedad
                if (searchEmpresa !== 'Elige...' && empresa.indexOf(searchEmpresa) === -1) {
                    shouldDisplay = false;
                }

                if (searchGenero !== 'Elige...' && genero.indexOf(searchGenero) === -1) {
                    shouldDisplay = false;
                }

                if (filterDateDesde && rowDate < filterDateDesde) {
                    shouldDisplay = false;
                }

                if (filterDateHasta && rowDate > filterDateHasta) {
                    shouldDisplay = false;
                }

                if (searchletiedad !== 'Elige...' && variedad.indexOf(searchletiedad) === -1) {
                    shouldDisplay = false;
                }

                // Mostrar u ocultar las filas según los filtros
                if (!shouldDisplay) {
                    rows[i].classList.add('oculto');
                } else {
                    rows[i].classList.remove('oculto');
                }
            }

            // Actualizar paginación después de aplicar los filtros
            paginas("myTable", "m1");
        } catch (error) {
            console.error("Error en la función filtro:", error);
        }
    }

    function filtroOcultar() {
        try {
            // Ocultar o mostrar el párrafo de filtro
            let parrafo = document.getElementById("filtro");
            let displayValue = window.getComputedStyle(parrafo).getPropertyValue("display");
            parrafo.style.display = displayValue === "none" ? "block" : "none";
        } catch (error) {
            console.error("Error en la función filtroOcultar:", error);
        }
    }

    function filtroLimpiar() {
        try {
            // Restablecer valores de los filtros y aplicar filtros
            document.getElementById('Empresa').value = "Elige...";
            document.getElementById('Genero').value = "Elige...";
            document.getElementById('FechaHasta').value = '';
            document.getElementById('FechaDesde').value = '';
            document.getElementById('variedad').value = "Elige...";
            filtro();
        } catch (error) {
            console.error("Error en la función filtroLimpiar:", error);
        }
    }
});
