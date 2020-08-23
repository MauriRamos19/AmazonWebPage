<?php
  session_start();
  if(!isset($_SESSION["token"]))
    header("Location: login.html");
  if(!isset($_COOKIE["token"]))
    header("Location: login.html");
  if($_SESSION["token"] != $_COOKIE["token"])
    header("Location: login.html");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amazon</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <script src="https://kit.fontawesome.com/86c1701753.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>

      <nav class="navbar navbar-dark">
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
      
        <a class="navbar-brand mr-auto ml-2"  href="#"><img src="img/logo.webp" width="110px" alt=""></a>
        <form class="form-inline">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
        </form>
        <a id="account" href="#" data-toggle="modal" data-target="#modalAdministrator"><i class="far fa-user-circle"></i><strong>Cuenta de Admistrador</strong></a>
        <a href="#" data-toggle="modal" data-target="#carModal"><i class="fas fa-shopping-cart"></i><strong>Carrrito</strong></a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
              <h2 class="m-auto py-2" style="color: white;">Hola, <?php echo $_COOKIE['name']; ?></h2><br>
              <a href="logout.php">Cerrar Sesion</a>
              
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="inputGroupSelect01">Departamentos</label>
                </div>
                <select class="custom-select" id="list-departments" onchange="changeDepartment()">

                </select><br>
              </div>
          </ul>
        </div>
    </nav>

   

    <div class="modal fade" id="modalAdministrator" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          
          <div class="modal-body">
            <form class="form-group">
              <div class="row">
                <div class="col-4">
                  
                </div>
                <div class="col-4">
                  <button type="button" class="btn btn-danger" data-dismiss="modal" data-toggle="modal" data-target="#modalAdd">Nuevo Producto</button>
                </div>
              
                <div class="col-2">
                 
                </div>
              </div>
              
               

            <form>
          </div>
  
        </div>
      </div>
    </div>
    
    <div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          
          <div class="modal-body">
            <form class="form-group">
              <input class="form-control" type="text" id="productName" placeholder="Nombre de producto"><br>
              <input class="form-control" type="text" id="productBrand" placeholder="Marca"><br>
              <input class="form-control" type="text" id="productImage" placeholder="Imagen"><br>
              <input class="form-control" type="text" id="productPrice" placeholder="Precio"><br>
              <input class="form-control" type="text" id="productCalification" placeholder="Calificacion"><br>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="addProduct()">Agregar Producto</button>
          </div>
            <form>
          </div>
  
        </div>
      </div>
    </div>


  
      <div id="carouselExampleControls" class="carousel slide d-none d-md-block" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="img/Fuji_TallHero_45M_v2_1x._CB432458380_.jpg" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="img/Fuji_TallHero_45M_v2_1x._CB432458380_2.jpg" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="img/Fuji_TallHero_Currency_v2_en_US_2x._CB428993290_3.jpg" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="img/Fuji_TallHero_Toys_en_US_1x._CB431858161_4.jpg" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="img/Fuji_TallHero_Home_v2_en_US_1x._CB429090084_5.jpg" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="img/Fuji_TallHero_Sports_en_US_1x._CB431860448_6.jpg" class="d-block w-100" alt="...">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>

      <div class="container" id="container-products">
        <div class="row" id="products">
          
        </div>
      </div>


      <!-- Modal -->
      <div class="modal fade" id="carModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Productos</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row" id="productsUser">
                
              </div>
            </div>
            <div class="modal-footer" id="footerModal">
              
            </div>
          </div>
        </div>
      </div>


      <div id="products-modal">
      </div>


      <footer>
        <div class="container p-5">
          <div class="row">
            <div class="col-12 col-md-4 p-1">
              <a href="#">Condiciones de Uso</a>
            </div>
            <div class="col-12 col-md-4 p-1">
              <a href="#">Aviso de Privaciodad</a>
            </div>
            <div class="col-12 col-md-4 p-1">
              &copy; 1996-2020, Amazon.com, Inc. or its affiliates
            </div>
          </div>
        </div>
      </footer>
      
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="js/controlador.js"></script>
</body>
</html>