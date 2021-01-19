<?php
session_start();

if (isset($_SESSION['usuario']) == 'Admin') {
    header("Location: admin-view.php");
    exit();
} else {
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <?php include 'includes/head.php' ?>
        <title>Login</title>
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

<?php } ?>