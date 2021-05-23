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
$Datos = generar_cuaderno();
$Count = 1001;
if ($Datos == false) {
    header("Location: ../");
    exit;
}

	class PDF extends FPDF {
		function Header(){
			$this->Image('../../img/usuario/consejo.png',10,8);
            $this->Image('../../img/usuario/escudo.jpg',263,6);
			$this->SetFont('Arial','B',11);
            $this->Cell(0,4,'REPUBLICA BOLIVARIANA DE VENEZUELA',0,1,'C');
            $this->Cell(0,5,'ASAMBLEA CONTITUYENTE EXTRAORDINARIA',0,1,'C');
            $this->SetFont('Arial','B',16);
            $this->SetTextColor(0, 32, 96);
            $this->Cell(0,5,'ELECCIONES PERIODO 2016 - 2018',0,1,'C');
            $this->SetTextColor(255, 0, 0);
            $this->Cell(0,5,'CONSEJO COMUNAL "EL JABILLO"',0,1,'C');
            $this->SetFont('Arial','B',10);
            $this->SetTextColor(0, 0, 0);
            $this->Cell(0,4,utf8_decode('ELECCIÓN DE VOCEROS Y VOCERAS DE LA UNIDAD FINANCIERA COMUNITARIA,'),0,1,'C');
            $this->Cell(0,4,utf8_decode('UNIDAD DE CONTRALORIA SOCIAL COMUNITARIA, Y DEMÁS VOCERIAS DE LOS COMITÉS DE TRABAJO'),0,1,'C');
			$this->Ln(2);
			$this->SetFont('Arial','B',11);
            $this->SetFillColor(229, 229, 229);
			$this->Cell(10,7,utf8_decode('N°'),1,0,'C');
			$this->Cell(75,7,'NOMBRE Y APELLIDO',1,0,'C');
			$this->Cell(28,7,utf8_decode('CÉDULA'),1,0,'C');
            $this->Cell(12,7,'EDAD',1,0,'C');
			$this->Cell(40,7,utf8_decode('DIRECCIÓN'),1,0,'C');
			$this->Cell(45,7,'FIRMA',1,0,'C');
            $this->Cell(25,7,'VOTO',1,0,'C');
            $this->Cell(45,7,'HUELLA',1,1,'C');
		}
		
		function Footer(){
            $this->SetTextColor(0, 0, 0);
			$this->SetY(-15);
			$this->SetFont('Arial','I',10);
			$this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'R');
		}
	}

	$pdf = new PDF('l');
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',14);
    while ($Dato = mysqli_fetch_row($Datos)){
        if (edad($Dato[3]) < 15) {continue;}
		if (Buscarmudados($Dato[0])) {continue;}
        $calle = substr($Dato[0],4,2);
        switch($calle) {
            case 'Cc':
                $direccion = 'Callejón Coromoto';
                break;
            case 'Cj':
                $direccion = 'Calle los Jabillos';
                break;
            case 'T1':
                $direccion = '1ra Transversal';
                break;
            case 'T2':
                $direccion = '2ra Transversal';
                break;
            case 'C2':
                $direccion = '2da Calle';
                break;
            default:
                break;
        }
        $pdf->SetFont('Arial','B',14);
        $pdf->Cell(10,14,substr($Count,1),1,0,'C');
        $pdf->Cell(75,14,utf8_decode($Dato[1]), 1);
        $pdf->Cell(28,14,number_format($Dato[2], 0, ',', '.'), 1, 0, 'R');
        $pdf->Cell(12,14,edad($Dato[3]),1,0,'C');
        $pdf->SetFont('Arial','B',11);
        $pdf->Cell(40,14,utf8_decode($direccion),1);
        $pdf->Cell(45,14,'',1);
        $pdf->Cell(25,14,'',1);
        $pdf->Cell(45,14,'',1,1);
        $Count += 1;
    }
	$pdf->Output('Cuaderno_de_votacion.pdf','I');
?>