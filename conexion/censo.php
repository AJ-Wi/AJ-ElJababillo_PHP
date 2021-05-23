<?php
require('conexion.php');

$Id = isset($_POST['id'])? $_POST['id'] : null;
$Calle = isset($_POST['calle'])? $_POST['calle'] : null;
$Casa = isset($_POST['casa'])? $_POST['casa'] : null;
$Nombre = isset($_POST['nombre'])? ucwords($_POST['nombre']) : null;
$Cedula = isset($_POST['cedula'])? $_POST['cedula'] : null;
$Nacionalidad = isset($_POST['nacionalidad'])? $_POST['nacionalidad'] : null;
$Nacimiento = isset($_POST['nacimiento'])? $_POST['nacimiento'] : null;
$Sexo = isset($_POST['sexo'])? $_POST['sexo'] : null;
$Tiempo = isset($_POST['tiempo'])? $_POST['tiempo'] : null;
$CNE = isset($_POST['CNE'])? $_POST['CNE'] : null;
$Estado_Civil = isset($_POST['estado_civil'])? $_POST['estado_civil'] : null;
$Instruccion = isset($_POST['instruccion'])? $_POST['instruccion'] : null;
$Trabaja = isset($_POST['trabaja'])? $_POST['trabaja'] : null;
$Donde_Trabaja = isset($_POST['donde_trabaja'])? $_POST['donde_trabaja'] : null;
$Telefono = isset($_POST['telefono'])? $_POST['telefono'] : null;
$Comercio_Vivienda = isset($_POST['comercio_vivienda'])? $_POST['comercio_vivienda'] : null;
$Ventas = isset($_POST['ventas'])? $_POST['ventas'] : null;
$IN = isset($_POST['insectos'])? $_POST['insectos'] : null;
$AN = isset($_POST['animales'])? $_POST['animales'] : null;
$EN = isset($_POST['enfermedad'])? $_POST['enfermedad'] : null;
if ($IN != null){$Insectos = implode(',', $IN);}else{$Insectos = null;}
if ($AN != null){$Animales = implode(',', $AN);}else{$Animales = null;}
if ($EN != null){$Enfermedad = implode(',', $EN);}else{$Enfermedad = null;}
$Cual_Enfermedad = isset($_POST['cual_enfermedad'])? $_POST['cual_enfermedad'] : null;
$Cual_Medicamento = isset($_POST['cual_medicamento'])? $_POST['cual_medicamento'] : null;
$Incapacitado = isset($_POST['incapacitado'])? $_POST['incapacitado'] : null;
$Tipo = isset($_POST['tipo'])? $_POST['tipo'] : null;
$Pensionado = isset($_POST['pensionado'])? $_POST['pensionado'] : null;
$Institucion = isset($_POST['institucion'])? $_POST['institucion'] : null;
$Tenencia = isset($_POST['tenencia'])? $_POST['tenencia'] : null;
$Terreno_Propio = isset($_POST['terreno_propio'])? $_POST['terreno_propio'] : null;
$Tipo_Vivienda = isset($_POST['tipo_vivienda'])? $_POST['tipo_vivienda'] : null;
$SIVIH = isset($_POST['SIVIH'])? $_POST['SIVIH'] : null;
$Constancia = isset($_POST['constancia'])? $_POST['constancia'] : null;
$Ley_Habitacional = isset($_POST['ley_habitacional'])? $_POST['ley_habitacional'] : null;
$OCV = isset($_POST['OCV'])? $_POST['OCV'] : null;
$Transporte = isset($_POST['transporte'])? $_POST['transporte'] : null;

$Fid = isset($_POST['fid'])? $_POST['fid'] : null;
$Fnombre = isset($_POST['fnombre'])? $_POST['fnombre'] : null;
$Fcedula = isset($_POST['fcedula'])? $_POST['fcedula'] : null;
$Fnacionalidad = isset($_POST['fnacionalidad'])? $_POST['fnacionalidad'] : null;
$Fnacimiento = isset($_POST['fnacimiento'])? $_POST['fnacimiento'] : null;
$Fsexo = isset($_POST['fsexo'])? $_POST['fsexo'] : null;
$Ftiempo = isset($_POST['ftiempo'])? $_POST['ftiempo'] : null;
$FCNE = isset($_POST['fCNE'])? $_POST['fCNE'] : null;
$Fparentesco = isset($_POST['fparentesco'])? $_POST['fparentesco'] : null;
$Finstruccion = isset($_POST['finstruccion'])? $_POST['finstruccion'] : null;
$Ftrabaja = isset($_POST['ftrabaja'])? $_POST['ftrabaja'] : null;
$Fincapacitado = isset($_POST['fincapacitado'])? $_POST['fincapacitado'] : null;
$Ftipo = isset($_POST['ftipo'])? $_POST['ftipo'] : null;
$Fpensionado = isset($_POST['fpensionado'])? $_POST['fpensionado'] : null;
$Fembarazo = isset($_POST['fembarazo'])? $_POST['fembarazo'] : null;
$i = 0;
$Nuevo = null;

if ($Calle != null){
    if ($Id != null) {
        if(actualizarPersona($Id, $Casa, $Nombre, $Cedula, $Nacionalidad, $Nacimiento, $Sexo, $Tiempo, $CNE, $Estado_Civil, $Instruccion, $Trabaja, $Donde_Trabaja, $Telefono, $Comercio_Vivienda, $Ventas, $Insectos, $Animales, $Enfermedad, $Cual_Enfermedad, $Cual_Medicamento, $Incapacitado, $Tipo, $Pensionado, $Institucion, $Tenencia, $Terreno_Propio, $Tipo_Vivienda, $SIVIH, $Constancia, $Ley_Habitacional, $OCV, $Transporte)){
            $Nuevo = 'No';
        }
    }else{
        $N = contar($Calle);
        $cuenta = mysqli_num_rows($N) + 1001;
        $Id = 'Jab-'.$Calle.'-'.substr($cuenta,1);
        if(insertarPersona($Id, $Casa, $Nombre, $Cedula, $Nacionalidad, $Nacimiento, $Sexo, $Tiempo, $CNE, $Estado_Civil, $Instruccion, $Trabaja, $Donde_Trabaja, $Telefono, $Comercio_Vivienda, $Ventas, $Insectos, $Animales, $Enfermedad, $Cual_Enfermedad, $Cual_Medicamento, $Incapacitado, $Tipo, $Pensionado, $Institucion, $Tenencia, $Terreno_Propio, $Tipo_Vivienda, $SIVIH, $Constancia, $Ley_Habitacional, $OCV, $Transporte)){
            $Nuevo = 'Si';
        }
    }
}

if ($Fnombre != null){
    foreach ($Fnombre as $nombre) {
        $nombre = ucwords($nombre);
        if ($Fid[$i] != null) {
            if(actualizarFamiliar($Id, $Fid[$i], $nombre, $Fcedula[$i], $Fnacionalidad[$i], $Fnacimiento[$i], $Fsexo[$i], $Ftiempo[$i], $FCNE[$i], $Fparentesco[$i], $Finstruccion[$i], $Ftrabaja[$i], $Fincapacitado[$i], $Ftipo[$i], $Fpensionado[$i], $Fembarazo[$i])){
                $i += 1;
            }
        }else{
            $FId = $i + 1;
            if(insertarFamiliar($Id, $FId, $nombre, $Fcedula[$i], $Fnacionalidad[$i], $Fnacimiento[$i], $Fsexo[$i], $Ftiempo[$i], $FCNE[$i], $Fparentesco[$i], $Finstruccion[$i], $Ftrabaja[$i], $Fincapacitado[$i], $Ftipo[$i], $Fpensionado[$i], $Fembarazo[$i])){
                $i += 1;
            }
        }
    }
}

if ($Nuevo == 'Si') {
    header("Location: ../admin/censo");
}else{
    if ($Nuevo == 'No') {
        header("Location: ../admin");
    }    
}

function contar($calle) {
    $sql = "SELECT * FROM persona WHERE id LIKE '%".$calle."%'";
    if (!$resultado = mysqli_query(conexion(), $sql)){
	   return 0;
	   exit;
    }else{
        return $resultado;
    }
}

function buscar($Dato) {
    if (substr($Dato,0,3) == 'Jab') {
        if ($resultado = buscarpersona($Dato)) {
            return $resultado;
        }
    }else{
        if ($resultado = buscarporCedula($Dato)) {
            return $resultado;
        }
    }
}

function buscarporCedula($Cedula) {
    $sql = "SELECT * FROM persona WHERE cedula='".$Cedula."'";
    if (!$resultado = mysqli_query(conexion(), $sql)){
	   return false;
	   exit;
    }else{
        if (mysqli_num_rows($resultado) == 0){
            if ($Datos = buscarfamiliar($Cedula)) { 
                while ($Dato = mysqli_fetch_row($Datos)){
                    if ($resultado = buscarpersona($Dato[0])) {
                        return $resultado;
                        exit;
                    }
                }
            }else{
                return false;
                exit;
            }            
        }else{
            return $resultado;
        }
    }
}

function buscarfamiliar($Cedula) {
    $sql = "SELECT * FROM familiar WHERE cedula='".$Cedula."'";
    if (!$resultado = mysqli_query(conexion(), $sql)){
	   return false;
	   exit;
    }else{
        if (mysqli_num_rows($resultado) == 0){
            return false;
            exit;
        }else{
            return $resultado;
        }
    }
}

function buscarpersona($Id) {
    $sql = "SELECT * FROM persona WHERE id='".$Id."'";
    if (!$resultado = mysqli_query(conexion(), $sql)){
	   return false;
	   exit;
    }else{
        if (mysqli_num_rows($resultado) == 0){
            return false;
            exit;
        }else{
            return $resultado;
        }
    }
}

function buscarfamiliares($Id) {
    $sql = "SELECT * FROM familiar WHERE id='".$Id."'";
    if (!$resultado = mysqli_query(conexion(), $sql)){
	   return false;
	   exit;
    }else{
        if (mysqli_num_rows($resultado) == 0){
            return false;
            exit;
        }else{
            return $resultado;
        }
    }
}

function generar_cuaderno() {
    $sql = "SELECT id, nombre, cedula, nacimiento FROM persona UNION SELECT id, nombre, cedula, nacimiento FROM familiar ORDER BY cedula";
    if (!$resultado = mysqli_query(conexion(), $sql)){
	   return false;
	   exit;
    }else{
        if (mysqli_num_rows($resultado) == 0){
            return false;
            exit;
        }else{
            return $resultado;
        }
    }
}

function generar_cne($ID) {
    $sql = "SELECT id, nombre, cedula, nacimiento FROM persona WHERE id LIKE '%".$ID."%' UNION SELECT id, nombre, cedula, nacimiento FROM familiar WHERE id LIKE '%".$ID."%' ORDER BY id";
    if (!$resultado = mysqli_query(conexion(), $sql)){
	   return false;
	   exit;
    }else{
        if (mysqli_num_rows($resultado) == 0){
            return false;
            exit;
        }else{
            return $resultado;
        }
    }
}

function generar_mercal($ID) {
    $sql = "SELECT id, nombre, cedula FROM persona WHERE id LIKE '%".$ID."%' ORDER BY id";
    if (!$resultado = mysqli_query(conexion(), $sql)){
	   return false;
	   exit;
    }else{
        if (mysqli_num_rows($resultado) == 0){
            return false;
            exit;
        }else{
            return $resultado;
        }
    }
}

function generar_patria($ID) {
    $sql = "SELECT id, nombre, cedula, telefono, CodigoP, SerialP FROM persona WHERE id LIKE '%".$ID."%' ORDER BY id";
    if (!$resultado = mysqli_query(conexion(), $sql)){
	   return false;
	   exit;
    }else{
        if (mysqli_num_rows($resultado) == 0){
            return false;
            exit;
        }else{
            return $resultado;
        }
    }
}

function buscarFamiliar_patria($Id) {
    $sql = "SELECT nombre, cedula, nacimiento, CodigoP, SerialP FROM familiar WHERE id='".$Id."'";
    if (!$resultado = mysqli_query(conexion(), $sql)){
	   return false;
	   exit;
    }else{
        if (mysqli_num_rows($resultado) == 0){
            return false;
            exit;
        }else{
            return $resultado;
        }
    }
}

function buscarID() {
    $sql = "SELECT id, nombre, cedula, telefono FROM persona ORDER BY id";
    if (!$resultado = mysqli_query(conexion(), $sql)){
	   return false;
	   exit;
    }else{
        if (mysqli_num_rows($resultado) == 0){
            return false;
            exit;
        }else{
            return $resultado;
        }
    }
}

function buscarFamiliarID($Id) {
    $sql = "SELECT nombre, cedula, nacimiento, parentesco FROM familiar WHERE id='".$Id."'";
    if (!$resultado = mysqli_query(conexion(), $sql)){
	   return false;
	   exit;
    }else{
        if (mysqli_num_rows($resultado) == 0){
            return false;
            exit;
        }else{
            return $resultado;
        }
    }
}

function datosfaltantes($ID) {
    $sql = "SELECT id, nombre, cedula, nacimiento FROM persona WHERE id LIKE '%".$ID."%' UNION SELECT id, nombre, cedula, nacimiento FROM familiar WHERE id LIKE '%".$ID."%' ORDER BY id";
    if (!$resultado = mysqli_query(conexion(), $sql)){
	   return false;
	   exit;
    }else{
        if (mysqli_num_rows($resultado) == 0){
            return false;
            exit;
        }else{
            return $resultado;
        }
    }
}

function Buscarmudados($Id) {
    $sql = "SELECT * FROM mudados WHERE ID='".$Id."'";
    if (!$resultado = mysqli_query(conexion(), $sql)){
	   return false;
	   exit;
    }else{
        if (mysqli_num_rows($resultado) == 0){
            return false;
            exit;
        }else{
            return true;
        }
    }
}

function generar_lista_juguetes() {
	$sql = "SELECT id, nombre, cedula, nacimiento, sexo FROM familiar ORDER BY id";
    if (!$resultado = mysqli_query(conexion(), $sql)){
	   return false;
	   exit;
    }else{
        if (mysqli_num_rows($resultado) == 0){
            return false;
            exit;
        }else{
            return $resultado;
        }
    }
}

function Buscarnopagaron($Id) {
    $sql = "SELECT * FROM nopagaron WHERE ID='".$Id."'";
    if (!$resultado = mysqli_query(conexion(), $sql)){
	   return false;
	   exit;
    }else{
        if (mysqli_num_rows($resultado) == 0){
            return false;
            exit;
        }else{
            return true;
        }
    }
}

function consolidado() {
    $sql = "SELECT nacimiento, sexo, CNE, instruccion, trabaja, incapacitado, tipo, cedula FROM persona UNION SELECT nacimiento, sexo, CNE, instruccion, trabaja, incapacitado, tipo, cedula FROM familiar";
    if (!$resultado = mysqli_query(conexion(), $sql)){
	   return false;
	   exit;
    }else{
        if (mysqli_num_rows($resultado) == 0){
            return false;
            exit;
        }else{
            return $resultado;
        }
    }
}

function consolidadopersona() {
    $sql = "SELECT tenencia, terreno_propio, tipo_vivienda, cedula FROM persona";
    if (!$resultado = mysqli_query(conexion(), $sql)){
	   return false;
	   exit;
    }else{
        if (mysqli_num_rows($resultado) == 0){
            return false;
            exit;
        }else{
            return $resultado;
        }
    }
}

function contactos() {
    $sql = "SELECT id, nombre, telefono FROM persona";
    if (!$resultado = mysqli_query(conexion(), $sql)){
	   return false;
	   exit;
    }else{
        if (mysqli_num_rows($resultado) == 0){
            return false;
            exit;
        }else{
            return $resultado;
        }
    }
}

function actualizarPersona($Id, $Casa, $Nombre, $Cedula, $Nacionalidad, $Nacimiento, $Sexo, $Tiempo, $CNE, $Estado_Civil, $Instruccion, $Trabaja, $Donde_Trabaja, $Telefono, $Comercio_Vivienda, $Ventas, $Insectos, $Animales, $Enfermedad, $Cual_Enfermedad, $Cual_Medicamento, $Incapacitado, $Tipo, $Pensionado, $Institucion, $Tenencia, $Terreno_Propio, $Tipo_Vivienda, $SIVIH, $Constancia, $Ley_Habitacional, $OCV, $Transporte) {
    $sql = "UPDATE persona SET id='".$Id."', casa='".$Casa."', nombre='".$Nombre."', cedula='".$Cedula."', nacionalidad='".$Nacionalidad."', nacimiento='".$Nacimiento."', sexo='".$Sexo."', tiempo='".$Tiempo."', CNE='".$CNE."', estado_civil='".$Estado_Civil."', instruccion='".$Instruccion."', trabaja='".$Trabaja."', donde_trabaja='".$Donde_Trabaja."', telefono='".$Telefono."', comercio_vivienda='".$Comercio_Vivienda."', ventas='".$Ventas."', insectos='".$Insectos."', animales='".$Animales."', enfermedad='".$Enfermedad."', cual_enfermedad='".$Cual_Enfermedad."', cual_medicamento='".$Cual_Medicamento."', incapacitado='".$Incapacitado."', tipo='".$Tipo."', pensionado='".$Pensionado."', institucion='".$Institucion."', tenencia='".$Tenencia."', terreno_propio='".$Terreno_Propio."', tipo_vivienda='".$Tipo_Vivienda."', SIVIH='".$SIVIH."', constancia='".$Constancia."', ley_habitacional='".$Ley_Habitacional."', OCV='".$OCV."', transporte='".$Transporte."' WHERE id='".$Id."'";
	if (!$resultado = mysqli_query(conexion(), $sql)){
	   return false;
	   exit;
    }else{
        return true;
        
    }
}

function actualizarFamiliar($Id, $Fid, $Fnombre, $Fcedula, $Fnacionalidad, $Fnacimiento, $Fsexo, $Ftiempo, $FCNE, $Fparentesco, $Finstruccion, $Ftrabaja, $Fincapacitado, $Ftipo, $Fpensionado, $Fembarazo) {
    $sql = "UPDATE familiar SET id='".$Id."', nombre='".$Fnombre."', cedula='".$Fcedula."', nacionalidad='".$Fnacionalidad."', nacimiento='".$Fnacimiento."', sexo='".$Fsexo."', tiempo='".$Ftiempo."', CNE='".$FCNE."', parentesco='".$Fparentesco."', instruccion='".$Finstruccion."', trabaja='".$Ftrabaja."', incapacitado='".$Fincapacitado."', tipo='".$Ftipo."', pensionado='".$Fpensionado."', embarazo='".$Fembarazo."' WHERE id='".$Id."' AND fid='".$Fid."'";
    if (!$resultado = mysqli_query(conexion(), $sql)){
	   return false;
	   exit;
    }else{
        return true;
    }
}

function insertarPersona($Id, $Casa, $Nombre, $Cedula, $Nacionalidad, $Nacimiento, $Sexo, $Tiempo, $CNE, $Estado_Civil, $Instruccion, $Trabaja, $Donde_Trabaja, $Telefono, $Comercio_Vivienda, $Ventas, $Insectos, $Animales, $Enfermedad, $Cual_Enfermedad, $Cual_Medicamento, $Incapacitado, $Tipo, $Pensionado, $Institucion, $Tenencia, $Terreno_Propio, $Tipo_Vivienda, $SIVIH, $Constancia, $Ley_Habitacional, $OCV, $Transporte) {
    $sql = "INSERT INTO persona (id, casa, nombre, cedula, nacionalidad, nacimiento, sexo, tiempo, CNE, estado_civil, instruccion, trabaja, donde_trabaja, telefono, comercio_vivienda, ventas, insectos, animales, enfermedad, cual_enfermedad, cual_medicamento, incapacitado, tipo, pensionado, institucion, tenencia, terreno_propio, tipo_vivienda, SIVIH, constancia, ley_habitacional, OCV, transporte) VALUES ('".$Id."', '".$Casa."', '".$Nombre."', '".$Cedula."', '".$Nacionalidad."', '".$Nacimiento."', '".$Sexo."', '".$Tiempo."', '".$CNE."', '".$Estado_Civil."', '".$Instruccion."', '".$Trabaja."', '".$Donde_Trabaja."', '".$Telefono."', '".$Comercio_Vivienda."', '".$Ventas."', '".$Insectos."', '".$Animales."', '".$Enfermedad."', '".$Cual_Enfermedad."', '".$Cual_Medicamento."', '".$Incapacitado."', '".$Tipo."', '".$Pensionado."', '".$Institucion."', '".$Tenencia."', '".$Terreno_Propio."', '".$Tipo_Vivienda."', '".$SIVIH."', '".$Constancia."', '".$Ley_Habitacional."', '".$OCV."', '".$Transporte."')";
    if (!$resultado = mysqli_query(conexion(), $sql)){
	   return false;
	   exit;
    }else{
        return true;
    }
}

function insertarFamiliar($Id, $FId, $Fnombre, $Fcedula, $Fnacionalidad, $Fnacimiento, $Fsexo, $Ftiempo, $FCNE, $Fparentesco, $Finstruccion, $Ftrabaja, $Fincapacitado, $Ftipo, $Fpensionado, $Fembarazo) {
    $sql = "INSERT INTO familiar (id, fid, nombre, cedula, nacionalidad, nacimiento, sexo, tiempo, CNE, parentesco, instruccion, trabaja, incapacitado, tipo, pensionado, embarazo) VALUES ('".$Id."', '".$FId."', '".$Fnombre."', '".$Fcedula."', '".$Fnacionalidad."', '".$Fnacimiento."', '".$Fsexo."', '".$Ftiempo."', '".$FCNE."', '".$Fparentesco."', '".$Finstruccion."', '".$Ftrabaja."', '".$Fincapacitado."', '".$Ftipo."', '".$Fpensionado."', '".$Fembarazo."')";
    if (!$resultado = mysqli_query(conexion(), $sql)){
	   return false;
	   exit;
    }else{
        return true;
    }
}

?>