<?php
session_start();
require 'db/dbconexion.php';

if ($_SESSION['usuario'] == 'Admin') {

    $limit = isset($_POST["limit-records"]) ? $_POST["limit-records"] : 10;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $start = ($page - 1) * $limit;
    $sql = "SELECT * FROM videojuegos ORDER BY id_videojuego DESC LIMIT $start, $limit";
    $res = mysqli_query($conexion,  $sql);

    $result1 = $conexion->query("SELECT count(id_videojuego) AS id_videojuego FROM videojuegos");
    $custCount = $result1->fetch_all(MYSQLI_ASSOC);
    $total = $custCount[0]['id_videojuego'];
    $pages = ceil($total / $limit);



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
        <title>Admin</title>
    </head>

    <body>
        <!--- Navigation -->
        <?php include 'includes/navbar.php' ?>

        <div class="admin-content container">
            <h3 class="text-dark text-center">Admin</h3>
            <div class="line border-top border-primary w-25 mx-auto my-3"></div>
        </div>

        <div class="container mt-5">
            <div class="row">
                <div class="col ml-2">
                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalAddGame" id="addnewbtn">Añadir</button>
                    <?php include 'includes/modal-add-game.php' ?>
                </div>
                <div class="col">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            <li class="page-item">
                                <a class="page-link text-dark" href="admin-view.php?page=<?= $Previous; ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            <?php for ($i = 1; $i <= $pages; $i++) : ?>
                                <li class="page-item <?php if ($page == $i) { ?>active<?php } ?>"><a class="page-link text-dark" href="admin-view.php?page=<?= $i; ?>"><?= $i; ?></a></li>
                            <?php endfor; ?>
                            <li class="page-item">
                                <a class="page-link text-dark" href="admin-view.php?page=<?= $Next; ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="col">
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-primary ml-1" type="submit">Search</button>
                    </form>
                </div>
            </div>

        </div>

        <div class="container pt-4">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Título</th>
                        <th scope="col">Fecha de Publicación</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Editar / Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($res) > 0) {
                        while ($videojuegos = mysqli_fetch_assoc($res)) {
                            $id = $videojuegos['id_videojuego'] ?>
                            <tr>
                                <td><?= $videojuegos['id_videojuego'] ?></td>
                                <td class="w-25"><img src="uploads/<?= $videojuegos['imagen'] ?>" class="img-thumbnail rounded float-left w-75"></td>
                                <td><?= $videojuegos['nombre'] ?></td>
                                <td><?= $videojuegos['fecha_pub'] ?></td>
                                <td>
                                    <p class="d-inline-block text-truncate" style="max-width: 150px;"><?= $videojuegos['informacion'] ?></p>
                                </td>
                                <td>
                                    <ul class="edit">
                                        <?php include 'includes/modal-delete-game.php' ?>
                                        <?php include 'includes/modal-edit-game.php' ?>
                                        <li><button class="btn mr-3 bg-dark" ><i class="far fa-edit text-light"></i></button></li>
                                        <li><button type="button" class="btn mr-3 bg-dark" data-toggle="modal" data-target="#modalDeleteGame<?= $videojuegos['id_videojuego'] ?>"><i class="fas fa-trash-alt text-light"></i></a></li>
                                    </ul>
                                </td>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>
        </div>

        <?php include 'includes/modal-msg.php' ?>
        <!--- Start Footer -->
        <?php include 'includes/footer.php' ?>
        <!--- Script Source Files -->
        <?php include 'includes/scripts.php' ?>
        <!-- Modal -->
        <?php if (isset($_GET['modal'])) { ?>
            <script>
                $(document).ready(function() {

                    $("#modalAddGame").modal("show");
                });
            </script>
        <?php } ?>
        <?php if (isset($_GET['msg'])) { ?>
            <script>
                $(document).ready(function() {

                    $("#modalMsg").modal("show");
                });
            </script>
        <?php } ?>
    </body>

    </html>
<?php } else {
    header("location: index.php");
    exit();
} ?>