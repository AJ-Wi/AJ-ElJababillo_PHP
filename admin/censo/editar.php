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
		<script src="/js/agregar_familiar.js"></script>
	</head>
	<body>
        <?php include('../../inc/header.php') ?>
        <div class="principal">
            <div class="censo">
                <form method="post" action="/conexion/censo.php">
                    <?php
                        require('../../conexion/censo.php');
                        $cedula = isset($_POST['cedula'])? $_POST['cedula'] : null;
                        $Datos = buscar($cedula);
                        if ($Datos == false) {
                            header("Location: ../");
                            exit;
                        }
                        while ($Dato = mysqli_fetch_row($Datos)){
                            $calle = substr($Dato[0],4,2);
                    ?>
                    <div class="subtitulo">
                        <h3>Código: <?php echo $Dato[0]; ?></h3>
                        <input type="hidden" name="id" value="<?php echo $Dato[0]; ?>">
                    </div>
                    <div class="subtitulo">
                        <label>Dirección</label>
                    </div>
                    <div class="seccion largo50">
                        <select name="calle" required>                            
                            <option value="">Seleccione la Calle</option>
                            <option value="T1" <?php if ($calle=='T1'){echo 'selected';} ?>>1ra Transversal</option>
                            <option value="T2"<?php if ($calle=='T2'){echo 'selected';} ?>>2da Transversal</option>
                            <option value="C2"<?php if ($calle=='C2'){echo 'selected';} ?>>2da Calle</option>
                            <option value="Cj"<?php if ($calle=='Cj'){echo 'selected';} ?>>Calle Jabillo</option>
                            <option value="Cc"<?php if ($calle=='Cc'){echo 'selected';} ?>>Callejón Coromoto</option>
                        </select>
                    </div>
                    <div class="seccion largo50">
                        <input type="text" name="casa" placeholder="Casa" value="<?php echo $Dato[1]; ?>">
                    </div>
                    <div class="subtitulo">
                        <label>Jefe de Familia</label>
                    </div>
                    <div class="seccion">
                        <input type="text" name="nombre" placeholder="Nombres y Apellidos" value="<?php echo $Dato[2]; ?>">
                    </div>
                    <div class="seccion">
                        <input type="text" name="cedula" placeholder="Cédula" value="<?php echo $Dato[3]; ?>">
                    </div>
                    <div class="seccion">
                        <select name="nacionalidad">
                            <option value="">Seleccione la Nacionalidad</option>
                            <option value="Venezolano"<?php if ($Dato[4]=='Venezolano'){echo 'selected';} ?>>Venezolano (a)</option>
                            <option value="Extranjero"<?php if ($Dato[4]=='Extrangero'){echo 'selected';} ?>>Extranjero (a)</option>
                        </select>
                    </div>
                    <div class="seccion">
                        <input type="text" name="nacimiento" placeholder="Nacimiento" value="<?php echo $Dato[5]; ?>">
                    </div>
                    <div class="seccion">
                        <select name="sexo">
                            <option value="">Seleccione el Sexo</option>
                            <option value="Femenino"<?php if ($Dato[6]=='Femenino'){echo 'selected';} ?>>Femenino</option>
                            <option value="Masculino"<?php if ($Dato[6]=='Masculino'){echo 'selected';} ?>>Masculino</option>
                        </select>
                    </div>
                    <div class="seccion">
                        <input type="text" name="tiempo" placeholder="Tiempo en la Comunidad" value="<?php echo $Dato[7]; ?>">
                    </div>
                    <div class="seccion">
                        <select name="CNE">
                            <option value="">Inscrito en el CNE</option>
                            <option value="Si"<?php if ($Dato[8]=='Si'){echo 'selected';} ?>>Si</option>
                            <option value="No"<?php if ($Dato[8]=='No'){echo 'selected';} ?>>No</option>
                        </select>
                    </div>
                    <div class="seccion">
                        <select name="estado_civil">
                            <option value="">Estado Civil</option>
                            <option value="Soltero"<?php if ($Dato[9]=='Soltero'){echo 'selected';} ?>>Soltero(a) </option>
				            <option value="Divorciado"<?php if ($Dato[9]=='Divorciado'){echo 'selected';} ?>>Divorciado(a) </option>
				            <option value="Concubino"<?php if ($Dato[9]=='Concubino'){echo 'selected';} ?>>Concubino(a) </option>
				            <option value="Casado"<?php if ($Dato[9]=='Casado'){echo 'selected';} ?>>Casado(a) </option>
				            <option value="Viudo"<?php if ($Dato[9]=='Viudo'){echo 'selected';} ?>>Viudo(a) </option>
                        </select>
                    </div>
                    <div class="seccion">
                        <select name="instruccion">
							<option value="">Nivel de Instrucción</option>
							<option value="Sin instruccion"<?php if ($Dato[10]=='Sin instruccion'){echo 'selected';} ?>>Sin instruccion </option>
							<option value="Basica"<?php if ($Dato[10]=='Basica'){echo 'selected';} ?>>Basica </option>
							<option value="Bachiller"<?php if ($Dato[10]=='Bachiller'){echo 'selected';} ?>>Bachiller </option>
							<option value="Tecnico Medio"<?php if ($Dato[10]=='Tecnico Medio'){echo 'selected';} ?>>Tecnico Medio </option>
							<option value="Tecnico Superior"<?php if ($Dato[10]=='Tecnico Superior'){echo 'selected';} ?>>Tecnico Superior </option>
							<option value="Universitario"<?php if ($Dato[10]=='Universitario'){echo 'selected';} ?>>Universitario </option>
							<option value="Post Grado"<?php if ($Dato[10]=='Post Grado'){echo 'selected';} ?>>Post Grado </option>
						</select>
                    </div>
                    <div class="seccion">
                        <select name="trabaja">
                            <option value="">Trabaja actualmente</option>
                            <option value="Si"<?php if ($Dato[11]=='Si'){echo 'selected';} ?>>Si</option>
                            <option value="No"<?php if ($Dato[11]=='No'){echo 'selected';} ?>>No</option>
                        </select>
                    </div>
                    <div class="seccion">
                        <select name="donde_trabaja">
                            <option value="">Donde Trabaja</option>
                            <option value="Pública"<?php if ($Dato[12]=='Pública'){echo 'selected';} ?>>Institución Pública </option>
				            <option value="Privada"<?php if ($Dato[12]=='Privada'){echo 'selected';} ?>>Privada </option>
				            <option value="Comercial"<?php if ($Dato[12]=='Comercial'){echo 'selected';} ?>>Comercial </option>
				            <option value="Propia"<?php if ($Dato[12]=='Propia'){echo 'selected';} ?>>Por cuenta Propia </option>
				            <option value="Buhonero"<?php if ($Dato[12]=='Buhonero'){echo 'selected';} ?>>Buhonería </option>
                        </select>
                    </div>
                    <div class="seccion">
                        <input type="text" name="telefono" placeholder="Telefonos" value="<?php echo $Dato[13]; ?>">
                    </div>
                    <div class="subtitulo">
                        <label>Situación Económica</label>
                    </div>
                    <div class="seccion largo50">
                        <select name="comercio_vivienda">
                            <option value="">Realiza Ventas en su casa</option>
                            <option value="Si"<?php if ($Dato[14]=='Si'){echo 'selected';} ?>>Si</option>
                            <option value="No"<?php if ($Dato[14]=='No'){echo 'selected';} ?>>No</option>
                        </select>
                    </div>
                    <div class="seccion largo50">
                        <select name="ventas">
                            <option value="">Ventas de que</option>
                            <option value="Dulces"<?php if ($Dato[15]=='Dulces'){echo 'selected';} ?>>Dulces</option>
                            <option value="Helados"<?php if ($Dato[15]=='Helados'){echo 'selected';} ?>>Helados</option>
                            <option value="Comida Preparada"<?php if ($Dato[15]=='Comida Preparada'){echo 'selected';} ?>>Comida Preparada</option>
                            <option value="Cervezas"<?php if ($Dato[15]=='Cervezas'){echo 'selected';} ?>>Cervezas</option>
                            <option value="Bodega General"<?php if ($Dato[15]=='Bodega General'){echo 'selected';} ?>>Bodega General</option>
                        </select>
                    </div>
                    <div class="subtitulo">
                        <label>Salud</label>
                    </div>
                    <div class="seccion opciones">
                        <?php
                        $Lista = explode(',', $Dato[16]);
                        $Insecto = array('no', 'no', 'no', 'no', 'no');
                        foreach ($Lista as $Item) {
                            if ($Item=='moscas') {$Insecto[0]='moscas';}
                            if ($Item=='hormigas') {$Insecto[1]='hormigas';}
                            if ($Item=='ratones') {$Insecto[2]='ratones';}
                            if ($Item=='cucarachas') {$Insecto[3]='cucarachas';}
                            if ($Item=='ciempies') {$Insecto[4]='ciempies';}
                        } ?>
                        <div><input type="checkbox" name="insectos[]" value="moscas"<?php if ($Insecto[0]=='moscas'){echo 'checked';} ?>>Moscas</div>
				        <div><input type="checkbox" name="insectos[]" value="hormigas"<?php if ($Insecto[1]=='hormigas'){echo 'checked';} ?>>Hormigas</div> 
				        <div><input type="checkbox" name="insectos[]" value="ratones"<?php if ($Insecto[2]=='ratones'){echo 'checked';} ?>>Ratones</div> 
				        <div><input type="checkbox" name="insectos[]" value="cucarachas"<?php if ($Insecto[3]=='cucarachas'){echo 'checked';} ?>>Cucarachas</div> 
				        <div><input type="checkbox" name="insectos[]" value="ciempies"<?php if ($Insecto[4]=='ciempies'){echo 'checked';} ?>>Ciempiés</div>
                    </div>
                    <div class="seccion opciones">
                        <?php
                        $Lista = explode(',', $Dato[17]);
                        $Animal = array('no', 'no', 'no', 'no', 'no');
                        foreach ($Lista as $Item) {
                            if ($Item=='perro') {$Animal[0]='perro';}
                            if ($Item=='gato') {$Animal[1]='gato';}
                            if ($Item=='pajaros') {$Animal[2]='pajaros';}
                            if ($Item=='gallinas') {$Animal[3]='gallinas';}
                            if ($Item=='patos') {$Animal[4]='patos';}
                        } ?>
                        <div><input type="checkbox" name="animales[]" value="perro"<?php if ($Animal[0]=='perro'){echo 'checked';} ?>>Perro</div>
				        <div><input type="checkbox" name="animales[]" value="gato"<?php if ($Animal[1]=='gato'){echo 'checked';} ?>>Gato</div> 
				        <div><input type="checkbox" name="animales[]" value="pajaros"<?php if ($Animal[2]=='pajaros'){echo 'checked';} ?>>Pájaros</div> 
				        <div><input type="checkbox" name="animales[]" value="gallinas"<?php if ($Animal[3]=='gallinas'){echo 'checked';} ?>>Gallinas</div>
				        <div><input type="checkbox" name="animales[]" value="patos"<?php if ($Animal[4]=='patos'){echo 'checked';} ?>>Patos</div>
                    </div>
                    <div class="seccion opciones">
                        <?php
                        $Lista = explode(',', $Dato[18]);
                        $Enfermedad = array('no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no');
                        foreach ($Lista as $Item) {
                            if ($Item=='cancer') {$Enfermedad[0]='cancer';}
                            if ($Item=='diabetes') {$Enfermedad[1]='diabetes';}
                            if ($Item=='sida') {$Enfermedad[2]='sida';}
                            if ($Item=='corazon') {$Enfermedad[3]='corazon';}
                            if ($Item=='hepatitis') {$Enfermedad[4]='hepatitis';}
                            if ($Item=='leucemia') {$Enfermedad[5]='leucemia';}
                            if ($Item=='epilepsia') {$Enfermedad[6]='epilepsia';}
                            if ($Item=='tuberculosis') {$Enfermedad[7]='tuberculosis';}
                            if ($Item=='hipertension') {$Enfermedad[8]='hipertension';}
                            if ($Item=='asma') {$Enfermedad[9]='asma';}
                            if ($Item=='otro') {$Enfermedad[10]='otro';}
                        } ?>
                        <div><input type="checkbox" name="enfermedad[]"  value="cancer"<?php if ($Enfermedad[0]=='cancer'){echo 'checked';} ?>>Cáncer</div>
				        <div><input type="checkbox" name="enfermedad[]"  value="diabetes"<?php if ($Enfermedad[1]=='diabetes'){echo 'checked';} ?>>Diabetes</div>
				        <div><input type="checkbox" name="enfermedad[]"  value="sida"<?php if ($Enfermedad[2]=='sida'){echo 'checked';} ?>>SIDA</div>
				        <div><input type="checkbox" name="enfermedad[]"  value="corazon"<?php if ($Enfermedad[3]=='corazon'){echo 'checked';} ?>>Corazón</div>
				        <div><input type="checkbox" name="enfermedad[]"  value="hepatitis"<?php if ($Enfermedad[4]=='hepatitis'){echo 'checked';} ?>>Hepatitis</div>
				        <div><input type="checkbox" name="enfermedad[]"  value="leucemia"<?php if ($Enfermedad[5]=='leucemia'){echo 'checked';} ?>>Leucemia</div>
				        <div><input type="checkbox" name="enfermedad[]"  value="epilepsia"<?php if ($Enfermedad[6]=='epilepsia'){echo 'checked';} ?>>Epilepsia</div>
				        <div><input type="checkbox" name="enfermedad[]"  value="tuberculosis"<?php if ($Enfermedad[7]=='tuberculosis'){echo 'checked';} ?>>Tuberculosis</div>
				        <div><input type="checkbox" name="enfermedad[]"  value="hipertension"<?php if ($Enfermedad[8]=='hipertension'){echo 'checked';} ?>>Hipertensión</div>
				        <div><input type="checkbox" name="enfermedad[]"  value="asma"<?php if ($Enfermedad[9]=='asma'){echo 'checked';} ?>>Asma</div>
                        <div><input type="checkbox" name="enfermedad[]"  value="otro"<?php if ($Enfermedad[10]=='otro'){echo 'checked';} ?>>Otro</div>
                        <input type="text" name="cual_enfermedad" placeholder="Cual Enfermedad" value="<?php echo $Dato[19]; ?>">
                    </div>
                    <div class="seccion">
                        <input type="text" name="cual_medicamento" placeholder="Cual ayuda medica necesita" value="<?php echo $Dato[20]; ?>">
                    </div>
                    <div class="seccion largo50">
                        <select name="incapacitado">
                            <option value="">Se encuentra Incapacitado</option>
                            <option value="Si"<?php if ($Dato[21]=='Si'){echo 'selected';} ?>>Si</option>
                            <option value="No"<?php if ($Dato[21]=='No'){echo 'selected';} ?>>No</option>
                        </select>
                        <input type="text" name="tipo" placeholder="Tipo de incapacidad" value="<?php echo $Dato[22]; ?>">
                    </div>
                    <div class="seccion largo50">
                        <select name="pensionado">
                            <option value="">Se encuentra Pensionado</option>
                            <option value="Si"<?php if ($Dato[23]=='Si'){echo 'selected';} ?>>Si</option>
                            <option value="No"<?php if ($Dato[23]=='No'){echo 'selected';} ?>>No</option>
                        </select>
                        <input type="text" name="institucion" placeholder="Cual Institución" value="<?php echo $Dato[24]; ?>">
                    </div>
                    <div class="subtitulo">
                        <label>Situación de Vivienda</label>
                    </div>
                    <div class="seccion">
                        <select name="tenencia">
                            <option value="">Tenencia de la Vivienda</option>
                            <option value="propia"<?php if ($Dato[25]=='propia'){echo 'selected';} ?>>Propia </option>
				            <option value="alquilada"<?php if ($Dato[25]=='alquilada'){echo 'selected';} ?>>Alquilada </option>
				            <option value="compartida"<?php if ($Dato[25]=='compartida'){echo 'selected';} ?>>Compartida </option>
				            <option value="invadida"<?php if ($Dato[25]=='invadida'){echo 'selected';} ?>>Invadida </option>
				            <option value="traspasada"<?php if ($Dato[25]=='traspasada'){echo 'selected';} ?>>Traspasada </option>
				            <option value="prestada"<?php if ($Dato[25]=='prestada'){echo 'selected';} ?>>Prestada </option>
                        </select>
                    </div>
                    <div class="seccion">
                        <select name="terreno_propio">
                            <option value="">Terreno Propio</option>
                            <option value="Si"<?php if ($Dato[26]=='Si'){echo 'selected';} ?>>Si</option>
                            <option value="No"<?php if ($Dato[26]=='No'){echo 'selected';} ?>>No</option>
                        </select>
                    </div>
                    <div class="seccion">
                        <select name="tipo_vivienda">
                            <option value="">Tipo de Vivienda</option>
                            <option value="quinta"<?php if ($Dato[27]=='quinta'){echo 'selected';} ?>>Quinta </option>
				            <option value="casa"<?php if ($Dato[27]=='casa'){echo 'selected';} ?>>Casa </option>
				            <option value="apartamento"<?php if ($Dato[27]=='apartamento'){echo 'selected';} ?>>Apartamento </option>
				            <option value="rancho"<?php if ($Dato[27]=='rancho'){echo 'selected';} ?>>Rancho </option>
				            <option value="habitacion"<?php if ($Dato[27]=='habitacion'){echo 'selected';} ?>>Habitación </option>
				            <option value="anexo"<?php if ($Dato[27]=='anexo'){echo 'selected';} ?>>Anexo </option>
                        </select>
                    </div>
                    <div class="seccion">
                        <select name="SIVIH">
                            <option value="">Inscrito en el SIVIH</option>
                            <option value="Si"<?php if ($Dato[28]=='Si'){echo 'selected';} ?>>Si</option>
                            <option value="No"<?php if ($Dato[28]=='No'){echo 'selected';} ?>>No</option>
                        </select>
                        <input type="text" name="constancia" placeholder="Constancia de Inscripción" value="<?php echo $Dato[29]; ?>">
                    </div>
                    <div class="seccion largo50">
                        <select name="ley_habitacional">
                            <option value="">Cotiza Ley de Pólitica Habitacional</option>
                            <option value="Si"<?php if ($Dato[30]=='Si'){echo 'selected';} ?>>Si</option>
                            <option value="No"<?php if ($Dato[30]=='No'){echo 'selected';} ?>>No</option>
                        </select>
                    </div>
                    <div class="seccion largo50">
                        <select name="OCV">
                            <option value="">Pertenece a una (OCV)</option>
                            <option value="Si"<?php if ($Dato[31]=='Si'){echo 'selected';} ?>>Si</option>
                            <option value="No"<?php if ($Dato[31]=='No'){echo 'selected';} ?>>No</option>
                        </select>
                    </div>
                    <div class="subtitulo">
                        <label>Servicios</label>
                    </div>
                    <div class="seccion largo100">
                        <select name="transporte">
                            <option value="">Tipo de Transporte</option>
                            <option value="propio"<?php if ($Dato[32]=='propio'){echo 'selected';} ?>>Propio</option>
				            <option value="publico"<?php if ($Dato[32]=='publico'){echo 'selected';} ?>>Público </option>
				            <option value="taxi"<?php if ($Dato[32]=='taxi'){echo 'selected';} ?>>Privado (Taxi) </option>
                        </select>
                    </div>
                    <div class="subtitulo">
                        <label>Grupo Familiar</label>
                        <img src="../../img/agregar.gif" alt="añadir familiar"  onclick="Agregar()" />
                    </div>
                    <div id="familiares">
                        <?php  
                            $Familiares = buscarfamiliares($Dato[0]);
                            $cuenta = 0;
                            if ($Familiares != false) {
                            while ($Familiar = mysqli_fetch_row($Familiares)){
                                $cuenta += 1;
                                echo '  <div class="familiar">                        
                                        <div class="titulofamiliares">
											<label>Familiar '.$cuenta.'</label>
										</div>
                                        <div class="seccion">
                                            <input type="hidden" name="fid[]" value="'.$Familiar[1].'">
                                            <input type="text" name="fnombre[]" placeholder="Nombres y Apellidos" value="'.$Familiar[2].'">
                                        </div>
                                        <div class="seccion">
                                            <input type="text" name="fcedula[]" placeholder="Cédula" value="'.$Familiar[3].'">
                                        </div>
                                        <div class="seccion">
                                            <select name="fnacionalidad[]">
                                                <option value="">Nacionalidad</option>
                                                <option value="Venezolano"';
                                if ($Familiar[4]=='Venezolano'){echo 'selected';}
                                echo               '>Venezolano (a)</option>
                                                <option value="Extranjero"';
                                if ($Familiar[4]=='Extranjero'){echo 'selected';}
                                echo               '>Extranjero (a)</option>
                                            </select>
                                        </div>
                                        <div class="seccion">
                                            <input type="text" name="fnacimiento[]" placeholder="Fecha de Nacimiento" value="'.$Familiar[5].'">
                                        </div>
                                        <div class="seccion">
                                            <select name="fsexo[]">
                                                <option value="">Sexo</option>
                                                <option value="Femenino"';
                                if ($Familiar[6]=='Femenino'){echo 'selected';}
                                echo                '>Femenino</option>
                                                <option value="Masculino"';
                                if ($Familiar[6]=='Masculino'){echo 'selected';}
                                echo                '>Masculino</option>
                                            </select>
                                        </div>
                                        <div class="seccion">
                                            <input type="text" name="ftiempo[]" placeholder="Tiempo en la Comunidad" value="'.$Familiar[7].'">
                                        </div>
                                        <div class="seccion">
                                            <select name="fCNE[]">
                                                <option value="">CNE</option>
                                                <option value="Si"';
                                if ($Familiar[8]=='Si'){echo 'selected';}
                                echo                '>Si</option>
                                                <option value="No"';
                                if ($Familiar[8]=='No'){echo 'selected';}
                                echo                '>No</option>
                                            </select>
                                        </div>
                                        <div class="seccion">
                                            <input type="text" name="fparentesco[]" placeholder="Parentesco" value="'.$Familiar[9].'">
                                        </div>
                                        <div class="seccion">
                                            <select name="finstruccion[]">
                                                <option value="">Nivel de Instrucción</option>
                                                <option value="Sin instruccion"';
                                if ($Familiar[10]=='Sin instruccion'){echo 'selected';}
                                echo '>Sin instruccion </option>
                                                <option value="Basica"';
                                if ($Familiar[10]=='Basica'){echo 'selected';}
                                echo '>Basica </option>
                                                <option value="Bachiller"';
                                if ($Familiar[10]=='Bachiller'){echo 'selected';}
                                echo '>Bachiller </option>
                                                <option value="Tecnico Medio"';
                                if ($Familiar[10]=='Tecnico Medio'){echo 'selected';}
                                echo '>Tecnico Medio </option>
                                                <option value="Tecnico Superior"';
                                if ($Familiar[10]=='Tecnico Superior'){echo 'selected';}
                                echo '>Tecnico Superior </option>
                                                <option value="Universitario"';
                                if ($Familiar[10]=='Universitario'){echo 'selected';}
                                echo '>Universitario </option>
                                                <option value="Post Grado"';
                                if ($Familiar[10]=='Post Grado'){echo 'selected';}
                                echo '>Post Grado </option>
                                            </select>
                                        </div>
                                        <div class="seccion">
                                            <select name="ftrabaja[]">
                                                <option value="">Trabaja</option>
                                                <option value="Si"';
                                if ($Familiar[11]=='Si'){echo 'selected';}
                                echo                '>Si</option>
                                                <option value="No"';
                                if ($Familiar[11]=='No'){echo 'selected';}
                                echo                '>No</option>
                                            </select>
                                        </div>
                                        <div class="seccion">
                                            <select name="fincapacitado[]">
                                                <option value="">Incapacitado</option>
                                                <option value="Si"';
                                if ($Familiar[12]=='Si'){echo 'selected';}
                                echo                '>Si</option>
                                                <option value="No"';
                                if ($Familiar[12]=='No'){echo 'selected';}
                                echo                '>No</option>
                                            </select>
                                            <input type="text" name="ftipo[]" placeholder="Tipo de incapacidad" value="'.$Familiar[13].'">
                                        </div>
                                        <div class="seccion">
                                            <select name="fpensionado[]">
                                                <option value="">Pensionado</option>
                                                <option value="Si"';
                                if ($Familiar[14]=='Si'){echo 'selected';}
                                echo                '>Si</option>
                                                <option value="No"';
                                if ($Familiar[14]=='No'){echo 'selected';}
                                echo                '>No</option>
                                            </select>
                                        </div>
                                        <div class="seccion largo100">
                                            <select name="fembarazo[]">
                                                <option value="">Embarazo Temprano</option>
                                                <option value="Si"';
                                if ($Familiar[15]=='Si'){echo 'selected';}
                                echo                '>Si</option>
                                                <option value="No"';
                                if ($Familiar[15]=='No'){echo 'selected';}
                                echo                '>No</option>
                                            </select>
                                        </div>
                                    </div>';
                        } } } ?>
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