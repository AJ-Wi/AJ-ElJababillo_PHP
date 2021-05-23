<?php
header('Content-Type: text/html; charset=UTF-8');
require('FPDF/fpdf.php');
require('../conexion/residencia.php');
require('../conexion/fecha.php');

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
{global $BCedula, $Nombre, $Direccion, $Nacionalidad, $Tramite;
date_default_timezone_set ('America/La_Paz');
	
	$html1 = '           Por medio de la presente, el <b>"CONSEJO COMUNAL EL JABILLO"</b>, integrado por los voceros electos de la comunidad del Jabillo (Ruperto Lugo parte baja), conformada por: calle el jabillo, callejón Coromoto, 1ra y 2da transversal, 2da calle entre 1ra y 2da transversal, hacemos constar, que el (la) ciudadano(a):';
	$html1 .= '<b>LUIS ALFREDO LOPEZ GIL</b>, mayor de edad, portador  de la cédula de identidad N° <b>27.796.136</b>, y de nacionalidad <b>Venezolano</b>';
	$html2 = '           Quien <b>BAJO FE DE JURAMENTO DECLARA</b> que habita de forma permanente en la siguiente dirección: <b>SEGUNDA CALLE DE RUPERTO LUGO CASA 6</b>, por lo que pertenece al ámbito geográfico del Consejo comunal.';
	$html3 = '           Constancia que se expide para tramite <b>Alimentación</b> a solicitud de parte interesada, en la comunidad El Jabillo, en fecha: <b>'.fecha('D').' '.date('j').' de '.fecha('M').' del '.date('Y').'.</b>';
	
	$this->SetTextColor(0, 32, 96);
	$this->Image('../img/logoweb.png',10,8);
	$this->Image('http://chart.googleapis.com/chart?chs=120x120&cht=qr&chl=consejoeljabillo.com.ve/validacion?CI=14645515R&.png',160,245);
	$this->SetFont('Arial','B',12);
	$this->Ln(40);
	$this->Cell(0,5,'REPUBLICA BOLIVARIANA DE VENEZUELA',0,1,'C');
	$this->Cell(0,5,'MINISTERIO DEL PODER POPULAR PARA LAS COMUNAS',0,1,'C');
	$this->Cell(0,5,'CONSEJO COMUNAL EL JABILLO',0,1,'C');
	//$this->Cell(0,5,'RIF J-315624856-8',0,1,'C');
	$this->Cell(0,5,'SITUR: CC-URB-2016-08-00023',0,1,'C');
	$this->Ln(5);
	$this->SetFont('Arial','U',12);
	$this->Cell(0,20,'CARTA DE RESIDENCIA',0,1,'C');
	$this->SetFont('Arial','',10);
	$this->SetLeftMargin(15);
	$this->SetRightMargin(15);
	$this->WriteHTML(utf8_decode($html1));
	$this->Ln(10);
	$this->WriteHTML(utf8_decode($html2));
	$this->Ln(10);
	$this->WriteHTML(utf8_decode($html3));
	$this->Ln(10);
	$this->Cell(0,5,'POR EL CONSEJO COMUNAL "EL JABILLO"',0,1,'C');
	$this->Ln(30);
	$this->Cell(0,5,'_____________________________',0,1,'C');
	$this->Cell(0,5,utf8_decode('UNIDAD EJECUTIVA.'),0,1,'C');
	$this->Ln(30);
	$this->Cell(90,5,'_____________________________',0,0,'C');
	$this->Cell(90,5,'_____________________________',0,1,'C');
	$this->Cell(90,5,utf8_decode('UNIDAD DE CONTRALORIA'),0,0,'C');
	$this->Cell(90,5,utf8_decode('UNIDAD DE FINANZAS'),0,1,'C');
	$this->Ln(30);
	$this->SetFont('Arial','',8);
	$this->Cell(90,5,utf8_decode('DOCUMENTO NO VALIDO SIN SELLO NI FIRMAS.'),0,1,'C');
}

}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Output('Constancia de Residencia.pdf','I');
?>
