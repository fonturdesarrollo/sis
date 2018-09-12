<?php
	require('../incluidos/constantes.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8' />
	<title>SISTEMA DE SOLICITUD DE CONSTANCIAS</title>
	<link rel="stylesheet" type="text/css" href="../estilo.css" />
	<script src="../js/css.js"></script>
        <script type='text/javascript'>
			function validar_ingreso(){				
			ruta=document.ingreso;		
			if(ruta.cuenta.value==''){
				alert('Debe rellenar el campo cuenta nómina.');
			}else if(isNaN(ruta.cuenta.value)){
				alert('El número de cuenta solo debe contener números 0-9.');
			}else if(ruta.cuenta.value.length!=20){
				alert('El número de cuenta de nómina debe contener 20 dígitos.\nAviso: Recuerde que no es el número de su tarjeta de débito.');
			}else if(ruta.ci.value==''){
				alert('Debe rellenar el campo cédula de identidad.');
			}else if(isNaN(ruta.ci.value)){
				alert('El número de cédula solo debe contener números 0-9.');
			}else if(ruta.destino.selectedIndex==0){
				alert('Debe especificar el destino de su solicitud.');
			}else if(ruta.destino.value=='OTRO'&&ruta.otro_destino.value=='A Quien Pueda Interesar'||ruta.destino.value=='OTRO'&&ruta.otro_destino.value=='A QUIEN PUEDA INTERESAR'||ruta.destino.value=='OTRO'&&ruta.otro_destino.value=='a quien pueda interesar'||
                                 ruta.destino.value=='OTRO'&&ruta.otro_destino.value=='A Quien Puede Interesar'||ruta.destino.value=='OTRO'&&ruta.otro_destino.value=='A QUIEN PUEDE INTERESAR'||ruta.destino.value=='OTRO'&&ruta.otro_destino.value=='a quien puede interesar'||
                                 ruta.destino.value=='OTRO'&&ruta.otro_destino.value=='A quien pueda interesar'||ruta.destino.value=='OTRO'&&ruta.otro_destino.value=='a Quien pueda interesar'||ruta.destino.value=='OTRO'&&ruta.otro_destino.value=='a quien Pueda interesar'||
                                 ruta.destino.value=='OTRO'&&ruta.otro_destino.value=='a quien pueda Interesar'||ruta.destino.value=='OTRO'&&ruta.otro_destino.value=='A Quien Pueda Interesar'||ruta.destino.value=='OTRO'&&ruta.otro_destino.value=='A quien Puede interesar'||
				     ruta.destino.value=='OTRO'&&ruta.otro_destino.value==''){
				alert('Debe ser específico en el campo de destino de su solicitud.');
				ruta.otro_destino.value='';
			}else{
				alert(' ¡ ATENCIÓN !\n\nEl Documento será válido por treinta (30) días a partir de su emisión.\nEl sistema generará un máximo de tres (3) constancias cada mes.\nLa remuneración especificada en este documento corresponde al mes anterior de la solicitud de la misma.');
				//ultima modificacion MEZA//
				var cuentao= ruta.cuenta.value;	
				var cedulao = ruta.ci.value;
				var cuentaen= code.encode(cuentao);//encripto la cadena
				var cedulaen = code.encode(cedulao);//encripto la cadena
				ruta.cuenta.value= cuentaen;
				ruta.ci.value= cedulaen;
                                // fin de la encryptacion de las variables MEZA
                                ruta.submit();
			}
		}
		function cambio_solicitud(){
			ruta=document.ingreso;
			if(ruta.solicitud.selectedIndex==1){
				document.getElementById("invisible").style.visibility="visible";
				document.getElementById("centradoinvisible").style.visibility="visible";
			}else{
				document.getElementById("invisible").style.visibility="hidden";
				document.getElementById("centradoinvisible").style.visibility="hidden";
			}
			ruta.action=ruta.solicitud.value;
		}
		function cambio_destino(){
			ruta=document.ingreso;
			if(ruta.destino.value=='OTRO'){
				document.getElementById("invisible2").style.visibility="visible";
				document.getElementById("invisible3").style.visibility="visible";
			}else{
				document.getElementById("invisible2").style.visibility="hidden";
				document.getElementById("invisible3").style.visibility="hidden";
				ruta.otro_destino.value='';
			}
		}
		function carga(){
			document.ingreso.destino.selectedIndex=0;
		}
	</script>
</head>
<body onload="carga(); document.getElementById('captcha').src = '../incluidos/securimage/securimage_show.php?' + Math.random(); return false">
	<table class='cien'>
		<tr>
			<td class='encabezado'>
				<img class='enc2' src='../imagenes/banner_fontur.png' />
			</td>
		</tr>
                <tr>
                    <td align="right"><a id='regresar' href="http://enterate.fontur.gov.ve/Ngaleria/rh.php">Regresar</a></td>
                </tr>
		<!--<tr>
		  <td align="right">
                    <a href="../incluidos/doc/tripticofinal.pdf" target="_blank"><img src="../imagenes/help.png" width="40" height="39" title="Descargue el triptico"></a>
                  </td>
                </tr>-->
		<tr>
			<td valign="top">
				<form name='ingreso' action='constancia.php' method='post'>
                                    <table align='center' class='auto' id='lineado'>
					<tr>
						<td colspan='3' class='auto' id='derechalineado'>
							<p class='titulo'>SISTEMA DE SOLICITUD DE CONSTANCIAS</p>
						</td>
                                                <td id='invisibleizq'>
							<a href="../incluidos/doc/tripticofinal.pdf" target="_blank"><img src="../imagenes/help.png" width="40" height="39" title="Descargue el triptico"></a>
						</td>
					</tr>
					<tr>
						<td colspan='4' class='auto' id='centrolineado'>
							<p>INGRESE LOS DATOS SOLICITADOS Y PRESIONE 'SIGUIENTE'</p>
						</td>
					</tr>
					<tr>
						<td class='auto' id='derecha'>
							<p>N° DE CUENTA NÓMINA</p>
						</td>
						<td class='auto' colspan='3'>
                                                    <p><input type='text' maxlength='20' name='cuenta' title="Ingrese su número de cuenta. &#10;En caso de no poseer cuenta, coloque su número de cédula y complete con ceros hasta llenar 20 dígitos.&#10;Ejemplo: 12345678900000000000"/></p>
						</td>
					</tr>
					<tr>
						<td class='auto' id='derecha'>
							<p>CÉDULA DE IDENTIDAD</p>
						</td>
						<td class='auto' colspan='3'>
							<p><input type='text' maxlength='8' name='ci' title="Ingrese su número de Cédula sin puntos.&#10;Ejemplo: 18000000"/></p>
						</td>
					</tr>
					<tr>
						<td class='auto' id='derecha'>
							<p>DIRIGIDO A</p>
						</td>
						<td class='auto' colspan='3'>
							<p>
								<select name='destino' onchange='cambio_destino();' title='Seleccione de la lista desplegable la institución o entidad bancaria destinataria, de no encontrarla haga clic en la opción "OTRO" y escriba el nombre del destinatario'>
									<option value='Seleccione'>Seleccione</option>
									<option value='BANAVIH'>BANAVIH</option>
									<option value='BANCO B.O.D'>BANCO B.O.D</option>
									<option value='BANCO BANESCO'>BANCO BANESCO</option>
									<option value='BANCO BICENTENARIO'>BANCO BICENTENARIO</option>
									<option value='BANCO DE VENEZUELA'>BANCO DE VENEZUELA</option>
									<option value='BANCO DEL TESORO'>BANCO DEL TESORO</option>
									<option value='BANCO EXTERIOR'>BANCO EXTERIOR</option>
									<option value='BANCO INDUSTRIAL'>BANCO INDUSTRIAL</option>
									<option value='BANCO MERCANTIL'>BANCO MERCANTIL</option>
									<option value='BANCO PROVINCIAL'>BANCO PROVINCIAL</option>
									<option value='BANCO SOFITASA'>BANCO SOFITASA</option>
									<option value='EMBAJADA AMERICANA'>EMBAJADA AMERICANA</option>
									<option value='I.V.S.S INSTITUTO VENEZOLANO DE LOS SEGUROS SOCIALES'>I.V.S.S INSTITUTO VENEZOLANO DE LOS SEGUROS SOCIALES</option>
									<option value='PDVAL'>PDVAL</option>
									<option value='SENIAT'>SENIAT</option>
									<option value='TODOS LOS BANCOS NACIONALES'>TODOS LOS BANCOS NACIONALES</option>
									<option value='OTRO'>OTRO</option>
								</select>
							</p>
						</td>
					</tr>
					<tr>
						<td class='auto' id='derecha'>
							<p id='invisible2'>INDIQUE OTRO</p>
						</td>
						<td class='auto' id='invisible3' colspan='2'>
							<p><input type='text' name='otro_destino' title='El sistema no permite colocar "A QUIEN PUEDA INTERESAR"'/></p>
						</td>
                                                <td></td>
					</tr>
					<tr>
						<td colspan='4' class='auto' id='centrado'>
							<p>Código de Seguridad</p>
							<p><img id="captcha" src="../incluidos/securimage/securimage_show.php" alt="CAPTCHA Image" /></p>
                                                        <p><input type="text" name="captcha_code" size="10" maxlength="6" title="Introduzca el código de seguridad tal como se muestra en la imágen respetando mayúsculas y minúsculas"/></p>
							<p><a href="#" onclick="document.getElementById('captcha').src = '../incluidos/securimage/securimage_show.php?' + Math.random(); return false">Haga clic para cambiar la imágen.</a></p>
						</td>
					</tr>
					<tr>
						<td colspan='4' class='auto' id='centrolineado'>
							<p>
								<input type='button' name='siguiente' value='Siguiente' onclick='validar_ingreso();'/>
								<input type='button' name='salir' value='Salir' onclick="javascript:window.location.href='../index.php';"/>
							</p>
						</td>
					</tr>
				</table>
				<?php
					if(isset($_GET['error'])){
						if($_GET['error']=='mpm'){
							echo "<br /><p class='valido' id='centrado'>USTED HA ALCANZADO EL MÁXIMO PERMITIDO POR EL MES, COMUNÍQUESE CON RECURSOS HUMANOS.</p>";
						}else if($_GET['error']=='rne'){
							echo "<br /><p class='valido' id='centrado'>REGISTRO NO ENCONTRADO, VERIFIQUE SU INFORMACIÓN.</p>";
						}else if($_GET['error']=='cvi'){
							echo "<br /><p class='valido' id='centrado'>CÓDIGO DE SEGURIDAD INCORRECTO, INTÉNTELO DE NUEVO.</p>";
						}else if($_GET['error']=='rem'){ //nuevo
							echo "<br /><p class='valido' id='centrado'>REMITENTE NO PERMITIDO, INTÉNTELO DE NUEVO.</p>";
						}
					}
				?>
				</form>
			</td>
		</tr>
		<tr>
			<td class='pie'>
				<img class='pie' src='../imagenes/mancha_gobierno.png' />
			</td>
		</tr>
	</table>
</body>
</html>
