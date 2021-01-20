<?php
session_start();
require 'dbconexion.php';

if (isset($_POST['deleteGame'])){
    $id_videojuego = $_POST['id_videojuego'];

    if (empty($id_videojuego)) {
        header("Location: ../admin-view.php?error=empty");
        exit();
    }

    $sql = "DELETE FROM videojuegos WHERE id_videojuego=$id_videojuego";
    $result = mysqli_query($conexion, $sql);

    if($result){
        header("Location: ../admin-view.php?msg=true");
        exit();
    } else {
        header("Location: ../admin-view.php?error=$id_videojuego");
        exit();
    }
} else {
    header("Location: ../admin-view.php?error");
        exit();
}