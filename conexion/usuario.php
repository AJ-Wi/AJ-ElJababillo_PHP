<?php
require('conexion.php');

$Usuario = isset($_POST['usuario'])? $_POST['usuario'] : null;
$Clave = isset($_POST['clave'])? $_POST['clave'] : null;
$Nombre = isset($_POST['nombre'])? $_POST['nombre'] : null;
$Cedula = isset($_POST['cedula'])? $_POST['cedula'] : null;

if ($Usuario != null) {
    if (actualizar($Usuario, $Clave, $Nombre, $Cedula) == true) {
        header("Location: ../usuario/config");
    }else{
        header("Location: ../usuario/config?error=3");
    }
}

function buscarporCedula($Cedula) {
    $sql = "SELECT * FROM usuarios WHERE cedula='".$Cedula."'";
    if (!$resultado = mysqli_query(conexion(), $sql)){
	   return false;
	   exit;
    }else{
        if (mysqli_num_rows($resultado) == 0){
            return false;
            exit;
        }else{
            return $resultado;
        }
    }
}

function actualizar($Usuario, $Clave, $Nombre, $Cedula) {
    $sql = "UPDATE usuarios SET usuario='".$Usuario."', clave='".$Clave."', nombre='".$Nombre."', cedula='".$Cedula."' WHERE cedula='".$Cedula."'";
    if (!$resultado = mysqli_query(conexion(), $sql)){
	   return false;
	   exit;
    }else{
        return true;
    }
}

?>