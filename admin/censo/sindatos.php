<?php
require('../../solicitudes/FPDF/fpdf.php');
require('../../conexion/censo.php');
require('../../conexion/edad.php');
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
$Datos = datosfaltantes($CodigoCalle);
if ($Datos == false) {
    header("Location: ../");
    exit;
}

	class PDF extends FPDF {
		function Header(){
            global $Calle;
			$this->SetDrawColor(0, 32, 96);
			$this->SetTextColor(0, 32, 96);
			$this->Image('../../img/logo.png',10,8);
			$this->SetFont('Arial','B',10);
			$this->Ln(4);
			$this->Cell(0,5,utf8_decode('Listado de Datos Faltantes'),0,1,'C');
			$this->Ln(1);
            $this->Cell(0,5,utf8_decode('Calle: '.$Calle),0,1);
			$this->Cell(20,7,'Id',1,0,'C');
			$this->Cell(80,7,'Nombres y Apellidos',1,0,'C');
			$this->Cell(30,7,utf8_decode('Cédula'),1,0,'C');
			$this->Cell(40,7,'Nacimiento',1,1,'C');
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
    while ($Dato = mysqli_fetch_row($Datos)){
        if ($Dato[2] == 0 or $Dato[3] == ''){
            if (edad($Dato[3]) >= 15 or $Dato[3] == ''){
                $pdf->Cell(20,7,$Dato[0],1,0,'C');
                $pdf->Cell(80,7,utf8_decode($Dato[1]), 1);
                if ($Dato[2] == 0){
                    $pdf->Cell(30,7,'', 1, 0, 'C');
                }else{
                    $pdf->Cell(30,7,number_format($Dato[2], 0, ',', '.'), 1, 0, 'C');
                }            
                $pdf->Cell(40,7,$Dato[3],1,1, 'C');
            }
        }
    }
	$pdf->Output('Lista_de_datos_faltantes_'.$CodigoCalle.'.pdf','I');
?>