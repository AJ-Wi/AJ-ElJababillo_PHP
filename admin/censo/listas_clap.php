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
$CodigoCalle = $_POST['direccion'];
switch($CodigoCalle) {
    case 'Cc':
        $Calle = 'Callejón Coromoto';
        break;
    case 'Cj':
        $Calle = 'Calle los Jabillos';
        break;
    case 'T1':
        $Calle = '1ra Transversal';
        break;
    case 'T2':
        $Calle = '2ra Transversal';
        break;
    case 'C2':
        $Calle = '2da Calle';
        break;
    default:
        break;
}
$Datos = generar_mercal($CodigoCalle);
$Datos2 = generar_mercal($CodigoCalle);
if ($Datos == false) {
    header("Location: ../");
    exit;
}

	class PDF extends FPDF {		
		function Header(){
            global $Calle;
			setlocale(LC_ALL, 'es_ES');
			$this->SetDrawColor(0, 32, 96);
			$this->SetTextColor(0, 32, 96);
			$this->Image('../../img/logopdf.png',10,8);
			$this->Image('../../img/usuario/logo_clap.jpg',170,5);
			$this->SetFont('Arial','B',15);
			$this->Ln(15);
			$this->Cell(0,5,utf8_decode('Listado de Familias del CLAP'),0,1,'C');
			$this->SetFont('Arial','B',12);
			$this->Ln(4);
			$this->SetFont('Arial','B',10);
            $this->Cell(155,5,'Calle: '.utf8_decode($Calle),0,0);
			$this->Cell(0,5,'Fecha: '.Date("j").'-'.Date("m").'-'.Date("y"),0,1);
			$this->Cell(25,7,'Id',1,0,'C');
			$this->Cell(60,7,'Nombres y Apellidos',1,0,'C');
			$this->Cell(20,7,utf8_decode('Cédula'),1,0,'C');
			$this->Cell(30,7,utf8_decode('Referencia'),1,0,'C');
			$this->Cell(50,7,'Firma',1,1,'C');
		}
		
		function Footer(){
			$this->SetTextColor(0, 32, 96);
			$this->SetY(-25);
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
	$Real = 0;		
    while ($Dato = mysqli_fetch_row($Datos)){
		if (Buscarmudados($Dato[0])) {continue;}
		if (Buscarnopagaron($Dato[0])) {continue;}
        $pdf->Cell(25,7,$Dato[0],1,0,'C');
        $pdf->Cell(60,7,utf8_decode($Dato[1]), 1);
        $pdf->Cell(20,7,number_format($Dato[2], 0, ',', '.'), 1, 0, 'R');
		$pdf->Cell(30,7,'',1);
        $pdf->Cell(50,7,'',1,1);
		$Real += 1;
    }
	$Falso = 0;
	/*if (($Calle == 'Callejón Coromoto') or ($Calle == '2ra Transversal') or ($Calle == '2da Calle')){
		while ($Dato = mysqli_fetch_row($Datos2)){
			if (Buscarmudados($Dato[0])) {
				$pdf->Cell(25,14,$Dato[0],1,0,'C');
				$pdf->Cell(60,14,utf8_decode($Dato[1]), 1);
				$pdf->Cell(20,14,number_format($Dato[2], 0, ',', '.'), 1, 0, 'R');
				$pdf->Cell(30,14,'',1);
				$pdf->Cell(50,14,'',1,1);
				$Falso += 1;
			}
		}
	}
	$pdf->Cell(50,7,'Total Real '.$Real,0,1);
	$pdf->Cell(50,7,'Total Falsos'.$Falso,0,1);*/
	$pdf->Cell(50,7,'Total de Familias: '.$Real,0,1);
	$pdf->Output('Lista_CLAP_'.$Calle.'.pdf','I');
?>