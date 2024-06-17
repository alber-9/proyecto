<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <title>Cura editar</title>
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
                <h1>Editar Sulfatar</h1>

                <div id="pulsar" class="container-fluid d-flex align-items-center justify-content-center bg-body-secondary bg-opacity-50 text-dark mx-2">
                    <h1>Filtra Sulfatar</h1>
                </div>
                <div id="filtro" style="display: none;" class="align-items-center justify-content-center bg-body-secondary bg-opacity-50 text-dark mx-2">
                    <div class="container text-center">
                        <div class="row text-dark">
                            <div class="col-lg-4 col-md-12 py-3">
                            <label for="Genero" class="form-label">Géneros</label>
                                <select id="Genero" class="form-select">
                                    <?php 
                                        $sql = "SELECT DISTINCT Genero FROM `cura`;";
                                        require('../../herramientas/rellenar.php'); 
                                    ?> 
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-12 py-3">
                                <label for="Parcelas" class="form-label">Parcelas</label>
                                <select id="Parcelas" class="form-select">
                                    <?php 
                                        $sql = "SELECT DISTINCT Parcela FROM `cura`;";
                                        require('../../herramientas/rellenar.php'); 
                                    ?> 
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-12 py-3">
                                <label for="Insecticida" class="form-label">Insecticida</label>
                                <select id="Insecticida" class="form-select">
                                    <?php 
                                        $sql = "SELECT DISTINCT Insecticida FROM `cura`;";
                                        require('../../herramientas/rellenar.php'); 
                                    ?> 
                                </select>
                                <div class="row pt-3">
                                    <button id="limpiar" class="btn btn-primary col-5 mx-2" type="button">Limpiar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php 
                    include('../../herramientas/tablaEditar.php');
                    generarTabla("SELECT * FROM Cura", "Cura", ['Parcela', 'Fecha', 'Insecticida']);
                ?> 
                <div class="row">
                    <div class="col-9">
                        <nav id="myTablePage" aria-label="Page navigation example"></nav>
                    </div>
                    
                    
                </div>
              
                
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
