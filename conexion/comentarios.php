<?php
require('conexion.php');
require('fecha.php');

$url = isset($_POST["URL"]) ? $_POST["URL"] : null;
$nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : null;
$comentario = isset($_POST["comentario"]) ? $_POST["comentario"] : null;

if (!$url == null){
    if (insertar($url, $comentario, $nombre) == false) {
        echo "Error: No se pudo agregar el comentario.";
    }else{
        header("Location: ../contacto");
    }
}

function buscarporURL($URL) {
    $sql = "SELECT * FROM comentarios WHERE URL='".$URL."'";
    if (!$resultado = mysqli_query(conexion(), $sql)){
	   return 0;
	   exit;
    }else{
        return $resultado;
    }
}

function insertar($URL, $Comentario, $Nombre) {
	$ahora = 'Publicado el '.fecha('D').' '.date('d').' de '.fecha('M').' del '.date('Y').' a las '.date('h:i:s A');
    $sql = "INSERT INTO comentarios (URL, fecha, nombre, comentario) VALUES ('".$URL."', '".$ahora."', '".$Nombre."', '".$Comentario."')";
    if (!$resultado = mysqli_query(conexion(), $sql)){
	   return false;
	   exit;
    }else{
        return true;
    }
}

?>