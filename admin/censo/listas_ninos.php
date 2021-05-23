<?php
session_start(); 
$Iniciada = isset($_SESSION["autentificado"]) ? $_SESSION["autentificado"] : null;
if ($Iniciada != "SI") { 
    header("Location: ../../usuario");
}	
?>
<?php
header('Content-Type: text/html; charset=UTF-8');
require('../../solicitudes/FPDF/fpdf.php');
require('../../conexion/censo.php');
require('../../conexion/edad.php');
//$ED = $_POST['edad'];
$ED = 12;
$Datos = generar_lista_juguetes();
$con = 1;
if ($Datos == false) {
    header("Location: ../");
    exit;
}

function Calle ($Codigo) {
	$Codigo = substr($Codigo,4,2);
	switch($Codigo) {
		case 'Cc':
			return 'Callejón Coromoto';
			break;
		case 'Cj':
			return 'Calle los Jabillos';
			break;
		case 'T1':
			return '1ra Transversal';
			break;
		case 'T2':
			return '2ra Transversal';
			break;
		case 'C2':
			return '2da Calle';
			break;
		default:
			break;
	}
}

	class PDF extends FPDF {
		function Header(){
            global $Calle;
			setlocale(LC_ALL, 'es_ES');
			$this->SetDrawColor(0, 32, 96);
			$this->SetTextColor(0, 32, 96);
			$this->Image('../../img/logo.png',10,8);
			$this->SetFont('Arial','B',15);
			$this->Ln(5);
			$this->Cell(0,5,utf8_decode('Listado de Niños'),0,1,'C');
			$this->SetFont('Arial','B',12);
			$this->Ln(2);
			$this->SetFont('Arial','B',10);
			$this->Ln(2);
			$this->Cell(10,7,utf8_decode('N°'),1,0,'C');
			$this->Cell(22,7,'Id',1,0,'C');
			$this->Cell(60,7,'Nombres y Apellidos',1,0,'C');
			$this->Cell(20,7,utf8_decode('Cédula'),1,0,'C');
			$this->Cell(10,7,'Edad',1,0,'C');
			$this->Cell(40,7,utf8_decode('Calle'),1,0,'C');
			$this->Cell(30,7,utf8_decode('Observación'),1,1,'C');
		}
		
		function Footer(){
			$this->SetTextColor(0, 32, 96);
			$this->SetY(-15);
			$this->SetFont('Arial','I',8);
			$this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
		}
	}

	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetDrawColor(0, 32, 96);
	$pdf->SetTextColor(0, 32, 96);
	$pdf->SetFont('Arial','B',10);
	$cero = array();
	$uno = array();
	$dos = array();
	$tres = array();
	$cuatro = array();
	$cinco = array();
	$seis = array();
	$siete = array();
	$ocho = array();
	$nueve = array();
	$diez = array();
	$once = array();
	$doce = array();
    while ($Dato = mysqli_fetch_row($Datos)){
			if (edad($Dato[3]) > $ED) {continue;}
			if (edad($Dato[3]) == 0){if ($Dato[4] == 'Masculino'){$cero[0] += 1;}else{$cero[1] += 1;}}
			if (edad($Dato[3]) == 1){if ($Dato[4] == 'Masculino'){$uno[0] += 1;}else{$uno[1] += 1;}}
			if (edad($Dato[3]) == 2){if ($Dato[4] == 'Masculino'){$dos[0] += 1;}else{$dos[1] += 1;}}
			if (edad($Dato[3]) == 3){if ($Dato[4] == 'Masculino'){$tres[0] += 1;}else{$tres[1] += 1;}}
			if (edad($Dato[3]) == 4){if ($Dato[4] == 'Masculino'){$cuatro[0] += 1;}else{$cuatro[1] += 1;}}
			if (edad($Dato[3]) == 5){if ($Dato[4] == 'Masculino'){$cinco[0] += 1;}else{$cinco[1] += 1;}}
			if (edad($Dato[3]) == 6){if ($Dato[4] == 'Masculino'){$seis[0] += 1;}else{$seis[1] += 1;}}
			if (edad($Dato[3]) == 7){if ($Dato[4] == 'Masculino'){$siete[0] += 1;}else{$siete[1] += 1;}}
			if (edad($Dato[3]) == 8){if ($Dato[4] == 'Masculino'){$ocho[0] += 1;}else{$ocho[1] += 1;}}
			if (edad($Dato[3]) == 9){if ($Dato[4] == 'Masculino'){$nueve[0] += 1;}else{$nueve[1] += 1;}}
			if (edad($Dato[3]) == 10){if ($Dato[4] == 'Masculino'){$diez[0] += 1;}else{$diez[1] += 1;}}
			if (edad($Dato[3]) == 11){if ($Dato[4] == 'Masculino'){$once[0] += 1;}else{$once[1] += 1;}}
			if (edad($Dato[3]) == 12){if ($Dato[4] == 'Masculino'){$doce[0] += 1;}else{$doce[1] += 1;}}
			$pdf->Cell(10,7,$con,1,0,'C');
			$pdf->Cell(22,7,$Dato[0],1,0,'C');
			$pdf->Cell(60,7,utf8_decode($Dato[1]), 1);
			$pdf->Cell(20,7,number_format($Dato[2], 0, ',', '.'), 1, 0, 'R');
			$pdf->Cell(10,7,edad($Dato[3]),1,0,'C');
			$pdf->Cell(40,7,utf8_decode(Calle($Dato[0])),1,0,'C');
			$pdf->Cell(30,7,'',1,1);
			$con += 1;
    }
	$pdf->Cell(50,7,utf8_decode('0 años= Niños: '.$cero[0].' Niñas: '.$cero[1].' Total: '.($cero[0] + $cero[1])),0,1);
	$pdf->Cell(50,7,utf8_decode('1 años= Niños: '.$uno[0].' Niñas: '.$uno[1].' Total: '.($uno[0]+$uno[1])),0,1);
	$pdf->Cell(50,7,utf8_decode('2 años= Niños: '.$dos[0].' Niñas: '.$dos[1].' Total: '.($dos[0]+$dos[1])),0,1);
	$pdf->Cell(50,7,utf8_decode('3 años= Niños: '.$tres[0].' Niñas: '.$tres[1].' Total: '.($tres[0]+$tres[1])),0,1);
	$pdf->Cell(50,7,utf8_decode('4 años= Niños: '.$cuatro[0].' Niñas: '.$cuatro[1].' Total: '.($cuatro[0]+$cuatro[1])),0,1);
	$pdf->Cell(50,7,utf8_decode('5 años= Niños: '.$cinco[0].' Niñas: '.$cinco[1].' Total: '.($cinco[0]+$cinco[1])),0,1);
	$pdf->Cell(50,7,utf8_decode('6 años= Niños: '.$seis[0].' Niñas: '.$seis[1].' Total: '.($seis[0]+$seis[1])),0,1);
	$pdf->Cell(50,7,utf8_decode('7 años= Niños: '.$siete[0].' Niñas: '.$siete[1].' Total: '.($siete[0]+$siete[1])),0,1);
	$pdf->Cell(50,7,utf8_decode('8 años= Niños: '.$ocho[0].' Niñas: '.$ocho[1].' Total: '.($ocho[0]+$ocho[1])),0,1);
	$pdf->Cell(50,7,utf8_decode('9 años= Niños: '.$nueve[0].' Niñas: '.$nueve[1].' Total: '.($nueve[0]+$nueve[1])),0,1);
	$pdf->Cell(50,7,utf8_decode('10 años= Niños: '.$diez[0].' Niñas: '.$diez[1].' Total: '.($diez[0]+$diez[1])),0,1);
	$pdf->Cell(50,7,utf8_decode('11 años= Niños: '.$once[0].' Niñas: '.$once[1].' Total: '.($once[0]+$once[1])),0,1);
	$pdf->Cell(50,7,utf8_decode('12 años= Niños: '.$doce[0].' Niñas: '.$doce[1].' Total: '.($doce[0]+$doce[1])),0,1);
	$pdf->Output($Calle.'.pdf','I');
?>