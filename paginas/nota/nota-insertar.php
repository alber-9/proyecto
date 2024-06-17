<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Cultivos insertar</title>
    <link rel="stylesheet" href="../../css/estilos.css">
    
</head>
<body>
  <?php
  // Incluir el archivo de conexión
  include '../../herramientas/conexion.php';
  ?>
    <div class="text-center">
        <div class="row ps-3" id="menu">
            <?php require('../../fijo/menu.php')?>
        </div>
        <div class="row" id="cuerpo">
            <div class="col-lg-9 col-md-12 order-2 order-lg-1 pt-5" id="contenido">
                <h1>Insertar nota</h1>
                <div id="alertContainer"></div>
                <form id="notaForm" class="d-flex flex-column g-3 align-items-center justify-content-center color">
                    <div class="p-2">
                        <label for="contenido" class="form-label">Contenido</label>
                        <input type="text" class="form-control" id="contenido" name="contenido">
                    </div>
                    <input type="hidden" id="usuarioFormulario" name="usuarioFormulario">
                    <input type="submit" value="Guardar" class="btn btn-primary">
                </form>
            </div>
            <div class="col-lg-3 col-md-12 order-1 order-lg-2 pt-3" id="info">
                <?php require('../../fijo/panel-lateral.php')?>    
            </div>
        </div>
        <div class="row" id="footer">
            <div class="col-12">
                <?php require('../../fijo/footer.php')?>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let inicioValue = localStorage.getItem('inicio');
            if (inicioValue !== null) {
                document.getElementById('usuarioFormulario').value = inicioValue;
            }

            document.getElementById('notaForm').addEventListener('submit', function(event) {
                event.preventDefault(); // Previene el comportamiento por defecto del formulario

                // Obtén los datos del formulario
                let formData = new FormData(this);

                // Envía los datos al servidor usando fetch API
                fetch('agregar.php', {
                    method: 'POST',
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    let alertContainer = document.getElementById('alertContainer');
                    if (data.success) {
                        // Mostrar alerta de éxito
                        alertContainer.innerHTML = '<div class="alert alert-success" role="alert">Nota guardada correctamente.</div>';
                        setTimeout(function() {
                            alertContainer.innerHTML = '';
                        }, 5000);

                        // Limpiar el formulario
                        document.getElementById('notaForm').reset();
                    } else {
                        // Mostrar alerta de error
                        alertContainer.innerHTML = '<div class="alert alert-danger" role="alert">' + (data.error || 'Error al guardar la nota.') + '</div>';
                        setTimeout(function() {
                            alertContainer.innerHTML = '';
                        }, 5000);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('alertContainer').innerHTML = '<div class="alert alert-danger" role="alert">Error al guardar la nota.</div>';
                    setTimeout(function() {
                        document.getElementById('alertContainer').innerHTML = '';
                    }, 5000);
                });
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script type="module" src="../../js/paquete.js"></script>
</body>
</html>
