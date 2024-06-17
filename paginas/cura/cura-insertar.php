<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Cura Insertar</title>
    <link rel="stylesheet" href="../../css/estilos.css"> 
</head>
<body>
    <?php
    // Incluir el archivo de conexión
    include '../../herramientas/conexion.php';
    ?>
    <div class="text-center">
        <!-- Stack the columns on mobile by making one full-width and the other half-width -->
        <div class="row ps-3" id="menu">
            <?php require('../../fijo/menu.php') ?>
        </div>

        <!-- Columns start at 50% wide on mobile and bump up to 33.3% wide on desktop -->
        <div class="row" id="cuerpo">
            <div class="col-lg-9 col-md-12 order-2 order-lg-1 row align-items-center justify-content-center color pt-5" id="contenido">
                <h1>Insertar Sulfatar</h1>
                <div id="alertContainer"></div>
                <form id="curaForm" class="d-flex flex-column g-3 align-items-center justify-content-center color">
                    <div class="col-3">
                        <label for="Parcelas" class="form-label">Parcelas</label>
                        <select id="Parcelas" name="Parcelas" class="form-select">
                            <?php 
                                $sql = "SELECT DISTINCT parcela FROM `cultivos`;";
                                require('../../herramientas/rellenar.php'); 
                            ?> 
                        </select>
                    </div>
                    <div class="col-3">
                        <label for="Fecha" class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="Fecha" id="Fecha">
                    </div>
                    <div class="col-3">
                        <label for="Insecticida" class="form-label">Insecticida</label>
                        <input type="text" class="form-control" name="Insecticida" id="Insecticida">
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Guardar</button>
                </form>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        let curaForm = document.getElementById('curaForm');
                        let alertContainer = document.getElementById('alertContainer');

                        curaForm.addEventListener('submit', function(event) {
                            event.preventDefault();

                            let formData = new FormData(curaForm);

                            let xhr = new XMLHttpRequest();
                            xhr.open('POST', 'agregar.php', true);
                            xhr.onreadystatechange = function() {
                                if (xhr.readyState === XMLHttpRequest.DONE) {
                                    if (xhr.status === 200) {
                                        let response = JSON.parse(xhr.responseText);
                                        if (response.success) {
                                            alertContainer.innerHTML = '<div class="alert alert-success" role="alert">Cura guardado correctamente.</div>';
                                            curaForm.reset();
                                            setTimeout(function() {
                                                alertContainer.innerHTML = '';
                                            }, 5000);
                                        } else {
                                            alertContainer.innerHTML = '<div class="alert alert-danger" role="alert">Error al guardar la cura: ' + response.error + '<br>Datos recibidos: ' + JSON.stringify(response.received) + '</div>';
                                            setTimeout(function() {
                                                alertContainer.innerHTML = '';
                                            }, 5000);
                                        }
                                    } else {
                                        alertContainer.innerHTML = '<div class="alert alert-danger" role="alert">Error total al guardar el cura.</div>';
                                        setTimeout(function() {
                                            alertContainer.innerHTML = '';
                                        }, 5000);
                                    }
                                }
                            };
                            xhr.send(formData);
                        });
                    });
                </script>
            </div>
            <div class="col-lg-3 col-md-12 order-1 order-lg-2 pt-3" id="info">
                <?php require('../../fijo/panel-lateral.php') ?>    
            </div>
        </div>

        <!-- Columns are always 50% wide, on mobile and desktop -->
        <div class="row" id="footer">
            <div class="col-12">
                <?php require('../../fijo/footer.php') ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script type="module" src="../../js/paquete.js"></script>
    <script type="module" src="filtros.js" defer></script>
</body>
</html>
