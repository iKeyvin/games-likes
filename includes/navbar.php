<?php
session_start();
?>
<nav class="navbar navbar-dark bg-dark navbar-expand-lg fixed-top">
    <div class="container">

        <a href="index.php" class="navbar-brand">
            <img src="img/logogameslikes.png" alt="Logo" title="Logo">
            Games & Likes
        </a>

        <button class="navbar-toggler" data-target="#navbarResponsive" data-toggle="collapse" type="button"><span class="navbar-toggler-icon"></span></button>

        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="videojuegos.php">Videojuegos</a>
                </li>
                <li class="nav-item">
                    <?php if (isset($_SESSION['id_usuario']) && $_SESSION['usuario'] == 'Admin') { ?>
                        <a id="btn-login" class="nav-link" href="admin-view.php"><?php echo $_SESSION['usuario']; ?></a>
                <li class="nav-item">
                    <a id="btn-login" class="nav-link" href="db/logout.php">Cerrar Sessión</a>
                </li>
            <?php } else if (isset($_SESSION['id_usuario']) && isset($_SESSION['usuario'])) { ?>
                <a id="btn-login" class="nav-link" href="user-view.php"><?php echo $_SESSION['usuario']; ?></a>

                </li>
                <li class="nav-item">
                    <a id="btn-login" class="nav-link" href="db/logout.php">Cerrar Sessión</a>
                </li>
            <?php } else { ?>
                <a id="btn-login" class="nav-link" href="login-view.php">Login</a>
            <?php } ?>
            </li>
            <form class="form-inline my-2 my-lg-0" action="./videojuegos.php" method="post">
                <input class="form-control mr-sm-2" type="search" placeholder="Buscar Videojuego" aria-label="Buscar" name="nombre">
                <button class="btn btn-primary my-2 my-sm-0" name="buscar" type="submit">Buscar</button>
            </form>
            </ul>
        </div>
    </div>
</nav>