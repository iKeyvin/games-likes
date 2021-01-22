<?php
session_start();
require 'db/dbconexion.php';

$limit = isset($_POST["limit-records"]) ? $_POST["limit-records"] : 6;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

if (isset($_POST['buscar'])) {
    $nombre = $_POST['nombre'];

    $sql = "SELECT * FROM videojuegos WHERE nombre LIKE '%$nombre%' ORDER BY id_videojuego DESC";
    $res = mysqli_query($conexion,  $sql);
} else if (isset($_POST['fullVideojuego'])) {

    $id_videojuego = $_POST['id_videojuego'];

    $sql = "SELECT * FROM videojuegos WHERE id_videojuego = $id_videojuego";
    $res = mysqli_query($conexion,  $sql);
} else {
    $sql = "SELECT * FROM videojuegos ORDER BY id_videojuego DESC LIMIT $start, $limit";
    $res = mysqli_query($conexion,  $sql);

    $result1 = $conexion->query("SELECT count(id_videojuego) AS id_videojuego FROM videojuegos");
    $custCount = $result1->fetch_all(MYSQLI_ASSOC);
    $total = $custCount[0]['id_videojuego'];
    $pages = ceil($total / $limit);
}



if ($page > 1) {
    $Previous = $page - 1;
    $Next = $page + 1;
} else if ($page == 1) {
    $Previous = 1;
    $Next = $page + 1;
}

if ($page == $pages) {
    $Previous = $page - 1;
    $Next = $pages;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'includes/head.php' ?>
    <title>Videojuegos</title>
</head>

<body>
    <!--- Navigation -->
    <?php include 'includes/navbar.php' ?>

    <!--- Videogames -->

    <?php if (isset($_POST['fullVideojuego']) != true) { ?>
        <div class="admin-content container">
            <h3 class="text-dark text-center">Videojuegos</h3>
            <div class="line border-top border-primary w-25 mx-auto my-3"></div>
        </div>

        <div class="container mt-5">
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <li class="page-item">
                        <a class="page-link text-dark" href="videojuegos.php?page=<?= $Previous; ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <?php for ($i = 1; $i <= $pages; $i++) : ?>
                        <li class="page-item <?php if ($page == $i) { ?>active<?php } ?>"><a class="page-link text-dark" href="videojuegos.php?page=<?= $i; ?>"><?= $i; ?></a></li>
                    <?php endfor; ?>
                    <li class="page-item">
                        <a class="page-link text-dark" href="videojuegos.php?page=<?= $Next; ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <?php if (mysqli_num_rows($res) > 0) {
            while ($videojuegos = mysqli_fetch_assoc($res)) {
                $id = $videojuegos['id_videojuego']; ?>

                <div class="container">
                    <div class="row mt-5">
                        <div class="col">
                            <img src="uploads/<?= $videojuegos['imagen'] ?>" alt="" class="zoom w-100">
                        </div>
                        <div id="moduleGames" class="col-8">
                            <h4 class="my-4"><?= $videojuegos['nombre'] ?></h4>
                            <h6><?= $videojuegos['fecha_pub'] ?></h6>
                            <p class="collapse" id="collapseExample" aria-expanded="false"><?= $videojuegos['informacion'] ?></p>
                            <form action="videojuegos.php" method="post">
                                <input type="hidden" name="id_videojuego" value="<?= $videojuegos['id_videojuego'] ?>">
                                <button type="submit" name="fullVideojuego" class="btnmas btn btn-outline-dark btn-md">Leer más</button>
                            </form>
                        </div>
                    </div>
                </div>

        <?php }
        } ?>
        <?php if (isset($_POST['buscar']) != true) { ?>
            <div class="container mt-5">
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <li class="page-item">
                            <a class="page-link text-dark" href="videojuegos.php?page=<?= $Previous; ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>
                        <?php for ($i = 1; $i <= $pages; $i++) : ?>
                            <li class="page-item <?php if ($page == $i) { ?>active<?php } ?>"><a class="page-link text-dark" href="videojuegos.php?page=<?= $i; ?>"><?= $i; ?></a></li>
                        <?php endfor; ?>
                        <li class="page-item">
                            <a class="page-link text-dark" href="videojuegos.php?page=<?= $Next; ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <?php }
    } else {
        if (mysqli_num_rows($res) > 0) {
            while ($videojuegos = mysqli_fetch_assoc($res)) {
                $id = $videojuegos['id_videojuego']; ?>

                <div class="container">
                    <div class="admin-content container">
                        <h3 class="text-dark text-center"><?= $videojuegos['nombre'] ?></h3>
                        <div class="line border-top border-primary w-25 mx-auto my-3"></div>
                    </div>

                    <div class="container mt-5">
                        <div class="row justify-content-center">
                            <img src="uploads/<?= $videojuegos['imagen'] ?>" alt="" class="zoom w-50">
                        </div>

                        <div class="row justify-content-center">
                            <button class="btnlikeup btn-block btn-primary pt-2 mt-5 mr-2">
                                <h3><i class="fas fa-thumbs-up"></i> 0</h3>
                            </button>
                            <button class="btnlikedown btn-block btn-primary pt-2 mt-5 ml-2º">
                                <h3><i class="fas fa-thumbs-down"></i> 0</h3>
                            </button>
                        </div>

                    </div>

                    <div class="container">
                        <div class="row mt-5 text-justify">
                            <div id="moduleGames" class="col">
                                <h5>Descripción</h5>
                                <p><?= $videojuegos['informacion'] ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="border-top border-bottom border-warning w-100 mx-auto my-3"></div>

                    <div class="container ml-1">
                        <div class="row">
                        <h2>Comentarios</h2>
                        <button type="button" class="btn btn-secondary ml-4" data-toggle="modal" data-target="#modalAddGame" id="addnewbtn">Añadir</button>
                        </div>
                        
                    </div>
                    <div class="container mt-5">
                        <div class="row">
                            <div class="col-2 text-center"><img src="img/cyber.jpg" class="img-thumbnail rounded float-left w-auto mb-2"><p>Usuario</p></div>
                            <div class="col-10 bg-dark text-light border border-dark rounded">Comentario</div>
                        </div>
                    </div>
                </div>



        <?php }
        } ?>
    <?php } ?>
    <div class="container mt-5"></div>
    <!--- Start Footer -->
    <?php include 'includes/footer.php' ?>
    <!--- Script Source Files -->
    <?php include 'includes/scripts.php' ?>
</body>

</html>