<?php
	session_start();
	require('../incluidos/bd-pgsql.php');

	$result = pg_query($conn, "SELECT nsm FROM constancias WHERE ci = '".$_SESSION['ci']."' AND date_part('month',fecha_solicitud) >= date_part('month',now()) AND date_part('year',fecha_solicitud) = date_part('year',now());");
	 if (!$result) {
	  echo "<p>Error ejecutando consulta en bd-pg select_nsm.</p>";
	  exit;
	}
	
	if(!pg_fetch_row($result)){
		//echo "<p>Personal no encontrado en los registros de bd-pg.</p>";
		$result2 = pg_query($conn, "INSERT INTO constancias (ci, nomina, hash, nsm, estado, fecha_solicitud, dirigido, apellidos_nombres, fecha_ingreso, gerencia, sueldo_base, prima_jerarquia, prima_antiguedad, prima_profesional, prima_hogar, sueldo_total, bono_alimentacion, diferencia_mensual, primatransporte, prima_hijo, cargo) VALUES ('".$_SESSION['ci']."', '".$_SESSION['nomina']."', '".$_SESSION['hash']."', '1', '0', '".date("d-m-Y")."', '".$_SESSION['destino']."', '".$_SESSION['apellidosynombres']."', '".$_SESSION['fechaingreso']."', '".strtoupper($_SESSION['gerencia'])."', '".$_SESSION['sueldobase']."', '".$_SESSION['primajerarquia']."', '".$_SESSION['primaantiguedad']."', '".$_SESSION['primaprofesional']."', '".$_SESSION['primahogar']."', '".$_SESSION['sueldototal']."', '".$_SESSION['bonoalimentacion']."', '".$_SESSION['diferenciamensual']."', '".$_SESSION['primatransporte']."', '".$_SESSION['primaporhijo']."', '".$_SESSION['cargo']."');");
		if (!$result2) {
		  echo "<p>Error ejecutando consulta en bd-pg insert_nsm1.</p>";
		  exit;
		}else {
			header('Location: imprimir_constancia.php');
		}
	}else{
		//verificar valor de consulta para actualizar o rechazar
		switch(pg_num_rows($result)){
			case 1:
				$result2 = pg_query($conn, "INSERT INTO constancias (ci, nomina, hash, nsm, estado, fecha_solicitud, dirigido, apellidos_nombres, fecha_ingreso, gerencia, sueldo_base, prima_jerarquia, prima_antiguedad, prima_profesional, prima_hogar, sueldo_total, bono_alimentacion, diferencia_mensual, primatransporte, prima_hijo, cargo) VALUES ('".$_SESSION['ci']."', '".$_SESSION['nomina']."', '".$_SESSION['hash']."', '2', '0', '".date("d-m-Y")."', '".$_SESSION['destino']."', '".$_SESSION['apellidosynombres']."', '".$_SESSION['fechaingreso']."', '".strtoupper($_SESSION['gerencia'])."', '".$_SESSION['sueldobase']."', '".$_SESSION['primajerarquia']."', '".$_SESSION['primaantiguedad']."', '".$_SESSION['primaprofesional']."', '".$_SESSION['primahogar']."', '".$_SESSION['sueldototal']."', '".$_SESSION['bonoalimentacion']."', '".$_SESSION['diferenciamensual']."', '".$_SESSION['primatransporte']."', '".$_SESSION['primaporhijo']."', '".$_SESSION['cargo']."');");
				if (!$result2) {
				  echo "<p>Error ejecutando consulta en bd-pg insert_nsm2.</p>";
				  exit;
				}else{
					header('Location: imprimir_constancia.php');
				}
			break;
			case 2:
				$result2 = pg_query($conn, "INSERT INTO constancias (ci, nomina, hash, nsm, estado, fecha_solicitud, dirigido, apellidos_nombres, fecha_ingreso, gerencia, sueldo_base, prima_jerarquia, prima_antiguedad, prima_profesional, prima_hogar, sueldo_total, bono_alimentacion, diferencia_mensual, primatransporte, prima_hijo, cargo) VALUES ('".$_SESSION['ci']."', '".$_SESSION['nomina']."', '".$_SESSION['hash']."', '3', '0', '".date("d-m-Y")."', '".$_SESSION['destino']."', '".$_SESSION['apellidosynombres']."', '".$_SESSION['fechaingreso']."', '".strtoupper($_SESSION['gerencia'])."', '".$_SESSION['sueldobase']."', '".$_SESSION['primajerarquia']."', '".$_SESSION['primaantiguedad']."', '".$_SESSION['primaprofesional']."', '".$_SESSION['primahogar']."', '".$_SESSION['sueldototal']."', '".$_SESSION['bonoalimentacion']."', '".$_SESSION['diferenciamensual']."', '".$_SESSION['primatransporte']."', '".$_SESSION['primaporhijo']."', '".$_SESSION['cargo']."');");
				if (!$result2) {
				  echo "<p>Error ejecutando consulta en bd-pg insert_nsm3.</p>";
				  exit;
				}else{
					header('Location: imprimir_constancia.php');
				}
			break;
			case 3: header('Location: ingreso.php?error=mpm'); break;
		}
	}
	pg_close($conn);
?>