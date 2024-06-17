<?php
include '../herramientas/conexion.php';

$response = array('success' => false, 'message' => '');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener datos del formulario
    $genero = $_POST['receta'];
    $abonoLunes = $_POST['abonoLunes'] == "Elige..." ? (isset($_POST['abonoLunes1']) ? $_POST['abonoLunes1'] : null) : $_POST['abonoLunes'];
    $abonoMartes = $_POST['abonoMartes'] == "Elige..." ? (isset($_POST['abonoMartes1']) ? $_POST['abonoMartes1'] : null) : $_POST['abonoMartes'];
    $abonoMiercoles = $_POST['abonoMiercoles'] == "Elige..." ? (isset($_POST['abonoMiercoles1']) ? $_POST['abonoMiercoles1'] : null) : $_POST['abonoMiercoles'];
    $abonoJueves = $_POST['abonoJueves'] == "Elige..." ? (isset($_POST['abonoJueves1']) ? $_POST['abonoJueves1'] : null) : $_POST['abonoJueves'];
    $abonoViernes = $_POST['abonoViernes'] == "Elige..." ? (isset($_POST['abonoViernes1']) ? $_POST['abonoViernes1'] : null) : $_POST['abonoViernes'];
    $abonoSabado = $_POST['abonoSabado'] == "Elige..." ? (isset($_POST['abonoSabado1']) ? $_POST['abonoSabado1'] : null) : $_POST['abonoSabado'];
    $abonoDomingo = $_POST['abonoDomingo'] == "Elige..." ? (isset($_POST['abonoDomingo1']) ? $_POST['abonoDomingo1'] : null) : $_POST['abonoDomingo'];
    $recetaRegistrada = $_POST['recetaRegistrada'] === 'true';


   
    // Prepara la consulta SQL para insertar o actualizar
    $dias = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'];
    $abonos = [$abonoLunes, $abonoMartes, $abonoMiercoles, $abonoJueves, $abonoViernes, $abonoSabado, $abonoDomingo];

    $success = true;

    foreach ($dias as $index => $dia) {
        $abono = $abonos[$index];
        if ($abono!=''){
             $sql = "INSERT INTO Receta (Genero, Dia, Abono) VALUES ('$genero', '$dia', '$abono')
                ON DUPLICATE KEY UPDATE Abono = VALUES(Abono)";
        
       

            if ($conn->query($sql) !== TRUE) {
                $success = false;
                $response['message'] .= "Error: " . $sql . "<br>" . $conn->error . "\n";
            }
    }
    }

    if ($success) {
        $response['success'] = true;
        $response['message'] = 'Datos guardados exitosamente';
    } else {
        $response['message'] = 'Ocurrió un error al guardar los datos';
    }

    $conn->close();
    echo json_encode($response);
}
?>
