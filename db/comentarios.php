<?php
session_start();
require 'dbconexion.php';


if ($_POST['action'] == 'addComment') {

    $usuario = $_POST['usuario'];
    $id_videojuego = $_POST['id_videojuego'];
    $imagen = $_POST['imagen'];
    $comentario = $_POST['comentario'];
    $fecha_pub = date('Y-m-d h:i:s');

    $data = 'usuario=' . $usuario . '&id_videojuego=' . $id_videojuego . '&imagen=' . $imagen . '&comentario=' . $comentario;

    if (empty($comentario)) {
        echo $data;
    } else {
        $sql = "INSERT INTO comentarios (usuario, comentario, id_videojuego, imagen, fecha_pub) VALUES ('$usuario', '$comentario',$id_videojuego,'$imagen', '$fecha_pub')";

        $result = mysqli_query($conexion, $sql);

        if ($result) {
            $sqlComentario = "SELECT id_comentario FROM comentarios WHERE comentario='$comentario'";
            $resComentario = mysqli_query($conexion,  $sqlComentario);
            if (mysqli_num_rows($resComentario) > 0) {
                while ($comentarios = mysqli_fetch_assoc($resComentario)) {
                    $idComentario = $comentarios['id_comentario'];
                    $array = array('key1' => $usuario, 'key2' => $comentario, 'key3' => $imagen, 'key4' => $fecha_pub, 'key5' => $idComentario);
                    echo json_encode($array);
                }
            }
        } else {
            echo 'error';
        }
    }
} else if ($_POST['action'] == 'deleteComment') {
    $id_comentario = $_POST['id_comentario'];
    $sql = "DELETE FROM comentarios WHERE id_comentario=$id_comentario";
    $result = mysqli_query($conexion, $sql);
}
