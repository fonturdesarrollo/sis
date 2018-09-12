<?php
	function pre_consulta_pgsql_chq($nomina, $ci){
		require('../incluidos/bd-pgsql.php');
		$result = pg_query($conn, "SELECT * FROM ".$nomina." WHERE \"CÉDULA DE IDENTIDAD\"='".$ci."';");
		//echo "SELECT * FROM ".$nomina." WHERE \"CÉDULA DE IDENTIDAD\"='".$ci."' AND \"NUMERO DE CUENTA DEL TRABAJADOR\"='".$cuenta."';<br />";
		if (!$result) {
			echo "<p>Error ejecutando consulta en bd-pg.</p>";
			exit;
		}
		return pg_num_rows($result);
	}
	
	function pre_consulta_pgsql_chq2($nomina, $ci){
		require('../incluidos/bd-pgsql.php');
		$result = pg_query($conn, "SELECT \"NUMERO DE CUENTA DEL TRABAJADOR\" FROM ".$nomina." WHERE \"CÉDULA DE IDENTIDAD\"='".$ci."';");
		//echo "SELECT * FROM ".$nomina." WHERE \"CÉDULA DE IDENTIDAD\"='".$ci."' AND \"NUMERO DE CUENTA DEL TRABAJADOR\"='".$cuenta."';<br />";
		if (!$result) {
			echo "<p>Error ejecutando consulta en bd-pg.</p>";
			exit;
		}
		$resultado = pg_fetch_array($result);
		return $resultado[0];
	}
	
	function consulta_pgsql($campo, $tabla, $condicion1, $condicion2){
		require('../incluidos/bd-pgsql.php');
		$result = pg_query($conn, "SELECT \"".$campo."\" FROM ".$tabla." WHERE \"CÉDULA DE IDENTIDAD\"='".$condicion1."' AND \"NUMERO DE CUENTA DEL TRABAJADOR\"='".$condicion2."';");
		//echo "SELECT \"".$campo."\" FROM ".$tabla." WHERE \"CÉDULA DE IDENTIDAD\"='".$condicion1."' AND \"NUMERO DE CUENTA DEL TRABAJADOR\"='".$condicion2."';<br />";
		if (!$result) {
			echo "<p>Error ejecutando consulta en bd-pg.</p>";
			exit;
		}
		$resultado = pg_fetch_array($result);
		return $resultado[0];
	}
?>