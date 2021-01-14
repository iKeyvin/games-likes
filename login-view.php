<?php
session_start();
if (isset($_SESSION['id_usuario']) === false && isset($_SESSION['usuario']) === false) {
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

    <!--- Login Form -->
    <form method="POST" action="db/login.php">
        <div class="container login-form w-50">
            <div class="form">
                <div class="col-12 text-center mt-5">
                    <h3 class="text-dark pt-4">Iniciar Sessión</h3>
                    <div class="line border-top border-primary w-25 mx-auto my-3"></div>
                </div>
                <div class="form-content mt-3">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <input type="text" class="form-control" name="usuario" placeholder="Usuario" value="" />
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="contraseña" placeholder="Contraseña" value="" />
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="login" class="btnSubmit btn-lg btn-primary mb-3">Login</button>
                    <a href="register-view.php" class="crear">Crear cuenta</a>
                    <?php if (isset($_GET['error'])) { ?>
                        <p class="error"><?php echo $_GET['error']; ?></p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </form>
    
</body>

</html>
<?php } else { header("Location: index.php"); } ?>