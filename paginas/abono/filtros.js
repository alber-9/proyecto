import { paginas, tablaPaginacion } from '../../herramientas/paginacion.js';

document.addEventListener("DOMContentLoaded", function() {
    try {
        if (window.location.href == "http://localhost/paginas/abono/abono-insertar.php") {
            receta();
            document.getElementById('parcela').addEventListener('change', receta);
        } else {
            document.getElementById('Genero').addEventListener('change', filtro);
            document.getElementById('Parcelas').addEventListener('change', filtro);
            document.getElementById('pulsar').addEventListener('click', filtroOcultar);
            document.getElementById('limpiar').addEventListener('click', filtroLimpiar);
        }
    } catch (error) {
        console.error("Error al configurar los eventos iniciales:", error);
    }

    function receta() {
        try {
            if (document.getElementById('myTable') != null) {
                let selectElement = document.getElementById("parcela");
                let selectedOption = selectElement.options[selectElement.selectedIndex];
                let searchGenero = selectedOption.id;
        
                let table = document.getElementById('myTable');
                let rows = table.getElementsByTagName('tr');
                if (searchGenero != 'Elige...') {
                    document.getElementById("cultivo").innerHTML = searchGenero.toLowerCase();
                    table.classList.remove('oculto');
                    rows[0].getElementsByTagName('th')[0].classList.add('oculto');
                
                    for (let i = 1; i < rows.length; i++) {
                        let cells = rows[i].getElementsByTagName('td');
                        cells[0].classList.add('oculto');
                        let genero = cells[0].textContent;
                        let shouldDisplay = true;
                    
                        if (searchGenero !== 'Elige...' && genero.indexOf(searchGenero) === -1) {
                            shouldDisplay = false;
                        }
                    
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
            }
        } catch (error) {
            console.error("Error en la función receta:", error);
        }
    }

    function filtro() {
        try {
            let searchGenero = document.getElementById('Genero').value;
            let searchParcelas = document.getElementById('Parcelas').value;
            
            let table = document.getElementById('myTable');
            let rows = table.getElementsByTagName('tr');
            
            for (let i = 1; i < rows.length; i++) {
                let cells = rows[i].getElementsByTagName('td');
                let genero = cells[0].textContent;
                let parcelas = cells[1].textContent;
                let shouldDisplay = true;
                
                if (searchGenero !== 'Elige...' && genero.indexOf(searchGenero) === -1) {
                    shouldDisplay = false;
                }
                
                if (searchParcelas !== 'Elige...' && parcelas.indexOf(searchParcelas) === -1) {
                    shouldDisplay = false;
                }

                if (!shouldDisplay) {
                    rows[i].classList.add('oculto');
                } else {
                    rows[i].classList.remove('oculto');
                }
            }
            paginas("myTable", "m1");
        } catch (error) {
            console.error("Error en la función applyFilters:", error);
        }
    }

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

    function filtroLimpiar() {
        try {
            document.getElementById('Genero').value = "Elige...";
            document.getElementById('Parcelas').value = "Elige...";
            applyFilters();
        } catch (error) {
            console.error("Error en la función filtroLimpiar:", error);
        }
    }
});
