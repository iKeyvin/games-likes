<?php
session_start();
require 'dbconexion.php';

if (
    isset($_POST['cancelFree'])
) {
    header("Location: ../user-view.php");
    exit();
}

if (isset($_POST['updateUser'])) {

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $nombre = validate($_POST['nombre']);
    $apellidos = validate($_POST['apellidos']);
    $email = validate($_POST['email']);
    $fecha_nacimiento = validate($_POST['fecha_nacimiento']);
    $telefono = validate($_POST['telefono']);
    $id_usuario = $_POST['id_usuario'];

    $img_name = $_FILES['imagen']['name'];
    $img_size = $_FILES['imagen']['size'];
    $tmp_name = $_FILES['imagen']['tmp_name'];
    $error = $_FILES['imagen']['error'];

    $user_data = '&usuario=' . $id_usuario . '&nombre=' . $nombre . '&apellidos=' . $apellidos . '&email=' . $email . '&telefono=' . $telefono . '&fecha_nacimiento=' . $fecha_nacimiento . '&modalUpdate=' . true;


    if (empty($nombre)) {
        header("Location: ../user-view.php?error=¡Introduce un nombre!&$user_data");
        exit();
    } else if (empty($apellidos)) {
        header("Location: ../user-view.php?error=¡Introduce los apellidos!&$user_data");
        exit();
    } else if (empty($email)) {
        header("Location: ../user-view.php?error=¡Introduce un correo eletrónico!&$user_data");
        exit();
    } else if (empty($telefono)) {
        header("Location: ../user-view.php?error=¡Introduce un número de teléfono!&$user_data");
        exit();
    } else if (empty($fecha_nacimiento)) {
        header("Location: ../user-view.php?error=¡Introduce la fecha de nacimiento!&$user_data");
        exit();
    } else {

        if (empty($img_name)) {

            $sql2 = "UPDATE usuarios SET nombre='$nombre', apellidos='$apellidos', email='$email', telefono='$telefono', fecha_nacimiento='$fecha_nacimiento' WHERE id_usuario=$id_usuario";

            $result2 = mysqli_query($conexion, $sql2);

            if ($result2) {
                header("Location: ../user-view.php?msg=true&mensaje=¡Enhorabuena! Se ha actualizado correctamente.");
                exit();
            } else {
                header("Location: ../user-view.php?error=Vaya, parece que se ha producido un error. Inténtalo de nuevo.&$user_data");
                exit();
            }
        } else {

            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);

            $allowed_exs = array("jpg", "jpeg", "png");

            if (in_array($img_ex_lc, $allowed_exs)) {

                $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                $img_upload_path = '../uploads/' . $new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);

                $sql2 = "UPDATE usuarios SET nombre='$nombre', apellidos='$apellidos', email='$email', telefono='$telefono', fecha_nacimiento='$fecha_nacimiento', imagen='$new_img_name' WHERE id_usuario=$id_usuario";

                $result2 = mysqli_query($conexion, $sql2);

                if ($result2) {
                    header("Location: ../user-view.php?msg=true&mensaje=¡Enhorabuena! Se ha actualizado correctamente.");
                    exit();
                } else {
                    header("Location: ../user-view.php?error=Vaya, parece que se ha producido un error. Inténtalo de nuevo.&$user_data");
                    exit();
                }
            }
        }
    }
} else {
    header("Location: ../user-view.php");
    exit();
}
