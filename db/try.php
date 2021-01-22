<?php
session_start();
require 'dbconexion.php';

if (
    isset($_POST['cancelFree'])
) {
    header("Location: ../admin-view.php");
    exit();
}

if (
    isset($_POST['updateGame'])
) {

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $nombre = validate($_POST['nombre']);
    $informacion = validate($_POST['informacion']);
    $fecha_pub = date('Y-m-d h:i:s');
    $categoria = validate($_POST['categoria']);
    $modal = true;
    $id_videojuego = $_POST['id_videojuego'];

    $img_name = $_FILES['imagen']['name'];
    $img_size = $_FILES['imagen']['size'];
    $tmp_name = $_FILES['imagen']['tmp_name'];
    $error = $_FILES['imagen']['error'];

    $user_data = 'nombre=' . $nombre . '&informacion=' . $informacion . '&categoria=' . $categoria . '&modal=' . true;


    if (empty($nombre)) {
        header("Location: ../admin-view.php?error=¡Introduce un título!&$user_data");
        exit();
    } else if (empty($informacion)) {
        header("Location: ../admin-view.php?error=¡Introduzca la descripción!&$user_data");
        exit();
    } else if (empty($categoria)) {
        header("Location: ../admin-view.php?error=¡Seleccione una categoría!&$user_data");
        exit();
    } else {
        if ($img_size > 150000) {
            $em = "Sorry, your file is too large.";
            header("Location: ../admin-view.php?error=$em&$user_data");
        } else {

            if (empty($img_name)) {
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);

                $allowed_exs = array("jpg", "jpeg", "png");

                if (in_array($img_ex_lc, $allowed_exs)) {
                    $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                    $img_upload_path = '../uploads/' . $new_img_name;
                    move_uploaded_file($tmp_name, $img_upload_path);

                    $sql2 = "UPDATE videojuegos SET nombre='$nombre', informacion='$informacion', id_categoria='$categoria', imagen='$new_img_name' WHERE id_videojuego='";
                }

                $result2 = mysqli_query($conexion, $sql2);

                if ($result2) {

                    header("Location: ../admin-view.php?success=¡Enhorabuena! Se ha añadido un nuevo videojuego.&modal=$modal");
                    exit();
                } else {
                    header("Location: ../admin-view.php?error=Vaya, parece que se ha producido un error. Inténtalo de nuevo.&$user_data");
                    exit();
                }
            } else {

                $sql2 = "UPDATE videojuegos SET nombre='$nombre', informacion='$informacion', id_categoria='$categoria' WHERE id_videojuego=$id_videojuego";
                $result2 = mysqli_query($conexion, $sql2);

                if ($result2) {

                    header("Location: ../admin-view.php?success=¡Enhorabuena! Se ha añadido un nuevo videojuego.&modal=$modal");
                    exit();
                } else {
                    header("Location: ../admin-view.php?error=Vaya, parece que se ha producido un error. Inténtalo de nuevo.&$user_data");
                    exit();
                }
            }
        }
    }
} else {
    header("Location: ../admin-view.php");
    exit();
}
