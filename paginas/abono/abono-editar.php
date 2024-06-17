<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Abono Editar</title>
    <link rel="stylesheet" href="../../css/estilos.css">
</head>
<body>
    <?php include '../../herramientas/conexion.php'; ?>
    <div class="text-center">
        <div class="row ps-3" id="menu">
            <?php require('../../fijo/menu.php') ?>
        </div>
        <div class="row" id="cuerpo">
            <div class="col-lg-9 col-md-12 order-2 order-lg-1 pt-5" id="contenido">
                <h1>Editar Abono</h1>
                <div id="pulsar" class="container-fluid d-flex align-items-center justify-content-center bg-body-secondary bg-opacity-50 text-dark mx-2">
                    <h1>Filtrar Abono</h1>
                </div>
                <div id="filtro" style="display: none;" class="align-items-center justify-content-center bg-body-secondary bg-opacity-50 text-dark mx-2">
                    <div id="alertContainer"></div>
                    <div class="container text-center">
                        <div class="row text-dark">
                            <div class="col-lg-4 col-md-12 py-3">
                                <label for="Genero" class="form-label">Géneros</label>
                                <select id="Genero" class="form-select">
                                    <?php
                                    $sql = "SELECT DISTINCT Genero FROM `cultivos`;";
                                    require('../../herramientas/rellenar.php')
                                    ?>
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-12 py-3">
                                <label for="Parcelas" class="form-label">Parcelas</label>
                                <select id="Parcelas" class="form-select">
                                    <?php
                                    $sql = "SELECT DISTINCT Parcela FROM `cultivos`;";
                                    require('../../herramientas/rellenar.php')
                                    ?>
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-12 py-3">
                                <div class="row pt-3">
                                    <button id="limpiar" class="btn btn-primary col-5 mx-2" type="button">Limpiar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="alertContainer"></div>
                <?php
                include('../../herramientas/tablaEditar.php');
                generarTabla("SELECT * FROM Abonado", "Abonado", ['Parcela', 'Fecha']);
                ?>
                <div class="row">
                    <div class="col-9">
                        <nav id="myTablePage" aria-label="Page navigation example">
                        </nav>
                    </div>
                    <div class="col-3">
                        <button id="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
                <script src="../../herramientas/editar.js" defer></script>
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        const checkboxes = document.querySelectorAll('.hecho-checkbox');

                        checkboxes.forEach(checkbox => {
                        checkbox.disabled = false; // Quita el atributo 'disabled'
                        checkbox.addEventListener('change', function() {
                            const fila = this.closest('tr');

                            if (this.checked) {
                                fila.classList.add('editar');
                            } else {
                                fila.classList.remove('editar');
                            }
                        });
                    });

                        document.getElementById('submit').addEventListener('click', function() {
                            const data = [];
                            const rows = document.querySelectorAll('#myTable tr.editar');

                            rows.forEach(row => {
                                const rowData = [];
                                const cells = row.querySelectorAll('td');

                                cells.forEach(cell => {
                                    let cellText = cell.textContent.trim();
                                    const input = cell.querySelector('input');

                                    if (input) {
                                        cellText = input.value;
                                    }

                                    rowData.push(cellText);
                                });

                                if (rowData.length > 0) {
                                    const valor = rowData[6] === "on" ? '1' : '0';
                                    const sql = `UPDATE Abonado SET Genero = '${rowData[0]}', Abono = '${rowData[3]}', Cantidad = '${rowData[4]}', riego = '${rowData[5]}', hecho = '${valor}' WHERE Parcela = '${rowData[1]}' AND Fecha = '${rowData[2]}'`;
                                    data.push(sql);
                                }
                            });

                            fetch('../../herramientas/actualizar.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({ editarDatos: data })
                            })
                            .then(response => response.text())
                            .then(response => {
                                
                                window.location.reload();
                            })
                            .catch(error => console.error('Error:', error));
                        });
                    });
                </script>
            </div>
            <div class="col-lg-3 col-md-12 order-1 order-lg-2 p-3" id="info">
                <?php require('../../fijo/panel-lateral.php') ?>
            </div>
        </div>
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
