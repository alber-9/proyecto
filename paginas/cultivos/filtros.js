import { paginas, tablaPaginacion } from '../../herramientas/paginacion.js';

document.getElementById('Genero').addEventListener('change', filtro);
document.getElementById('Parcelas').addEventListener('change', filtro);
document.getElementById('Temporadas').addEventListener('change', filtro);

function filtro() {
    try {
        // Obtener los valores seleccionados de los filtros
        let searchGenero = document.getElementById('Genero').value;
        let searchParcelas = document.getElementById('Parcelas').value;
        let searchTemporadas = document.getElementById('Temporadas').value;

        // Obtener la tabla y las filas
        let table = document.getElementById('myTable');
        let rows = table.getElementsByTagName('tr');

        // Iterar sobre las filas de la tabla
        for (let i = 1; i < rows.length; i++) {
            let cells = rows[i].getElementsByTagName('td');
            let genero = cells[0].textContent;
            let parcelas = cells[1].textContent;
            let temporadas = cells[2].textContent;
            let shouldDisplay = true;

            // Verificar si cada fila debe mostrarse según los filtros aplicados
            if (searchGenero !== 'Elige...' && genero.indexOf(searchGenero) === -1) {
                shouldDisplay = false;
            }

            if (searchParcelas !== 'Elige...' && parcelas.indexOf(searchParcelas) === -1) {
                shouldDisplay = false;
            }

            if (searchTemporadas !== 'Elige...' && temporadas.indexOf(searchTemporadas) === -1) {
                shouldDisplay = false;
            }

            // Mostrar u ocultar la fila según el resultado del filtro
            if (!shouldDisplay) {
                rows[i].classList.add('oculto');
            } else {
                rows[i].classList.remove('oculto');
            }
        }

        // Actualizar la paginación después de aplicar los filtros
        paginas("myTable", "m1");
    } catch (error) {
        console.error("Error en la función filtro:", error);
    }
}

document.addEventListener("DOMContentLoaded", function() {
    try {
        // Agregar evento para ocultar o mostrar el filtro
        document.getElementById('pulsar').addEventListener('click', filtroOcultar);

        function filtroOcultar() {
            try {
                let parrafo = document.getElementById("filtro");
                let displayValue = window.getComputedStyle(parrafo).getPropertyValue("display");
                if (displayValue === "none") {
                    parrafo.style.display = "block";
                } else {
                    parrafo.style.display = "none";
                }
            } catch (error) {
                console.error("Error en la función filtroOcultar:", error);
            }
        }

        // Agregar evento para limpiar los filtros
        document.getElementById('limpiar').addEventListener('click', filtroLimpiar);

        function filtroLimpiar() {
            try {
                // Restablecer los valores de los filtros
                document.getElementById('Temporadas').value = "Elige...";
                document.getElementById('Genero').value = "Elige...";
                document.getElementById('Parcelas').value = "Elige...";
                // Aplicar los filtros nuevamente después de limpiar
                filtro();
            } catch (error) {
                console.error("Error en la función filtroLimpiar:", error);
            }
        }
    } catch (error) {
        console.error("Error al configurar los eventos de la página:", error);
    }
});
