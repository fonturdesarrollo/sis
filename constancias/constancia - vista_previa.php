<!--
<!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8' />
	<title>CONSTANCIA DE TRABAJO</title>
	<link rel='stylesheet' type='text/css' href='estilo.css' />
</head>
<body>
	<table align='center'>
		<tr>
			<td class='constancia'>
				<img style='width:512px;height:75px;border:1px' src='imagenes/encabezado_fontur.png'>
				<br /><br />
				<p><?php //echo $correlativo1; ?></p>
				<p id='derecha'><?php //echo $lugar.", ".$fechaahora; ?></p>
				<br />
				<p>Señores:</p>
				<p><strong><?php //echo $destino; ?></strong></p>
				<p>Presente.-</p>
				<br />
				<p id='justificado'>
					Quien suscribe, El Gerente de Recursos Humanos de la <strong><?php //echo $institucion.", ".$nacgerente; ?>,</strong> por medio de la presente, hago constar que la (el) ciudadana (o) <strong><?php /*echo*/ $_SESSION['apellidosynombres']=consulta_pgsql("APELLIDOS Y NOMBRES", $tabla, $ci, $cuenta); ?>,</strong> titular de la Cédula de Identidad <strong>N° <?php //echo $ci; ?>,</strong> labora en esta <strong><?php //echo $institucion; ?></strong> desde el <strong><?php /*echo*/ $_SESSION['fechaingreso']=consulta_pgsql("FECHA DE INGRESO", $tabla, $ci, $cuenta); ?>,</strong> actualmente cumple funciones de <strong><?php /*echo*/ $_SESSION['cargo']=consulta_pgsql("DENOMINACION DEL CARGO", $tabla, $ci, $cuenta); ?>,</strong> adscrita (o) a <strong><?php /*echo*/ $_SESSION['gerencia']=strtoupper(consulta_pgsql("GERENCIA", $tabla, $ci, $cuenta)); ?>,</strong> devengando una remuneración mensual de:
				</p>
				<br /><br />
				<table align='center' style='width:512px;height:150px;'>
					<tr>
						<td class='tablaconstancia' id='lineado'>
							<p><strong>Sueldo Base:</strong></p>
						</td>
						<td class='tablaconstancia' id='centrolineado'>
							<p><?php /*echo*/ $_SESSION['sueldobase']=consulta_pgsql("SUELDO BASICO MENSUAL", $tabla, $ci, $cuenta); ?></p>
						</td>
					</tr>
					<?php
						$_SESSION['diferenciamensual']=consulta_pgsql("DIFERENCIA DE SUELDO POR ENCARGADURIA MENSUAL", $tabla, $ci, $cuenta);
						if(consulta_pgsql("DIFERENCIA DE SUELDO POR ENCARGADURIA MENSUAL", $tabla, $ci, $cuenta)!=''&&consulta_pgsql("DIFERENCIA DE SUELDO POR ENCARGADURIA MENSUAL", $tabla, $ci, $cuenta)!='0,00'&&consulta_pgsql("DIFERENCIA DE SUELDO POR ENCARGADURIA MENSUAL", $tabla, $ci, $cuenta)!='0'){
							//echo "<tr><td class='tablaconstancia' id='lineado'><p><strong>Diferencia Mensual:</strong></p></td><td class='tablaconstancia' id='centrolineado'><p>".$_SESSION['diferenciamensual']."</p></td></tr>";
						}
						$_SESSION['primajerarquia']=consulta_pgsql("PRIMA JERARQUIA MENSUAL", $tabla, $ci, $cuenta);
						if(consulta_pgsql("PRIMA JERARQUIA MENSUAL", $tabla, $ci, $cuenta)!=''&&consulta_pgsql("PRIMA JERARQUIA MENSUAL", $tabla, $ci, $cuenta)!='0,00'&&consulta_pgsql("PRIMA JERARQUIA MENSUAL", $tabla, $ci, $cuenta)!='0'){
							//echo "<tr><td class='tablaconstancia' id='lineado'><p><strong>Prima de Jerarquía:</strong></p></td><td class='tablaconstancia' id='centrolineado'><p>".$_SESSION['primajerarquia']."</p></td></tr>";
						}
						$_SESSION['primaantiguedad']=consulta_pgsql("PRIMA ANTIGUEDAD MENSUAL", $tabla, $ci, $cuenta);
						if(consulta_pgsql("PRIMA ANTIGUEDAD MENSUAL", $tabla, $ci, $cuenta)!=''&&consulta_pgsql("PRIMA ANTIGUEDAD MENSUAL", $tabla, $ci, $cuenta)!='0,00'&&consulta_pgsql("PRIMA ANTIGUEDAD MENSUAL", $tabla, $ci, $cuenta)!='0'){
							//echo "<tr><td class='tablaconstancia' id='lineado'><p><strong>Prima de Antigüedad:</strong></p></td><td class='tablaconstancia' id='centrolineado'><p>".$_SESSION['primaantiguedad']."</p></td></tr>";
						}
						$_SESSION['primaprofesional']=consulta_pgsql("PRIMA DE PROFESIONALIZACION MENSUAL", $tabla, $ci, $cuenta);
						if(consulta_pgsql("PRIMA DE PROFESIONALIZACION MENSUAL", $tabla, $ci, $cuenta)!=''&&consulta_pgsql("PRIMA DE PROFESIONALIZACION MENSUAL", $tabla, $ci, $cuenta)!='0,00'&&consulta_pgsql("PRIMA DE PROFESIONALIZACION MENSUAL", $tabla, $ci, $cuenta)!='0'){
							//echo "<tr><td class='tablaconstancia' id='lineado'><p><strong>Prima de Profesional:</strong></p></td><td class='tablaconstancia' id='centrolineado'><p>".$_SESSION['primaprofesional']."</p></td></tr>";
						}
						$_SESSION['primahogar']=consulta_pgsql("PRIMA HOGAR MENSUAL", $tabla, $ci, $cuenta);
						if(consulta_pgsql("PRIMA HOGAR MENSUAL", $tabla, $ci, $cuenta)!=''&&consulta_pgsql("PRIMA HOGAR MENSUAL", $tabla, $ci, $cuenta)!='0,00'&&consulta_pgsql("PRIMA HOGAR MENSUAL", $tabla, $ci, $cuenta)!='0'){
							//echo "<tr><td class='tablaconstancia' id='lineado'><p><strong>Prima Hogar:</strong></p></td><td class='tablaconstancia' id='centrolineado'><p>".$_SESSION['primahogar']."</p></td></tr>";
						}
					?>
					<tr>
						<td class='tablaconstancia' id='lineado'>
							<p><strong>Sueldo Total:</strong></p>
						</td>
						<td class='tablaconstancia' id='centrolineado'>
							<p><? /*echo*/ $_SESSION['sueldototal']=consulta_pgsql("TOTAL DE SUELDO MAS PRIMA", $tabla, $ci, $cuenta); ?></p>
						</td>
					</tr>
				</table>
				<br />
				<p><strong>Beneficios Socios Económicos:</strong></p>
				<table align='center' style='width:512px;height:25px;'>
					<tr>
						<td class='tablaconstancia' id='lineado'>
							<p><strong>Bono de Alimentación:</strong></p>
						</td>
						<td class='tablaconstancia' id='centrolineado'>
							<p><strong><?php echo $bonoalimentacion; ?></strong></p>
						</td>
					</tr>
				</table>
				<br />
				<p>Sin más a que hacer referencia se despide.</p>
				<br />
				<p id='centrado'>Atentamente,</p>
				<br /><br />
				<p id='centrado'><strong><?php echo $nyagerente; ?></strong></p>
				<p id='centrado'><strong>GERENTE DE RECURSOS HUMANOS</strong></p>
				<p class='pie2' id='centrado'><strong><?php echo $lema; ?></strong></p>
				<p><?php echo $correlativo2; ?></p>
				<br /><br />
				<p class='pie1' id='centrado'><strong><?php echo $rif ?></strong></p>
				<p class='pie2' id='centrado'><strong><?php echo $institucion2; ?></strong></p>
				<p class='pie2' id='centrado'><?php echo $direccioninstitucion; ?></p>
				<p class='pie2' id='centrado'><?php echo $contacto; ?></p>
				<br />
				<p class='validacion' id='derecha'>Validación: <strong><?php echo $hash; ?></strong></p>
				<br /><br />
				<p class='pie2' id='centrado'>C</p>
				<p class='pie2' id='centrado'>Documento válido por treinta (30) días.</p>
				<p class='pie2' id='centrado'>La remuneración especificada en este documento corresponde al mes anterior de la solicitud de la misma.</p>
				<br /><br />
				<p id='centrado'><input type='button' value='IMPRIMIR' onclick="javascript:window.location.href='pgsql-insercion_constancia.php';" /></p>
			</td>
		</tr>
	</table>		
</body>
</html>