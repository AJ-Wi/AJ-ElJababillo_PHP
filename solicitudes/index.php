<?php
$error = isset($_GET["ERROR"]) ? $_GET["ERROR"] : null;

if (!is_null($error)){
	$mensaje = '<h2>Datos NO encontrados.</h2>';
}else{
	$mensaje = '';
}

?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Solicitudes</title>
		<?php include('../inc/head.php') ?>
		<meta name="description" content="Solicita tu carta de residencia por esta pagina">
		<meta property="og:title" content="Solicitudes" />
        <meta property="og:description" content="Solicita tu carta de residencia por esta pagina" />
		<link rel="stylesheet" href="/css/articulo.css">
		<link rel="stylesheet" href="/css/solicitud.css">
		<script src="/js/jquery-1.11.3.min.js"></script>	
		<script src="/js/solicitud1.js"></script>
	</head>
	<body id="solicitud">
        <?php include('../inc/header.php') ?>
        <div class="principal">
            <main>
                <article class="articulo">
                    <h2>Solicita por aquí tu carta de Residencia.</h2>
                    <div class="imagenS"><img src="/img/info/solicitud.png" alt=""></div>
                    <h4>Para solicitar tu carta de residencia o carta de buena conducta es sencillo y rápido.</h4> 
                    <p>Solo selecciona la solicitud deseada, escribe el motivo de la solicitud e ingresa tu número de cédula abajo y presiona solicitar, el sistema generara tu carta con los datos que nos suministraste al momento de llenar tu <span>censo demográfico.</span></p>
                    <p>Imprímela y llévala con un Vocero de la Unidad Ejecutiva para que proceda a firmarla y sellarla.</p>
                    <p>En caso de que no hayas llenado tu censo demográfico <span>NO PODRAS</span> utilizar este sistema y deberás dirigirte con el Vocero de la Comisión Electoral para gestionar tu censo y con ello tu carta de residencia o carta de buena conducta.</p>
                    <p>El Consejo Comunal "El Jabillo" está a tu servicio, para sugerencias, ayuda o reclamos, por favor dirígete a la sección de contacto.</p>
					<?php echo $mensaje; ?>
                    <div class="solicitud">
						<form id="seleccionar" method="post" action="">
							<div class="seleccion">
								<select class="dato" name="solicitud" onChange="mostrar(this.value);" required>
									<option value="">Seleccione la Solicitud</option>
									<option value="R">Carta de Residencia</option>
									<option value="C">Carta de Buena Conducta</option>
									<option value="J">Justificativo CLAP</option>
								</select>
                            </div>
                        </form>
						<div id="R" class="formulario">
							<form method="post" action="carta_de_residencia.php">
								<div class="motivo">
									<input class="dato" type="text" name="tramite" placeholder="Motivo de la solicitud" autocomplete="on" tabindex="1" required>
								</div>
								<div class="datos">
									<input class="dato" type="text" name="cedula" placeholder="Ingrese su Cédula" autocomplete="on" tabindex="2" required>
									<input class="solicitar" type="submit" tabindex="2" value="Solicitar">
								</div>
							</form>
						</div>
						<div id="C" class="formulario">
							<form method="post" action="carta_buena_conducta.php">
								<div class="motivo">
									<input class="dato" type="text" name="tramite" placeholder="Motivo de la solicitud" autocomplete="on" tabindex="1" required>
								</div>
								<div class="datos">
									<input class="dato" type="text" name="cedula" placeholder="Ingrese su Cédula" autocomplete="on" tabindex="2" required>
									<input class="solicitar" type="submit" tabindex="2" value="Solicitar">
								</div>
							</form>
						</div>
						<div id="J" class="formulario">
							<form method="post" action="justificativo_clap.php">
								<div class="motivo">
									<input class="dato" type="date" name="fecha" autocomplete="on" tabindex="1" required>
								</div>
								<div class="datos">
									<input class="dato" type="text" name="cedula" placeholder="Ingrese su Cédula" autocomplete="on" tabindex="2" required>
									<input class="solicitar" type="submit" tabindex="2" value="Solicitar">
								</div>
							</form>
						</div>
                    </div>
                </article>
            </main>
            <?php include('../inc/aside.php') ?>
        </div>
        <?php include('../inc/footer.php') ?>
	</body>
</html>