<?php 
	require('../conexion/articulos.php');
	
	$ART = isset($_GET["Art"]) ? $_GET["Art"] : null;

	if ($ART != null){
		$Articulo = buscarporArticulo($ART);
		while ($fila = mysqli_fetch_row($Articulo)){
			$Id = $fila[0];
			$Titulo = $fila[1];
			$Fecha = $fila[2];
			$Descripcion = $fila[3];
			$Des = substr($Descripcion,0,100);
			$Imagen = '/img/articulos/'.$fila[4];
		}
	}else{
		$Titulo = 'Articulos';
		$Fecha = date('d/m/y');
		$Descripcion = '<h2>Articulo NO encontrado.</h2>';
		$Des = 'Articulo NO encontrado.';
		$Imagen = '/img/error.png';
	}
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title><?php echo $Titulo; ?></title>
		<?php include('../inc/head.php') ?>
		<meta name="description" content="<?php echo $Des; ?>">
		<meta property="og:title" content="<?php echo $Titulo; ?>" />
        <meta property="og:description" content="<?php echo $Des; ?>" />
		<link rel="stylesheet" href="/css/articulo.css">
	</head>
	<body>
        <?php include('../inc/header.php') ?>
        <div class="principal">
            <main>
                <article class="articulo">
                    <h2><?php echo utf8_decode($Titulo); ?></h2>
                    <h4>Fecha: <?php echo $Fecha; ?>.</h4>
                    <div class="imagen"><img src="<?php echo $Imagen; ?>" alt="Art"></div>
                    <?php echo utf8_decode($Descripcion); ?>
                </article>
            </main>
            <?php include('../inc/aside.php') ?>
        </div>
        <?php include('../inc/footer.php') ?>
	</body>
</html>