<?php
	session_start();
	require('../incluidos/bd-pgsql.php');

	$result = pg_query($conn, "SELECT nsm FROM constancias WHERE ci = '".$_SESSION['ci']."' AND date_part('month',fecha_solicitud) >= date_part('month',now());");
	if (!$result) {
	  echo "<p>Error ejecutando consulta en bd-pg.</p>";
	  exit;
	}
	
	if(!pg_fetch_row($result)){
		//echo "<p>Personal no encontrado en los registros de bd-pg.</p>";
		$result2 = pg_query($conn, "INSERT INTO constancias (ci, nomina, hash, nsm, estado, fecha_solicitud) VALUES ('".$_SESSION['ci']."', '".$_SESSION['nomina']."', '".$_SESSION['hash']."', '1', '0', '".date("d-m-Y")."');");
		if (!$result2) {
		  echo "<p>Error ejecutando consulta en bd-pg.</p>";
		  exit;
		}else{
			header('Location: imprimir_constancia.php');
		}
	}else{
		//verificar valor de consulta para actualizar o rechazar
		switch(pg_num_rows($result)){
			case 1:
				$result2 = pg_query($conn, "INSERT INTO constancias (ci, nomina, hash, nsm, estado, fecha_solicitud) VALUES ('".$_SESSION['ci']."', '".$_SESSION['nomina']."', '".$_SESSION['hash']."', '2', '0', '".date("d-m-Y")."');");
				if (!$result2) {
				  echo "<p>Error ejecutando consulta en bd-pg.</p>";
				  exit;
				}else{
					header('Location: imprimir_constancia.php');
				}
			break;
			case 2:
				$result2 = pg_query($conn, "INSERT INTO constancias (ci, nomina, hash, nsm, estado, fecha_solicitud) VALUES ('".$_SESSION['ci']."', '".$_SESSION['nomina']."', '".$_SESSION['hash']."', '3', '0', '".date("d-m-Y")."');");
				if (!$result2) {
				  echo "<p>Error ejecutando consulta en bd-pg.</p>";
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