<?php
session_start(); 
$Iniciada = isset($_SESSION["autentificado"]) ? $_SESSION["autentificado"] : null;
if ($Iniciada != "SI") { 
    header("Location: ../../usuario");
}	
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>ESTUDIO DEMOGRÁFICO Y SOCIOECONÓMICO</title>
		<?php include('../../inc/head.php') ?>
		<meta name="description" content="Página pribada, solo para Voceros autorizados">
		<meta property="og:title" content="Usuario" />
        <meta property="og:description" content="Página pribada, solo para Voceros autorizados" />
		<link rel="stylesheet" href="/css/carnet.css">
	</head>
	<body>
        <?php include('../../inc/header.php') ?>
        <div class="principal">
			<div class="carnets">
				<?php  
					require('../../conexion/censo.php');
					require('../../conexion/edad.php');
					$Datos = consolidado();
					$Personas = consolidadopersona();
					if ($Datos == false) {
						header("Location: ../");
						exit;
					}
					$poblacion = 0;
					$cne = 0;
					$Total = 0;
					$M = 0;
					$F = 0;
					$b = 0;
					$d = 0;
					$tm = 0;
					$ts = 0;
					$u = 0;
					$p = 0;
					$trabaja = 0;
					$pro = 0;
					$al = 0;
					$tras = 0;
					$inv = 0;
					$otra = 0;
					$prop = 0;
					$Q = 0;
					$C = 0;
					$A = 0;
					$R = 0;
					$O = 0;
					$prueba = '';
					while ($Dato = mysqli_fetch_row($Datos)){
						$poblacion += 1;
						if ($Dato[2] == 'Si'){$cne += 1;}
						if ($Dato[4] == 'Si'){$trabaja += 1;}
						if ($Dato[3] == 'Basica'){$b += 1;}
						if ($Dato[3] == 'Bachiller'){$d += 1;}
						if ($Dato[3] == 'Tecnico Medio'){$tm += 1;}
						if ($Dato[3] == 'Tecnico Superior'){$ts += 1;}
						if ($Dato[3] == 'Universitario'){$u += 1;}
						if ($Dato[3] == 'Post Grado'){$p += 1;}
						if ($Dato[3] == 'Sin instruccion'){$p += 1;}
						if (edad($Dato[0]) >= 0 && edad($Dato[0]) <= 200) {
							$Total += 1;
							if ($Dato[1] == 'Masculino'){
								$M += 1;
							}else{
								$F += 1;
							}
						}
					}
					while ($Persona = mysqli_fetch_row($Personas)){
						if ($Persona[0] == 'propia'){$pro += 1;}
						if ($Persona[0] == 'alquilada'){$al += 1;}
						if ($Persona[0] == 'compartida'){$otra += 1;}
						if ($Persona[0] == 'invadida'){$inv += 1;}
						if ($Persona[0] == 'traspasada'){$tras += 1;}
						if ($Persona[0] == 'prestada'){$otra += 1;}
						if ($Persona[0] == ''){$otra += 1;}
						if ($Persona[1] == 'Si'){$prop += 1;}
						if ($Persona[2] == 'quinta'){$Q += 1;}
						if ($Persona[2] == 'casa'){$C += 1;}
						if ($Persona[2] == 'apartamento'){$A += 1;}
						if ($Persona[2] == 'rancho'){$R += 1;}
						if ($Persona[2] == 'habitacion'){$O += 1;}
						if ($Persona[2] == 'anexo'){$O += 1;}
						if ($Persona[2] == ''){$O += 1;}
					}
					echo 'Masculino: '.$M.'<br/>
						Femenino: '.$F.'<br/>
						Total: '.$Total.'<br/>
						%: '.(($Total * 100)/756).'<br/>
						Poblacion: '.$poblacion.'<br/>
						CNE: '.$cne.'<br/><br/>';
						
					echo 'basica: '.$b.' %: '.(($b * 100)/756).'<br/>
						diversificado: '.$d.' %: '.(($d * 100)/756).'<br/>
						tecnico medio: '.$tm.' %: '.(($tm * 100)/756).'<br/>
						tecnico superior: '.$ts.' %: '.(($ts * 100)/756).'<br/>
						universitario: '.$u.' %: '.(($u * 100)/756).'<br/>
						otro: '.$p.' %: '.(($p * 100)/756).'<br/><br/>';
					echo 'Trabaja: '.$trabaja.' %: '.(($trabaja * 100)/756).'<br/>';
					echo 'propia: '.$pro.' %: '.(($pro * 100)/292).'<br/>
						alquilada: '.$al.' %: '.(($al * 100)/292).'<br/>
						traspaso: '.$tras.' %: '.(($tras * 100)/292).'<br/>
						invadida: '.$inv.' %: '.(($inv * 100)/292).'<br/>
						pagandose: 0 %: 0<br/>
						otra: '.$otra.' %: '.(($otra * 100)/292).'<br/>
						terreno propio: '.$prop.' %: '.(($prop * 100)/292).'<br/><br/>';
					echo 'quinta: '.$Q.' %: '.(($Q * 100)/292).'<br/>
						casa: '.$C.' %: '.(($C * 100)/292).'<br/>
						apartamento: '.$A.' %: '.(($A * 100)/292).'<br/>
						rancho: '.$R.' %: '.(($R * 100)/292).'<br/>
						otro: '.$O.' %: '.(($O * 100)/292).'<br/><br/>';
				?>				
			</div>			
        </div>
        <?php include('../../inc/footer.php') ?>
	</body>
</html>