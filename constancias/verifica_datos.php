<?php
	session_start();
?>
<html>
<head>
	<meta charset='utf-8' />
	<title>SISTEMA DE SOLICITUD DE CONSTANCIAS</title>
	<link rel="stylesheet" type="text/css" href="../estilo.css" />
	<script src="../js/css.js"></script>
</head>
<body>
	<table class='cien'>
		<tr>
			<td class='encabezado'>
				<img class='enc3' src='../imagenes/cabecera.png' />
			</td>
		</tr>
		<tr>
			<td>
<?php
	if($_SERVER['REMOTE_ADDR']!="127.0.0.1"&&$_SERVER['REMOTE_ADDR']!="172.16.7.213"&&$_SERVER['REMOTE_ADDR']!="172.16.0.185"){
		header('Location: ingreso.php');
	}

	if(isset($_POST['ci'])&&$_POST['ci']!=null&&$_POST['ci']!=""){ 
		$ci=$_POST['ci'];
		include('pgsql-verificar_datos.php');
	}else{
		header('Location: verificar_datos.php');
	}
	
	if(pre_consulta_pgsql_chq('accion_centralizada', $ci)!=0){
		$nomina='accion_centralizada';
		$tabla='accion_centralizada';
		$cuenta=pre_consulta_pgsql_chq2('accion_centralizada', $ci);
	}else if(pre_consulta_pgsql_chq('accion_centralizada', number_format($ci,0,"","."))!=0){
		$nomina='accion_centralizada';
		$tabla='accion_centralizada';
		$ci=number_format($ci,0,"",".");   	
		$cuenta=pre_consulta_pgsql_chq2('accion_centralizada', $ci);
	}else if(pre_consulta_pgsql_chq('fijos', $ci)!=0){
		$nomina='fijos';
		$tabla='fijos';
		$cuenta=pre_consulta_pgsql_chq2('fijos', $ci);
	}else if(pre_consulta_pgsql_chq('fijos', number_format($ci,0,"","."))!=0){
		$nomina='fijos';
		$tabla='fijos';
		$ci=number_format($ci,0,"",".");
		$cuenta=pre_consulta_pgsql_chq2('fijos', $ci);		
	}else if(pre_consulta_pgsql_chq('nuevo_circo', $ci)!=0){
		$nomina='nuevo_circo';
		$tabla='nuevo_circo';
		$cuenta=pre_consulta_pgsql_chq2('nuevo_circo', $ci);
	}else if(pre_consulta_pgsql_chq('nuevo_circo', number_format($ci,0,"","."))!=0){
		$nomina='nuevo_circo';
		$tabla='nuevo_circo';
		$ci=number_format($ci,0,"",".");
		$cuenta=pre_consulta_pgsql_chq2('nuevo_circo', $ci);
	}else if(pre_consulta_pgsql_chq('pasaje_estudiantil', $ci)!=0){
		$nomina='pasaje_estudiantil';
		$tabla='pasaje_estudiantil';
		$cuenta=pre_consulta_pgsql_chq2('pasaje_estudiantil', $ci);
	}else if(pre_consulta_pgsql_chq('pasaje_estudiantil', number_format($ci,0,"","."))!=0){
		$nomina='pasaje_estudiantil';
		$tabla='pasaje_estudiantil';
		$ci=number_format($ci,0,"",".");	
		$cuenta=pre_consulta_pgsql_chq2('pasaje_estudiantil', $ci);
	}else if(pre_consulta_pgsql_chq('peaje', $ci)!=0){
		$nomina='peaje';
		$tabla='peaje';
		$cuenta=pre_consulta_pgsql_chq2('peaje', $ci);
	}else if(pre_consulta_pgsql_chq('peaje', number_format($ci,0,"","."))!=0){
		$nomina='peaje';
		$tabla='peaje';
		$ci=number_format($ci,0,"",".");	
		$cuenta=pre_consulta_pgsql_chq2('peaje', $ci);
	}else if(pre_consulta_pgsql_chq('mision_transporte', $ci)!=0){
		$nomina='mision_transporte';
		$tabla='mision_transporte';
		$cuenta=pre_consulta_pgsql_chq2('mision_transporte', $ci);
	}else if(pre_consulta_pgsql_chq('mision_transporte', number_format($ci,0,"","."))!=0){
		$nomina='mision_transporte';
		$tabla='mision_transporte';
		$ci=number_format($ci,0,"",".");
		$cuenta=pre_consulta_pgsql_chq2('mision_transporte', $ci);
	}else{
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=verificar_datos.php?error=rne">'; exit;
	}

	echo "<p><b>SOLICITANTE:</b> ".$_SERVER['REMOTE_ADDR'];
	echo "<p><b>NOMINA:</b> ".$nomina."</p>";
	echo "<p><b>NÚMERO DE CUENTA:</b> ".substr($cuenta,1)."</p>";
	echo "<p><b>APELLIDOS Y NOMBRES:</b> ".consulta_pgsql("APELLIDOS Y NOMBRES", $tabla, $ci, $cuenta)."</p>";
	echo "<p><b>FECHA DE INGRESO:</b> ".consulta_pgsql("FECHA DE INGRESO", $tabla, $ci, $cuenta)."</p>";
	echo "<p><b>DENOMINACION DEL CARGO:</b> ".consulta_pgsql("DENOMINACION DEL CARGO", $tabla, $ci, $cuenta)."</p>";
	echo "<p><b>GERENCIA:</b> ".strtoupper(consulta_pgsql("GERENCIA", $tabla, $ci, $cuenta))."</p>";
	echo /*number_format(*/"<p><b>SUELDO BASICO MENSUAL:</b> ".consulta_pgsql("SUELDO BASICO MENSUAL", $tabla, $ci, $cuenta)."</p>"/*,2,',','.')*/;
	echo /*number_format(*/"<p><b>DIFERENCIA DE SUELDO POR ENCARGADURIA MENSUAL:</b> ".consulta_pgsql("DIFERENCIA DE SUELDO POR ENCARGADURIA MENSUAL", $tabla, $ci, $cuenta)."</p>"/*,2,',','.')*/;
	echo /*number_format(*/"<p><b>PRIMA JERARQUIA MENSUAL:</b> ".consulta_pgsql("PRIMA JERARQUIA MENSUAL", $tabla, $ci, $cuenta)."</p>"/*,2,',','.')*/;
	echo /*number_format(*/"<p><b>PRIMA ANTIGUEDAD MENSUAL:</b> ".consulta_pgsql("PRIMA ANTIGUEDAD MENSUAL", $tabla, $ci, $cuenta)."</p>"/*,2,',','.')*/;
	echo /*number_format(*/"<p><b>PRIMA DE PROFESIONALIZACION MENSUAL:</b> ".consulta_pgsql("PRIMA DE PROFESIONALIZACION MENSUAL", $tabla, $ci, $cuenta)."</p>"/*,2,',','.')*/;
	echo /*number_format(*/"<p><b>PRIMA HOGAR MENSUAL:</b> ".consulta_pgsql("PRIMA HOGAR MENSUAL", $tabla, $ci, $cuenta)."</p>"/*,2,',','.')*/;
	echo /*number_format(*/"<p><b>TOTAL DE SUELDO MAS PRIMA:</b> ".consulta_pgsql("TOTAL DE SUELDO MAS PRIMA", $tabla, $ci, $cuenta)."</p>"/*,2,',','.')*/;
	echo /*number_format(*/"<p><b>BONO DE ALIMENTACION:</b> ".consulta_pgsql("BONO DE ALIMENTACION", $tabla, $ci, $cuenta)."</p>"/*,2,',','.')*/;
	echo /*number_format(*/"<p><b>PRIMA DE TRANSPORTE:</b> ".consulta_pgsql("PRIMA DE TRANSPORTE", $tabla, $ci, $cuenta)."</p>"/*,2,',','.')*/;
	echo "<br />";
	echo "<p><a href='verificar_datos.php' target='_self'>REGRESAR</a></p>";
?>
</tr>
		<tr>
			<td class='pie'>
				<img class='pie1' src='../imagenes/pie.png' />
			</td>
		</tr>
	</table>
</body>
</html>