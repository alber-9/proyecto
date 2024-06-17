<?php
// Establecer el tipo de contenido de la respuesta como JSON
header('Content-Type: application/json');

// Incluir el archivo de conexión a la base de datos
include '../../herramientas/conexion.php';

// Inicializar el array de respuesta
$response = array();

// Verificar si todos los datos necesarios están presentes
if (!isset($_POST['Parcelas']) || !isset($_POST['Fecha']) || !isset($_POST['Insecticida'])) {
    echo json_encode(['success' => false, 'error' => 'Datos incompletos']);
    exit();
}

// Obtener datos del formulario
$Parcelas = $_POST['Parcelas'];
$Fecha = $_POST['Fecha'];
$Insecticida = $_POST['Insecticida'];

// Consulta para obtener el género del cultivo en la parcela especificada
$sql = "SELECT DISTINCT genero FROM `cultivos` WHERE Parcela ='$Parcelas';";
$result = $conn->query($sql);

// Verificar si la consulta se ejecutó correctamente
if ($result) {
    // Verificar si se encontró un resultado
    if ($row = $result->fetch_assoc()) {
        $Cultivos = $row['genero'];
    } else {
        $response['success'] = false;
        $response['error'] = 'Parcela no encontrada';
        echo json_encode($response);
        exit();
    }
} else {
    $response['success'] = false;
    $response['error'] = 'Error en la consulta de género: ' . $conn->error;
    echo json_encode($response);
    exit();
}

// Sanitizar los datos de entrada para evitar inyección SQL
$Cultivos = $conn->real_escape_string($Cultivos);
$Parcelas = $conn->real_escape_string($Parcelas);
$Fecha = $conn->real_escape_string($Fecha);
$Insecticida = $conn->real_escape_string($Insecticida);

// Construir la consulta SQL para insertar los datos en la tabla `Cura`
$sql = "INSERT INTO `Cura` (`Genero`, `Parcela`, `fecha`, `Insecticida`) VALUES ('$Cultivos', '$Parcelas', '$Fecha', '$Insecticida')";

// Ruta del archivo de registros
$archivo = '../../registros/insertar.txt';

// Agregar la nueva línea al final del archivo
$linea = $sql . "\n"; // Agregar un salto de línea al final del SQL

// Verificar si se ha escrito correctamente en el archivo
if (file_put_contents($archivo, $linea, FILE_APPEND) === false) {
    $response['success'] = false;
    $response['error'] = 'Error al escribir en el archivo';
    echo json_encode($response);
    exit();
}

// Ejecutar la consulta SQL para insertar los datos en la base de datos
if ($conn->query($sql) === TRUE) {
    $response['success'] = true;
} else {
    $response['success'] = false;
    $response['error'] = $conn->error;
}

// Cerrar la conexión a la base de datos
$conn->close();

// Devolver la respuesta en formato JSON
echo json_encode($response);
?>
