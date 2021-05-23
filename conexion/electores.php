<?php
	function elector($Nac, $ci) {
		$oldSetting = libxml_use_internal_errors( true );
		libxml_clear_errors();
		
		$xml = new DomDocument(); 
		$xml->loadHTMLFile('http://www.cne.gob.ve/web/registro_electoral/ce.php?nacionalidad='.$Nac.'&cedula='.$ci.'');

		$tabla = $xml->getElementsByTagName('table')->item(4);

		$datos = $tabla->nodeValue;
		
		$porciones = explode("\n", $datos);
		
		$N = 0;
		
		foreach ($porciones as $porcion){
			$porcion = trim(utf8_decode($porcion));
			if ($porcion =='El número de cédula ingresado no corresponde a un elector'){
				return false;
				exit;
			}
			if ($porcion =='Centro:'){
				$N = 1;
				continue;
			}
			if ($N == 1){
				return $porcion;
				exit;
			}
		}		
		
		libxml_clear_errors();
		libxml_use_internal_errors( $oldSetting );
	}
	
	function colegio($centro) {
		switch($centro) {
			case 'INSTITUTO EDUCACIÓNAL GLADYS DE FREITES':
				return 'I.E. GLADYS DE FREITES';
				break;
			case 'ESCUELA BÁSICA NACIONAL CIUDAD DE BARCELONA':
				return 'E.B.N. CIUDAD DE BARCELONA';
				break;
			case 'UNIDAD EDUCATIVA NACIONAL LICEO BOLIVARIANO NICANOR BOLET PERAZA':
				return 'U.E.N.L.B. NICANOR BOLET PERAZA';
				break;
			case 'CENTRO PREESCOLAR FUNDAPOL':
				return 'CENTRO PREESCOLAR FUNDAPOL';
				break;
			default:
			return false;
				break;
		}
	}
?> 