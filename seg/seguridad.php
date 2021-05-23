<?php
session_start(); 
$Iniciada = isset($_SESSION["autentificado"]) ? $_SESSION["autentificado"] : null;
$CEDULA = isset($_SESSION["cedula"]) ? $_SESSION["cedula"] : null;
if ($Iniciada != "SI") { 
    header("Location: /admin");
}	
?>