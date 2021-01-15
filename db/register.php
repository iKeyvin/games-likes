<?php
session_start();
require 'dbconexion.php';

if (
    isset($_POST['usuario']) && isset($_POST['contraseña'])
    && isset($_POST['nombre']) && isset($_POST['re_contraseña']) && isset($_POST['apellidos']) && isset($_POST['fecha_nacimiento']) && isset($_POST['telefono']) && isset($_POST['email'])
) {

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $usuario = validate($_POST['usuario']);
    $contraseña = validate($_POST['contraseña']);
    $re_contraseña = validate($_POST['re_contraseña']);
    $nombre = validate($_POST['nombre']);
    $apellidos = validate($_POST['apellidos']);
    $email = validate($_POST['email']);
    $fecha_nacimiento = validate($_POST['fecha_nacimiento']);
    $telefono = validate($_POST['telefono']);


    $user_data = 'usuario=' . $usuario . '&nombre=' . $nombre . '&apellidos=' . $apellidos . '&email=' . $email . '&telefono=' . $telefono . '&fecha_nacimiento=' . $fecha_nacimiento;


    if (empty($usuario)) {
        header("Location: ../register-view.php?error=¡Introduce un usuario!&$user_data");
        exit();
    } else if (empty($nombre)) {
        header("Location: ../register-view.php?error=¡Introduce el nombre!&$user_data");
        exit();
    } else if (empty($apellidos)) {
        header("Location: ../register-view.php?error=¡Introduce los apellidos!&$user_data");
        exit();
    } else if (empty($email)) {
        header("Location: ../register-view.php?error=¡Introduce un correo eletrónico!&$user_data");
        exit();
    }else if (empty($telefono)) {
        header("Location: ../register-view.php?error=¡Introduce un número de teléfono!&$user_data");
        exit();
    } else if (empty($fecha_nacimiento)) {
        header("Location: ../register-view.php?error=¡Introduce la fecha de nacimiento!&$user_data");
        exit();
    } else if (empty($contraseña)) {
        header("Location: ../register-view.php?error=¡Introduce una contraseña!&$user_data");
        exit();
    } else if (empty($re_contraseña)) {
        header("Location: ../register-view.php?error=La contraseña de verificación no coincide.&$user_data");
        exit();
    } else if ($contraseña !== $re_contraseña) {
        header("Location: ../register-view.php?error=La contraseña de verificación no coincide.&$user_data");
        exit();
    } else {
        // hashing the contraseña
        $contraseña = md5($contraseña);

        $sql = "SELECT * FROM usuarios WHERE usuario='$usuario' ";
        $result = mysqli_query($conexion, $sql);

        if (mysqli_num_rows($result) > 0) {
            header("Location: ../register-view.php?error=¡El usuario ya existe!&$user_data");
            exit();
        } else {

            $sql2 = "INSERT INTO usuarios (usuario, nombre, apellidos, fecha_nacimiento, telefono, email, contraseña) VALUES ('$usuario','$nombre','$apellidos','$fecha_nacimiento','$telefono','$email', '$contraseña')";
            $result2 = mysqli_query($conexion, $sql2);

            if ($result2) {
                header("Location: ../register-view.php?success=¡Enhorabuena! Tu cuenta se ha creado.");
                exit();
            } else {
                header("Location: ../register-view.php?error=Vaya, parece que se ha producido un error. Inténtalo de nuevo.&$user_data");
                exit();
            }
        }
    }
} else {
    header("Location: ../register-view.php");
    exit();
}
