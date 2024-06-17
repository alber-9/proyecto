<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilos.css">
    
</head>
<body>
    <?php
        // Incluir el archivo de conexión
        include 'herramientas/conexion.php';
    ?>
    <div class="text-center">
        <!-- Menú -->
        <div class="row ps-3" id="menu">
            <?php require( 'fijo/menu.php')?>
        </div>

        <!-- Contenido principal -->
        <div class="row" id="cuerpo">
        
            <!-- Contenido principal -->
            <div class="col-lg-9 col-md-12 order-2 order-lg-1 pt-5" id="contenido">
                <h1 class="color">Informacion del campo</h1>
                <!-- Carrusel -->
                <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="imagen/foto1.jpg" class="d-block w-100" alt="">
                        </div>
                        <div class="carousel-item">
                            <img src="imagen/foto1.jpg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="imagen/foto1.jpg" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <h1 class="color">Historia del campo</h1>
                <!-- Contenido de las tarjetas -->
                <div class="color mb-3 m-3">
                    <!-- Primera tarjeta -->
                    <div class="row g-0 m-3">
                        <div class="col-md-4">
                            <img src="imagen/foto3.jpg" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">La Revolución Agrícola: Un Cambio en la Humanidad</h5>
                                <p class="card-text mt-4">
                                    Hace miles de años, nuestros ancestros abandonaron la vida nómada para establecerse y cultivar la tierra. Este paso crucial marcó el 
                                    inicio de la Revolución Agrícola, un período en el cual la humanidad aprendió a sembrar, cosechar y domesticar plantas y animales. 
                                    Este cambio transformó no solo nuestra dieta y estilo de vida, sino también nuestras estructuras sociales y económicas. Desde los 
                                    primeros campos de trigo en Mesopotamia hasta los arrozales de Asia, la agricultura sigue siendo la columna vertebral de nuestra 
                                    existencia en la Tierra.
                                </p>
                                <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                            </div>
                        </div>
                    </div>

                    <!-- Segunda tarjeta -->
                    <div class="row g-0 m-3">
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Innovaciones Agrícolas: Forjando el Futuro de la Alimentación</h5>
                                <p class="card-text mt-4">
                                A través de los siglos, la agricultura ha evolucionado gracias a innovaciones que han revolucionado la producción de alimentos. 
                                Desde el arado y la irrigación hasta los modernos sistemas de cultivo hidropónico y la ingeniería genética, cada avance ha ampliado 
                                nuestros límites y aumentado la eficiencia. La historia agrícola es un testimonio de la creatividad humana y su capacidad para 
                                adaptarse a los desafíos de la alimentación global en un mundo en constante cambio.
                                </p>
                                <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                            </div>
                        </div> 
                        <div class="col-md-4">
                            <img src="imagen/foto3.jpg" class="img-fluid rounded-start" alt="...">
                        </div>
                    </div>

                    <!-- Tercera tarjeta -->
                    <div class="row g-0 m-3">
                        <div class="col-md-4">
                            <img src="imagen/foto3.jpg" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"> La Agricultura y el Impacto Ambiental: Un Equilibrio Frágil</h5>
                                <p class="card-text mt-4">
                                A medida que la agricultura se expandió para alimentar a una población en crecimiento, también
                                 comenzaron a surgir preocupaciones sobre su impacto en el medio ambiente. Desde la deforestación 
                                 hasta la erosión del suelo y la contaminación por pesticidas, la historia de la agricultura es
                                 también una historia de cómo hemos aprendido a mitigar y enfrentar los desafíos ambientales que 
                                 nosotros mismos hemos creado.
                                </p>
                                <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                            </div>
                        </div>
                    </div>

                    <!-- Cuarta tarjeta -->
                    <div class="row g-0 m-3">
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">La Agricultura en la Era Moderna: Tecnología y Sostenibilidad</h5>
                                <p class="card-text mt-4">
                                En el siglo XXI, la agricultura se encuentra en un punto de inflexión. Con avances en inteligencia
                                 artificial, biotecnología y técnicas agrícolas sostenibles, estamos explorando nuevas formas de 
                                 alimentar a una población global en crecimiento mientras protegemos nuestros recursos naturales. 
                                 Esta era moderna de la agricultura no solo busca la eficiencia y la rentabilidad, sino también la 
                                 responsabilidad hacia el planeta y las generaciones futuras.
                                </p>
                                <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <img src="imagen/foto3.jpg" class="img-fluid rounded-start" alt="...">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Panel lateral -->
            <div class="col-lg-3 col-md-12 order-1 order-lg-2 p-3" id="info">
                <?php require( 'fijo/panel-lateral.php')?>
            </div>
        </div>

        <!-- Footer -->
        <div class="row" id="footer">
            <div class="col-12">
                <?php require( 'fijo/footer.php')?>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script type="module" src="js/paquete.js"></script>
</body>
</html>
