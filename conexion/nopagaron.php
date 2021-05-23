<?php
require('conexion.php');

$Id = isset($_POST['id'])? $_POST['id'] : null;

if (isset($_REQUEST['guardar'])){
	if ($Id != null){
		if(insertarnopagaron($Id)){
			header("Location: ../admin/censo/nopagaron.php");
		}
	}else{
		header("Location: ../admin/censo/nopagaron.php");
	}
}elseif (isset($_REQUEST['eliminar'])){
	if ($Id != null){
		if(eliminarnopagaron($Id)){
			header("Location: ../admin/censo/nopagaron.php");
		}
	}else{
		header("Location: ../admin/censo/nopagaron.php");
	}
}

function nopagaron() {
    $sql = "SELECT * FROM nopagaron ORDER BY ID";
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

function insertarnopagaron($Id) {
    $sql = "INSERT INTO nopagaron (ID) VALUES ('".$Id."')";
    if (!$resultado = mysqli_query(conexion(), $sql)){
	   return false;
	   exit;
    }else{
        return true;
    }
}

function eliminarnopagaron($Id) {
    $sql = "DELETE FROM nopagaron WHERE ID='".$Id."'";
    if (!$resultado = mysqli_query(conexion(), $sql)){
	   return false;
	   exit;
    }else{
        return true;
    }
}

?>