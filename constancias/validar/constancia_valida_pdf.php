<?php
session_start();

require('../../fpdf17/fpdf.php');

class PDF extends FPDF
{
    function Header(){
        $this->Image('../../imagenes/encabezado_fontur.png',20,10,168,25);
    }
    function Footer(){
        $this->SetY(-20);
        $this->SetFont('Arial','',10);$this->Cell(84,5,utf8_decode('Documento válido por treinta (30) días a partir de su emisión.'),0,0,'L');$this->Cell(69,3,utf8_decode('Validación: '),0,0,'R');$this->SetFont('Arial','B',10);$this->Cell(15,3,$_SESSION['hash'],0,1,'R');
        $this->SetFont('Arial','',9,5);$this->Cell(168,5,utf8_decode('La validez de la presente constancia, puede ser consultada a través del correo constancia_de_trabajo@fontur.gob.ve'),0,0,'J');
    }
}
$i=0;
if($_SESSION['diferenciamensual']==''||$_SESSION['diferenciamensual']=='0,00'||$_SESSION['diferenciamensual']=='0'){
	$i++;
}
if($_SESSION['primajerarquia']==''||$_SESSION['primajerarquia']=='0,00'||$_SESSION['primajerarquia']=='0'){
	$i++;
}
if($_SESSION['primaantiguedad']==''||$_SESSION['primaantiguedad']=='0,00'||$_SESSION['primaantiguedad']=='0'){
	$i++;
}
if($_SESSION['primaprofesional']==''||$_SESSION['primaprofesional']=='0,00'||$_SESSION['primaprofesional']=='0'){
	$i++;
}
if($_SESSION['primahogar']==''||$_SESSION['primahogar']=='0,00'||$_SESSION['primahogar']=='0'){
	$i++;
}
if($_SESSION['primatransporte']==''||$_SESSION['primatransporte']=='0,00'||$_SESSION['primatransporte']=='0'){
	$i++;
}
$var1=8-$i;
$var2=56/$var1;

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage('P','Letter');
$pdf->SetMargins(20,20,20);
$pdf->SetFont('Arial','',11);
$pdf->Image('../../imagenes/FirmaDigitalCarnet.png',67,192,75,45,'PNG');
$pdf->Image('../../imagenes/Mision.jpg',158,268,30,10,'JPG');
$pdf->Cell(168,30,'',0,1,'C');
$pdf->Cell(84,5,utf8_decode($_SESSION['correlativo1'])."-".date('Y'),0,0,'L');
$pdf->Cell(84,5,$_SESSION['lugar'].", ".$_SESSION['fechasolicitud'],0,1,'R');
$pdf->Cell(168,5,'',0,1,'C');
$pdf->Cell(168,5,utf8_decode('Señores:'),0,1,'L');
$pdf->SetFont('Arial','B',11);
$pdf->Cell(168,5,utf8_decode($_SESSION['destino']),0,1,'L');
$pdf->SetFont('Arial','',11);
$pdf->Cell(168,5,'Presente.-',0,1,'L');
$pdf->Cell(168,5,'',0,1,'C');
if ($_SESSION['cargo']!=''){
    $pdf->MultiCell(168,5,utf8_decode('Quien suscribe, Gerente (E) de Recursos Humanos de la '.$_SESSION['institucion'].', '.$_SESSION['nacgerente'].', por medio de la presente, hago constar que la (el) ciudadana (o) '.$_SESSION['apellidosynombres'].', titular de la Cédula de Identidad N° '.$_SESSION['ci'].' labora en esta Fundación, desde el '.$_SESSION['fechaingreso'].', actualmente cumple funciones de '.$_SESSION['cargo'].', adscrita (o) a la '.strtoupper($_SESSION['gerencia']).', devengando una remuneración mensual de:'),0,'J');
}else {
    $pdf->MultiCell(168,5,utf8_decode('Quien suscribe, Gerente (E) de Recursos Humanos de la '.$_SESSION['institucion'].', '.$_SESSION['nacgerente'].', por medio de la presente, hago constar que la (el) ciudadana (o) '.$_SESSION['apellidosynombres'].', titular de la Cédula de Identidad N° '.$_SESSION['ci'].' labora en esta Fundación, desde el '.$_SESSION['fechaingreso'].', en condición de CONTRATADO, adscrita (o) a la '.strtoupper($_SESSION['gerencia']).', devengando una remuneración mensual de:'),0,'J');
}
$pdf->Cell(168,5,'',0,1,'C');
//$pdf->Cell(168,5,'',0,1,'C');
$pdf->SetFont('Arial','B',11);$pdf->Cell(126,$var2,'Sueldo Base:',1,0,'L');$pdf->SetFont('Arial','',11);$pdf->Cell(42,$var2,$_SESSION['sueldobase'],1,1,'R');
if($_SESSION['diferenciamensual']!=''&&$_SESSION['diferenciamensual']!='0,00'&&$_SESSION['diferenciamensual']!='0'){
	$pdf->SetFont('Arial','B',11);$pdf->Cell(126,$var2,utf8_decode('Diferencia Mensual:'),1,0,'L');$pdf->SetFont('Arial','',11);$pdf->Cell(42,$var2,$_SESSION['diferenciamensual'],1,1,'R');
}
if($_SESSION['primajerarquia']!=''&&$_SESSION['primajerarquia']!='0,00'&&$_SESSION['primajerarquia']!='0'){
	$pdf->SetFont('Arial','B',11);$pdf->Cell(126,$var2,utf8_decode('Prima de Jerarquía:'),1,0,'L');$pdf->SetFont('Arial','',11);$pdf->Cell(42,$var2,$_SESSION['primajerarquia'],1,1,'R');
}
if($_SESSION['primaantiguedad']!=''&&$_SESSION['primaantiguedad']!='0,00'&&$_SESSION['primaantiguedad']!='0'){
	$pdf->SetFont('Arial','B',11);$pdf->Cell(126,$var2,utf8_decode('Prima de Antigüedad:'),1,0,'L');$pdf->SetFont('Arial','',11);$pdf->Cell(42,$var2,$_SESSION['primaantiguedad'],1,1,'R');
}
if($_SESSION['primaprofesional']!=''&&$_SESSION['primaprofesional']!='0,00'&&$_SESSION['primaprofesional']!='0'){
	$pdf->SetFont('Arial','B',11);$pdf->Cell(126,$var2,utf8_decode('Prima de Profesional:'),1,0,'L');$pdf->SetFont('Arial','',11);$pdf->Cell(42,$var2,$_SESSION['primaprofesional'],1,1,'R');
}
if($_SESSION['primahogar']!=''&&$_SESSION['primahogar']!='0,00'&&$_SESSION['primahogar']!='0'){
	$pdf->SetFont('Arial','B',11);$pdf->Cell(126,$var2,utf8_decode('Prima Hogar:'),1,0,'L');$pdf->SetFont('Arial','',11);$pdf->Cell(42,$var2,$_SESSION['primahogar'],1,1,'R');
}
if($_SESSION['primatransporte']!=''&&$_SESSION['primatransporte']!='0,00'&&$_SESSION['primatransporte']!='0'){
	$pdf->SetFont('Arial','B',11);$pdf->Cell(126,$var2,utf8_decode('Prima Transporte:'),1,0,'L');$pdf->SetFont('Arial','',11);$pdf->Cell(42,$var2,$_SESSION['primatransporte'],1,1,'R');
}
$pdf->SetFont('Arial','B',11);$pdf->Cell(126,$var2,utf8_decode('Sueldo Total:'),1,0,'L');$pdf->SetFont('Arial','',11);$pdf->Cell(42,$var2,$_SESSION['sueldototal'],1,1,'R');
$pdf->Cell(168,5,'',0,1,'C');
$pdf->SetFont('Arial','B',11);$pdf->Cell(168,7,utf8_decode('Beneficios Socios Económicos'),0,1,'L');
$pdf->Cell(126,$var2,utf8_decode('Bono de Alimentación:'),1,0,'L');$pdf->SetFont('Arial','',11);$pdf->Cell(42,$var2,$_SESSION['bonoalimentacion'],1,1,'R');
$pdf->Cell(168,5,'',0,1,'C');
$pdf->Cell(168,5,'',0,1,'C');
$pdf->Cell(168,5,utf8_decode('Sin más a que hacer referencia se despide.'),0,1,'L');
$pdf->Cell(168,5,utf8_decode('Atentamente'),0,1,'C');
$pdf->Cell(168,10,'',0,1,'C');
$pdf->SetFont('Arial','B',11);
$pdf->Cell(168,10,'',0,1,'C');
$pdf->Cell(168,5,utf8_decode($_SESSION['nyagerente']),0,1,'C');
$pdf->Cell(168,5,utf8_decode('GERENTE DE RECURSOS HUMANOS (E)'),0,1,'C');
$pdf->SetFont('Arial','',11);
$pdf->Cell(56,5,utf8_decode($_SESSION['correlativo2']),0,0,'L');$pdf->SetFont('Arial','B',8);$pdf->Cell(56,5,utf8_decode($_SESSION['lema']),0,0,'C');$pdf->Cell(56,5,'',0,1,'R');
$pdf->Cell(168,5,'',0,1,'C');
$pdf->SetFont('Arial','BI',9);
$pdf->Cell(168,3,utf8_decode($_SESSION['rif']),0,1,'C');
$pdf->SetFont('Arial','B',8);
$pdf->Cell(168,3,utf8_decode($_SESSION['institucion2']),0,1,'C');
$pdf->SetFont('Arial','',8);
$pdf->Cell(168,3,utf8_decode($_SESSION['direccioninstitucion']),0,1,'C');
$pdf->Cell(168,3,utf8_decode($_SESSION['contacto']),0,1,'C');
//$pdf->Cell(168,5,'',0,1,'C');
session_destroy();
$pdf->Output();
//}
?>