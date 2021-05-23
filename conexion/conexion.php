<?php

function conexion() {
    $conn = mysqli_connect ('127.0.0.1', 'root', 'clave','censo');
    
    if (mysqli_connect_errno($conn)) {
        return false;
	   exit;
    }else{
        return $conn;
    }
}

?>