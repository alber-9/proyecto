<?php
// Incluir el archivo de conexión
include '../../herramientas/conexion.php';

// Configurar el encabezado para manejar la solicitud POST y enviar respuesta en formato JSON
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener el cuerpo de la solicitud y decodificar el JSON
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    // Verificar si hay registros en los datos decodificados
    if (isset($data['registros']) && is_array($data['registros'])) {
        $registros = $data['registros'];

        // Abrir el archivo para escritura
        $archivo = '../../registros/insertar.txt';
        $fileHandle = fopen($archivo, 'a');
        
        if ($fileHandle) {
            // Inicializar un contador de inserciones exitosas
            $successCount = 0;

            // Preparar una consulta preparada para insertar los datos
            $stmt = $conn->prepare("INSERT INTO producto  (empresa, genero, fecha, variedad, kilos, precios) VALUES (?, ?, ?, ?, ?, ?)");

            if ($stmt) {
                $stmt->bind_param('ssssdd', $empresa, $genero, $fecha, $variedad, $kilos, $precios);

                // Recorrer los registros y ejecutarlos
                foreach ($registros as $registro) {
                    $empresa = $registro['empresa'];
                    $genero = $registro['genero'];
                    $fecha = $registro['fecha'];
                    $variedad = $registro['variedad'];
                    $kilos = $registro['kilos'];
                    $precios = $registro['precios'];

                    // Crear la consulta de inserción
                    $consulta = "INSERT INTO producto  (empresa, genero, fecha, variedad, kilos, precios) VALUES ('$empresa', '$genero', '$fecha', '$variedad', $kilos, $precios);\n";
                    
                    // Escribir la consulta en el archivo
                    if (fwrite($fileHandle, $consulta)) {
                        // Ejecutar la consulta preparada
                        if ($stmt->execute()) {
                            $successCount++;
                        }
                    }
                }

                $stmt->close();
            }

            fclose($fileHandle);

            // Verificar si todas las consultas fueron escritas y ejecutadas exitosamente
            if ($successCount == count($registros)) {
                echo json_encode(['status' => 'success', 'message' => 'Todos los productos fueron guardados correctamente.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Algunos productos no pudieron ser guardados.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No se pudo abrir el archivo para escritura.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Datos de entrada inválidos.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método de solicitud no permitido.']);
}

$conn->close();
?>
