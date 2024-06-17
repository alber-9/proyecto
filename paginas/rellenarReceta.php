<?php
// Incluir el archivo de conexión
include '../herramientas/conexion.php';

// Verificar si se ha recibido el valor seleccionado
if (isset($_POST['selectedValue'])) {
    $selectedValue = $_POST['selectedValue'];

    // Construir la consulta SQL
    $sql = "SELECT dia, abono FROM receta WHERE Genero = '$selectedValue'";

    // Ejecutar la consulta
    $result = $conn->query($sql);

    // Verificar el éxito de la consulta
    if ($result && $result->num_rows > 0) {
        // Procesar el resultado de la consulta
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row; // Agregar cada fila al array
        }

        // Devolver los datos como respuesta
        echo json_encode(["success" => true, "result" => $data]);
    } else {
        // Manejar errores de consulta o sin resultados
        echo json_encode(["success" => false, "error" => $conn->error]);
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
} else {
    // Manejar el caso en que no se haya recibido el valor seleccionado
    echo json_encode(["success" => false, "error" => "No selected value received"]);
}
?>
