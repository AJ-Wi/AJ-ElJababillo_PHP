<?php
require('../../conexion/censo.php');
require('../../conexion/edad.php');
$nombre = 'familias.csv';
header( "Content-Type: application/octet-stream");
header( "Content-Disposition: attachment; filename=".$nombre."");
$Datos = buscarID();
if ($Datos == false) {
	header("Location: ../");
	exit;
}
$Contenido = 'ID,Nombre,Cedula,Nombre_autorizado,Cedula_autorizado,Entregado'.chr(13).chr(10); // Encabezado del archivo
while ($Dato = mysqli_fetch_row($Datos)){	
	if ((substr($Dato[0],5,2) == "Cj") or (substr($Dato[0],5,2) == "T1")){
		if (Buscarmudados($Dato[0])) {continue;}
	}
	if (Buscarnopagaron($Dato[0])) {continue;}
	$Autorizado = buscarFamiliarID($Dato[0]);
	$Años = 14;
	if ($Autorizado != false) {
		while ($Carga = mysqli_fetch_row($Autorizado)) {
			if (edad($Carga[2]) >= 15){
				if ($Años < edad($Carga[2])){
					$Nombre = $Carga[0];
					$Cedula = $Carga[1];
					$Años = edad($Carga[2]);
				}									
			}
		}
	}
	$Contenido .= $Dato[0].','.utf8_decode($Dato[1]).','.$Dato[2].','.utf8_decode($Nombre).','.$Cedula.','.$Dato[3].chr(13).chr(10);
	$Nombre = '';
	$Cedula = '';
	$Años = '';
}

echo $Contenido;

?>