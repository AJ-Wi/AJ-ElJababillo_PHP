<?php
require('conexion.php');

$titulo = isset($_POST["titulo"]) ? $_POST["titulo"] : null;
$fecha = isset($_POST["fecha"]) ? $_POST["fecha"] : null;
$descripcion = isset($_POST["descripcion"]) ? $_POST["descripcion"] : null;
$nombre_archivo = isset($_FILES['imagen']['name'])? $_FILES['imagen']['name'] : null; 
$tipo_archivo = isset($_FILES['imagen']['type'])? $_FILES['imagen']['type'] : null; 
$tamano_archivo = isset($_FILES['imagen']['size'])? $_FILES['imagen']['size'] : null; 
$imagen = $nombre_archivo;

if (!$titulo == null){
	$N = buscarArticulos();
    $cuenta = mysqli_num_rows($N) + 1001;
    $Id = 'Jab'.substr($cuenta,1);
    if (insertar($Id, $titulo, $fecha, $descripcion, $imagen) == false) {
        echo "Error: No se pudo agregar el articulo.";
    }else{
        header("Location: /articulo/ingresar.php");
    }
}

function buscarporArticulo($Art) {
    $sql = "SELECT * FROM articulos WHERE ID='".$Art."'";
    if (!$resultado = mysqli_query(conexion(), $sql)){
	   return 0;
	   exit;
    }else{
        return $resultado;
    }
}

function buscarArticulos() {
    $sql = "SELECT * FROM articulos ORDER BY ID DESC";
    if (!$resultado = mysqli_query(conexion(), $sql)){
	   return 0;
	   exit;
    }else{
        return $resultado;
    }
}

function insertar($Id, $titulo, $fecha, $descripcion, $imagen) {
	if (move_uploaded_file($_FILES['imagen']['tmp_name'], '../img/articulos/'.$imagen)){
		$sql = "INSERT INTO articulos (id, titulo, fecha, descripcion, imagen) VALUES ('".$Id."', '".$titulo."', '".cambiarFecha($fecha)."', '".$descripcion."', '".$imagen."')";
		if (!$resultado = mysqli_query(conexion(), $sql)){
		   return false;
		   exit;
		}else{
			return true;
		}
	}    
}

function cambiarFecha($fecha) {
  return implode("-", array_reverse(explode("-", $fecha)));
} 

?>