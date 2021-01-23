<?php
session_start();
require 'dbconexion.php';

if ($_POST['action'] == 'up') {

    $id_videojuego = $_POST['id_videojuego'];
    $id_usuario = $_POST['id_usuario'];

    $sql = "SELECT * FROM votos WHERE id_videojuego = $id_videojuego AND id_usuario=$id_usuario";
    $result = mysqli_query($conexion,  $sql);
    $votosUp = mysqli_num_rows($result);

    if ($votosUp > 0) {

        $sql2 = "SELECT * FROM votos WHERE id_videojuego = $id_videojuego AND id_usuario=$id_usuario AND thumbs='like'";
        $result2 = mysqli_query($conexion,  $sql2);
        $votosUp2 = mysqli_num_rows($result2);

        if($votosUp2 == 1){
            $sql5 = "DELETE FROM votos WHERE id_videojuego = $id_videojuego AND id_usuario=$id_usuario AND thumbs='like'";
            $result5 = mysqli_query($conexion, $sql5);
        } else {
            $sql5 = "UPDATE votos SET thumbs='like' WHERE id_videojuego = $id_videojuego AND id_usuario=$id_usuario ";
            $result5 = mysqli_query($conexion, $sql5);
        }
    } else {

        $sql3 = "INSERT INTO votos (id_videojuego, id_usuario, thumbs) VALUES ('$id_videojuego','$id_usuario','like')";
        $result3 = mysqli_query($conexion, $sql3);
    }

    $sqlVotosUp = "SELECT * FROM votos WHERE id_videojuego = $id_videojuego AND thumbs='like'";
    $resVotosUp = mysqli_query($conexion, $sqlVotosUp);
    $votosUp = mysqli_num_rows($resVotosUp);

    $sqlVotosDown = "SELECT * FROM votos WHERE id_videojuego = $id_videojuego AND thumbs='dislike'";
    $resVotosDown = mysqli_query($conexion, $sqlVotosDown);
    $votosDown = mysqli_num_rows($resVotosDown);

    $array = array($votosUp,$votosDown);
    echo json_encode($array);


} else if ($_POST['action'] == 'down') {

    $id_videojuego = $_POST['id_videojuego'];
    $id_usuario = $_POST['id_usuario'];

    $sql = "SELECT * FROM votos WHERE id_videojuego = $id_videojuego AND id_usuario=$id_usuario";
    $result = mysqli_query($conexion,  $sql);
    $votosUp = mysqli_num_rows($result);;

    if ($votosUp > 0) {

        $sql2 = "SELECT * FROM votos WHERE id_videojuego = $id_videojuego AND id_usuario=$id_usuario AND thumbs='dislike'";
        $result2 = mysqli_query($conexion,  $sql2);
        $votosUp2 = mysqli_num_rows($result2);

        if($votosUp2 == 1){
            $sql5 = "DELETE FROM votos WHERE id_videojuego = $id_videojuego AND id_usuario=$id_usuario AND thumbs='dislike'";
            $result5 = mysqli_query($conexion, $sql5);
        } else {
            $sql5 = "UPDATE votos SET thumbs='dislike' WHERE id_videojuego = $id_videojuego AND id_usuario=$id_usuario ";
            $result5 = mysqli_query($conexion, $sql5);
        }
    } else {

        $sql3 = "INSERT INTO votos (id_videojuego, id_usuario, thumbs) VALUES ('$id_videojuego','$id_usuario','dislike')";
        $result3 = mysqli_query($conexion, $sql3);
    }

    $sqlVotosDown = "SELECT * FROM votos WHERE id_videojuego = $id_videojuego AND thumbs='dislike'";
    $resVotosDown = mysqli_query($conexion, $sqlVotosDown);
    $votosDown = mysqli_num_rows($resVotosDown);

    $sqlVotosUp = "SELECT * FROM votos WHERE id_videojuego = $id_videojuego AND thumbs='like'";
    $resVotosUp = mysqli_query($conexion, $sqlVotosUp);
    $votosUp = mysqli_num_rows($resVotosUp);

    $array = array($votosUp,$votosDown);
    echo json_encode($array);
   
}



