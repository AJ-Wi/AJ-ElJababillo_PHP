<?php //require('../../seg/seguridad.php') ?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>ESTUDIO DEMOGRÁFICO Y SOCIOECONÓMICO</title>
		<?php include('../../inc/head.php') ?>
		<meta name="description" content="Página pribada, solo para Voceros autorizados">
		<meta property="og:title" content="Usuario" />
        <meta property="og:description" content="Página pribada, solo para Voceros autorizados" />
		<link rel="stylesheet" href="/css/censo.css">
		<script src="/js/agregar_familiar.js"></script>
	</head>
	<body>
        <?php include('../../inc/header.php') ?>
        <div class="principal">
            <div class="censo">
                <form method="post" action="/conexion/censo.php">
                    <div class="subtitulo">
                        <label>Dirección</label>
                    </div>
                    <div class="seccion largo50">
                        <select name="calle" required>
                            <option value="">Seleccione la Calle</option>
                            <option value="T1">1ra Transversal</option>
                            <option value="T2">2da Transversal</option>
                            <option value="C2">2da Calle</option>
                            <option value="Cj">Calle Jabillo</option>
                            <option value="Cc">Callejón Coromoto</option>
                        </select>
                    </div>
                    <div class="seccion largo50">
                        <input type="text" name="casa" placeholder="Casa">
                    </div>
                    <div class="subtitulo">
                        <label>Jefe de Familia</label>
                    </div>
                    <div class="seccion">
                        <input type="text" name="nombre" placeholder="Nombres y Apellidos" required>
                    </div>
                    <div class="seccion">
                        <input type="text" name="cedula" placeholder="Cédula">
                    </div>
                    <div class="seccion">
                        <select name="nacionalidad">
                            <option value="">Seleccione la Nacionalidad</option>
                            <option value="Venezolano">Venezolano (a)</option>
                            <option value="Extranjero">Extranjero (a)</option>
                        </select>
                    </div>
                    <div class="seccion">
                        <input type="text" name="nacimiento" placeholder="Fecha de Nacimiento">
                    </div>
                    <div class="seccion">
                        <select name="sexo">
                            <option value="">Seleccione el Sexo</option>
                            <option value="Femenino">Femenino</option>
                            <option value="Masculino">Masculino</option>
                        </select>
                    </div>
                    <div class="seccion">
                        <input type="text" name="tiempo" placeholder="Tiempo en la Comunidad">
                    </div>
                    <div class="seccion">
                        <select name="CNE">
                            <option value="">Inscrito en el CNE</option>
                            <option value="Si">Si</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                    <div class="seccion">
                        <select name="estado_civil">
                            <option value="">Estado Civil</option>
                            <option value="Soltero">Soltero(a) </option>
				            <option value="Divorciado">Divorciado(a) </option>
				            <option value="Concubino">Concubino(a) </option>
				            <option value="Casado">Casado(a) </option>
				            <option value="Viudo">Viudo(a) </option>
                        </select>
                    </div>
                    <div class="seccion">
                        <select name="instruccion">
							<option value="">Nivel de Instrucción</option>
							<option value="Sin instruccion">Sin instruccion </option>
							<option value="Basica">Basica </option>
							<option value="Bachiller">Bachiller </option>
							<option value="Tecnico Medio">Tecnico Medio </option>
							<option value="Tecnico Superior">Tecnico Superior </option>
							<option value="Universitario">Universitario </option>
							<option value="Post Grado">Post Grado </option>
						</select>
                    </div>
                    <div class="seccion">
                        <select name="trabaja">
                            <option value="">Trabaja actualmente</option>
                            <option value="Si">Si</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                    <div class="seccion">
                        <select name="donde_trabaja">
                            <option value="">Donde Trabaja</option>
                            <option value="Pública">Institución Pública </option>
				            <option value="Privada">Privada </option>
				            <option value="Comercial">Comercial </option>
				            <option value="Propia">Por cuenta Propia </option>
				            <option value="Buhonero">Buhonería </option>
                        </select>
                    </div>
                    <div class="seccion">
                        <input type="text" name="telefono" placeholder="Telefonos">
                    </div>
                    <div class="subtitulo">
                        <label>Situación Económica</label>
                    </div>
                    <div class="seccion largo50">
                        <select name="comercio_vivienda">
                            <option value="">Realiza Ventas en su casa</option>
                            <option value="Si">Si</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                    <div class="seccion largo50">
                        <select name="ventas">
                            <option value="">Ventas de que</option>
                            <option value="Dulces">Dulces</option>
                            <option value="Helados">Helados</option>
                            <option value="Comida Preparada">Comida Preparada</option>
                            <option value="Cervezas">Cervezas</option>
                            <option value="Bodega General">Bodega General</option>
                        </select>
                    </div>
                    <div class="subtitulo">
                        <label>Salud</label>
                    </div>
                    <div class="seccion opciones">
                        <div><input type="checkbox" name="insectos[]" value="moscas">Moscas</div>
				        <div><input type="checkbox" name="insectos[]" value="hormigas">Hormigas</div> 
				        <div><input type="checkbox" name="insectos[]" value="ratones">Ratones</div> 
				        <div><input type="checkbox" name="insectos[]" value="cucarachas">Cucarachas</div> 
				        <div><input type="checkbox" name="insectos[]" value="ciempies">Ciempiés</div>
                    </div>
                    <div class="seccion opciones">
                        <div><input type="checkbox" name="animales[]" value="perro">Perro</div>
				        <div><input type="checkbox" name="animales[]" value="gato">Gato</div> 
				        <div><input type="checkbox" name="animales[]" value="pajaros">Pájaros</div> 
				        <div><input type="checkbox" name="animales[]" value="gallinas">Gallinas</div>
				        <div><input type="checkbox" name="animales[]" value="patos">Patos</div>
                    </div>
                    <div class="seccion opciones">
                        <div><input type="checkbox" name="enfermedad[]"  value="cancer">Cáncer</div>
				        <div><input type="checkbox" name="enfermedad[]"  value="diabetes">Diabetes</div>
				        <div><input type="checkbox" name="enfermedad[]"  value="sida">SIDA</div>
				        <div><input type="checkbox" name="enfermedad[]"  value="corazon">Corazón</div>
				        <div><input type="checkbox" name="enfermedad[]"  value="hepatitis">Hepatitis</div>
				        <div><input type="checkbox" name="enfermedad[]"  value="leucemia">Leucemia</div>
				        <div><input type="checkbox" name="enfermedad[]"  value="epilepsia">Epilepsia</div>
				        <div><input type="checkbox" name="enfermedad[]"  value="tuberculosis">Tuberculosis</div>
				        <div><input type="checkbox" name="enfermedad[]"  value="hipertension">Hipertensión</div>
				        <div><input type="checkbox" name="enfermedad[]"  value="asma">Asma</div>
                        <div><input type="checkbox" name="enfermedad[]"  value="otro">Otro</div>
                        <input type="text" name="cual_enfermedad" placeholder="Cual Enfermedad">
                    </div>
                    <div class="seccion">
                        <input type="text" name="cual_medicamento" placeholder="Cual ayuda medica necesita">
                    </div>
                    <div class="seccion largo50">
                        <select name="incapacitado">
                            <option value="">Se encuentra Incapacitado</option>
                            <option value="Si">Si</option>
                            <option value="No">No</option>
                        </select>
                        <input type="text" name="tipo" placeholder="Tipo de incapacidad">
                    </div>
                    <div class="seccion largo50">
                        <select name="pensionado">
                            <option value="">Se encuentra Pensionado</option>
                            <option value="Si">Si</option>
                            <option value="No">No</option>
                        </select>
                        <input type="text" name="institucion" placeholder="Cual Institución">
                    </div>
                    <div class="subtitulo">
                        <label>Situación de Vivienda</label>
                    </div>
                    <div class="seccion">
                        <select name="tenencia">
                            <option value="">Tenencia de la Vivienda</option>
                            <option value="propia">Propia </option>
				            <option value="alquilada">Alquilada </option>
				            <option value="compartida">Compartida </option>
				            <option value="invadida">Invadida </option>
				            <option value="traspasada">Traspasada </option>
				            <option value="prestada">Prestada </option>
                        </select>
                    </div>
                    <div class="seccion">
                        <select name="terreno_propio">
                            <option value="">Terreno Propio</option>
                            <option value="Si">Si</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                    <div class="seccion">
                        <select name="tipo_vivienda">
                            <option value="">Tipo de Vivienda</option>
                            <option value="quinta">Quinta </option>
				            <option value="casa">Casa </option>
				            <option value="apartamento">Apartamento </option>
				            <option value="rancho">Rancho </option>
				            <option value="habitacion">Habitación </option>
				            <option value="anexo">Anexo </option>
                        </select>
                    </div>
                    <div class="seccion">
                        <select name="SIVIH">
                            <option value="">Inscrito en el SIVIH</option>
                            <option value="Si">Si</option>
                            <option value="No">No</option>
                        </select>
                        <input type="text" name="constancia" placeholder="Constancia de Inscripción">
                    </div>
                    <div class="seccion largo50">
                        <select name="ley_habitacional">
                            <option value="">Cotiza Ley de Pólitica Habitacional</option>
                            <option value="Si">Si</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                    <div class="seccion largo50">
                        <select name="OCV">
                            <option value="">Pertenece a una (OCV)</option>
                            <option value="Si">Si</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                    <div class="subtitulo">
                        <label>Servicios</label>
                    </div>
                    <div class="seccion largo100">
                        <select name="transporte">
                            <option value="">Tipo de Transporte</option>
                            <option value="propio">Propio</option>
				            <option value="publico">Público </option>
				            <option value="taxi">Privado (Taxi) </option>
                        </select>
                    </div>
                    <div class="subtitulo">
                        <label>Grupo Familiar</label>
                        <img src="../../img/agregar.gif" alt="añadir familiar"  onclick="Agregar()" />
                    </div>
                    <div id="familiares">                        
                    </div>
                    <div id="botones"> 
                        <input type="submit" value="Guardar">   
                    </div>
                </form>
            </div>
        </div>
        <?php include('../../inc/footer.php') ?>
	</body>
</html>
