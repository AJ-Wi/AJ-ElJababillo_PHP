<?php
require('conexion.php');

$Id = isset($_POST['id'])? $_POST['id'] : null;

if (isset($_REQUEST['guardar'])){
	if ($Id != null){
		if(insertarMudados($Id)){
			header("Location: ../admin/censo/mudados.php");
		}
	}else{
		header("Location: ../admin/censo/mudados.php");
	}
}elseif (isset($_REQUEST['eliminar'])){
	if ($Id != null){
		if(eliminarMudados($Id)){
			header("Location: ../admin/censo/mudados.php");
		}
	}else{
		header("Location: ../admin/censo/mudados.php");
	}
}

function mudados() {
    $sql = "SELECT * FROM mudados ORDER BY ID";
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

function insertarMudados($Id) {
    $sql = "INSERT INTO mudados (ID) VALUES ('".$Id."')";
    if (!$resultado = mysqli_query(conexion(), $sql)){
	   return false;
	   exit;
    }else{
        return true;
    }
}

function eliminarMudados($Id) {
    $sql = "DELETE FROM mudados WHERE ID='".$Id."'";
    if (!$resultado = mysqli_query(conexion(), $sql)){
	   return false;
	   exit;
    }else{
        return true;
    }
}

?>