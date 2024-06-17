<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "alozloz";

$conn = new mysqli($servername, $username, $password, $database);

// Comprobar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
    
}


?>