<?php
	// VERIFICA AL EMPLEADO Y LLAMA A LA BASE DE DATOS MSSQL
	/*$result = pg_query($conn, "SELECT ci,cuenta FROM pasaje WHERE ci='".$ci."' AND nomina='".$nomina."';");
	if (!$result) {
	  echo "<p>Error ejecutando consulta en bd-pg verify.</p>";
	  exit;
	}
	
	if(!pg_fetch_row($result)){
		echo "<p>Personal no encontrado en los registros de bd-pg.</p>";
	}else{
		//include('mssql-consulta_constancia.php'); // CONSULTA A MS SQL SERVER
	}*/
	
	function pre_consulta_pgsql($nomina, $ci, $cuenta){
		require('../incluidos/bd-pgsql.php');
		$result = pg_query($conn, "SELECT * FROM ".$nomina." WHERE \"CÉDULA DE IDENTIDAD\"='".$ci."' AND \"NUMERO DE CUENTA DEL TRABAJADOR\"='".$cuenta."';");
		//echo "SELECT * FROM ".$nomina." WHERE \"CÉDULA DE IDENTIDAD\"='".$ci."' AND \"NUMERO DE CUENTA DEL TRABAJADOR\"='".$cuenta."';<br />";
		if (!$result) {
			//echo "<p>Error ejecutando consulta en bd-pg pre_consulta.</p>";
			echo '<meta http-equiv="refresh" content="0; url=ingreso.php?error=rne" />';
			exit;
		}
		return pg_num_rows($result);
	}
	
	function consulta_pgsql($campo, $tabla, $condicion1, $condicion2){
		require('../incluidos/bd-pgsql.php');
		$result = pg_query($conn, "SELECT \"".$campo."\" FROM ".$tabla." WHERE \"CÉDULA DE IDENTIDAD\"='".$condicion1."' AND \"NUMERO DE CUENTA DEL TRABAJADOR\"='".$condicion2."';");
		//echo "SELECT \"".$campo."\" FROM ".$tabla." WHERE \"CÉDULA DE IDENTIDAD\"='".$condicion1."' AND \"NUMERO DE CUENTA DEL TRABAJADOR\"='".$condicion2."';<br />";
		if (!$result) {
			echo "<p>Error ejecutando consulta en bd-pg consulta.</p>";
			//exit;
		}
		$resultado = pg_fetch_array($result);
		return $resultado[0];
	}
	
	function consulta_pgsql_val1($campo, $tabla, $condicion){
		require('../../incluidos/bd-pgsql.php');
		$result = pg_query($conn, "SELECT ".$campo." FROM ".$tabla." WHERE hash='".$condicion."' AND fecha_solicitud > now() - '30 days'::interval;");
		//echo "SELECT ".$campo." FROM ".$tabla." WHERE hash='".$condicion."' AND fecha_solicitud > now() - '30 days'::interval;";
		if (!$result) {
			echo "<p>Error ejecutando consulta en bd-pg consulta val1.</p>";
			exit;
		}else if(pg_num_rows($result)==0){
			header('Location: index.php?error=cvne');
		}
		$resultado = pg_fetch_array($result);
		return $resultado[0];
	}
	
	function consulta_pgsql_val2($campo, $tabla, $condicion){
		require('../../incluidos/bd-pgsql.php');
		$result = pg_query($conn, "SELECT \"".$campo."\" FROM ".$tabla." WHERE \"CÉDULA DE IDENTIDAD\"='".$condicion."';");
		//echo "SELECT \"".$campo."\" FROM ".$tabla." WHERE \"CÉDULA DE IDENTIDAD\"='".$condicion."';";
		if (!$result) {
			echo "<p>Error ejecutando consulta en bd-pg consulta val2.</p>";
			exit;
		}else if(pg_num_rows($result)==0){
			header('Location: index.php?error=cvne');
		}
		$resultado = pg_fetch_array($result);
		return $resultado[0];
	}
	
	function consulta_pgsql_val3($campo, $tabla, $condicion1, $condicion2){
		require('../../incluidos/bd-pgsql.php');
		$result = pg_query($conn, "SELECT \"".$campo."\" FROM ".$tabla." WHERE \"CÉDULA DE IDENTIDAD\"='".$condicion1."' AND \"NUMERO DE CUENTA DEL TRABAJADOR\"='".$condicion2."';");
		//echo "SELECT \"".$campo."\" FROM ".$tabla." WHERE \"CÉDULA DE IDENTIDAD\"='".$condicion1."' AND \"NUMERO DE CUENTA DEL TRABAJADOR\"='".$condicion2."';<br />";
		if (!$result) {
			echo "<p>Error ejecutando consulta en bd-pg consulta val3.</p>";
			exit;
		}
		$resultado = pg_fetch_array($result);
		return $resultado[0];
	}
?>