<?php

function fecha($ahora) {
date_default_timezone_set ('America/La_Paz');
    
$trans = array(
    'Mon'       => 'Lunes',
    'Tue'       => 'Martes',
    'Wed'       => 'Miercoles',
    'Thu'       => 'Jueves',
    'Fri'       => 'Viernes',
    'Sat'       => 'Sábado',
    'Sun'       => 'Domingo',    
    'Jan'       => 'Enero',
    'Feb'       => 'Febrero',
    'Mar'       => 'Marzo',
    'Apr'       => 'Abril',
    'May'       => 'Mayo',
    'Jun'       => 'Junio',
    'Jul'       => 'Julio',
    'Aug'       => 'Agosto',
    'Sep'       => 'Septiembre',    
    'Oct'       => 'Octubre',
    'Nov'       => 'Noviembre',
    'Dec'       => 'Diciembre',
);

return $trans[date(''.$ahora.'')];
    
}

?>