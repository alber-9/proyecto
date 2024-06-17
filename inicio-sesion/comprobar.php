<?php 
// Verifica si el formulario ha sido enviado
if (!empty($_POST["inicio"])) {

    try {
        // Obtiene los datos del formulario
        $username = $_POST['username'];
        $password = $_POST['password'];
    
        // Consulta SQL para verificar los datos de inicio de sesión
        $sql = "SELECT * FROM Usuarios WHERE NombreUsuario='$username' AND Contrasena='$password'";
        $result = $conn->query($sql);

        // Verificar si se encontró algún registro
        if ($result->num_rows > 0) {
            echo "<div class='alert alert-success' role='alert'>Nombre de usuario es correcto.</div>";
            ?>
            <!-- Impresión de la letiable PHP dentro de una etiqueta de script -->
            <script>
                // Obtener el valor de la letiable PHP y asignarlo a una letiable de JavaScript
                let usuario = "<?php echo $username; ?>";
                // Almacenar la letiable en localStorage
                localStorage.setItem('inicio', usuario);
                // Redirigir al usuario
                 window.location.href = '/';
            </script>
            <?php 
        } else {
            // Inicio de sesión fallido
            echo "<script>localStorage.setItem('inicio', '');</script>";
            echo "<div class='alert alert-danger' role='alert'>Nombre de usuario o contraseña incorrectos.</div>";
        }
    } catch (Exception $e) {
        // Manejar errores
        echo "<div class='alert alert-danger' role='alert'>Se produjo un error: " . $e->getMessage() . "</div>";
    }
}
?>
