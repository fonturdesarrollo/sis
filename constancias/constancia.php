<?php
	session_start();
?>
<html>
<head>
	<meta charset='utf-8' />
</head>
<body>
<?php //nuevo meza//	
	require('../incluidos/constantes.php');
	if(isset($_POST['cuenta'])&&isset($_POST['ci'])&&isset($_POST['destino'])&&isset($_POST['captcha_code'])){
		include '../incluidos/securimage/securimage.php';
		$securimage = new Securimage();
		if ($securimage->check($_POST['captcha_code']) == false) {
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=ingreso.php?error=cvi">';
			return 0;
		}
		if(isset($_POST['otro_destino'])&& $_POST['otro_destino']!=''){
                    //desde aqui la validacion MEZA //
                    $cadenaO=$_POST['otro_destino'];
                    $array=explode(' ',$cadenaO);
                    for($j=0;$j<count($array);$j++){
                        $comparador=valida($array[$j]);
                        if ($comparador==1){
                            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=ingreso.php?error=rem">';
                            return 0;
                        }
                    }
                    // hasta aqui la modificacion ---// MEZA--
                    $destino=strtoupper($_POST['otro_destino']);
		}else{
			$destino=$_POST['destino'];
		}
                
		$cuenta="0".base64_decode($_POST['cuenta']);
		$ci=base64_decode($_POST['ci']);
		include('pgsql-consulta_constancia.php');
		include('../incluidos/codificar.php');
		$hash=codificar($ci, $fechaahora);
	}else{
		header('Location: ingreso.php');
	}
	if(pre_consulta_pgsql('accion_centralizada', $ci, $cuenta)!=0){
		$nomina='accion_centralizada';
		$tabla='accion_centralizada';
	}else if(pre_consulta_pgsql('accion_centralizada', number_format($ci,0,"","."), $cuenta)!=0){
		$nomina='accion_centralizada';
		$tabla='accion_centralizada';
		$ci=number_format($ci,0,"",".");
	}else if(pre_consulta_pgsql('fijos', $ci, $cuenta)!=0){
		$nomina='fijos';
		$tabla='fijos';
	}else if(pre_consulta_pgsql('fijos', number_format($ci,0,"","."), $cuenta)!=0){
		$nomina='fijos';
		$tabla='fijos';
		$ci=number_format($ci,0,"",".");
	}else if(pre_consulta_pgsql('nuevo_circo', $ci, $cuenta)!=0){
		$nomina='nuevo_circo';
		$tabla='nuevo_circo';
	}else if(pre_consulta_pgsql('nuevo_circo', number_format($ci,0,"","."), $cuenta)!=0){
		$nomina='nuevo_circo';
		$tabla='nuevo_circo';
		$ci=number_format($ci,0,"",".");
	}else if(pre_consulta_pgsql('pasaje_estudiantil', $ci, $cuenta)!=0){
		$nomina='pasaje_estudiantil';
		$tabla='pasaje_estudiantil';
	}else if(pre_consulta_pgsql('pasaje_estudiantil', number_format($ci,0,"","."), $cuenta)!=0){
		$nomina='pasaje_estudiantil';
		$tabla='pasaje_estudiantil';
		$ci=number_format($ci,0,"",".");
	}else if(pre_consulta_pgsql('peaje', $ci, $cuenta)!=0){
		$nomina='peaje';
		$tabla='peaje';
	}else if(pre_consulta_pgsql('peaje', number_format($ci,0,"","."), $cuenta)!=0){
                $nomina='peaje';
		$tabla='peaje';
		$ci=number_format($ci,0,"",".");
	}else if(pre_consulta_pgsql('mision_transporte', $ci, $cuenta)!=0){
		$nomina='mision_transporte';
		$tabla='mision_transporte';
	}else if(pre_consulta_pgsql('mision_transporte', number_format($ci,0,"","."), $cuenta)!=0){
		$nomina='mision_transporte';
		$tabla='mision_transporte';
		$ci=number_format($ci,0,"",".");
	} else {
                echo '<meta http-equiv="refresh" content="0; url=ingreso.php?error=rne" />';
                exit;
        }

        $_SESSION['correlativo1']=$correlativo1;
	$_SESSION['lugar']=$lugar; // CONSTANTE
	$_SESSION['fechaahora']=$fechaahora; // CONSTANTE
	$_SESSION['destino']=$destino;
	$_SESSION['institucion']=$institucion; // CONSTANTE
	$_SESSION['nacgerente']=$nacgerente; // CONSTANTE
	$_SESSION['ci']=$ci;
	//$_SESSION['bonoalimentacion']=$bonoalimentacion; // CONSTANTE
	$_SESSION['nyagerente']=$nyagerente; // CONSTANTE
	$_SESSION['lema']=$lema; // CONSTANTE
	$_SESSION['correlativo2']=$correlativo2; // CONSTANTE
	$_SESSION['rif']=$rif; // CONSTANTE
	$_SESSION['institucion2']=$institucion2; // CONSTANTE
	$_SESSION['direccioninstitucion']=$direccioninstitucion; // CONSTANTE
	$_SESSION['contacto']=$contacto; // CONSTANTE
	$_SESSION['hash']=$hash;
	$_SESSION['nomina']=$nomina;
	$_SESSION['apellidosynombres']=consulta_pgsql("APELLIDOS Y NOMBRES", $tabla, $ci, $cuenta);
	$_SESSION['fechaingreso']=consulta_pgsql("FECHA DE INGRESO", $tabla, $ci, $cuenta);
	$_SESSION['cargo']=consulta_pgsql("DENOMINACION DEL CARGO", $tabla, $ci, $cuenta);
	$_SESSION['gerencia']=strtoupper(consulta_pgsql("GERENCIA", $tabla, $ci, $cuenta));
	$_SESSION['sueldobase']=/*number_format(*/consulta_pgsql("SUELDO BASICO MENSUAL", $tabla, $ci, $cuenta)/*,2,',','.')*/;
	$_SESSION['diferenciamensual']=/*number_format(*/consulta_pgsql("DIFERENCIA DE SUELDO POR ENCARGADURIA MENSUAL", $tabla, $ci, $cuenta)/*,2,',','.')*/;
	$_SESSION['primajerarquia']=/*number_format(*/consulta_pgsql("PRIMA JERARQUIA MENSUAL", $tabla, $ci, $cuenta)/*,2,',','.')*/;
	$_SESSION['primaantiguedad']=/*number_format(*/consulta_pgsql("PRIMA ANTIGUEDAD MENSUAL", $tabla, $ci, $cuenta)/*,2,',','.')*/;
	$_SESSION['primaprofesional']=/*number_format(*/consulta_pgsql("PRIMA DE PROFESIONALIZACION MENSUAL", $tabla, $ci, $cuenta)/*,2,',','.')*/;
	$_SESSION['primahogar']=/*number_format(*/consulta_pgsql("PRIMA HOGAR MENSUAL", $tabla, $ci, $cuenta)/*,2,',','.')*/;
	$_SESSION['sueldototal']=/*number_format(*/consulta_pgsql("TOTAL DE SUELDO MAS PRIMA", $tabla, $ci, $cuenta)/*,2,',','.')*/;
	$_SESSION['bonoalimentacion']=/*number_format(*/consulta_pgsql("BONO DE ALIMENTACION", $tabla, $ci, $cuenta)/*,2,',','.')*/;
	$_SESSION['primatransporte']=/*number_format(*/consulta_pgsql("PRIMA DE TRANSPORTE", $tabla, $ci, $cuenta)/*,2,',','.')*/;
	$_SESSION['primaporhijo']=/*number_format(*/consulta_pgsql("PRIMA POR HIJO", $tabla, $ci, $cuenta)/*,2,',','.')*/;
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=pgsql-insercion_constancia.php">';
        
//funciones para las validaciones del renitente OTRO-- -- -- --- -- --- --- //
function valida($array_cadena){
	$arreglo_compara=
	array('quien',
              'quienes',
              'pueda',
              'puede',
	      'puedas',		
	      'puedan',		
	      'interesar',		
	      'interesa'
	);
 	$alerta=0;
	for($j=0;$j<count($arreglo_compara);$j++)
	{ 
		 $array_cadena;
		 $arreglo_compara[$j];		
		if(strcasecmp($array_cadena,$arreglo_compara[$j])==0)
		{
                    $alerta=1;
                    return $alerta;
                    exit;
		}else{
                    $alerta=0;
		}
	}
}
// fin de la funcion de comparacion	-----------------------------------------------//
?>
</body>
</html>