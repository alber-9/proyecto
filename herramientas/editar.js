document.addEventListener("DOMContentLoaded", function() {
    let celdas = document.querySelectorAll('td');
    let botonesEliminar = document.querySelectorAll('.eliminar-fila');
    
    celdas.forEach(function(celda) {
        celda.addEventListener('dblclick', function(event) {
            try {
                let fila = this.parentNode;

                if (!fila.classList.contains('editar')) {
                    fila.classList.add('editar');
                }

                let indiceCelda = Array.from(fila.children).indexOf(this);
                let nombreColumna = document.querySelector('th:nth-child(' + (indiceCelda + 1) + ')').textContent;
                let nombreTabla = document.getElementById('myTable').dataset.tabla;
                let noEditables = true;

                // Determinar si la celda es editable según la tabla y la columna
                switch (nombreTabla) {
                    case "Cultivos":
                        if (nombreColumna === 'Parcela' || nombreColumna === 'Genero' || nombreColumna === 'Temporada') {
                            noEditables = false;
                        }
                        break;
                    case "abonado":
                        if (nombreColumna === 'Parcela' || nombreColumna === 'Fecha') {
                            noEditables = false;
                        }
                        break;
                    case "producto":
                        if (nombreColumna === 'Id' || nombreColumna === 'Empresa' || nombreColumna === 'Genero' || 
                            nombreColumna === 'Fecha' || nombreColumna === 'letiedad' || nombreColumna === 'Total') {
                            noEditables = false;
                        }
                        break;
                    default:
                        break;
                }

                if (noEditables) {
                    if (!this.querySelector('*') && this.textContent.trim() !== '') {
                        let contenidoActual = this.innerHTML.trim();
                        this.innerHTML = '<input type="text" value="' + contenidoActual + '" class="form-control">';
                        let input = this.querySelector('input');
                        input.focus();
                    }

                    if (event.target !== this) {
                        event.stopPropagation();
                    }
                }
            } catch (error) {
                // Manejar errores en el evento de doble clic
            }
        });
    });

    botonesEliminar.forEach(function(boton) {
        boton.addEventListener('click', function() {
            try {
                let fila = this.closest('tr');
                fila.parentNode.removeChild(fila);
            } catch (error) {
                // Manejar errores al eliminar la fila
            }
        });
    });
});
