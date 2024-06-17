import { paginas, tablaPaginacion } from '../../herramientas/paginacion.js';

document.addEventListener("DOMContentLoaded", function() {
    // Agregar eventos después de cargar el DOM
    try {
        document.getElementById('Genero').addEventListener('change', filtro);
        document.getElementById('Parcelas').addEventListener('change', filtro);
        document.getElementById('Insecticida').addEventListener('change', filtro);
        document.getElementById('pulsar').addEventListener('click', filtroOcultar);
        document.getElementById('limpiar').addEventListener('click', filtroLimpiar);
    } catch (error) {
        console.error("Error al configurar los eventos:", error);
    }

    function receta() {
        try {
            // Obtener valores de los filtros
            let searchGenero = document.getElementById('GeneroInsertar').value;
            let searchParcelas = document.getElementById('Parcelas').value;
            let searchInsecticida = document.getElementById('Insecticida').value;
            let table = document.getElementById('myTable');
            let rows = table.getElementsByTagName('tr');

            // Verificar si se ha seleccionado un género
            if (searchGenero != 'Elige...') {
                document.getElementById("cultivo").innerHTML = searchGenero.toLowerCase();
                table.classList.remove('oculto');

                // Iterar sobre las filas de la tabla y aplicar filtros
                for (let i = 1; i < rows.length; i++) {
                    let cells = rows[i].getElementsByTagName('td');
                    let genero = cells[0].textContent;
                    let shouldDisplay = true;

                    if (searchGenero !== 'Elige...' && genero.indexOf(searchGenero) === -1) {
                        shouldDisplay = false;
                    }
                    if (searchParcelas !== 'Elige...' && parcelas.indexOf(searchParcelas) === -1) {
                        shouldDisplay = false;
                    }
                    if (searchInsecticida !== 'Elige...' && temporadas.indexOf(searchInsecticida) === -1) {
                        shouldDisplay = false;
                    }

                    // Mostrar u ocultar las filas según los filtros
                    if (!shouldDisplay) {
                        rows[i].classList.add('oculto');
                    } else {
                        rows[i].classList.remove('oculto');
                    }
                }
            } else {
                table.classList.add('oculto');
                document.getElementById("cultivo").innerHTML = '';
            }
        } catch (error) {
            console.error("Error en la función receta:", error);
        }
    }

    function filtro() {
        try {
            // Obtener valores de los filtros
            let searchGenero = document.getElementById('Genero').value;
            let searchParcelas = document.getElementById('Parcelas').value;
            let searchInsecticida = document.getElementById('Insecticida').value;

            let table = document.getElementById('myTable');
            let rows = table.getElementsByTagName('tr');

            // Iterar sobre las filas de la tabla y aplicar filtros
            for (let i = 1; i < rows.length; i++) {
                let cells = rows[i].getElementsByTagName('td');
                let genero = cells[0].textContent;
                let parcelas = cells[1].textContent;
                let insecticida = cells[3].textContent;
                let shouldDisplay = true;

                if (searchGenero !== 'Elige...' && genero.indexOf(searchGenero) === -1) {
                    shouldDisplay = false;
                }
                if (searchParcelas !== 'Elige...' && parcelas.indexOf(searchParcelas) === -1) {
                    shouldDisplay = false;
                }
                if (searchInsecticida !== 'Elige...' && insecticida.indexOf(searchInsecticida) === -1) {
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
            document.getElementById('Genero').value = "Elige...";
            document.getElementById('Parcelas').value = "Elige...";
            document.getElementById('Insecticida').value = "Elige...";
            filtro();
        } catch (error) {
            console.error("Error en la función filtroLimpiar:", error);
        }
    }
});
