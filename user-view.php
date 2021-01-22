<?php
session_start();
require 'db/dbconexion.php';

if ($_SESSION['usuario'] == 'Admin') {
    header("Location: admin-view.php");
    exit();
} else {
    $usuario = $_SESSION['usuario'];
    $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
    $res = mysqli_query($conexion,  $sql);

?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <?php include 'includes/head.php' ?>
        <title>User</title>
    </head>

    <body>
        <!--- Navigation -->
        <?php include 'includes/navbar.php' ?>

        <div class="admin-content container">
            <h3 class="text-dark text-center">Mi perfil</h3>
            <div class="line border-top border-primary w-25 mx-auto my-3"></div>
        </div>
        <?php include 'includes/modal-update-user.php' ?>
        <div class="container mb-5 mt-5 d-flex justify-content-center">
            <div class="row text-center">
                <?php if (mysqli_num_rows($res) > 0) {
                    while ($usuarios = mysqli_fetch_assoc($res)) { ?>
                        <div class="col">
                            <img src="uploads/<?= $usuarios['imagen'] ?>" alt="" class="zoom w-50">
                            <h4 class="mt-3 text-center text-dark">Usuario: <?= $usuarios['usuario'] ?></h4>
                        </div>
            </div>
            <?php include 'includes/modal-update-user.php' ?>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" colspan="2">Datos</th>
                        <th scope="col" class="text-right">Editar <button class="btn bg-warning" ><i class="far fa-edit text-dark" data-toggle="modal" data-target="#modalUpdateUser<?= $usuarios['id_usuario'] ?>"></i></button></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Nombre</th>
                        <td colspan="2"><?= $usuarios['nombre'] ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Apellidos</th>
                        <td colspan="2"><?= $usuarios['apellidos'] ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Fecha de nacimiento</th>
                        <td colspan="2"><?= $usuarios['fecha_nacimiento'] ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Email</th>
                        <td colspan="2"><?= $usuarios['email'] ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Teléfono</th>
                        <td colspan="2"><?= $usuarios['telefono'] ?></td>
                    </tr>
                </tbody>
            </table>
    <?php }
                } ?>
        </div>
        

        <?php include 'includes/modal-msg-user.php' ?>
        <!--- Start Footer -->
        <?php include 'includes/footer.php' ?>
        <!--- Script Source Files -->
        <?php include 'includes/scripts.php' ?>

        <?php if (isset($_GET['modalUpdate'])) { ?>
            <script>
                $(document).ready(function() {
                    $("#modalUpdateUser").modal("show");
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

<?php } ?>