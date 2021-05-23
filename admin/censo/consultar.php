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
		<link rel="stylesheet" href="/css/imprimir.css">
	</head>
	<body>
        <?php include('../../inc/header.php') ?>
        <div class="principal">
            <div class="censo">
                <form method="" action="">
                    <?php
                        require('../../conexion/censo.php');
                        $cedula = isset($_POST['cedula'])? $_POST['cedula'] : null;
                        $Datos = buscar($cedula);
                        if ($Datos == false) {
                            header("Location: ../");
                            exit;
                        }
                        while ($Dato = mysqli_fetch_row($Datos)){
                            switch(substr($Dato[0],4,2)) {
								case 'Cc':
									$calle = 'Callejón Coromoto';
									break;
								case 'Cj':
									$calle = 'Calle los Jabillos';
									break;
								case 'T1':
									$calle = '1ra Transversal';
									break;
								case 'T2':
									$calle = '2ra Transversal';
									break;
								case 'C2':
									$calle = '2da Calle';
									break;
								default:
									break;
							}
                    ?>
                    <div class="subtitulo">
                        <h3>Código: <?php echo $Dato[0]; ?></h3>
                    </div>
                    <div class="subtitulo">
                        <label>Dirección</label>
                    </div>
                    <div class="seccion largo50">
						<?php echo $calle; ?>
                    </div>
                    <div class="seccion largo50">
                        <?php echo $Dato[1]; ?>
                    </div>
                    <div class="subtitulo">
                        <label>Jefe de Familia</label>
                    </div>
                    <div class="seccion">
                        <?php echo $Dato[2]; ?>
                    </div>
                    <div class="seccion">
                        <?php echo $Dato[3]; ?>
                    </div>
                    <div class="seccion">
						<?php echo $Dato[4]; ?>
                    </div>
                    <div class="seccion">
                        <?php echo $Dato[5]; ?>
                    </div>
                    <div class="seccion">
						<?php echo $Dato[6]; ?>
                    </div>
                    <div class="seccion">
                        <?php echo $Dato[7]; ?> años en la comunidad
                    </div>
                    <div class="seccion">
						<?php if ($Dato[8] == ''){echo 'No Inscrito en el CNE';}else{echo $Dato[8].' Inscrito en el CNE';} ?>
                    </div>
                    <div class="seccion">
						<?php echo $Dato[9]; ?>
                    </div>
                    <div class="seccion">
						<?php echo $Dato[10]; ?>
                    </div>
                    <div class="seccion">
						<?php if ($Dato[11] == ''){echo 'No Trabaja';}else{echo $Dato[11].' Trabaja';} ?>
                    </div>
                    <div class="seccion">
						<?php if ($Dato[12] == ''){echo 'Donde Trabaja';}else{echo $Dato[12];} ?>
                    </div>
                    <div class="seccion">
                        Tlf: <?php echo $Dato[13]; ?>
                    </div>
                    <div class="subtitulo">
                        <label>Situación Económica</label>
                    </div>
                    <div class="seccion largo50">
						<?php if ($Dato[14] == ''){echo 'No Realiza Ventas en su casa';}else{echo $Dato[14].' Realiza Ventas en su casa';} ?>
                    </div>
                    <div class="seccion largo50">
						<?php if ($Dato[15] == ''){echo 'Ventas de que';}else{echo $Dato[15];} ?>
                    </div>
                    <div class="subtitulo">
                        <label>Salud</label>
                    </div>
                    <div class="seccion opciones">
						<?php echo $Dato[16]; ?>
                    </div>
                    <div class="seccion opciones">
						<?php echo $Dato[17]; ?>
                    </div>
                    <div class="seccion opciones">
						<?php if ($Dato[18] == ''){echo 'No sufre de enfermedad';}else{echo $Dato[18];} ?>
                        <?php echo $Dato[19]; ?>
                    </div>
                    <div class="seccion">
						<?php if ($Dato[20] == ''){echo 'No necesita ayuda';}else{echo $Dato[20];} ?>
                    </div>
                    <div class="seccion largo50">
						<?php if ($Dato[21] == ''){echo 'No Se encuentra Incapacitado';}else{echo $Dato[21].' Se encuentra Incapacitado';} ?>
                        <?php echo $Dato[22]; ?>
                    </div>
                    <div class="seccion largo50">
						<?php if ($Dato[23] == ''){echo 'No Se encuentra pensionado';}else{echo $Dato[23].' Se encuentra pensionado';} ?>
                        <?php echo $Dato[24]; ?>
                    </div>
                    <div class="subtitulo">
                        <label>Situación de Vivienda</label>
                    </div>
                    <div class="seccion">
						<?php if ($Dato[25] == ''){echo 'Tenencia de la Vivienda';}else{echo 'Vivienda '.$Dato[25];} ?>
                    </div>
                    <div class="seccion">
						<?php if ($Dato[26] == ''){echo 'Terreno Propio: No';}else{echo 'Terreno Propio: '.$Dato[26];} ?>
                    </div>
                    <div class="seccion">
						<?php if ($Dato[27] == ''){echo 'Tipo de Vivienda';}else{echo $Dato[27];} ?>
                    </div>
                    <div class="seccion">
						<?php if ($Dato[28] == ''){echo 'No Inscrito en el SIVIH';}else{echo $Dato[28].' Inscrito en el SIVIH';} ?>
                        <?php echo $Dato[29]; ?>
                    </div>
                    <div class="seccion largo50">
						<?php if ($Dato[30] == ''){echo 'No Cotiza Ley de Pólitica Habitacional';}else{echo $Dato[30].' Cotiza Ley de Pólitica Habitacional';} ?>
                    </div>
                    <div class="seccion largo50">
						<?php if ($Dato[31] == ''){echo 'No Pertenece a una (OCV)';}else{echo $Dato[31].' Pertenece a una (OCV)';} ?>
                    </div>
                    <div class="subtitulo">
                        <label>Servicios</label>
                    </div>
                    <div class="seccion largo100">
						<?php if ($Dato[32] == ''){echo 'Transporte Público';}else{echo 'Transporte '.$Dato[32];} ?>
                    </div>
					<div class="saltopagina"></div>
                    <div class="subtitulo">
                        <label>Grupo Familiar</label>
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
                                            '.$Familiar[2].'
                                        </div>
                                        <div class="seccion">
                                            '.$Familiar[3].'
                                        </div>
                                        <div class="seccion">
                                            '.$Familiar[4].'
                                        </div>
                                        <div class="seccion">
                                            '.$Familiar[5].'
                                        </div>
                                        <div class="seccion">
                                            '.$Familiar[6].'
                                        </div>
                                        <div class="seccion">
                                            '.$Familiar[7].' años en la comunidad
                                        </div>
                                        <div class="seccion">';
										if ($Familiar[8] == ''){echo 'No Inscrito en el CNE';}else{echo $Familiar[8].' Inscrito en el CNE';}
                                echo    '</div>
                                        <div class="seccion">
                                            '.$Familiar[9].'
                                        </div>
                                        <div class="seccion">';
										if ($Familiar[10] == ''){echo 'Nivel de Instrucción';}else{echo $Familiar[10];}
                                echo    '</div>
                                        <div class="seccion">';
										if ($Familiar[11] == ''){echo 'No Trabaja';}else{echo $Familiar[11].' Trabaja';}
                                echo    '</div>
                                        <div class="seccion">';
										if ($Familiar[12] == ''){echo 'No Se encuentra Incapacitado';}else{echo $Familiar[12].' Se encuentra Incapacitado';}
								echo	$Familiar[13];
                                echo	'</div>
                                        <div class="seccion">';
										if ($Familiar[14] == ''){echo 'No Se encuentra pensionado';}else{echo $Familiar[14].' Se encuentra pensionado';}
                                echo	'</div>
                                        <div class="seccion largo100">';
										if ($Familiar[15] == ''){echo 'No Se encuentra con Embarazo Temprano';}else{echo $Familiar[15].' Se encuentra con Embarazo Temprano';}
                                echo	'</div>
                                    </div>';
                        } } } ?>
                    </div>
                </form>
            </div>
        </div>
        <?php include('../../inc/footer.php') ?>
	</body>
</html>