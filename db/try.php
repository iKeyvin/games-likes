<?php
session_start();
require 'dbconexion.php';

if (isset($_POST['up'])) {

    header("Location: ../videojuegos.php?error0=Vaya, parece que se ha producido un error. Inténtalo de nuevo.");
    exit();

    $voto = $_POST['votoup'];
    $id_videojuego = $_POST['id_videojuego'];
    $id_usuario = $_POST['id_usuario'];

    $sql = "SELECT * FROM votos WHERE id_videojuego = $id_videojuego AND id_usuario = $id_usuario AND thumbs_up > 0 ";
    $result = mysqli_query($conexion, $sql);

    $sql2 = "SELECT * FROM votos WHERE id_videojuego = $id_videojuego AND id_usuario = $id_usuario AND thumbs_up = 0 ";
    $result2 = mysqli_query($conexion, $sql);

    

    if($result == false){

        $sql3 = "INSERT INTO votos (id_videojuego, id_usuario, thumbs_up) VALUES ('$id_videojuego','$id_usuario', 1)";
        $result3 = mysqli_query($conexion, $sql2);

        header("Location: ../videojuegos.php?error1=Vaya, parece que se ha producido un error. Inténtalo de nuevo.");
        exit();

    } else if($result2){
        $sql3 = "UPDATE votos SET thumbs_up=1 WHERE id_videojuego=$id_videojuego AND id_usuario=$id_usuario";
        $result3 = mysqli_query($conexion, $sql2);
        header("Location: ../videojuegos.php?error1=Vaya, parece que se ha producido un error. Inténtalo de nuevo.");
        exit();
    } else {
        $sql3 = "UPDATE votos SET thumbs_up=0 WHERE id_videojuego=$id_videojuego AND id_usuario=$id_usuario";
        $result3 = mysqli_query($conexion, $sql2);
        header("Location: ../videojuegos.php?error3=Vaya, parece que se ha producido un error. Inténtalo de nuevo.");
        exit();
    }

} else if (isset($_POST['down'])) {

    $voto = $_POST['votodown'];

}