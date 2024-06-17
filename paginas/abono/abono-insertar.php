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
                <h1>Insertar abonado de: <span id="cultivo"></span></h1>
                <div id="alertContainer"></div>
                <form id="cultivoForm" class="d-flex flex-column g-3 align-items-center justify-content-center color">
                    <div class="row">
                        <div class="col-6">
                            <label for="parcela" class="form-label">Parcela</label>
                            <select id="parcela" class="form-select" name="parcela" required>
                                <?php 
                                    $sql = "SELECT DISTINCT Genero, Parcela FROM `cultivos`;";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        $columnas = $result->fetch_fields();
                                        $columna = $columnas[0]->name;
                                        $columna2 = $columnas[1]->name;
                                        echo "<option id='Elige...' selected>Elige...</option>";
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option id=".$row[$columna].">" . $row[$columna2] . "</option>";
                                        }
                                    } else {
                                        echo "<option>No se encontraron estados</option>";
                                    }
                                ?> 
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="fecha" class="form-label">Fecha</label>
                            <input type="date" class="form-control" id="fecha" name="fecha" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <h2>Receta</h2>
                            <?php 
                                $sql = "SELECT genero, dia, abono FROM `receta`;";
                                require('../../herramientas/tabla.php');
                            ?>
                        </div>
                        <div class="col-4">
                            <div class="d-flex flex-column g-3 align-items-center justify-content-center color">
                                <!-- Lunes a Jueves -->
                                <?php 
                                $dias = ["Lunes", "Martes", "Miércoles", "Jueves"];
                                foreach ($dias as $dia) {
                                    echo "
                                    <div class='p-2'>
                                        <label for='abono$dia' class='form-label'>$dia</label>
                                        <select id='abono$dia' name='abono$dia' class='form-select abono-dia'>";
                                            $sql = "SELECT DISTINCT abono FROM `receta` UNION SELECT DISTINCT abono FROM `Abonado`;";
                                            require('../../herramientas/rellenar.php');
                                    echo "<option value='otros..'>otros..</option>   
                                        </select>
                                        <div id='añadir$dia'></div>
                                        <input type='number' class='form-control' id='cantidad$dia' name='cantidad$dia' placeholder='Gramos'>
                                        <input type='number' class='form-control' id='riego$dia' name='riego$dia' placeholder='Riego' >
                                    </div>";
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="d-flex flex-column g-3 align-items-center justify-content-center color">
                                <!-- Viernes a Domingo -->
                                <?php 
                                $dias = ["Viernes", "Sábado", "Domingo"];
                                foreach ($dias as $dia) {
                                    echo "
                                    <div class='p-2'>
                                        <label for='abono$dia' class='form-label'>$dia</label>
                                        <select id='abono$dia' name='abono$dia' class='form-select abono-dia'>";
                                            $sql = "SELECT DISTINCT abono FROM `receta`;";
                                            require('../../herramientas/rellenar.php');
                                    echo "<option value='otros..'>otros..</option>   
                                        </select>
                                        <div id='añadir$dia'></div>
                                        <input type='number' class='form-control' id='cantidad$dia' name='cantidad$dia' placeholder='Gramos'>
                                        <input type='number' class='form-control' id='riego$dia' name='riego$dia' placeholder='Riego'>
                                    </div>";
                                }
                                ?>
                                <div class="p-1">
                                    <label for="repetir" class="form-label">Repetir</label>
                                    <select id="repetir" name="repetir" class="form-select">
                                        <option selected>1 semana</option>
                                        <option>2 semanas</option>
                                        <option>3 semanas</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <button type="submit" id="submitButton" class="btn btn-primary">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-3 col-md-12 order-1 order-lg-2 p-3" id="info">
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
        document.addEventListener('DOMContentLoaded', function() {
            // Agregar evento de clic a cada elemento con la clase 'abono-dia'
            document.querySelectorAll('.abono-dia').forEach(function(element) {
                element.addEventListener('click', function() {
                    insertarInputDebajo(element.id);
                });
            });

            document.getElementById('cultivoForm').addEventListener('submit', function(event) {
                event.preventDefault(); // Previene el comportamiento por defecto del formulario
                let formData = new FormData(this);
                let xhr = new XMLHttpRequest();
                xhr.open('POST', 'agregar.php', true);
                xhr.onload = function() {
                    let data = JSON.parse(this.responseText);
                    if (data.success) {
                        document.getElementById('alertContainer').innerHTML = '<div class="alert alert-success" role="alert">Cultivo guardado correctamente.</div>';
                        document.getElementById('cultivoForm').reset();
                        setTimeout(function() {
                            document.getElementById('alertContainer').innerHTML = '';
                        }, 5000);
                    } else {
                        document.getElementById('alertContainer').innerHTML = '<div class="alert alert-danger" role="alert">Error al guardar el cultivo: ' + data.error + '<br>Datos recibidos: ' + JSON.stringify(data.received) + '</div>';
                        setTimeout(function() {
                            document.getElementById('alertContainer').innerHTML = '';
                        }, 5000);
                    }
                };
                xhr.onerror = function() {
                    document.getElementById('alertContainer').innerHTML = '<div class="alert alert-danger" role="alert">Error total al guardar el cultivo.</div>';
                    setTimeout(function() {
                        document.getElementById('alertContainer').innerHTML = '';
                    }, 5000);
                };
                xhr.send(formData);
            });
        });

        function insertarInputDebajo(elementId) {
            let selectElement = document.getElementById(elementId);
            if (selectElement.options[selectElement.selectedIndex].text === 'otros..') {
                let contenedor = document.getElementById('añadir' + elementId.replace('abono', ''));
                if (!contenedor.querySelector('#'+elementId+'1')) {
                    let nuevoInput = document.createElement('input');
                    nuevoInput.id = elementId + '1';
                    nuevoInput.name = elementId + '1';
                    nuevoInput.type = 'text';
                    nuevoInput.placeholder = 'abono';
                    nuevoInput.className = 'form-control';
                    contenedor.appendChild(nuevoInput);
                }
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script type="module" src="../../js/paquete.js"></script>
    <script type="module" src="filtros.js" defer></script>
</body>
</html>
