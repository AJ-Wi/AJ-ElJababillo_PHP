<?php
function edad($fecha){
    if ($fecha){
        $fecha = str_replace("/","-",$fecha);
        $i = explode('-', $fecha);
        $fecha = $i[2]."-".$i[1]."-".$i[0];
        $fecha = date('Y/m/d',strtotime($fecha));
        $hoy = date('Y/m/d');
        $dif = abs(strtotime($hoy) - strtotime($fecha));
        $edad = floor($dif / (365*60*60*24));
        return $edad;
    }
}
?>