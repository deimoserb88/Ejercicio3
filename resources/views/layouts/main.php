<?php 

    function head($ua = null){
        !is_null($ua) ? $ua->sessionValidate() : null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="/resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <style>
      body {
        font-family: 'Lato', serif;
      }
    </style>

    <title>Blog X</title>
</head>
<body>

<div id="app" class="container-fluid p-0">
      <header class="row m-0 bg-light">
        <div class="col-9">
          <h1 class="ml-3 mt-2">Blog X</h1>
        </div>
        <div class="col-3">
          <img src="/resources/images/blog.png" style="height:60px" alt="Logo">
        </div>
      </header>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/">Inicio</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Últimas publicaciones</a>
              </li>
              <?php if(!is_null($ua) && $ua->sv){ ?>
              <li class="nav-item">
                <button type="button" class="nav-link btn btn-link"
                          onclick="app.view('newpost')">
                  Nueva publicación
                </button>
              </li>
              <?php } ?>
            </ul>
            <ul class="navbar-nav ml-auto">
              <li class="nav-item dropdown">
                <?php if(is_null($ua) || !$ua->sv){ ?>
                  <button type="button" 
                      class="nav-link btn btn-link"
                      onclick="app.view('inisesion')">
                        Iniciar sesión <i class="bi bi-box-arrow-in-right"></i>
                  </button>
                <?php }else{ ?>
                    <a href="#" role="button" data-bs-toggle="dropdown" 
                        id="navbarDropdown" aria-haspopup="true" aria-expanded="false" 
                        class="nav-link dropdown-toggle">
                      <?=$ua->name?>
                    </a>
                      <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li>
                          <button type="button" class="btn btn-dropdown-item" 
                                  onclick="app.view('logout')">
                            Cerrar sesión
                          </button>
                        </li>
                      </ul>
                    
                <?php } ?>
              </li>
            </ul>
            </div>
            <form class="d-flex">
              <input class="form-control me-2" id="buscar-palabra" type="search" placeholder="Buscar" aria-label="Search">
              <button class="btn btn-outline-success" type="button" onclick="app.buscarPalabra()"><i class="bi bi-search"></i></button>
            </form>
    
        </div>
  </nav>




<?php
    }
    function scripts($script=""){
?>
  </div>
    <script src="/resources/js/jquery.min.js"></script>
    <script src="/resources/js/bootstrap.bundle.min.js"></script>
    <script src="/resources/js/app.js"></script>
<?php

        if($script != ''){
          echo '<script src="/resources/js/' . $script .'"></script>';
        }

    }
    function foot(){
?>

</body>
</html>
<?php }