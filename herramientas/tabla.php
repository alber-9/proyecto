<?php
    // Consulta para obtener los datos de la tabla Cultivos
    $result = $conn->query($sql);

    // Verificar si se encontraron resultados
    echo '<div class="m-5">';
    $fieldInfo = $result->fetch_field();

    // Obtener el nombre de la tabla
    $nombreDeLaTabla = $fieldInfo->table;
    //echo "El nombre de la tabla es: " . $nombreDeLaTabla . "<br>";
    if ($result->num_rows > 0) {
        echo "<table id='myTable' data-tabla='". $nombreDeLaTabla."' class='table table-striped'>";
        echo '<thead>';
        echo '<tr>';
        // Obtener los nombres de las columnas
        $columnas = $result->fetch_fields();
        foreach ($columnas as $columna) {
            echo '<th scope="col">' . $columna->name . '</th>';
        }
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        // Iterar sobre los resultados y mostrar cada fila en la tabla
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            foreach ($columnas as $columna) {
                $nombreColumna = $columna->name;
                $valor = $row[$nombreColumna];
                if ($nombreColumna == 'Hecho') {
                    // Si la columna es 'hecho', poner un checkbox
                    $checked = $valor ? 'checked' : '';
                    echo '<td><input type="checkbox" class="hecho-checkbox" ' . $checked . ' disabled></td>';
                } else {
                    // Verificar si el valor es un número y si es entero
                    if (is_numeric($valor) && intval($valor) == floatval($valor)) {
                        // Es un número entero, mostrar sin decimales
                        echo '<td>' . intval($valor) . '</td>';
                    } else {
                        // No es un número entero, mostrar tal cual
                        echo '<td>' . $valor . '</td>';
                    }
                }
            }
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    } else {
        echo "No se encontraron datos en la tabla";
    }

    echo '</div>';
?>
