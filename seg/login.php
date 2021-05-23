<?php

require('../conexion/conexion.php');

$usuario = isset($_POST["usuario"]) ? $_POST["usuario"] : null;
$clave = isset($_POST["clave"]) ? $_POST["clave"] : null;

if ($usuario){
    if (buscarporUsuario($usuario, $clave)){
        header("Location: ../admin");
    }else{
        header("Location: ../admin?error=si");
    }
}

function buscarporUsuario($Usuario, $Clave) {
    $sql = "SELECT * FROM usuarios WHERE usuario='".$Usuario."'";
    if (!$resultado = mysqli_query(conexion(), $sql)){
	   return false;
	   //break;
    }
    
    if (mysqli_num_rows($resultado) > 0){
		while ($fila = mysqli_fetch_row($resultado)) {
			if ($Clave == $fila[1]){
				session_start(); 
                $_SESSION["autentificado"]= "SI"; 
                $_SESSION["nombre"]= $fila[2];
                $_SESSION["cedula"]= $fila[3];
                return true;
			}
		}
    }
}

?>