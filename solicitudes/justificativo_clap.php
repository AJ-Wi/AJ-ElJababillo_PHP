<?php
header('Content-Type: text/html; charset=UTF-8');
require('FPDF/fpdf.php');
require('../conexion/residencia.php');
require('../conexion/fecha.php');
require('../inc/qrcode.php');

$BCedula = isset($_POST["cedula"]) ? $_POST["cedula"] : null;
$Fecha = isset($_POST["fecha"]) ? $_POST["fecha"] : null;
$Dia = substr($Fecha,8,2);
$Ano = substr($Fecha,0,4);
$Mes = Mes($Fecha);

if (!is_null($BCedula)){
    $Datos = buscarporCedula($BCedula);
    $Nombre = $Datos[0];
    $Direccion = $Datos[1];
    $Nacionalidad = $Datos[2];
}else{
    exit;
}

if ($Nombre == ''){
	header("Location: ../solicitudes?ERROR=1" );	
}

$filename = '../validacion/'.$BCedula.'J.png';
QRcode::png('https://consejoeljabillo.com.ve/validacion?CI='.$BCedula.'J', $filename, 'H', 2, 2);

function Mes($fecha)
{
	switch (substr($fecha,5,2)) {
    case '01':
        return 'Enero';
        break;
    case '02':
        return 'Febrero';
        break;
    case '03':
        return 'Marzo';
        break;
	case '04':
        return 'Abril';
        break;
	case '05':
        return 'Mayo';
        break;
	case '06':
        return 'Junio';
        break;
    case '07':
        return 'Julio';
        break;
    case '08':
        return 'Agosto';
        break;
	case '09':
        return 'Septiembre';
        break;
	case '10':
        return 'Octubre';
        break;
	case '11':
        return 'Noviembre';
        break;
	case '12':
        return 'Diciembre';
        break;
	}
}

class PDF extends FPDF
{

//****************************************************************
protected $B = 0;
protected $I = 0;
protected $U = 0;
protected $HREF = '';

function WriteHTML($html)
{
    // Intérprete de HTML
    $html = str_replace("\n",' ',$html);
    $a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
    foreach($a as $i=>$e)
    {
        if($i%2==0)
        {
            // Text
            if($this->HREF)
                $this->PutLink($this->HREF,$e);
            else
                $this->Write(5,$e);
        }
        else
        {
            // Etiqueta
            if($e[0]=='/')
                $this->CloseTag(strtoupper(substr($e,1)));
            else
            {
                // Extraer atributos
                $a2 = explode(' ',$e);
                $tag = strtoupper(array_shift($a2));
                $attr = array();
                foreach($a2 as $v)
                {
                    if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                        $attr[strtoupper($a3[1])] = $a3[2];
                }
                $this->OpenTag($tag,$attr);
            }
        }
    }
}

function OpenTag($tag, $attr)
{
    // Etiqueta de apertura
    if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,true);
    if($tag=='A')
        $this->HREF = $attr['HREF'];
    if($tag=='BR')
        $this->Ln(5);
}

function CloseTag($tag)
{
    // Etiqueta de cierre
    if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,false);
    if($tag=='A')
        $this->HREF = '';
}

function SetStyle($tag, $enable)
{
    // Modificar estilo y escoger la fuente correspondiente
    $this->$tag += ($enable ? 1 : -1);
    $style = '';
    foreach(array('B', 'I', 'U') as $s)
    {
        if($this->$s>0)
            $style .= $s;
    }
    $this->SetFont('',$style);
}

function PutLink($URL, $txt)
{
    // Escribir un hiper-enlace
    $this->SetTextColor(0,0,255);
    $this->SetStyle('U',true);
    $this->Write(5,$txt,$URL);
    $this->SetStyle('U',false);
    $this->SetTextColor(0);
}
//****************************************************************

function Header()
{global $BCedula, $Nombre, $Direccion, $Nacionalidad, $Dia, $Ano, $Mes, $filename;
date_default_timezone_set ('America/La_Paz');
	
	$html1 = '           El <b>"CLAP EL JABILLO"</b>, se dirige respetuosamente a Uds. a fin de dejar constancia de que el (la) Ciudadano(a): ';
	$html1 .= '<b>'.strtoupper($Nombre).'</b>, portador  de la cédula de identidad N° <b>'.number_format($BCedula, 0, ',', '.').'</b>, y de nacionalidad <b>'.$Nacionalidad.'</b> ';
	$html1 .= 'Quien <b>BAJO FE DE JURAMENTO DECLARA</b> que habita de forma permanente en la siguiente dirección: <b>'.strtoupper($Direccion).'</b>,';
	$html1 .= ' tuvo que dejar de asistir a su lugar de trabajo, por razones de venta de cajas de alimentación provista por el <b>CLAP El Jabillo.</b>';
	$html2 = '           Esperando que sepan comprender las razones expuestas y otorguen la justificación en tiempo y forma correspondientes, se extiende ';
	$html2 .= 'el presente documento para los fines que el interesado estime convenientes, en la comunidad El Jabillo, en fecha: ';
	$html2 .= '<b>'.$Dia.' de '.$Mes.' del '.$Ano.'.</b> ';
	
	//$this->SetTextColor(0, 32, 96);
	$this->Image('../img/logoweb.png',10,8);
	$this->Image($filename,160,245);
	$this->SetFont('Arial','B',12);
	$this->Ln(40);
	$this->Cell(0,5,'REPUBLICA BOLIVARIANA DE VENEZUELA',0,1,'C');
	$this->Cell(0,5,'MINISTERIO DEL PODER POPULAR PARA LAS COMUNAS',0,1,'C');
	$this->Cell(0,5,'CONSEJO COMUNAL EL JABILLO',0,1,'C');
	//$this->Cell(0,5,'RIF J-315624856-8',0,1,'C');
	$this->Cell(0,5,'SITUR: CC-URB-2016-08-00023',0,1,'C');
	$this->Cell(0,5,'CLAP EL JABILLO',0,1,'C');
	$this->Cell(0,5,'CLAPS-DIS-01012200106',0,1,'C');
	$this->Ln(5);
	$this->SetFont('Arial','U',12);
	$this->Cell(0,20,'JUSTIFICATIVO',0,1,'C');
	$this->SetFont('Arial','',10);
	$this->SetLeftMargin(15);
	$this->SetRightMargin(15);
	$this->Cell(0,5,utf8_decode('Señores'),0,1,'l');
	$this->SetFont('Arial','B',10);
	$this->Cell(0,5,utf8_decode('A quien dirige la justificación'),0,1,'l');
	$this->SetFont('Arial','',10);
	$this->Cell(0,5,utf8_decode('Presente.-'),0,1,'l');
	$this->Ln(10);
	$this->WriteHTML(utf8_decode($html1));
	$this->Ln(10);
	$this->WriteHTML(utf8_decode($html2));
	$this->Ln(10);
	$this->Cell(0,5,'POR EL CLAP "EL JABILLO"',0,1,'C');
	$this->Ln(30);
	$this->Cell(0,5,'_____________________________',0,1,'C');
	$this->Cell(0,5,utf8_decode('VOC. TERRITORIAL'),0,1,'C');
	$this->Cell(0,5,utf8_decode('WLADIMIR PÉREZ'),0,1,'C');
	$this->Cell(0,5,utf8_decode('C.I. 14.261.751'),0,1,'C');
	$this->Cell(0,5,utf8_decode('TLF. (0412)583-58-38'),0,1,'C');
	$this->Ln(30);
	$this->SetFont('Arial','',8);
	$this->Cell(90,5,utf8_decode('DOCUMENTO NO VALIDO SIN SELLO NI FIRMAS.'),0,1,'C');
}

}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Output('Justificativo Clap.pdf','I');
?>
