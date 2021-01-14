<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'includes/head.php' ?>
    <title>Login</title>
</head>

<body>
    <!--- Navigation -->
    <?php include 'includes/navbar.php' ?>
    <!--- Register Form -->
    <form method="POST" action="db/register.php">
        <div class="container register-form w-100">
            <div class="form">
                <div class="col-12 text-center mt-5">
                    <h3 class="text-dark pt-4">Registrarse</h3>
                    <div class="line border-top border-primary w-25 mx-auto my-3"></div>
                </div>
                <div class="register-content mt-3">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Usuario *" value="" />
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Nombre *" value="" />
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Apellidos *" value="" />
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <input type="date" class="form-control" placeholder="Fecha Nacimiento *" value="" />
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Teléfono/Móvil *" value="" />
                            </div>
                            <div class="form-group">
                                <input type="contraseña" class="form-control" placeholder="Contraseña *" value="" />
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="register" class="btnSubmit btn-lg btn-primary mb-3">Crear Cuenta</button>
                </div>
            </div>
        </div>
    </form>
</body>
</html>