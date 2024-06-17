<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombreDeLaTabla = $_POST['tabla'];
    $condiciones = [];
    $valores = [];

    // Validar el nombre de la tabla para evitar inyección SQL
    if (!preg_match('/^[a-zA-Z0-9_]+$/', $nombreDeLaTabla)) {
        echo json_encode(["status" => "error", "message" => "Nombre de tabla inválido"]);
        exit;
    }

    foreach ($_POST as $clave => $valor) {
        if ($clave != 'tabla') {
            $condiciones[] = "$clave = ?";
            $valores[] = $valor;
        }
    }

    if (count($condiciones) == 0) {
        echo json_encode(["status" => "error", "message" => "No se proporcionaron condiciones para la eliminación"]);
        exit;
    }

    $sql = "DELETE FROM $nombreDeLaTabla WHERE " . implode(' AND ', $condiciones);

    if ($stmt = $conn->prepare($sql)) {
        $tipos = str_repeat('s', count($valores));
        $stmt->bind_param($tipos, ...$valores);

        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Fila eliminada correctamente"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error al eliminar la fila: " . $stmt->error]);
        }
        $stmt->close();
    } else {
        echo json_encode(["status" => "error", "message" => "Error al preparar la consulta: " . $conn->error]);
    }

    $conn->close();
}
?>
