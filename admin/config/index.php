<?php require('../../seg/seguridad.php') ?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Configuracion de Usuario</title>
		<?php include('../../inc/head.php') ?>
		<meta name="description" content="Configuracion de Usuario">
		<meta property="og:title" content="Configuracion de Usuario" />
        <meta property="og:description" content="Configuracion de Usuario" />
		<link rel="stylesheet" href="/css/usuario.css">
		<link rel="stylesheet" href="/css/foto_perfil.css">
	</head>
	<body>
        <?php include('../../inc/header.php') ?>
        <div class="principal">
            <main>
                <article class="usuario">
                    <h2>Configuracion de Usuario</h2>
                    <?php   
                        if(file_exists("../../img/usuario/".$CEDULA)) {
                            $Imagen = '<img src="../../img/usuario/'.$CEDULA.'" alt="Usuario">';
                        }else{
                            $Imagen = '<img src="../../img/usuario/usuario.png" alt="Usuario">';
                        }                            
                    ?>
                    <div class="imagen">
                        <a href="#modal"><?php echo $Imagen; ?></a>                  
                    </div>
                        <?php 
                        $Error = isset($_GET['error'])? $_GET['error'] : null;
                            if ($Error == 1) {
                                echo '<div id="error"><h4>La extensión o el tamaño de la imagen no es correcta.</h4><h4>Se permiten imagenes .jpg o .png</h4><h4>se permiten imagenes de 200 Kb máximo.</h4></div>';
                            }
                            if ($Error == 2) {
                                echo '<div id="error"><h3>Ocurrió algún error al subir el fichero. No pudo guardarse.</h3></div>';
                            }
                        ?>                        
                    <p>En esta Sección puede modificar los datos de acceso de usuario</p>
                    <?php
                        require('../../conexion/usuario.php');
						$USUARIO = buscarporCedula($CEDULA);
						while ($fila = mysqli_fetch_row($USUARIO)){
                    ?>                       
                    <form method="post" action="/conexion/usuario.php">
                        <div class="texto">
                            <input type="text" name="usuario" autocomplete="on" tabindex="1" value="<?php echo $fila[0]; ?>">
                        </div>
                        <div class="texto">
                            <input type="password" name="clave" autocomplete="on" tabindex="2" value="<?php echo $fila[1]; ?>">
                        </div>
                        <div class="texto">
                            <input type="text" name="nombre" autocomplete="on" tabindex="3" value="<?php echo $fila[2]; ?>">
                        </div>
                        <input type="hidden" name="cedula" value="<?php echo $fila[3]; ?>">
                        <?php } ?>
                        <input class="boton" type="submit" value="Guardar">
                    </form>
                    <?php 
                        if ($Error == 1) {
                            echo '<div id="error"><h4>Disculpe no se pudieron guardar los cambios.</h4></div>';
                        }
                    ?>
                </article>
            </main>
            <?php include('../../inc/aside.php') ?>
        </div>
        <?php include('../../inc/footer.php') ?>
        <div id="modal">
            <div class="datos">
                <form method="post" action="/conexion/foto_perfil.php" enctype="multipart/form-data">
                    <div id="modal_titulo">
                        <h3 id="titulo">Cambiar imagen de Perfil</h3>
                        <a href=""><h3 id="cerrar">X</h3></a>
                    </div>
                    <div id="foto"><input type="file" name="foto"></div>
                    <input type="hidden" name="cedula" value="<?php echo $CEDULA; ?>">
                    <input class="boton" type="submit" value="Guardar">
                </form>
            </div>
        </div>
	</body>
</html>