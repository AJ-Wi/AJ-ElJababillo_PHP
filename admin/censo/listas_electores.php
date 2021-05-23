<?php
session_start(); 
$Iniciada = isset($_SESSION["autentificado"]) ? $_SESSION["autentificado"] : null;
if ($Iniciada != "SI") { 
    header("Location: ../../usuario");
}	
?>
<?php
require('../../solicitudes/FPDF/fpdf.php');
require('../../conexion/censo.php');
require('../../conexion/edad.php');
require('../../conexion/electores.php');

$Formato = $_POST['formato'];
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
        $Calle = '2da Transversal';
        break;
    case 'C2':
        $Calle = '2da Calle';
        break;
    default:
        break;
}
$Datos = generar_cne($CodigoCalle);

if ($Datos == false) {
    header("Location: ../");
    exit;
}

if ($Formato == 'pdf'){
	header('Content-Type: text/html; charset=UTF-8');
	
	class PDF extends FPDF {		
		function Header(){
            global $Calle;
			setlocale(LC_ALL, 'es_ES');
			$this->SetDrawColor(0, 32, 96);
			$this->SetTextColor(0, 32, 96);
			$this->Image('../../img/logopdf.png',10,8);
			$this->Image('../../img/usuario/CNE.png',160,10);
			$this->SetFont('Arial','B',15);
			$this->Ln(15);
			$this->Cell(0,5,utf8_decode('Listado de Votantes'),0,1,'C');
			$this->SetFont('Arial','B',12);
			$this->Ln(4);
			$this->SetFont('Arial','B',10);
            $this->Cell(0,5,'Calle: '.utf8_decode($Calle),0,1);
			$this->Cell(25,7,'Id',1,0,'C');
			$this->Cell(60,7,'Nombre y Apellido',1,0,'C');
			$this->Cell(20,7,utf8_decode('Cédula'),1,0,'C');
			$this->Cell(80,7,utf8_decode('Centro de Votación'),1,1,'C');
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
	
    while ($Dato = mysqli_fetch_row($Datos)){
		if (edad($Dato[3]) < 18) {continue;}
		$Centro = elector('V', $Dato[2]);
		if (!$Centro) {continue;}
		$Escuela = colegio($Centro);
		if (!$Escuela) {continue;}
        $pdf->Cell(25,7,$Dato[0],1,0,'C');
        $pdf->Cell(60,7,utf8_decode($Dato[1]), 1);
        $pdf->Cell(20,7,number_format($Dato[2], 0, ',', '.'), 1, 0, 'R');
		$pdf->Cell(80,7,utf8_decode($Escuela),1,1);
    }
	
	$pdf->Output('Lista_Electores_'.$Calle.'.pdf','I');
}else{
	header( "Content-Type: application/octet-stream");
	header( "Content-Disposition: attachment; filename=".$Calle.".csv");

	$Contenido = 'ID,Nombre y Apellido,'.utf8_decode('Cédula').','.utf8_decode('Centro de Votación').chr(13).chr(10); // Encabezado del archivo

	while ($Dato = mysqli_fetch_row($Datos)){
		if (edad($Dato[3]) < 18) {continue;}
		$Centro = elector('V', $Dato[2]);
		if (!$Centro) {continue;}
		$Escuela = colegio($Centro);
		//if (!$Escuela) {continue;}
		//$Contenido .= $Dato[0].','.utf8_decode($Dato[1]).','.number_format($Dato[2], 0, ',', '.').','.utf8_decode($Escuela).chr(13).chr(10);
		$Contenido .= $Dato[0].','.utf8_decode($Dato[1]).','.number_format($Dato[2], 0, ',', '.').','.utf8_decode($Centro).chr(13).chr(10);
	}

	echo $Contenido;
}
?>