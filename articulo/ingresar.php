<?php require('../seg/seguridad.php') ?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Ingresar Articulos</title>
		<?php include('../inc/head.php') ?>
		<meta name="description" content="Ingresar Articulos">
		<meta property="og:title" content="Ingresar Articulos" />
        <meta property="og:description" content="Ingresar Articulos" />
		<link rel="stylesheet" href="/css/nuevo_articulo.css">
		<link rel="stylesheet" href="/css/stylesheet.css">
		<script src="/js/advanced.js" ></script>
		<script src="/js/wysihtml5-0.3.0.js" ></script>
	</head>
	<body>
        <?php include('../inc/header.php') ?>
        <div class="principal">
            <main>
                <article class="usuario">
                    <h2>Ingresar Articulos</h2>
                    <form method="post" action="/conexion/articulos.php" enctype="multipart/form-data">
                        <div class="texto">
                            <input type="text" name="titulo" autocomplete="on" placeholder="Titulo del Articulo" tabindex="1" value="">
                        </div>
                        <div class="texto">
                            <input type="date" name="fecha" autocomplete="on" tabindex="2" value="">
                        </div>
						<div class="texto">
                            <input type="file" name="imagen">
                        </div>
						<?php include('../inc/menu_editor.php') ?>
                        <div class="textoarea">
							<textarea name="descripcion" id="wysihtml5-editor" spellcheck="false" wrap="off" rows=20 placeholder="Contenido del Articulo ..." tabindex="3"></textarea>
                        </div>
						<script>
						  var editor = new wysihtml5.Editor("wysihtml5-editor", {
							toolbar:     "wysihtml5-editor-toolbar",
							stylesheets: ["css/editor.css"],
							parserRules: wysihtml5ParserRules
						  });
						</script>
                        <input class="boton" type="submit" value="Guardar">
                    </form>
                </article>
            </main>
            <?php include('../inc/aside.php') ?>
        </div>
        <?php include('../inc/footer.php') ?>
	</body>
</html>