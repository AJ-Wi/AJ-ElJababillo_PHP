<?php
require('../../conexion/censo.php');
require('../../conexion/edad.php');
$nombre = 'clap.csv';
header( "Content-Type: application/octet-stream");
header( "Content-Disposition: attachment; filename=".$nombre."");
$Datos = buscarID();
if ($Datos == false) {
	header("Location: ../");
	exit;
}
$Contenido = 'ID,Nombre,Cedula,telefono,integrantes,Nombre autorizado,Cedula autorizado,Parentesco autorizado'.chr(13).chr(10); // Encabezado del archivo
while ($Dato = mysqli_fetch_row($Datos)){
	$Autorizado = buscarFamiliarID($Dato[0]);
	$Años = 14;
	$cuantos = 1;
	if ($Autorizado != false) {
		while ($Carga = mysqli_fetch_row($Autorizado)) {
			$cuantos += 1;
			if (edad($Carga[2]) >= 15){
				if ($Años < edad($Carga[2])){
					$Nombre = $Carga[0];
					$Cedula = $Carga[1];
					$Parentesco = $Carga[3];
					$Años = edad($Carga[2]);
				}									
			}
		}
	}
	$Contenido .= $Dato[0].','.utf8_decode($Dato[1]).','.$Dato[2].','.$Dato[3].','.$cuantos.','.utf8_decode($Nombre).','.$Cedula.','.$Parentesco.chr(13).chr(10);
	$Nombre = '';
	$Cedula = '';
	$Parentesco = '';
	$Años = '';
}

echo $Contenido;

?>