<?php
include 'conexion.php';

if (isset($_POST['tabla']) && isset($_POST['clave']) && isset($_POST['valor']) && isset($_POST['campo'])) {
    $tabla = $_POST['tabla'];
    $campo = $_POST['campo'];
    $clave = json_decode($_POST['clave'], true);
    $valor = $_POST['valor'] === 'true' ? 1 : 0; // Convertir el valor booleano a entero

    // Construir la parte de la consulta WHERE dinámicamente
    $whereClause = [];
    foreach ($clave as $key => $value) {
        $whereClause[] = "$key = '$value'";
    }
    $whereClause = implode(' AND ', $whereClause);

    $sql = "UPDATE $tabla SET $campo = ? WHERE $whereClause";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $valor);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request";
}
?>
