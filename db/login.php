<?php

require 'dbconexion.php';
session_start();

if (isset($_POST['usuario']) && isset($_POST['contraseña'])) {
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
     }

    $usuario = validate($_POST['usuario']);
    $contraseña = validate($_POST['contraseña']);
    
    if (empty($usuario)) {
		header("Location: ../login-view.php?error=Usuario o contraseña incorrecto!");
	    exit();
	}else if(empty($contraseña)){
        header("Location: ../login-view.php?error=Usuario o contraseña incorrecto!");
	    exit();
	}else{
		$sql = "SELECT * FROM usuarios WHERE usuario='$usuario' AND contraseña='$contraseña'";

		$result = mysqli_query($conexion, $sql);

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
            if ($row['usuario'] === $usuario && $row['contraseña'] === $contraseña) {
            	$_SESSION['usuario'] = $row['usuario'];
            	$_SESSION['nombre'] = $row['nombre'];
            	$_SESSION['id_usuario'] = $row['id_usuario'];
            	header("Location: ../index.php");
		        exit();
            }else{
				header("Location: ../login-view.php?error=Usuario o contraseña incorrecto!");
		        exit();
			}
		}else{
			header("Location: ../login-view.php?error=Usuario o contraseña incorrecto!");
	        exit();
		}
	}
	
}else{
	header("Location: ../login-view.php");
	exit();
}

?>