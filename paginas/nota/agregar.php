<?php
// Incluir el archivo de conexión
include '../../herramientas/conexion.php';

// Verificar si se recibieron los datos necesarios
if (isset($_POST['usuarioFormulario']) && isset($_POST['contenido'])) {
    $nombreUsuario = $_POST['usuarioFormulario'];
    $contenidoNota = $_POST['contenido'];

    try {
        // Sanitizar los datos de entrada para evitar inyección SQL
        $nombreUsuario = $conn->real_escape_string($nombreUsuario);
        $contenidoNota = $conn->real_escape_string($contenidoNota);
        
        // Preparar la consulta SQL para obtener todos los usuarios excepto el usuario actual
        $sql = "SELECT NombreUsuario FROM `usuarios` WHERE NombreUsuario != '$nombreUsuario'";
        // Ejecutar la consulta
        $result = $conn->query($sql);
        $data = [];
        $hoy = date("Y-m-d H:i:s");

        // Verificar el éxito de la consulta
        if ($result && $result->num_rows > 0) {
            // Procesar el resultado de la consulta
            while ($row = $result->fetch_assoc()) {
                $nombreUsuarioOtro = $row['NombreUsuario'];
                $consulta = "INSERT INTO Notas (NombreUsuario, ContenidoNota, FechaCreacion, Leida) VALUES ('$nombreUsuarioOtro', '$contenidoNota', '$hoy', TRUE)";
                $data[] = $consulta;
            }
        }
        
        // Añadir la nota para el usuario actual
        $data[] = "INSERT INTO Notas (NombreUsuario, ContenidoNota, FechaCreacion, Leida) VALUES ('$nombreUsuario', '$contenidoNota', '$hoy', FALSE)";

        // Ejecutar todas las consultas recopiladas
        foreach ($data as $consulta) {
            $conn->query($consulta);
        }

        // Responder con éxito
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        // Responder con error en caso de excepción
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} else {
    // Responder con error si faltan datos
    echo json_encode(['success' => false, 'error' => 'Faltan datos requeridos']);
}
?>
