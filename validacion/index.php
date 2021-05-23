<?php
require('../conexion/residencia.php');

$Dato = isset($_GET["CI"]) ? $_GET["CI"] : null;
$Cedula = substr($Dato,0,strlen($Dato)-1);
$solicitud = substr($Dato,strlen($Dato)-1);
$QR = $Dato.'.png';

if ($solicitud == 'R'){
	$Titulo = 'Validación de carta de Residencia.';
	$carta = 'Residencia';
}else{
	if ($solicitud == 'C'){
		$Titulo = 'Validación de carta de Buena Conducta.';
		$carta = 'Buena Conducta';
	}else{
		$Titulo = 'Validación de Documento.';
		$carta = '';
	}	
}

if (file_exists($QR)){
	if (!is_null($Cedula)){
		$Datos = buscarporCedula($Cedula);
		if ($Datos[0] != ''){
			$Nombre = '<p><span>Nombre: </span>'.$Datos[0].'</p>';
			$Ci = '<p><span>Cédula: </span>'.number_format($Cedula, 0, ',', '.').'</p>';
			$Id = '<p><span>Código: </span>'.$Datos[3].'</p>';
			if ($carta != ''){
				$imagen = '../img/info/validado_si.png';
				$certificar = '<p>El Consejo Comunal "El Jabillo" certifica la emision de la carta de '.$carta.', emitida para la persona cuyos datos aparenen arriba.</p>';
			}else{
				$imagen = '../img/info/validado_no.png';
				$certificar = '<h2>El Consejo Comunal "El Jabillo" <span>NO certifica</span> la emision de este documento</h2>';
			}		
		}else{
			$Nombre = '';
			$Ci = '';
			$Id = '';
			$imagen = '../img/info/validado_no.png';
			$certificar = '<h2>El Consejo Comunal "El Jabillo" <span>NO certifica</span> la emision de este documento</h2>';
		}    
	}else{	
		exit;
	}
}

?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Validación</title>
		<?php include('../inc/head.php') ?>
		<meta name="description" content="Validación de carta de residencia">
		<meta property="og:title" content="Validación" />
        <meta property="og:description" content="Validación de carta de residencia" />
		<link rel="stylesheet" href="/css/articulo.css">		
	</head>
	<body id="solicitud">
        <?php include('../inc/header.php') ?>
        <div class="principal">
            <main>
                <article class="articulo">
                    <h2><?php echo $Titulo; ?></h2>
                    <div class="imagenV"><img src=<?php echo $imagen; ?> alt=""></div>
                    <?php 
						echo $Nombre;
						echo $Ci;
						echo $Id;
						echo '<img src="'.$QR.'" />'; 
						echo $certificar; 
					?>
                </article>
            </main>
            <?php include('../inc/aside.php') ?>
        </div>
        <?php include('../inc/footer.php') ?>
	</body>
</html>