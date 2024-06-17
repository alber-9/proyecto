

export function paginas(nombre, id) {
    let table = document.getElementById(nombre);
    let rows = table.getElementsByTagName('tr');
    id = id.slice(1);
    let cantidad = 0;

    // Añadir la clase 'paguina' a todas las filas, excepto la primera
    for (let i = 1; i < rows.length; i++) {
        rows[i].classList.add('paguina');
    }

    // Mostrar el grupo de filas correspondiente al ID actual
    for (let i = (id - 1) * 5 + 1; i < rows.length && cantidad < 5; i++) {
        let row = rows[i];
        if (!row.classList.contains('oculto')) {
            row.classList.remove('paguina');
            cantidad++;
        }
    }

    // Mostrar siempre la primera fila (encabezado)
    rows[0].classList.remove('paguina');

    // Llamar a la función para actualizar la paginación de la tabla
    tablaPaginacion(nombre, nombre.charAt(0) + id);
}

export function tablaPaginacion(nombre, id) {
    let table = document.getElementById(nombre);
    let rows = table.getElementsByTagName('tr');
    let cantidad = 0;

    // Contar cuántas filas no tienen la clase 'oculto'
    for (let i = 1; i < rows.length; i++) {
        if (!rows[i].classList.contains('oculto')) {
            cantidad++;
        }
    }

    let tabla = `<ul class="pagination align-items-center justify-content-center">`;
    id = id.slice(1);
    let ultimo = Math.ceil(cantidad / 5);

    // Generar los elementos de la paginación
    if (cantidad > 5) {
        for (let i = 1; i <= ultimo; i++) {
            if (id == i) {
                tabla += `<li class="page-item"><a id="${nombre.charAt(0)}${i}" class="page-link active">${i}</a></li>`;
            } else if (1 == i || (+id + 1) == i || (+id - 1) == i || ultimo == i) {
                tabla += `<li class="page-item"><a id="${nombre.charAt(0)}${i}" class="page-link">${i}</a></li>`;
            } else {
                tabla += `<li class="page-item"><a id="${nombre.charAt(0)}${i}" class="page-link oculto">${i}</a></li>`;
            }
        }
    }

    tabla += `</ul>`;

    // Actualizar el elemento de paginación en el DOM
    document.getElementById(nombre + "Page").innerHTML = tabla;
}
