<?php
require('conexion.php');

$cedula = isset($_POST["cedula"]) ? $_POST["cedula"] : null;

if (!$cedula == null){
    $Existe = buscarporCedula($cedula);
    echo $Existe;
    header("Location: ../info/tarjeta_socialista?existe=$Existe");
}

function buscarporCedula($cedula) {
    $sql = "SELECT * FROM tarjetas WHERE cedula='".$cedula."'";
    if (!$resultado = mysqli_query(conexion(), $sql)){
	   return 'error';
	   exit;
    }else{
        if (mysqli_num_rows($resultado)>0) {
            return 'si';
        }else{
            return 'no';
        }
    }
}

?>