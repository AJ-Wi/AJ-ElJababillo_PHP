<?php require('../../seg/seguridad.php') ?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>ESTUDIO DEMOGRÁFICO Y SOCIOECONÓMICO</title>
		<?php include('../../inc/head.php') ?>
		<meta name="description" content="Página pribada, solo para Voceros autorizados">
		<meta property="og:title" content="Usuario" />
        <meta property="og:description" content="Página pribada, solo para Voceros autorizados" />
		<link rel="stylesheet" href="/css/censo.css">
	</head>
	<body>
        <?php include('../../inc/header.php') ?>
        <div class="principal">
            <div class="censo">
                <form method="post" action="/conexion/mudados.php">
					<div class="subtitulo">
						<h3>Familias que NO viven en la comunidad</h3>
                    </div>
					<div class="seccion largo100">
						<input type="text" name="id" value="">
					</div>
					<div id="botones"> 
                        <input type="submit" name="guardar" value="Guardar">
						<input type="submit" name="eliminar" value="Eliminar"> 
                    </div>
                </form>
				<?php
                    require('../../conexion/mudados.php');
					$Datos = mudados();
                    if ($Datos != false) {
						while ($Dato = mysqli_fetch_row($Datos)){
							echo '<div class="seccion largo100">
									<label>'.$Dato[0].'</label>
								</div>';
						}
					}                        							
                ?>
            </div>
        </div>
        <?php include('../../inc/footer.php') ?>
	</body>
</html>