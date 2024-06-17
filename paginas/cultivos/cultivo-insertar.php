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
                <h1>Insertar cultivo</h1>
                <div id="alertContainer"></div>
                <form id="cultivoForm" class="d-flex flex-column g-3 align-items-center justify-content-center color">
                    <div class="p-2">
                        <label for="genero" class="form-label">Genero</label>
                        <input type="text" class="form-control" id="genero" name="genero">
                    </div>
                    <div class="p-2">
                        <label for="parcela" class="form-label">Parcela</label>
                        <input type="text" class="form-control" id="parcela" name="parcela">
                    </div>
                    <div class="p-2">
                        <label for="temporadda" class="form-label">Temporadda</label>
                        <input type="text" class="form-control" id="temporadda" name="temporadda" placeholder="">
                    </div>
                    <div class="p-2">
                        <label for="cantidadPlantas" class="form-label">Cantidad plantas</label>
                        <input type="text" class="form-control" id="cantidadPlantas" name="cantidadPlantas" placeholder="">
                    </div>
                    <div class="p-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre">
                    </div>
                    <div class="col-12">
                        <button type="submit" id="submitButton" class="btn btn-primary">Guardar</button>
                    </div>
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
            document.getElementById('cultivoForm').addEventListener('submit', function(event) {
                event.preventDefault(); // Previene el comportamiento por defecto del formulario

                // Obtén los datos del formulario
                let formData = new FormData(this);
                let params = new URLSearchParams();
                for (let pair of formData) {
                    params.append(pair[0], pair[1]);
                }

                // Envía los datos al servidor usando XMLHttpRequest
                let xhr = new XMLHttpRequest();
                xhr.open('POST', 'agregar.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        let response = JSON.parse(xhr.responseText);
                        if (xhr.status === 200 && response.success) {
                            // Mostrar alerta de éxito
                            document.getElementById('alertContainer').innerHTML = '<div class="alert alert-success" role="alert">Cultivo guardado correctamente.</div>';
                            setTimeout(function() {
                                document.getElementById('alertContainer').innerHTML = '';
                            }, 5000);

                            // Limpiar el formulario
                            document.getElementById('cultivoForm').reset();
                        } else {
                            // Mostrar alerta de error
                            document.getElementById('alertContainer').innerHTML = '<div class="alert alert-danger" role="alert">Error al guardar el cultivo.</div>';
                            setTimeout(function() {
                                document.getElementById('alertContainer').innerHTML = '';
                            }, 5000);
                        }
                    } else if (xhr.readyState === XMLHttpRequest.DONE) {
                        // Mostrar alerta de error
                        document.getElementById('alertContainer').innerHTML = '<div class="alert alert-danger" role="alert">Error al guardar el cultivo.</div>';
                        setTimeout(function() {
                            document.getElementById('alertContainer').innerHTML = '';
                        }, 5000);
                    }
                };
                xhr.send(params.toString());
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script type="module" src="../../js/paquete.js"></script>
</body>
</html>
