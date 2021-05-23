<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Consejo Comunal el Jabillo</title>
		<?php include('inc/head.php') ?>
		<meta name="description" content="Articulos sobres eventos y actos del consejo comunal el jabillo">
		<meta property="og:title" content="Consejo Comunal El Jabillo" />
        <meta property="og:description" content="Articulos sobres eventos y actos del consejo comunal el jabillo" />
		<meta name="norton-safeweb-site-verification" content="xxlreaplhf6wkupesw9lf9ziksr1ywplw1odjvd8i0k8s4sxtdn5fueuk244vh9or6x051lt36su725ios9zilnem-ouogplmv6pn7plygx1fvvtdm9d0owwbtifon42" />
		<link rel="stylesheet" href="css/banner.css">
		<link rel="stylesheet" href="css/blog.css">
	</head>
	<body id="inicio">
        <?php include('inc/header.php') ?>
        <?php include('inc/banner.php') ?>		
        <div class="principal">
			<main>
				<?php 
					require('conexion/articulos.php');
					
					$Articulos = buscarArticulos();

					while ($fila = mysqli_fetch_row($Articulos)){
						$Id = $fila[0];
						$Titulo = $fila[1];
						$Fecha = $fila[2];
						if (substr($fila[3],0,1) == '<'){
							$Descripcion = substr($fila[3],3,190);
						}else{
							$Descripcion = substr($fila[3],0,190);
						}
						$Imagen = '/img/articulos/'.$fila[4];
						
						echo '<article class="blog">
								<h3><a href="articulo/?Art='.$Id.'">'.utf8_decode($Titulo).'.</a></h3>
								<h5>'.$Fecha.'</h5>
								<div class="contenido">
									<div class="imagen">
										<a href="articulo/?Art='.$Id.'"><img src="'.$Imagen.'" alt=""></a>
									</div><br>
									<p>'.utf8_decode($Descripcion).'...<br><br>
									<a href="articulo/?Art='.$Id.'">Leer más</a></p>
								</div>
							</article>';
						
					}
				?>
			</main>
			<?php include('inc/aside.php') ?>
        </div>
		<?php include('inc/footer.php') ?>
	</body>
</html>