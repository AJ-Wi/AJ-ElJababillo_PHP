function Agregar() {
	var familiares = document.getElementById('familiares');
    var cuenta = familiares.getElementsByClassName('familiar').length + 1;
    var familiar = document.createElement('div');
    familiar.setAttribute('class', 'familiar');    
	familiar.innerHTML += '<div class="titulofamiliares"><label>Familiar ' + cuenta + '</label></div>';
    familiar.innerHTML += '<div class="seccion"><input type="text" name="fnombre[]" placeholder="Nombres y Apellidos"></div>';
    familiar.innerHTML += '<div class="seccion"><input type="text" name="fcedula[]" placeholder="Cédula"></div>';
    familiar.innerHTML += '<div class="seccion"><select name="fnacionalidad[]"><option value="">Nacionalidad</option><option value="Venezolano">Venezolano (a)</option><option value="Extranjero">Extranjero (a)</option></select></div>';
    familiar.innerHTML += '<div class="seccion"><input type="text" name="fnacimiento[]" placeholder="Fecha de Nacimiento"></div>';
    familiar.innerHTML += '<div class="seccion"><select name="fsexo[]"><option value="">Sexo</option><option value="Femenino">Femenino</option><option value="Masculino">Masculino</option></select></div>';
    familiar.innerHTML += '<div class="seccion"><input type="text" name="ftiempo[]" placeholder="Tiempo en la Comunidad"></div>';
    familiar.innerHTML += '<div class="seccion"><select name="fCNE[]"><option value="">CNE</option><option value="Si">Si</option><option value="No">No</option></select></div>';
    familiar.innerHTML += '<div class="seccion"><input type="text" name="fparentesco[]" placeholder="Parentesco"></div>';
    familiar.innerHTML += '<div class="seccion"><select name="finstruccion[]"><option value="">Nivel de Instrucción</option><option value="Sin instruccion">Sin instruccion </option><option value="Basica">Basica </option><option value="Bachiller">Bachiller </option><option value="Tecnico Medio">Tecnico Medio </option><option value="Tecnico Superior">Tecnico Superior </option><option value="Universitario">Universitario </option><option value="Post Grado">Post Grado </option></select></div>';
    familiar.innerHTML += '<div class="seccion"><select name="ftrabaja[]"><option value="">Trabaja</option><option value="Si">Si</option><option value="No">No</option></select></div>';
    familiar.innerHTML += '<div class="seccion"><select name="fincapacitado[]"><option value="">Incapacitado</option><option value="Si">Si</option><option value="No">No</option></select><input type="text" name="tipo[]" placeholder="Tipo de incapacidad"></div>';
    familiar.innerHTML += '<div class="seccion"><select name="fpensionado[]"><option value="">Pensionado</option><option value="Si">Si</option><option value="No">No</option></select></div>';
    familiar.innerHTML += '<div class="seccion largo100"><select name="fembarazo[]"><option value="">Embarazo Temprano</option><option value="Si">Si</option><option value="No">No</option></select></div>';
    familiares.appendChild(familiar);
}