<?php require('../../seg/seguridad.php') ?>
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
					$Datos = buscarID();
					$Count = 0;
					$inicio = 0;
					$Const = 9;
					$fin = 9;
					if ($Datos == false) {
                        header("Location: ../");
                        exit;
                    }
					while ($Dato = mysqli_fetch_row($Datos)){
						//if (Buscarmudados($Dato[0])){continue;}
						$Autorizado = buscarFamiliarID($Dato[0]);
						$Autorizacion = false;
						$Años = 14;
						if ($Autorizado != false) {
							while ($Carga = mysqli_fetch_row($Autorizado)) {
								if (edad($Carga[2]) >= 15){
									if ($Años < edad($Carga[2])){
										$Nombre = $Carga[0];
										$Cedula = number_format($Carga[1], 0, ',', '.');
										$Autorizacion = true;
										$Años = edad($Carga[2]);
									}									
								}
							}
						}
						if ($Count == $inicio){echo '<div class="pagina">'; $inicio += $Const;}
						echo '<div class="carnet">
								<div class="general">
									<div class="izquierdo">
										<h3>C  L  A  P</h3>
									</div>
									<div class="contenido">
										<div class="logo">
											<img src="../../img/logosimple.png" alt="El Jabillo">
										</div>
										<p>Nombre y Apellido:</p>
										<h3>'.$Dato[1].'</h3>
										<p>Cédula:</p>
										<h3>'.number_format($Dato[2], 0, ',', '.').'</h3>';						
						if ($Autorizacion){
							echo '<p>Autorizado:</p>
								<p>'.$Nombre.'</p>
								<p>'.$Cedula.'</p>';
						}
						echo '</div>
							</div>
								<div class="codigo">
									<h2>'.$Dato[0].'</h2>
								</div>
							</div>';
						$Count += 1;
						if ($Count == $fin){echo '</div><div class="saltopagina"></div>'; $fin += $Const;}
					}
				?>				
			</div>			
        </div>
        <?php include('../../inc/footer.php') ?>
	</body>
</html>