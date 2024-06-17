<?php
include 'conexion.php';

function generarTabla($sql, $nombreDeLaTabla, $clavePrimaria) {
    global $conn;

    $result = $conn->query($sql);

    echo '<div class="m-5">';
    if ($result->num_rows > 0) {
        // Añadir la clase 'table-responsive' para que la tabla sea responsive
        echo "<div class='table-responsive'>";
        echo "<table id='myTable' data-tabla='". $nombreDeLaTabla ."' class='table table-striped table-bordered'>";
        echo '<thead>';
        echo '<tr>';
        $columnas = $result->fetch_fields();
        foreach ($columnas as $columna) {
            echo '<th scope="col">' . $columna->name . '</th>';
        }
        echo '<th scope="col">Acción</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            $identificadores = [];
            foreach ($columnas as $columna) {
                $nombreColumna = $columna->name;
                $valor = $row[$nombreColumna];
                if ($nombreColumna == 'Hecho') {
                    $checked = $valor ? 'checked' : '';
                    echo '<td><input type="checkbox" class="hecho-checkbox" ' . $checked . ' disabled></td>';
                } else {
                    if (is_numeric($valor) && intval($valor) == floatval($valor)) {
                        echo '<td>' . intval($valor) . '</td>';
                    } else {
                        echo '<td>' . $valor . '</td>';
                    }
                }
                if (in_array($nombreColumna, $clavePrimaria)) {
                    $identificadores[$nombreColumna] = $valor;
                }
            }
            $idDataAttributes = '';
            foreach ($identificadores as $key => $value) {
                $idDataAttributes .= 'data-' . strtolower($key) . '="' . $value . '" ';
            }
            echo '<td>';
            echo '<button class="btn btn-danger delete-btn" ' . $idDataAttributes . '>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
            </svg>
            </button>';
            echo '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
        echo '</div>'; // Cerrar el div 'table-responsive'
    } else {
        echo "No se encontraron datos en la tabla " . $nombreDeLaTabla;
    }
    echo '</div>';
}
?>



<script>

document.addEventListener("DOMContentLoaded", function() {
    let deleteRow;
    let deleteData;

    const deleteBtns = document.querySelectorAll('.delete-btn');
    deleteBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            deleteRow = this.closest('tr');
            deleteData = { tabla: document.getElementById('myTable').getAttribute('data-tabla') };

            Array.from(this.attributes).forEach(attr => {
                if (attr.name.startsWith('data-')) {
                    let key = attr.name.substring(5);
                    deleteData[key] = attr.value;
                }
            });

            // Abrir el modal de confirmación
            document.getElementById('confirmModal').style.display = 'block';
        });
    });

    document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
        // Realizar la eliminación
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '/herramientas/eliminar_fila.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                const data = JSON.parse(xhr.responseText);
                if (data.status === 'success') {
                    deleteRow.remove();
                    document.getElementById('alertModalBody').textContent = data.message;
                    document.getElementById('alertModal').style.display = 'block';
                } else {
                    document.getElementById('alertModalBody').textContent = data.message;
                    document.getElementById('alertModal').style.display = 'block';
                }
                window.location.reload();
            }
        };
        xhr.onerror = function() {
            document.getElementById('alertModalBody').textContent = 'Error al realizar la solicitud.';
            document.getElementById('alertModal').style.display = 'block';
        };
        const params = new URLSearchParams(deleteData).toString();
        xhr.send(params);

        // Cerrar el modal de confirmación
        document.getElementById('confirmModal').style.display = 'none';
    });
});


</script>
