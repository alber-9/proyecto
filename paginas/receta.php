<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
    <link rel="stylesheet" href="../../css/estilos.css"> 
</head>
<body>
    <?php 
        include '../herramientas/conexion.php'; 
    ?>

    <div class="text-center">
        <div class="row ps-3" id="menu">
            <?php require('../fijo/menu.php')?>
        </div>

        <div class="row" id="cuerpo">
            <div class="col-lg-9 col-md-12 order-2 order-lg-1 p-5" id="contenido">
                <h1>contenido receta</h1>
                <div class="col-12 align-items-center justify-content-center">
                    <form id="recetaForm">            
                        <label for="receta" class="form-label">cultivo</label>
                        <select id="receta" class="form-select" name="receta">
                            <?php 
                                $sql = "SELECT DISTINCT genero FROM `Cultivos`;";
                                require('../herramientas/rellenar.php'); 
                            ?> 
                        </select>
                        <h2 class="color">Receta<span id="registro"></span></h2>
                        <div id="alertContainer"></div>
                        <div class="row color">
                            <div class="col-6">
                                <label for="abonoLunes" class="form-label">Lunes</label>
                                <select id="abonoLunes"  name="abonoLunes" class="form-select">
                                    <?php 
                                        $sql = "SELECT DISTINCT abono FROM `receta` UNION SELECT DISTINCT abono FROM `Abonado`;";
                                        require('../herramientas/rellenar.php'); 
                                    ?> 
                                </select>
                                <input type='text' class='form-control' id='abonoLunes1' name='abonoLunes1' placeholder='abono' required>
                                <label for="abonoMartes" class="form-label">Martes</label>
                                <select id="abonoMartes" name="abonoMartes" class="form-select">
                                    <?php 
                                        $sql = "SELECT DISTINCT abono FROM `receta` UNION SELECT DISTINCT abono FROM `Abonado`;";
                                        require('../herramientas/rellenar.php'); 
                                    ?> 
                                </select>
                                <input type='text' class='form-control' id='abonoMartes1' name='abonoMartes1' placeholder='abono' required>
                                <label for="abonoMiercoles" class="form-label">Miercoles</label>
                                <select id="abonoMiercoles"  name="abonoMiercoles" class="form-select">
                                    <?php 
                                        $sql = "SELECT DISTINCT abono FROM `receta` UNION SELECT DISTINCT abono FROM `Abonado`;";
                                        require('../herramientas/rellenar.php'); 
                                    ?> 
                                </select>
                                <input type='text' class='form-control' id='abonoMiercoles1' name='abonoMiercoles1' placeholder='abono' required>
                                <label for="abonoJueves" class="form-label">Jueves</label>
                                <select id="abonoJueves" name="abonoJueves" class="form-select">
                                    <?php 
                                        $sql = "SELECT DISTINCT abono FROM `receta` UNION SELECT DISTINCT abono FROM `Abonado`;";
                                        require('../herramientas/rellenar.php'); 
                                    ?> 
                                </select>
                                <input type='text' class='form-control' id='abonoJueves1' name='abonoJueves1' placeholder='abono' required>
                            </div>
                            <div class="col-6">
                                <label for="abonoViernes" class="form-label">Viernes</label>
                                <select id="abonoViernes" name="abonoViernes" class="form-select">
                                    <?php 
                                        $sql = "SELECT DISTINCT abono FROM `receta` UNION SELECT DISTINCT abono FROM `Abonado`;";
                                        require('../herramientas/rellenar.php'); 
                                    ?> 
                                </select>
                                <input type='text' class='form-control' id='abonoViernes1' name='abonoViernes1' placeholder='abono' required>
                                <label for="abonoSabado" name="abonoMiercoles" class="form-label">Sabado</label>
                                <select id="abonoSabado" name="abonoSabado" class="form-select">
                                    <?php 
                                        $sql = "SELECT DISTINCT abono FROM `receta` UNION SELECT DISTINCT abono FROM `Abonado`;";
                                        require('../herramientas/rellenar.php'); 
                                    ?> 
                                </select>
                                <input type='text' class='form-control' id='abonoSabado1' name='abonoSabado1' placeholder='abono' required>
                                <label for="abonoDomingo" class="form-label">Domingo</label>
                                <select id="abonoDomingo" name="abonoDomingo" class="form-select">
                                    <?php 
                                        $sql = "SELECT DISTINCT abono FROM `receta` UNION SELECT DISTINCT abono FROM `Abonado`;;";
                                        require('../herramientas/rellenar.php'); 
                                    ?> 
                                </select>
                                <input type='text' class='form-control' id='abonoDomingo1' name='abonoDomingo1' placeholder='abono' required>
                                
                                <input type="hidden" id="recetaRegistrada" name="recetaRegistrada" value="false">
                                <button id="submit" type="button" class="btn btn-primary m-5">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-3 col-md-12 order-1 order-lg-2 pt-3" id="info">
                <?php require('../fijo/panel-lateral.php')?>
            </div>
        </div>

        <div class="row" id="footer">
            <div class="col-12">
                <?php require('../fijo/footer.php')?>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("submit").addEventListener("click", function() {
            // Actualizar el campo oculto antes de enviar el formulario
            document.getElementById("recetaRegistrada").value = "true";

            // Recoger todos los valores del formulario
            let formData = new FormData(document.getElementById("recetaForm"));

            // Enviar datos al servidor
            fetch("guardarReceta.php", {
                method: "POST",
                body: formData
            })
            .then(response => {
                if (response.ok) {
                    document.getElementById('alertContainer').innerHTML = '<div class="alert alert-success" role="alert">Datos guardados exitosamente.</div>';
                    setTimeout(function() {
                        document.getElementById('alertContainer').innerHTML = '';
                    }, 5000);
                } else {
                    document.getElementById('alertContainer').innerHTML = '<div class="alert alert-danger" role="alert">Ocurrió un error al guardar los datos.</div>';
                    setTimeout(function() {
                        document.getElementById('alertContainer').innerHTML = '';
                    }, 5000);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });

        document.getElementById("receta").addEventListener("change", function() {
            let selectedValue = this.value;

            let formData = new FormData();
            formData.append("selectedValue", selectedValue);

            fetch("rellenarReceta.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                const dias = ["Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado", "Domingo"];
                if (data.success) {
                    dias.forEach(function(dato) {
                        document.getElementById('abono' + dato).value = "Elige...";
                    });
                    if (data.result) {
                        data.result.forEach(function(dato) {
                            
                            document.getElementById('abono' + dato.dia).value = dato.abono;
                        });
                        document.getElementById("registro").innerHTML = '<div class="alert alert-success" role="alert">La receta está registrada.</div>';
                        document.getElementById("recetaRegistrada").value = "true";
                    } 
                } else {
                    
                    dias.forEach(function(dato) {
                        document.getElementById('abono' + dato).value = "Elige...";
                    });
                    if (document.getElementById("receta").value != "Elige..."){
                        document.getElementById("registro").innerHTML = '<div class="alert alert-danger" role="alert">La receta no está registrada.</div>';
                    }else{
                        document.getElementById("registro").innerHTML = '<div class="alert alert-warning" role="alert">Elige una cultivo.</div>';
                        setTimeout(function() {
                            document.getElementById('registro').innerHTML = '';
                        }, 5000);
                    }
                    
                    document.getElementById("recetaRegistrada").value = "false";
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });

</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script type="module" src="../../js/paquete.js"></script>
</body>
</html>

