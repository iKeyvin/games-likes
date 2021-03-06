<?php
session_start();
require 'db/dbconexion.php';

$usuario = $_SESSION['usuario'];

$limit = isset($_POST["limit-records"]) ? $_POST["limit-records"] : 6;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;
$id_videojuego = $_POST['id_videojuego'];

if (isset($_POST['buscar'])) {
    $nombre = $_POST['nombre'];

    $sql = "SELECT * FROM videojuegos WHERE nombre LIKE '%$nombre%' ORDER BY id_videojuego DESC";
    $res = mysqli_query($conexion,  $sql);
} else if (isset($_POST['fullVideojuego'])) {

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

$sqlVotosUp = "SELECT * FROM votos WHERE id_videojuego = $id_videojuego AND thumbs='like'";
$resVotosUp = mysqli_query($conexion, $sqlVotosUp);
$votosUp = mysqli_num_rows($resVotosUp);

$sqlVotosDown = "SELECT * FROM votos WHERE id_videojuego = $id_videojuego AND thumbs='dislike'";
$resVotosDown = mysqli_query($conexion, $sqlVotosDown);
$votosDown = mysqli_num_rows($resVotosDown);


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
        <?php } ?>
        <?php if (mysqli_num_rows($res) > 0) {
            while ($videojuegos = mysqli_fetch_assoc($res)) {
                $id = $videojuegos['id_videojuego']; ?>
                <!--- Main videogames -->
                <div class="container">
                    <div class="row mt-5">
                        <div class="col">
                            <form action="videojuegos.php" method="post">
                                <button type="submit" name="fullVideojuego" class="border-0 m-0 bg-white"><img src="uploads/<?= $videojuegos['imagen'] ?> " class="zoom w-100" /></button>
                        </div>
                        <div id="moduleGames" class="col-8">
                            <h4 class="my-4"><?= $videojuegos['nombre'] ?></h4>
                            <h6><?= $videojuegos['fecha_pub'] ?></h6>
                            <p class="collapse" id="collapseExample" aria-expanded="false"><?= $videojuegos['informacion'] ?></p>

                            <input type="hidden" name="id_videojuego" value="<?= $videojuegos['id_videojuego'] ?>">
                            <button type="submit" name="fullVideojuego" class="btnmas btn btn-outline-dark btn-md">Leer más</button>
                            </form>
                        </div>
                    </div>
                </div>

            <?php }
        } else { ?>
            <h6 class="text-center">No se encuentra ningún dato.</h6>
        <?php } ?>
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
                            <input type="hidden" id="videojuegoAjax" name="id_videojuego" value="<?= $videojuegos['id_videojuego'] ?>">
                            <input type="hidden" id="usuarioAjax" name="id_usuario" value="<?= $_SESSION['id_usuario'] ?>">
                            <button id="like" class="btnlikeup btn-block btn-primary pt-2 mt-5 mr-2">
                                <h3><i class="fas fa-thumbs-up"></i>
                                    <p class="display_up d-inline"><?= $votosUp ?></p>
                                </h3>
                            </button>
                            <button id="dislike" name="down" class="btnlikedown btn-block btn-primary pt-2 mt-5 ml-2º">
                                <h3><i class="fas fa-thumbs-down"></i>
                                    <p class="display_down d-inline"><?= $votosDown ?></p>
                                </h3>
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
                        </div>
                    </div>
                </div>
                <?php
                $sqlComentario = "SELECT * FROM comentarios WHERE id_videojuego = $id_videojuego ORDER BY fecha_pub ASC";
                $resComentario = mysqli_query($conexion,  $sqlComentario);
                if (mysqli_num_rows($resComentario) > 0) {
                    while ($comentarios = mysqli_fetch_assoc($resComentario)) { ?>
                        <div class="container mt-5" id="comentarios<?= $comentarios['id_comentario'] ?>">
                            <div class="row">
                                <div class="col-2 text-center"><img src="uploads/<?= $comentarios['imagen'] ?>" class="img-thumbnail rounded float-left w-auto mb-2">
                                    <p>Usuario: <?= $comentarios['usuario'] ?></p>
                                </div>
                                <div class="col-10 bg-dark text-light border border-dark rounded">
                                    <p class="text-muted">Fecha: <?= $comentarios['fecha_pub'] ?></p>
                                    <p><?= $comentarios['comentario'] ?></p>
                                </div>
                            </div>
                            <div class="d-flex flex-row-reverse mt-2">
                                <input type="hidden" id="idComentario" value="<?= $comentarios['id_comentario'] ?>">
                                <?php if ($_SESSION['usuario'] == $comentarios['usuario']) { ?>
                                    <button type="button" class="btn btn-danger" id="deleteComment<?= $comentarios['id_comentario'] ?>">Eliminar</button>
                                <?php } ?>
                            </div>
                        </div>
                        </div>
                <?php }
                } ?>
                <div class="container mt-5" id="comentariosAppend"></div>
                <?php if (isset($_SESSION['usuario'])) { ?>
                    <div class="container mt-5">
                        <div class="row">
                            <input type="hidden" id="imagenAjax" value="<?= $_SESSION['imagen'] ?>">
                            <input type="hidden" id="usuarioComAjax" value="<?= $_SESSION['usuario'] ?>">
                            <input type="hidden" id="videojuegoComAjax" value="<?= $videojuegos['id_videojuego'] ?>">
                            <div class="col-2 text-center"><img src="uploads/<?= $_SESSION['imagen'] ?>" class="img-thumbnail rounded float-left w-auto mb-2">
                                <p class="display_usuario"><?= $_SESSION['usuario']  ?></p>
                            </div>
                            <textarea id="comentarioAjax" class="col-10 bg-warning text-dark border border-warning rounded" style="height:150px;" placeholder="Escribe un comentario..."></textarea>
                        </div>
                        <div class="d-flex flex-row-reverse"><button type="button" class="btn btn-primary" id="addComment">Comentar</button></div>
                    </div>
                <?php } ?>

        <?php }
        } ?>
    <?php } ?>
    <div class="container mt-5"></div>

    <?php include 'includes/modal-msg.php' ?>
    <!--- Start Footer -->
    <?php include 'includes/footer.php' ?>
    <!--- Script Source Files -->
    <?php include 'includes/scripts.php' ?>
</body>

</html>