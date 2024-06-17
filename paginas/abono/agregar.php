<?php
// Establecer el tipo de contenido de la respuesta como JSON
header('Content-Type: application/json');

// Incluir el archivo de conexión a la base de datos
include '../../herramientas/conexion.php';

// Inicializar el array de respuesta
$response = array();

// Verificar que se hayan recibido todos los datos necesarios
if (!isset($_POST['parcela']) || !isset($_POST['fecha']) || !isset($_POST['repetir'])) {
    $response['success'] = false;
    $response['error'] = 'Datos incompletos';
    $response['received'] = $_POST; // Datos recibidos para depuración
    echo json_encode($response);
    exit();
}

// Obtener los valores de los datos recibidos
$parcela = $_POST['parcela'];
$fecha = $_POST['fecha'];
$repetir = intval($_POST['repetir'][0]); // Obtener el primer valor del array 'repetir' y convertirlo a entero

// Definir los días de la semana
$dias = ["Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado", "Domingo"];

// Consultar el género del cultivo en la parcela especificada
$sql = "SELECT DISTINCT genero FROM `cultivos` WHERE Parcela ='$parcela';";
$result = $conn->query($sql);
if ($result) {
    if ($row = $result->fetch_assoc()) {
        $genero = $row['genero'];
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

// Escapar los valores para evitar inyecciones SQL
$genero = $conn->real_escape_string($genero);
$parcela = $conn->real_escape_string($parcela);
$fecha = $conn->real_escape_string($fecha);

// Iterar sobre el número de semanas especificado en 'repetir'
for ($semana = 0; $semana < $repetir; $semana++) {
    $nueva_fecha = $fecha;
    
    // Iterar sobre los días de la semana
    foreach ($dias as $dia) {
        // Verificar si se recibieron datos para el día actual
        if (isset($_POST["abono$dia"]) && isset($_POST["cantidad$dia"]) && isset($_POST["riego$dia"])) {
            $abono = $conn->real_escape_string($_POST["abono$dia"]);
            $cantidad = $conn->real_escape_string($_POST["cantidad$dia"]);
            $riego = $conn->real_escape_string($_POST["riego$dia"]);

            // Manejar el caso especial cuando el abono es 'otros..'
            if ($abono == 'otros..') {
                $nuevoAbonoKey = "abono" . $dia . "1";
                if (isset($_POST[$nuevoAbonoKey]) && !empty($_POST[$nuevoAbonoKey])) {
                    $abono = $conn->real_escape_string($_POST[$nuevoAbonoKey]);
                } else {
                    $abono = 'Nada';
                }
            }
            // Manejar el caso cuando el abono es 'Elige...'
            if ($abono == 'Elige...') {
                $abono = 'Nada';
            }

            // Verificar si se recibió un valor de riego
            if (!empty($riego)) {
                // Registrar los datos para depuración
                error_log("Datos para $dia: abono=$abono, cantidad=$cantidad, riego=$riego, fecha=$nueva_fecha");

                // Insertar los datos en la tabla 'abonado'
                $sql = "INSERT INTO `abonado`(`Genero`, `Parcela`, `Fecha`, `Abono`, `Cantidad`, `Riego`, `Hecho`) 
                        VALUES ('$genero','$parcela','$nueva_fecha','$abono','$cantidad','$riego','0')";

                if ($conn->query($sql) === TRUE) {
                    $response['success'] = true;

                    // Escribir la consulta SQL en el archivo de registro
                    $archivo = '../../registros/insertar.txt';
                    $nueva_linea = $sql . "\n";
                    if (file_put_contents($archivo, $nueva_linea, FILE_APPEND) === false) {
                        $response['success'] = false;
                        $response['error'] = 'Error al escribir en el archivo';
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['success'] = false;
                    $response['error'] = 'Error al insertar los datos para ' . $dia . ': ' . $conn->error;
                    echo json_encode($response);
                    exit();
                }
            }

            // Avanzar a la siguiente fecha
            $nueva_fecha = date('Y-m-d', strtotime($nueva_fecha . ' +1 day'));
        }
    }

    // Avanzar a la siguiente semana
    $fecha = date('Y-m-d', strtotime($fecha . ' +1 week'));
}

// Cerrar la conexión a la base de datos
$conn->close();

// Devolver la respuesta como JSON
echo json_encode($response);
?>
