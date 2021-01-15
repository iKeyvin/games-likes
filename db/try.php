<?php 
session_start(); 
require 'dbconexion.php';

if (isset($_POST['usuario']) && isset($_POST['contraseña'])
    && isset($_POST['nombre']) && isset($_POST['re_contraseña'])&& isset($_POST['apellidos']) && isset($_POST['fecha_nacimiento']) && isset($_POST['telefono']) && isset($_POST['email'])) {

	function validate($data){
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


    $sql2 = "INSERT INTO usuarios (usuario, nombre, apellidos, fecha_nacimiento, telefono, email, contraseña) VALUES ('$usuario','$nombre','$apellidos','$fecha_nacimiento','$telefono','$email', '$contraseña')";
    $result2 = mysqli_query($conexion, $sql2);

    if($result2){
        header("Location: ../register-view.php?success=Your account has been created successfully");
	         exit();
    }
}