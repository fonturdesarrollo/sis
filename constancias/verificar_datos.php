<?php
	if($_SERVER['REMOTE_ADDR']!="127.0.0.1"&&$_SERVER['REMOTE_ADDR']!="172.16.7.213"&&$_SERVER['REMOTE_ADDR']!="172.16.0.185"){
		header('Location: ingreso.php');
	}
?>
<!DOCTYPE html>
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
		  <td align="right">
          </td>
		</tr>
		<tr>
			<td valign="top">
				<form name='ingreso' action='verifica_datos.php' method='post'>
				<table align='center' class='auto' id='lineado'>
					<tr>
						<td colspan='2' class='auto' id='centrolineado'>
							<p class='titulo'>SISTEMA DE SOLICITUD DE CONSTANCIAS</p>
						</td>
					</tr>
					<tr>
						<td colspan='2' class='auto' id='centrolineado'>
							<p>INGRESE LOS DATOS SOLICITADOS Y PRESIONE 'SIGUIENTE'</p>
						</td>
					</tr>
					<tr>
						<td class='auto' id='derecha'>
							<p>CÉDULA DE IDENTIDAD</p>
						</td>
						<td class='auto'>
							<p><input type='text' maxlength='8' name='ci' title="Ingrese su número de Cédula sin puntos.&#10;Ejemplo: 18000000"/></p>
						</td>
					</tr>
					<tr>
						<td colspan='2' class='auto' id='centrolineado'>
							<p>
								<input type='submit' name='siguiente' value='Siguiente'/>
							</p>
						</td>
					</tr>
				</table>
				<?php
					if(isset($_GET['error'])){
						if($_GET['error']=='rne'){
							echo "<br /><p class='valido' id='centrado'>REGISTRO NO ENCONTRADO, NO APARECE EN NINGUNA DE LAS NÓMINAS.</p>";
						}
					}
				?>
				</form>
			</td>
		</tr>
		<tr>
			<td class='pie'>
				<img class='pie1' src='../imagenes/pie.png' />
			</td>
		</tr>
	</table>
</body>
</html>