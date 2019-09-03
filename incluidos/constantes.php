<?php
	require('meses.php');
	require('cuenta_correlativo.php');
	//$correlativo1='GRRHH/CT/'.cuenta_correlativo();
	$correlativo1='OGH/CT/'.cuenta_correlativo();
	$lugar='Caracas';
	$fechaahora=date('j').' de '.$mes.' de '.date('Y');
	$año=date('Y');
	$institucion='Fundación Fondo Nacional de Transporte Urbano (FONTUR)';
	//$nacgerente='RAINER JOSE BRICEÑO LA ROSA'; //02082013
    //$nacgerente='YAIRI ZULEIMA LEON';
	//$nacgerente='LIC. MARLA MUÑOZ OLIVO Cedula V-5.890.991';
	$nacgerente='ROSELIN NEGRON V- 12.260.911';
	$unidadtributaria=107;
	$calculobonoalimentacion=($unidadtributaria/2)*31;
	$bonoalimentacion=number_format($calculobonoalimentacion, 2, ',', '.');
	//$correlativo2='RB/kv';
    //$correlativo2='YL/ja';
	//$correlativo2='ZS/IC/mm.';
	$correlativo2='PF/mm.';
	//$nyagerente='RAINER BRICEÑO';
	//$nyagerente='YAIRI LEON';
	//$nyagerente='LIC. MARLA MUÑOZ OLIVO';
	$nyagerente='ROSELIN NEGRON';
    //$lema='"Independencia y Patria Socialista... ¡Viviremos y Venceremos!"';
	$lema=' ';
	$rif='Rif: G-20006289-4';
	$institucion2='FUNDACION FONDO NACIONAL DE TRANSPORTE URBANO';
	$direccioninstitucion='Av. Los Jabillos. Edf. FONTUR, Sabana Grande. Caracas - Venezuela';
	$contacto='Máster (0212)707.02.77 -/fax. 707.0283 e-mail: fontur@fontur.gob.ve - http://www.fontur.gob.ve';
?>