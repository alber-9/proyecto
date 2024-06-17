<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
    <link rel="stylesheet" href="/css/estilos.css"> 
</head>
<body>
  <?php
  // Incluir el archivo de conexión a la base de datos
  include '../herramientas/conexion.php';
  ?>
  
  <div class="text-center">
      <!-- Menú de navegación -->
      <div class="row ps-3" id="menu">
          <?php require('../fijo/menu.php'); ?>
      </div>

      <!-- Contenido principal -->
      <div class="row" id="cuerpo">
          <div class="pt-5" id="contenido">
              <div class="container pt-5">
                  <div class="col-md-12 mx-5 pt-5">
                      <div class="card">
                          <div class="card-header">
                              <h4 class="text-center">Iniciar Sesión</h4>
                          </div>
                          <div class="card-body">
                              <?php require('comprobar.php'); ?>
                              <form method="post" action="">
                                  <div class="form-group">
                                      <label for="username">Nombre de Usuario:</label>
                                      <input type="text" class="form-control" id="username" name="username" required>
                                  </div>
                                  <div class="form-group">
                                      <label for="password">Contraseña:</label>
                                      <input type="password" class="form-control" id="password" name="password" required>
                                  </div>
                                  <input name="inicio" class="btn btn-primary btn-block mt-3" type="submit" value="Iniciar Sesión">
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>

     <!-- Footer -->
     <div class="row" id="footer">
        <div class="col-12">
            <?php require( '../fijo/footer.php')?>
        </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script type="module" src="../js/paquete.js"></script>
  
</body>
</html>
