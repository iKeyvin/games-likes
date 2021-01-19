<?php
session_start();
require 'dbconexion.php';

if ($_SESSION['usuario'] == 'Admin') {

    $sql = "SELECT * FROM videojuegos ORDER BY id DESC";
    $res = mysqli_query($conexion,  $sql);

    if (mysqli_num_rows($res) > 0) {
        while ($images = mysqli_fetch_assoc($res)) { }}

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
                <div class="col ml-3">
                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalAddGame" id="addnewbtn">Añadir</button>
                    <?php include 'includes/modal-add-game.php' ?>
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
                        <th scope="col">Imagen</th>
                        <th scope="col">Título</th>
                        <th scope="col">Fecha de Publicación</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Editar / Borrar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><img src="http://placehold.it/80x80" class="img-thumbnail rounded float-left"></td>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>
                            <p class="d-inline-block text-truncate" style="max-width: 150px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                        </td>
                        <td>
                            <ul class="edit">
                                <li><a href="" class="btn mr-3 bg-dark" target="_blank"><i class="far fa-edit text-light"></i></a></li>
                                <li><a href="" class="btn mr-3 bg-dark" target="_blank"><i class="fas fa-trash-alt text-light"></i></a></li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td><img src="http://placehold.it/80x80" class="img-thumbnail rounded float-left"></td>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>
                            <p class="d-inline-block text-truncate" style="max-width: 150px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                        </td>
                        <td>
                            <ul class="edit">
                                <li><a href="" class="btn mr-3 bg-dark" target="_blank"><i class="far fa-edit text-light"></i></a></li>
                                <li><a href="" class="btn mr-3 bg-dark" target="_blank"><i class="fas fa-trash-alt text-light"></i></a></li>
                            </ul>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>


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
        <?php }?>
    </body>

    </html>
<?php } else {
    header("location: index.php");
    exit();
} ?>