<?php
require('../../conexion/censo.php');
$nombre = 'contactos.csv';
header( "Content-Type: application/octet-stream");
header( "Content-Disposition: attachment; filename=".$nombre."");
$Datos = contactos();
if ($Datos == false) {
	header("Location: ../");
	exit;
}
$Contenido = 'Name,Given Name,Additional Name,Family Name,Yomi Name,Given Name Yomi,Additional Name Yomi,Family Name Yomi,Name Prefix,Name Suffix,Initials,Nickname,Short Name,Maiden Name,Birthday,Gender,Location,Billing Information,Directory Server,Mileage,Occupation,Hobby,Sensitivity,Priority,Subject,Notes,Group Membership,E-mail 1 - Type,E-mail 1 - Value,Phone 1 - Type,Phone 1 - Value,Phone 2 - Type,Phone 2 - Value,Address 1 - Type,Address 1 - Formatted,Address 1 - Street,Address 1 - City,Address 1 - PO Box,Address 1 - Region,Address 1 - Postal Code,Address 1 - Country,Address 1 - Extended Address,Website 1 - Type,Website 1 - Value'.chr(13).chr(10); // Encabezado del archivo
while ($Dato = mysqli_fetch_row($Datos)){
	if ($Dato[2] == ''){continue;}
	if (Buscarmudados($Dato[0])) {continue;}
	$tlf = str_replace(' ', '', $Dato[2]);
	$tlf = str_replace('-', '', $tlf);
	if (substr($tlf,0,4) == '0212'){
		$Contenido .= utf8_decode($Dato[1]).',,,,,,,,,,,,,,,,,,,,,,,,,,* My Contacts ::: Jabillo,,,,,Home,'.$tlf.',Home,"'.utf8_decode(Direccion($Dato[0])).' Ruperto Lugo, caracas, Distrito Capital 1030 Venezuela",'.utf8_decode(Direccion($Dato[0])).',caracas,,Distrito Capital,1030,Venezuela,Ruperto Lugo,,'.chr(13).chr(10);
	}else{
		$Contenido .= utf8_decode($Dato[1]).',,,,,,,,,,,,,,,,,,,,,,,,,,* My Contacts ::: Jabillo,,,Mobile,'.$tlf.',,,Home,"'.utf8_decode(Direccion($Dato[0])).' Ruperto Lugo, caracas, Distrito Capital 1030 Venezuela",'.utf8_decode(Direccion($Dato[0])).',caracas,,Distrito Capital,1030,Venezuela,Ruperto Lugo,,'.chr(13).chr(10);
	}
	
}

echo $Contenido;

function Direccion($id) {
$calle = substr($id,4,2);
	switch($calle) {
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

?>