<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Producto Insertar</title>
    <link rel="stylesheet" href="../../css/estilos.css">
    
</head>
<body>
    <?php
    // Incluir el archivo de conexión
    include '../../herramientas/conexion.php';
    ?>
    <div class="text-center">
        <div class="row ps-3" id="menu">
            <?php require('../../fijo/menu.php') ?>
        </div>
        <div class="row" id="cuerpo">
            <div class="col-lg-9 col-md-12 order-2 order-lg-1 pt-5" id="contenido">
                <h1>Producto Cultivo</h1>
                <div id="alertContainer"></div>
                <div class="row mx-5">
                    <div class="col-6">
                        <label for="empresa" class="form-label">Empresa</label>
                        <select id="empresa" class="form-select">
                            <?php 
                                $sql = "SELECT DISTINCT Empresa FROM `producto`;";
                                require('../../herramientas/rellenar.php'); 
                            ?> 
                        </select>
                        <input type='text' class='form-control' id='empresa1' name='empresa1' placeholder='Empresa' required> 
                    </div>
                    <div class="col-6">
                        <label for="fecha" class="form-label">Fecha:</label>
                        <input type="date" id="fecha" class="form-select" name="" required>
                    </div>
                </div>
                
                <form id="cultivoForm" class="d-flex flex-column g-3 align-items-center justify-content-center color">
                    <div class="row w-75">
                        <div class="col-3">
                            <label for="Genero" class="form-label">Género</label>
                            <select id="Genero" class="form-select">
                                <?php 
                                    $sql = "SELECT DISTINCT genero FROM `cultivos`;";
                                    require('../../herramientas/rellenar.php'); 
                                ?> 
                            </select>
                        </div>
                        <div class="col-3">
                            <label for="Variedad" class="form-label">Variedad:</label>
                            <select id="Variedad" class="form-select" disabled>
                                <option value="">Elige...</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <label for="Kilos" class="form-label">Kilos:</label>
                            <input type="number" id="Kilos" class="form-control" name="ciudad" required>
                        </div>
                        <div class="col-3">
                            <label for="Precios" class="form-label">Precios:</label>
                            <input type="number" id="Precios" class="form-control" name="Precios" required>
                        </div>
                        <div class="p-3">
                            <button type="reset" class="btn btn-primary" onclick="añadirFila()">Añadir</button>
                        </div>
                        <table id="miTabla" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Empresa</th>
                                    <th>Género</th>
                                    <th>Fecha</th>
                                    <th>Variedad</th>
                                    <th>Kilos</th>
                                    <th>Precios</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="tablaCuerpo">
                                <!-- Las filas de datos se añadirán aquí -->
                            </tbody>
                        </table>
                        <div class="col-12">
                            <button type="button" class="btn btn-primary" id="enviarFormulario">Enviar</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-3 col-md-12 order-1 order-lg-2 pt-3" id="info">
                <?php require('../../fijo/panel-lateral.php') ?>    
            </div>
        </div>
        <div class="row" id="footer">
            <div class="col-12">
                <?php require('../../fijo/footer.php') ?>
            </div>
        </div>
    </div>

    <script>
         document.addEventListener('DOMContentLoaded', function() {
            // Desactivar el campo Variedad inicialmente
            let variedadSelect = document.getElementById('Variedad');
            variedadSelect.disabled = true;

            // Manejar el cambio en el campo Género
            document.getElementById('Genero').addEventListener('change', function() {
                let generoSeleccionado = this.value;
                variedadSelect.disabled = !generoSeleccionado;

                // Limpiar las opciones actuales
                variedadSelect.innerHTML = '<option value="">Elige...</option>';

                if (generoSeleccionado) {
                    <?php
                    // Generar una lista de variedades por cada género
                    $sql = "SELECT DISTINCT genero, nombre FROM `cultivos`;";
                    $result = $conn->query($sql);
                    $VariedadPorGenero = [];
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $genero = $row["genero"];
                            $nombres = explode(',', $row["nombre"]);
                            if (!isset($VariedadPorGenero[$genero])) {
                                $VariedadPorGenero[$genero] = [];
                            }
                            $VariedadPorGenero[$genero] = array_merge($VariedadPorGenero[$genero], $nombres);
                        }
                    }
                    ?>
                    let VariedadPorGenero = <?php echo json_encode($VariedadPorGenero); ?>;

                    // Añadir las nuevas opciones basadas en el género seleccionado
                    VariedadPorGenero[generoSeleccionado].forEach(function(variedad) {
                        let option = document.createElement('option');
                        option.value = variedad.trim();
                        option.textContent = variedad.trim();
                        variedadSelect.appendChild(option);
                    });
                }
            });
        });

        function vaciarTabla() {
            document.getElementById('tablaCuerpo').innerHTML = '';
        }

        function borrarFila(button) {
            button.closest('tr').remove();
        }

        function añadirFila() {
            
            
            let empresa = document.getElementById('empresa').value;
            if (empresa == "Elige..." || empresa == "No se encontraron estados") {
                empresa = document.getElementById('empresa1').value;
            }
            const fecha = document.getElementById('fecha').value;
            const Genero = document.getElementById('Genero').value;
            const Variedad = document.getElementById('Variedad').value;
            const Kilos = parseFloat(document.getElementById('Kilos').value);
            const Precios = parseFloat(document.getElementById('Precios').value);
            const Total = Kilos * Precios;
            let resultadoFormateado = Total.toFixed(2);
            
            if (!fecha || !empresa || Genero === "Elige..." || isNaN(Kilos) || isNaN(Precios)) {                
                    document.getElementById('alertContainer').innerHTML = '<div class="alert alert-warning" role="alert">Tienes que insertar los valores</div>';
                    setTimeout(function() {
                        document.getElementById('alertContainer').innerHTML = '';
                    }, 5000);
            }else{
                const nuevaFila = `<tr>
                    <td>${empresa}</td>
                    <td>${Genero}</td>
                    <td>${fecha}</td>
                    <td>${Variedad}</td>
                    <td>${Kilos.toFixed(2)}</td>
                    <td>${Precios.toFixed(2)}</td>
                    <td>${resultadoFormateado}</td>
                    <td><button class="btn btn-primary" onclick="borrarFila(this)">Borrar</button></td>
                    </tr>`;
                    

                    console.log(isNaN(Precios) ? Precios : ''); 
                document.getElementById('tablaCuerpo').insertAdjacentHTML('beforeend', nuevaFila);
            }

            
        }

        document.getElementById('enviarFormulario').addEventListener('click', function() {
            let registros = [];
            document.querySelectorAll('#tablaCuerpo tr').forEach(function(row) {
                const cells = row.querySelectorAll('td');
                const registro = {
                    empresa: cells[0].innerText.trim(),
                    genero: cells[1].innerText.trim(),
                    fecha: cells[2].innerText.trim(),
                    variedad: cells[3].innerText.trim(),
                    kilos: parseFloat(cells[4].innerText.trim()),
                    precios: parseFloat(cells[5].innerText.trim()),
                };
                registros.push(registro);
            });

            fetch('agregar.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ registros: registros }),
            })
            .then(response => {
                if (response.ok) {
                    document.getElementById('alertContainer').innerHTML = '<div class="alert alert-success" role="alert">Producto guardado correctamente.</div>';
                    vaciarTabla();
                    document.getElementById('fecha').value = '';
                    document.getElementById('empresa').value = 'Elige...';
                    setTimeout(function() {
                        document.getElementById('alertContainer').innerHTML = '';
                    }, 5000);
                } else {
                    throw new Error('Error al guardar el producto.');
                }
            })
            .catch(error => {
                document.getElementById('alertContainer').innerHTML = '<div class="alert alert-danger" role="alert">' + error.message + '</div>';
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script type="module" src="../../js/paquete.js"></script>
</body>
</html>
