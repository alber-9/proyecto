<?php
header('Content-Type: application/json');

include '../../herramientas/conexion.php';

$response = array();

// Verificar si todos los datos necesarios están presentes
if (!isset($_POST['genero']) || !isset($_POST['parcela']) || !isset($_POST['temporadda']) || !isset($_POST['cantidadPlantas']) || !isset($_POST['nombre'])) {
    echo json_encode(['success' => false, 'error' => 'Datos incompletos']);
    exit();
}

// Obtener datos del formulario
$genero = $_POST['genero'];
$parcela = $_POST['parcela'];
$temporadda = $_POST['temporadda'];
$cantidadPlantas = $_POST['cantidadPlantas'];
$nombre = $_POST['nombre'];

// Sanitizar los datos de entrada para evitar inyección SQL
$genero = $conn->real_escape_string($genero);
$parcela = $conn->real_escape_string($parcela);
$temporadda = $conn->real_escape_string($temporadda);
$cantidadPlantas = $conn->real_escape_string($cantidadPlantas);
$nombre = $conn->real_escape_string($nombre);

// Insertar datos en la base de datos
$sql = "INSERT INTO `cultivos` (`Genero`, `Parcela`, `Temporada`, `CantidadPlanta`, `Nombre`) VALUES ('$genero', '$parcela', '$temporadda', '$cantidadPlantas', '$nombre')";

// Ruta del archivo
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

if ($conn->query($sql) === TRUE) {
    $response['success'] = true;
} else {
    $response['success'] = false;
    $response['error'] = $conn->error;
}

$conn->close();

// Devolver respuesta en formato JSON
echo json_encode($response);
?>
