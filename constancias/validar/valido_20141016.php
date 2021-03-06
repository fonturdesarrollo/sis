<?php
	require('../pgsql-consulta_constancia.php');
	require('../../incluidos/constantes.php');
	if(!isset($_POST['codigo'])){
		header('Location: index.php');
	}else{
		$fechasolicitud=consulta_pgsql_val1("fecha_solicitud", "constancias", $_POST['codigo']);
		$nomina=consulta_pgsql_val1("nomina", "constancias", $_POST['codigo']);
		$ci=consulta_pgsql_val1("ci", "constancias", $_POST['codigo']);
		$cuenta=consulta_pgsql_val2("NUMERO DE CUENTA DEL TRABAJADOR", $nomina, $ci);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8' />
	<title>VALIDAR CONSTANCIA DE TRABAJO</title>
	<link rel='stylesheet' type='text/css' href='../../estilo.css' />
</head>
<body>
	<table align='center' class='cien'>
		<tr>
			<td class='encabezado'>
				<img class='enc1' src='../../imagenes/header_gobierno.png' />
				<img class='enc2' src='../../imagenes/banner_fontur.png' />
			</td>
		</tr>
		<tr>
			<td>
				<table align='center' class='auto' id='lineado'>
					<tr>
						<td colspan='2' class='auto' id='centrolineado'>
							<p><strong>CONSTANCIA VÁLIDA<strong></p>
						</td>
					</tr>
					<tr>
						<td colspan='2' class='auto' id='centrolineado'>
							<p><strong>INFORMACIÓN DE VALIDACIÓN</strong></p>
						</td>
					</tr>
					<tr>
						<td class='auto' id='derecha'>
							<p><strong>VALIDACIÓN</strong></p>
						</td>
						<td class='auto' id='centrado'>
							<p><?php echo $_POST['codigo']; ?></p>
						</td>
					</tr>
					<tr>
						<td class='auto' id='derecha'>
							<p><strong>FECHA DE SOLICITUD</strong></p>
						</td>
						<td class='auto' id='centrado'>
							<p><?php echo date('d-m-Y',strtotime($fechasolicitud)); ?></p>
						</td>
					</tr>
					<tr>
						<td class='auto' id='derecha'>
							<p><strong>APELLIDOS Y NOMBRES</strong></p>
						</td>
						<td class='auto' id='centrado'>
							<p><?php echo consulta_pgsql_val3("APELLIDOS Y NOMBRES", $nomina, $ci, $cuenta); ?></p>
						</td>
					</tr>
					<tr>
						<td class='auto' id='derecha'>
							<p><strong>N° CÉDULA</strong></p>
						</td>
						<td class='auto' id='centrado'>
							<p><?php echo $ci; ?></p>
						</td>
					</tr>
					<tr>
						<td colspan='2' class='auto' id='centrolineado'>
							<p><input type='button' name='aceptar' value='Aceptar' onclick="javascript:window.location.href='index.php';"/></p>
						</td>
					</tr>
				</table>
				<br /><p class='valido' id='centrado'>ESTA CONSTANCIA TIENE UNA VALIDEZ DE TREINTA (30) DÍAS A PARTIR DE SU EMISIÓN.</p>
			</td>
		</tr>
		<tr>
			<td class='pie'>
				<p class='pie' id='centrado'><?php echo $institucion2; ?></p>
				<p class='pie' id='centrado'><?php echo $direccioninstitucion; ?></p>
				<p class='pie' id='centrado'><?php echo $contacto; ?></p>
			</td>
		</tr>
	</table>		
</body>
</html>