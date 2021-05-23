<?php
require('../../conexion/censo.php');
require('../../conexion/edad.php');
$nombre = 'clap.csv';
header( "Content-Type: application/octet-stream");
header( "Content-Disposition: attachment; filename=".$nombre."");
$ED = 12;
$Datos = generar_lista_juguetes();
$con = 1;
if ($Datos == false) {
	header("Location: ../");
	exit;
}

function Calle ($Codigo) {
	$Codigo = substr($Codigo,4,2);
	switch($Codigo) {
		case 'Cc':
			return 'Callejón Coromoto';
			break;
		case 'Cj':
			return 'Calle los Jabillos';
			break;
		case 'T1':
			return '1ra Transversal';
			break;
		case 'T2':
			return '2ra Transversal';
			break;
		case 'C2':
			return '2da Calle';
			break;
		default:
			break;
	}
}

$Contenido = 'N,Nombre,Cedula,Edad,Calle'.chr(13).chr(10); // Encabezado del archivo
while ($Dato = mysqli_fetch_row($Datos)){
	if (edad($Dato[3]) > $ED) {continue;}
	
	$Contenido .= $con.','.utf8_decode($Dato[1]).','.number_format($Dato[2], 0, ',', '.').','.edad($Dato[3]).','.utf8_decode(Calle($Dato[0])).chr(13).chr(10);
	$Nombre = '';
	$Cedula = '';
	$Parentesco = '';
	$Años = '';
	$con += 1;
}

echo $Contenido;

?>