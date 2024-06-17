export function mostrar() {
    try {
        // Verifica si el texto del elemento con id "session" es "Inicio de sesion"
        if (document.getElementById("session").innerHTML == "Inicio de sesion") {
            // Si es así, redirige al usuario a la página de inicio de sesión
            window.location.href = "/inicio-sesion/login.php"; 
        } else {
            // Si no, cambia el texto del elemento a "Inicio de sesion"
            document.getElementById("session").innerHTML = "Inicio de sesion";
            // Recarga la página
            location.reload();
            // Limpia el elemento 'inicio' del localStorage
            localStorage.setItem('inicio', '');
        }
    } catch (error) {
        // Maneja cualquier error que ocurra durante la ejecución del bloque try
        //console.error("Error en la función mostrar:", error);
    }
}
