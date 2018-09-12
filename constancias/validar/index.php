<?php
	require('../pgsql-consulta_constancia.php');
	require('../../incluidos/constantes.php');
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
				<img class='enc2' src='../../imagenes/banner_fontur.png' />
			</td>
		</tr>
		<tr>
			<td>
				<form name='validacion' action='valido.php' method='post'>
				<table align='center' class='auto' id='lineado'>
					<tr>
						<td colspan='2' class='auto' id='centrolineado'>
							<p>VALIDAR CONSTANCIA</p>
						</td>
					</tr>
					<tr>
						<td class='auto' id='derecha'>
							<p>CÓDIGO DE VALIDACIÓN</p>
						</td>
						<td class='auto' id='centrado'>
							<p><input type='text' name='codigo' /></p>
						</td>
					</tr>
					<tr>
						<td colspan='2' class='auto' id='centrolineado'>
							<p>
								<input type='submit' name='validar' value='Validar' onclick=''/>
								<input type='button' name='salir' value='Salir' onclick="javascript:window.location.href='../../index.php';"/>
							</p>
						</td>
					</tr>
				</table>
				<?php
					if(isset($_GET['error'])){
						if($_GET['error']=='cvne'){
							echo "<br /><p class='valido' id='centrado'>CÓDIGO DE VALIDACIÓN INEXISTENTE EN NUESTROS REGISTROS</p>";
						}
					}
				?>
				</form>
			</td>
		</tr>
		<tr>
			<td class='pie'>
				<img class='pie' src='../../imagenes/mancha_gobierno.png' />
			</td>
		</tr>
	</table>		
</body>
</html>
