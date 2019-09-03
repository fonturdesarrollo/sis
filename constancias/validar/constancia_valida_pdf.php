<?php
session_start();

require('../../fpdf17/fpdf.php');

class PDF extends FPDF
{
    function Header(){
        //$this->Image('../../imagenes/encabezado_fontur.png',20,10,168,25);
		$this->Image('../../imagenes/cintillo_nuevo.png',20,10,168,15);
    }
    function Footer(){
        $this->SetY(-20);
        $this->SetFont('Arial','',10);$this->Cell(84,5,utf8_decode('Documento válido por treinta (30) días a partir de su emisión.'),0,0,'L');$this->Cell(69,3,utf8_decode('Validación: '),0,0,'R');$this->SetFont('Arial','B',10);$this->Cell(15,3,$_SESSION['hash'],0,1,'R');
        $this->SetFont('Arial','',9,5);$this->Cell(168,5,utf8_decode('La validez de la presente constancia, puede ser consultada a través del correo constancia_de_trabajo@fontur.gob.ve'),0,0,'J');
    }
}
/*****************FIN DE FUNCION DE IMPRESION DE ENCABEZADO Y PIE DE PAGINA***********************/
///////////////////////////////////////////////////////////////////////////////////////////////////
/******** SE RELIZA ACTUALIZA UN CONTADOR QUE INCREMENTA CUANDO LOS COCEPTOS DE PAGO ESTAN EN CERO O BLANCO***/
/******** EL VALOR DEL CONTADOR DEFINE EL ALTO DE LAS CELDAS PARA CADA CONCEPTO DE PAGO EN LA IMPRESION ***********/
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
if($_SESSION['primaporhijo']==''||$_SESSION['primaporhijo']=='0,00'||$_SESSION['primaporhijo']=='0'){
	$i++;
}
if ($i<6){
    $var1=9-$i;
    $var2=56/$var1;  /*** $VAR2 DEFINE EL ALTO DE LA CELDA CUANDO EL TRABAJADOR POSEE DOS CONCEPTOS DE PAGO O MAS**/  
    
} else {
    $var2=9.5;      /*** $VAR2 DEFINE EL ALTO DE LA CELDA CUANDO EL TRABAJADOR POSEE UNO O DOS CONCEPTOS DE PAGO NADA MAS**/
}
/*********************FIN DE CONTEO DE CONCEPTOS Y DEFINICION DE ALTO DE CELDA DE IMPRESION DE CONCEPTOS***************/
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage('P','Letter');
$pdf->SetMargins(20,20,20);
$pdf->SetFont('Arial','',11);
//$pdf->Image('../../imagenes/FirmaDigitalCarnet.png',67,192,75,45,'PNG');
/****************SE DEFINE LA ALTURA A LA QUE SE IMPRIMIRA IMAGEN DE FIRMA DE GERENTE DE RRHH***********/
if ($i<6){
    $pdf->Image('../../imagenes/FirmaDigitalCarnet.png',68,190,75,30,'PNG'); /***UBICACION CON TRES CONCEPTOS DE PAGO O MAS***/
} else if ($i==7) {
    //$pdf->Image('../imagenes/FirmaDigitalCarnet.png',68,160,75,45,'PNG');
    $pdf->Image('../../imagenes/FirmaDigitalCarnet.png',68,150,75,30,'PNG');  /**UBICACION CON UN CONCEPTO DE PAGO**/
} else if ($i==6){
    $pdf->Image('../../imagenes/FirmaDigitalCarnet.png',68,162,75,30,'PNG'); /***UBICACION CON DOS CONCEPTOS DE PAGO*/
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
/**********************FIN DE IMPRESION DE FIRMA GERENTE RRHH************************************************/
//$pdf->Image('../../imagenes/Mision.jpg',158,268,30,10,'JPG');
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
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/**********SE DEFINE TEXTO QUE ACOMPAÑARA AL CARGO EN FUNCION DE LA NOMINA A LA QUE PERTENECE EL TRABAJADOR*******/
if ($_SESSION['nomina']=="fijos" or $_SESSION['nomina']=="nuevo_circo"){
	$texto="quien ocupa el cargo de"; /**** TEXTO QUE APLICARA PARA PERSONAL FIJO CON CARGO (SE HACE USO LA TABLA NUEVO CIRCO PARA PERSONAL OBRERO)***/
}else{
	$texto="quien se desempeña como"; /***TEXTO PARA PERSONAL CONTRATADO**/
}
/*******************FIN DEFINICION DE TEXTO QUE ACOMPAÑA AL CARGO DEL TRABAJADOR***********************************/
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/**** SE INICIA CON LA IMPRESION DEL TEXTO DE LA CONSTANCIA EN FUNCION DE LA NOMINA A LA CUAL PERTENECE EL TRABAJADOR***/
/*********************** SE DEFINE TEXTO PARA PERSONAL FJO Y CONTRATADO ************************************************/
if ($_SESSION['nomina']=="fijos" or $_SESSION['nomina']=="accion_centralizada" or $_SESSION['nomina']=="nuevo_circo" or $_SESSION['nomina']=="pasaje_estudiantil"){
    //$pdf->MultiCell(168,5,utf8_decode('Quien suscribe, Gerente (E) de Recursos Humanos de la '.$_SESSION['institucion'].', '.$_SESSION['nacgerente'].', por medio de la presente, hago constar que la (el) ciudadana (o) '.$_SESSION['apellidosynombres'].', titular de la Cédula de Identidad N° '.$_SESSION['ci'].' labora en esta Fundación, desde el '.$_SESSION['fechaingreso'].', actualmente cumple funciones de '.$_SESSION['cargo'].', adscrita (o) a la '.strtoupper($_SESSION['gerencia']).', devengando una remuneración mensual de:'),0,'J');
	//$pdf->MultiCell(168,5,utf8_decode('Quien suscribe, '.$_SESSION['nacgerente'].' Gerente de la Oficina de Gestión Humana de la '.$_SESSION['institucion'].', por medio de la presente, hago constar que la (el) ciudadana (o) '.$_SESSION['apellidosynombres'].', titular de la Cédula de Identidad N° '.$_SESSION['ci'].' labora en esta Fundación, desde el '.$_SESSION['fechaingreso'].', '.$texto.' '.$_SESSION['cargo'].', adscrita (o) a la '.strtoupper($_SESSION['gerencia']).', devengando una remuneración mensual de:'),0,'J');
	$pdf->MultiCell(168,5,utf8_decode('Quien suscribe, '.$_SESSION['nacgerente'].' Gerente de la Oficina de Gestión Humana de la '.$_SESSION['institucion'].', por medio de la presente, hago constar que la (el) ciudadana (o) '.$_SESSION['apellidosynombres'].', titular de la Cédula de Identidad N° '.$_SESSION['ci'].' labora en esta Fundación, desde el '.$_SESSION['fechaingreso'].', '.$texto.' '.$_SESSION['cargo'].', adscrita (o) a la '.strtoupper($_SESSION['gerencia']).', devengando una remuneración mensual de:'),0,'J');
}else if ($_SESSION['nomina']=="mision_transporte"){ /////TEXTO PARA PERSONAL JUBILADO////////
    //$pdf->MultiCell(168,5,utf8_decode('Quien suscribe, Gerente (E) de Recursos Humanos de la '.$_SESSION['institucion'].', '.$_SESSION['nacgerente'].', por medio de la presente, hago constar que la (el) ciudadana (o) '.$_SESSION['apellidosynombres'].', titular de la Cédula de Identidad N° '.$_SESSION['ci'].' labora en esta Fundación, desde el '.$_SESSION['fechaingreso'].', en condición de CONTRATADO, adscrita (o) a la '.strtoupper($_SESSION['gerencia']).', devengando una remuneración mensual de:'),0,'J');
	//$pdf->MultiCell(168,5,utf8_decode('Quien suscribe, '.$_SESSION['nacgerente'].' Gerente de la Oficina de Gestión Humana de la '.$_SESSION['institucion'].', por medio de la presente, hago constar que la (el) ciudadana (o) '.$_SESSION['apellidosynombres'].', titular de la Cédula de Identidad N° '.$_SESSION['ci'].' labora en esta Fundación, desde el '.$_SESSION['fechaingreso'].', en condición de CONTRATADO, adscrita (o) a la '.strtoupper($_SESSION['gerencia']).', devengando una remuneración mensual de:'),0,'J');
	$pdf->MultiCell(168,5,utf8_decode('Quien suscribe, '.$_SESSION['nacgerente'].' Gerente de la Oficina de Gestión Humana de la '.$_SESSION['institucion'].', por medio de la presente, hago constar que la (el) ciudadana (o) '.$_SESSION['apellidosynombres'].', titular de la Cédula de Identidad N° '.$_SESSION['ci'].' es Jubilada (o) de (FONTUR), desde el '.$_SESSION['fechaingreso'].', devengando una asignación mensual de:'),0,'J');
} else { ///////////TEXTO PARA PERSONAL PENSIONADO///////////
        $pdf->MultiCell(168,5,utf8_decode('Quien suscribe, '.$_SESSION['nacgerente'].' Gerente de la Oficina de Gestión Humana de la '.$_SESSION['institucion'].', por medio de la presente, hago constar que la (el) ciudadana (o) '.$_SESSION['apellidosynombres'].', titular de la Cédula de Identidad N° '.$_SESSION['ci'].' es Pensionada (o) de (FONTUR), desde el '.$_SESSION['fechaingreso'].', devengando una pensión mensual de:'),0,'J');
}
/******************************FIN DE IMPRESION TEXTO DE LA CONSTANCIA***************************************************/
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$pdf->Cell(168,5,'',0,1,'C');
//$pdf->Cell(168,5,'',0,1,'C');
////////////////SE DEFINE EL NOMBRE A MOSTRAR EN EL CONCEPTO DE ASIGNACION O SUELDO ///////////////////////////////////////////
////////////////EN FUNCION DE LA NOMINA A LA QUE PERTENECE EL TRABAJADOR//////////////////////////////////////////////////////
if ($_SESSION['nomina']=="fijos" or $_SESSION['nomina']=="accion_centralizada" or $_SESSION['nomina']=="nuevo_circo" or $_SESSION['nomina']=="pasaje_estudiantil"){
        $pdf->SetFont('Arial','B',11);$pdf->Cell(126,$var2,'Sueldo Base:',1,0,'L');$pdf->SetFont('Arial','',11);$pdf->Cell(42,$var2,$_SESSION['sueldobase'],1,1,'R');
}
if ($_SESSION['nomina']=="mision_transporte"){ ////// TEXTO PARA JUBILADOS////////////
        $pdf->SetFont('Arial','B',11);$pdf->Cell(126,$var2,utf8_decode('Jubilación Mensual:'),1,0,'L');$pdf->SetFont('Arial','',11);$pdf->Cell(42,$var2,$_SESSION['sueldobase'],1,1,'R');
}
if ($_SESSION['nomina']=="peaje"){//////////TEXTO PARA PENSIONADOS/////////////////
        $pdf->SetFont('Arial','B',11);$pdf->Cell(126,$var2,utf8_decode('Pensión Mensual:'),1,0,'L');$pdf->SetFont('Arial','',11);$pdf->Cell(42,$var2,$_SESSION['sueldobase'],1,1,'R');
}
///*****************FIN DE DEFINICION DE TEXTO PARA CONCEPTO DE ASIGANACION MENSUAL***************************************************/
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($_SESSION['diferenciamensual']!=''&&$_SESSION['diferenciamensual']!='0,00'&&$_SESSION['diferenciamensual']!='0'){
	$pdf->SetFont('Arial','B',11);$pdf->Cell(126,$var2,utf8_decode('Diferencia de Sueldo:'),1,0,'L');$pdf->SetFont('Arial','',11);$pdf->Cell(42,$var2,$_SESSION['diferenciamensual'],1,1,'R');
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
if($_SESSION['primaporhijo']!=''&&$_SESSION['primaporhijo']!='0,00'&&$_SESSION['primaporhijo']!='0'){
	$pdf->SetFont('Arial','B',11);$pdf->Cell(126,$var2,utf8_decode('Prima por Hijo:'),1,0,'L');$pdf->SetFont('Arial','',11);$pdf->Cell(42,$var2,$_SESSION['primaporhijo'],1,1,'R');
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/*****************DEFINICION DE TEXTO PARA TOTAL DE REMUNERACIONES SEGUN NOMINA***************************************************************/
if ($_SESSION['nomina']=="fijos" or $_SESSION['nomina']=="accion_centralizada" or $_SESSION['nomina']=="nuevo_circo" or $_SESSION['nomina']=="pasaje_estudiantil"){
        $pdf->SetFont('Arial','B',11);$pdf->Cell(126,$var2,utf8_decode('Sueldo Total:'),1,0,'L');$pdf->SetFont('Arial','',11);$pdf->Cell(42,$var2,$_SESSION['sueldototal'],1,1,'R');
}
if ($_SESSION['nomina']=="mision_transporte"){ /*****TEXTO JUBILADOS*******/
        $pdf->SetFont('Arial','B',11);$pdf->Cell(126,$var2,utf8_decode('Total Jubilación:'),1,0,'L');$pdf->SetFont('Arial','',11);$pdf->Cell(42,$var2,$_SESSION['sueldototal'],1,1,'R');
}
if ($_SESSION['nomina']=="peaje"){  /****TEXTO PENSIONADOS*******/
        $pdf->SetFont('Arial','B',11);$pdf->Cell(126,$var2,utf8_decode('Total Pensión:'),1,0,'L');$pdf->SetFont('Arial','',11);$pdf->Cell(42,$var2,$_SESSION['sueldototal'],1,1,'R');
}
/*********************FIN DE DEFINICION TEXTO PARA TOTALES SEGUN NOMINA*************************************************************************/
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$pdf->Cell(168,5,'',0,1,'C');
$pdf->SetFont('Arial','B',11);$pdf->Cell(168,7,utf8_decode('Beneficio Social de Caracter  No Remunerativo'),0,1,'L');
$pdf->Cell(126,$var2,utf8_decode('Cestaticket Socialista:'),1,0,'L');$pdf->SetFont('Arial','',11);$pdf->Cell(42,$var2,$_SESSION['bonoalimentacion'],1,1,'R');
$pdf->Cell(168,5,'',0,1,'C');
$pdf->Cell(168,5,utf8_decode('Sin más a que hacer referencia se despide.'),0,1,'L');
$pdf->Cell(168,5,utf8_decode('Atentamente'),0,1,'C');
$pdf->Cell(168,8,'',0,1,'C');
$pdf->Cell(168,8,'',0,1,'C');
$pdf->SetFont('Arial','B',11);
$pdf->Cell(168,5,utf8_decode($_SESSION['nyagerente']),0,1,'C');
//$pdf->Cell(168,5,utf8_decode('GERENTE DE RECURSOS HUMANOS (E)'),0,1,'C');
$pdf->Cell(168,5,utf8_decode('GERENTE DE LA OFICINA DE GESTIÓN HUMANA'),0,1,'C');
$pdf->SetFont('Arial','',8);
$pdf->Cell(168,3,utf8_decode('Designada mediante Punto de Cuenta N° 323 de fecha veinte (20) de agosto de 2019'),0,1,'C');
//$pdf->Cell(168,3,utf8_decode('y Oficio de Notificación N° PRE/O/498 de fecha quince (15) de octubre de 2018.'),0,1,'C');
$pdf->Cell(168,3,utf8_decode(''),0,1,'C');
//$pdf->Cell(56,5,utf8_decode($_SESSION['correlativo2']),0,0,'L');$pdf->SetFont('Arial','B',8);$pdf->Cell(56,5,utf8_decode($_SESSION['lema']),0,0,'C');$pdf->Cell(56,5,'',0,1,'R');
$pdf->SetFont('Arial','',11);
$pdf->Cell(56,5,"LC/EP.",0,0,'L');$pdf->SetFont('Arial','B',8);$pdf->Cell(56,5,utf8_decode($_SESSION['lema']),0,0,'C');$pdf->Cell(56,5,'',0,1,'R');
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