<?php
session_start(); 
$Iniciada = isset($_SESSION["autentificado"]) ? $_SESSION["autentificado"] : null;
if ($Iniciada != "SI") { 
    header("Location: ../usuario");
}

$nombre_archivo = isset($_FILES['foto']['name'])? $_FILES['foto']['name'] : null; 
$tipo_archivo = isset($_FILES['foto']['type'])? $_FILES['foto']['type'] : null; 
$tamano_archivo = isset($_FILES['foto']['size'])? $_FILES['foto']['size'] : null; 
$Cedula = isset($_POST['cedula'])? $_POST['cedula'] : null;

    if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "png")) && ($tamano_archivo < 200000))) { 
        header("Location: ../usuario/config?error=1");
    }else{
        if (move_uploaded_file($_FILES['foto']['tmp_name'], '../img/usuario/'.$Cedula)){ 
            header("Location: ../usuario/config");
        }else{ 
            header("Location: ../usuario/config?error=2");
        } 
    } 

?>