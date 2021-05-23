<?php
require('conexion.php');

function buscarporCedula($Cedula) {
	$sql = "SELECT * FROM familiar WHERE cedula='".$Cedula."'"; 
	$Datos = array();
	$Id = '';
	$Nombre = '';
	$casa = '';
	$Direccion = '';
	$Nacionalidad = '';
	$Count = 0;
    if ($resultado = mysqli_query(conexion(), $sql)){
		if (mysqli_num_rows($resultado) > 0){
			foreach ($resultado as $fila){
				$Nombre = $fila['nombre'];
				$Id = $fila['id'];
				$Count = 1;
			}
		}
	}
	if ($Count == 0){
		$sql = "SELECT * FROM persona WHERE cedula='".$Cedula."'";
		if ($resultado = mysqli_query(conexion(), $sql)){
			if (mysqli_num_rows($resultado) > 0){
				foreach ($resultado as $fila){
					$Nombre = $fila['nombre'];
					$casa = $fila['casa'];
					$Nacionalidad = $fila['nacionalidad'];
					$Id = $fila['id'];
					break;
				}
			}
		}
	}else{
		$sql = "SELECT * FROM persona WHERE id='".$Id."'";
		if ($resultado = mysqli_query(conexion(), $sql)){
			if (mysqli_num_rows($resultado) > 0){
				foreach ($resultado as $fila){
					$casa = $fila['casa'];
					$Nacionalidad = $fila['nacionalidad'];
				}
			}
		}
	}
	if ($Cedula != 9958493){
	switch(substr($Id, 4, 2)) {
    case 'T1':
        $Direccion = '1ra Transversal de Ruperto Lugo '.$casa;
        break;
	case 'T2':
        $Direccion = '2da Transversal de Ruperto Lugo '.$casa;
        break;
	case 'C2':
        $Direccion = '2da Calle de Ruperto Lugo '.$casa;
        break;
	case 'Cc':
        $Direccion = 'Segunda transversal de Ruperto Lugo, Callejón Coromoto '.$casa;
        break;
	case 'Cj':
        $Direccion = 'Calle Jabillo de Ruperto Lugo '.$casa;
        break;
    default:
        break;
    }
	}else{
		$Direccion = $casa;
	}
	$Datos = array($Nombre, $Direccion, $Nacionalidad, $Id);
	return $Datos;
	exit;
}

?>