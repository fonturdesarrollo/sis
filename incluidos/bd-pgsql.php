<?php
	/************************************conexión servidor local***********************************************/
        $conn = pg_connect("host=127.0.0.1 port=5432 dbname=nominas user=postgres password=postgres");
        /************************************conexión server5***********************************************/
        //$conn = pg_connect("host=127.0.0.1 port=5432 dbname=nominas user=postgres password=noseascomoyosoy");
	if (!$conn) {
	  echo "<p>Error conectando a bd-pg.</p>";
	  exit;
	}
?>