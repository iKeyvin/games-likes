<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'includes/head.php'?>
    <title>Regisitrarse</title>
</head>

<body>
    <!--- Navigation -->
    <?php include 'includes/navbar.php'?>
    <!--- Register Form -->
    <form method="post" action="db/register.php">
        <div class="container register-form w-100">
            <div class="form">
                <div class="col-12 text-center mt-5">
                    <h3 class="text-dark pt-4">Registrarse</h3>
                    <div class="line border-top border-primary w-25 mx-auto my-3"></div>
                </div>
                <div class="register-content mt-3">
                    <?php if (isset($_GET['error'])) {?>
                        <p class="error"><?php echo $_GET['error']; ?></p>
                    <?php }?>

                    <?php if (isset($_GET['success'])) {?>
                        <p class="success text-success"><?php echo $_GET['success']; ?></p>
                    <?php }?>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <?php if (isset($_GET['usuario'])) {?>
                                    <input type="text" class="form-control" placeholder="Usuario *" name="usuario" value="<?php echo $_GET['usuario']; ?>" />
                                <?php } else {?>
                                    <input type="text" class="form-control" placeholder="Usuario *" name="usuario" value="" />
                                <?php }?>
                            </div>
                            <div class="form-group">
                                <?php if (isset($_GET['nombre'])) {?>
                                    <input type="text" class="form-control" placeholder="Nombre *" name="nombre" value="<?php echo $_GET['nombre']; ?>" />
                                <?php } else {?>
                                    <input type="text" class="form-control" placeholder="Nombre *" name="nombre" value="" />
                                <?php }?>
                            </div>
                            <div class="form-group">
                            <?php if (isset($_GET['apellidos'])) {?>
                                <input type="text" class="form-control" placeholder="Apellidos *" name="apellidos" value="<?php echo $_GET['apellidos']; ?>" />
                                <?php } else {?>
                                    <input type="text" class="form-control" placeholder="Apellidos *" name="apellidos" value="" />
                                <?php }?>
                            </div>
                            <div class="form-group">
                            <?php if (isset($_GET['email'])) {?>
                                <input type="text" class="form-control" placeholder="Correo Electrónico *" name="email" value="<?php echo $_GET['email']; ?>" />
                                <?php } else {?>
                                    <input type="text" class="form-control" placeholder="Correo Electrónico *" name="email" value="" />
                                <?php }?>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                            <?php if (isset($_GET['fecha_nacimiento'])) {?>
                                <input type="date" class="form-control" placeholder="Fecha Nacimiento *" name="fecha_nacimiento" value="<?php echo $_GET['fecha_nacimiento']; ?>" />
                                <?php } else {?>
                                    <input type="date" class="form-control" placeholder="Fecha Nacimiento *" name="fecha_nacimiento" value="" />
                                <?php }?>
                            </div>
                            <div class="form-group">
                            <?php if (isset($_GET['telefono'])) {?>
                                <input type="text" class="form-control" placeholder="Teléfono/Móvil *" name="telefono" value="<?php echo $_GET['telefono']; ?>" />
                                <?php } else {?>
                                    <input type="text" class="form-control" placeholder="Teléfono/Móvil *" name="telefono" value="" />
                                <?php }?>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Contraseña *" name="contraseña" value="" />
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Verificar la  contraseña *" name="re_contraseña" value="" />
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="register" class="btnSubmit btn-lg btn-primary mb-3">Crear Cuenta</button>
                    <p class="pl-1"> ¿Ya tienes una cuenta? <a href="login-view.php" class="crear">Login</a></p>
                </div>
            </div>
        </div>
    </form>
    <!--- Script Source Files -->
    <?php include 'includes/scripts.php'?>
</body>

</html>
