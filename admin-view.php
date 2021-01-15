<?php
session_start();

if ($_SESSION['usuario'] == 'Admin') {

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
        <!--- Start Footer -->
        <?php include 'includes/footer.php' ?>
        <!--- Script Source Files -->
        <?php include 'includes/scripts.php' ?>
    </body>

    </html>
<?php } else {
    header("location: index.php");
    exit();
} ?>