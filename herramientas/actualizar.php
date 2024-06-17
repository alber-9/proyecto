<?php
// Iniciar la sesión para manejar mensajes de sesión
session_start();

// Obtener la entrada de la solicitud HTTP
$input = file_get_contents('php://input');
$data = json_decode($input, true);

// Verificar si los datos fueron decodificados correctamente
if (isset($data['editarDatos'])) {
    $editarDatos = $data['editarDatos'];

    // Incluir el archivo de conexión
    include 'conexion.php';

    try {
        // Asumir que cada valor en $editarDatos corresponde a una consulta SQL
        foreach($editarDatos as $consulta) {
            // Ejecutar la consulta
            if (mysqli_query($conn, $consulta)) {
                echo "Consulta ejecutada exitosamente: " . $consulta . "<br>";
            } else {
                throw new Exception("Error al ejecutar la consulta: " . $consulta . " - Error: " . mysqli_error($conn));
            }
        }
    } catch (Exception $e) {
        // Capturar y mostrar cualquier error
        echo "Se produjo un error: " . $e->getMessage() . "<br>";
    } finally {
        // Cerrar la conexión (opcional, si no se maneja automáticamente al final del script)
        mysqli_close($conn);
    }
} else { 
    echo "No se recibieron datos";
}
?>
