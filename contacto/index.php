<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Comentanos</title>
		<?php include('../inc/head.php') ?>
		<meta name="description" content="Dejanos tu comentario a serca de nuestra gestion">
		<meta property="og:title" content="Poligonal del Consejo Comunal el Jabillo" />
        <meta property="og:description" content="Dejanos tu comentario a serca de nuestra gestion" />
		<link rel="stylesheet" href="/css/banner.css">
		<link rel="stylesheet" href="/css/articulo.css">
		<link rel="stylesheet" href="/css/comentarios.css">
		<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>	
		<script src="/js/comentario.js"></script>
	</head>
	<body id="contacto">
        <?php include('../inc/header.php') ?>
        <?php include('../inc/banner.php') ?>
        <div class="principal">
			<main>
				<article class="articulo">
					<h2>Dejanos tu comentario, sujerencias y/o solicitudes...</h2>
					<div class="what">
						<h3>Unete al grupo de WhatsApp de la Comunidad </h3>
						<a href="https://chat.whatsapp.com/B0GrV6jQvAdHvHXDfacrox"  target="_blank"><img class="whatsapp" src="/img/whatsapp_logo.png" alt=""></a>
					</div>
					<div class="comentarios">
                        <?php
                            require('../conexion/comentarios.php');
							$Comentarios = buscarporURL('comentario');
                            $cuenta = mysqli_num_rows($Comentarios);
							if ($cuenta == 1){
								echo '<h4>'.$cuenta.' comentario</h4>';
							}else{
								echo '<h4>'.$cuenta.' comentarios</h4>';
							}                             
                        ?>
                        <section id="comentar">
                            <form method="post" action="/conexion/comentarios.php">
                                <textarea class="area"  name="comentario" rows="1" placeholder="Agrega un Comentario..." maxlength="1000" autocomplete="on" tabindex="1" required></textarea>
                                <div class="enviar" id="enviar">
                                        <input type="hidden" name="URL" value="comentario">
                                        <input class="texto" type="text" name="nombre" placeholder="Nombre" autocomplete="on" tabindex="2" required>
                                        <input class="boton" type="submit" tabindex="3" value="Publicar"/>
                                </div>
                            </form>
                        </section>
                        <section class="comentario">
                            <?php
                            if ($cuenta > 0){
								while ($fila = mysqli_fetch_row($Comentarios)) {
									echo '<h4>'.$fila[2].'</h4>';
                                    echo '<h6>'.$fila[1].'</h6>';
                                    echo '<p>'.$fila[3].'</p><br>';
								}
                            }
                            ?>
                        </section>
                    </div>
				</article>
			</main>
			<?php include('../inc/aside.php') ?>
        </div>
        <?php include('../inc/footer.php') ?>
	</body>
</html>