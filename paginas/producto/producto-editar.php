<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <title>Producto editar</title>
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
            <div class="col-lg-9 col-md-12 order-2 order-lg-1 pt-5" id="contenido">
                <h1>Editar producto</h1>

                <div id="pulsar" class="container-fluid d-flex align-items-center justify-content-center bg-body-secondary bg-opacity-50 text-dark mx-2">
                    <h1>Filtra producto</h1>
                </div>
                <div id="filtro" style="display: none;" class="align-items-center justify-content-center bg-body-secondary bg-opacity-50 text-dark mx-2">
                    <div class="container text-center">
                        <div class="row text-dark">
                            <div class="col-lg-4 col-md-12 py-3">
                                <label for="Empresa" class="form-label">Empresa</label>
                                <select id="Empresa" class="form-select">
                                    <?php 
                                        $sql = "SELECT DISTINCT Empresa FROM `producto`;";
                                        require('../../herramientas/rellenar.php'); 
                                    ?> 
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-12 py-3">
                                <label for="Genero" class="form-label">Generos</label>
                                <select id="Genero" class="form-select">
                                    <?php 
                                        $sql = "SELECT DISTINCT Genero FROM `producto`;";
                                        require('../../herramientas/rellenar.php'); 
                                    ?> 
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-12 py-3">
                                <label for="letiedad" class="form-label">letiedad</label>
                                <select id="letiedad" class="form-select">
                                    <?php 
                                        $sql = "SELECT DISTINCT letiedad FROM `producto`;";
                                        require('../../herramientas/rellenar.php'); 
                                    ?> 
                                </select>
                            </div> 
                            <div class="col-lg-4 col-md-12 py-3">
                                <label for="FechaDesde" class="form-label">Fecha desde</label>
                                <input type="date" id="FechaDesde" class="form-select">
                            </div>
                            <div class="col-lg-4 col-md-12 py-3">
                                <label for="FechaHasta" class="form-label">Fecha hasta</label>
                                <input type="date" id="FechaHasta" class="form-select">
                            </div>
                            <div class="col-lg-4 col-md-12 py-3">
                                <div class="row pt-3">
                                    <button id="limpiar" class="btn btn-primary col-5 mx-2" type="button">Limpiar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php 
                    include('../../herramientas/tablaEditar.php');
                    generarTabla("SELECT * FROM producto", "producto", ['Id']);
                ?> 
                <div class="row">
                    <div class="col-9">
                        <nav id="myTablePage" aria-label="Page navigation example"></nav>
                    </div>
                    <div class="col-3">
                        <button id="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
                <script src="../../herramientas/editar.js" defer></script>
                <script>
                document.addEventListener('DOMContentLoaded', function() {
                    let submitBtn = document.getElementById('submit');
                    if(submitBtn) {
                        submitBtn.addEventListener('click', function() {
                            let data = [];
                            let rows = document.querySelectorAll('#myTable tr.editar');
                            rows.forEach(function(row) {
                                let rowData = [];
                                let cells = row.querySelectorAll('td');
                                cells.forEach(function(cell, cellIndex) {
                                    let cellText = cell.innerText;
                                    let inputVal = cell.querySelector('input');
                                    if (inputVal !== null) {
                                        cellText = inputVal.value;
                                    }
                                    rowData.push(cellText);
                                });
                                if (rowData.length > 0) {
                                    let sql = `UPDATE Producto SET Kilos = '${rowData[5]}', Precios = '${rowData[6]}' WHERE Id = '${rowData[0]}'`;
                                    data.push(sql);
                                }
                            });

                            let xhr = new XMLHttpRequest();
                            xhr.open('POST', '../../herramientas/actualizar.php', true);
                            xhr.setRequestHeader('Content-Type', 'application/json');
                            xhr.onreadystatechange = function() {
                                if (xhr.readyState === 4 && xhr.status === 200) {
                                    // Manejar la respuesta del servidor si es necesario
                                    window.location.reload();
                                }
                            };
                            xhr.send(JSON.stringify({ editarDatos: data }));
                        });
                    }
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

    <?php require('../../fijo/modal.php') ?>
</body>
</html>
