<?php

$result = $conn->query($sql);

// Verificar si se encontraron resultados
if ($result->num_rows > 0) {
    // Obtener los nombres de las columnas
    $columnas = $result->fetch_fields();
    $columna = $columnas[0]->name; // Obtener el nombre de la primera columna

    // Generar las opciones del menú desplegable
    echo "<option selected>Elige...</option>";
    while ($row = $result->fetch_assoc()) {
        echo "<option>" . $row[$columna] . "</option>";
    }
} else {
    echo "<option>No se encontraron estados</option>";
}
?>
