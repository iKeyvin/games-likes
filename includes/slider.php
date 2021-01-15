<?php
session_start();
?>
<div id="mycarousel" class="carousel slide" data-ride="carousel" data-interval="6500">

    <!-- Indicators -->
    <ul class="carousel-indicators">
        <li data-target="#mycarousel" data-slide-to="0" class="active"></li>
        <li data-target="#mycarousel" data-slide-to="1"></li>
        <li data-target="#mycarousel" data-slide-to="2"></li>
    </ul>

    <!-- The slideshow -->
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="img/img1.png" alt="" class="w-100">
            <div class="carousel-caption">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-8 bg-custom d-none d-md-block py-3 px-0">
                            <h1>Games & Likes</h1>
                            <div class="sliderline border-top border-primary w-50 mx-auto my-3"></div>
                            <h3 class="pb-3">Proyecto Web</h3>
                            <a href="videojuegos.php" class="btn btn-danger btn-lg mr-2">Ver Reseñas</a>
                            <?php if (isset($_SESSION['id_usuario']) && isset($_SESSION['usuario'])) { ?>
                            <a href="search-view.php" class="btn btn-primary btn-lg ml-2">Buscar</a>
                            <?php } else { ?>
                            <a href="register-view.php" class="btn btn-primary btn-lg ml-2">Registrarse</a>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item">
        <img src="img/img2.png" alt="" class="w-100">
            <div class="carousel-caption">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-8 bg-custom d-none d-md-block py-3 px-0">
                            <h1>Games & Likes</h1>
                            <div class="sliderline border-top border-primary w-50 mx-auto my-3"></div>
                            <h3 class="pb-3">Proyecto Web</h3>
                            <a href="videojuegos.php" class="btn btn-danger btn-lg mr-2">Ver Reseñas</a>
                            <?php if (isset($_SESSION['id_usuario']) && isset($_SESSION['usuario'])) { ?>
                            <a href="search-view.php" class="btn btn-primary btn-lg ml-2">Buscar</a>
                            <?php } else { ?>
                            <a href="register-view.php" class="btn btn-primary btn-lg ml-2">Registrarse</a>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item">
        <img src="img/img3.png" alt="" class="w-100">
            <div class="carousel-caption">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-8 bg-custom d-none d-md-block py-3 px-0">
                            <h1>Games & Likes</h1>
                            <div class="sliderline border-top border-primary w-50 mx-auto my-3"></div>
                            <h3 class="pb-3">Proyecto Web</h3>
                            <a href="videojuegos.php" class="btn btn-danger btn-lg mr-2">Ver Reseñas</a>
                            <?php if (isset($_SESSION['id_usuario']) && isset($_SESSION['usuario'])) { ?>
                            <a href="search-view.php" class="btn btn-primary btn-lg ml-2">Buscar</a>
                            <?php } else { ?>
                            <a href="register-view.php" class="btn btn-primary btn-lg ml-2">Registrarse</a>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Left and right controls -->
    <a class="carousel-control-prev" href="#mycarousel" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#mycarousel" data-slide="next">
        <span class="carousel-control-next-icon"></span>
    </a>
</div>