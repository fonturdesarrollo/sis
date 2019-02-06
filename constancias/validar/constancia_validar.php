<?php
session_start();
require('../../incluidos/constantes.php');
require('../pgsql-consulta_constancia.php');

$_SESSION['diferenciamensual']=consulta_pgsql_val1("diferencia_mensual", "constancias", $_POST['codigo']);
$_SESSION['primaantiguedad']=consulta_pgsql_val1("prima_antiguedad", "constancias", $_POST['codigo']);
$_SESSION['primajerarquia']=consulta_pgsql_val1("prima_jerarquia", "constancias", $_POST['codigo']);
$_SESSION['primaprofesional']=consulta_pgsql_val1("prima_profesional", "constancias", $_POST['codigo']);
$_SESSION['primahogar']=consulta_pgsql_val1("prima_hogar", "constancias", $_POST['codigo']);
//$_SESSION['correlativo1']='GRRHH/CT/'.consulta_pgsql_val1("id", "constancias", $_POST['codigo']);
$_SESSION['correlativo1']='OGH/CT/'.consulta_pgsql_val1("id", "constancias", $_POST['codigo']);
$_SESSION['destino']=consulta_pgsql_val1("dirigido", "constancias", $_POST['codigo']);
$_SESSION['cargo']=consulta_pgsql_val1("cargo", "constancias", $_POST['codigo']);
$_SESSION['apellidosynombres']=consulta_pgsql_val1("apellidos_nombres", "constancias", $_POST['codigo']);
$_SESSION['ci']=consulta_pgsql_val1("ci", "constancias", $_POST['codigo']);
$_SESSION['fechaingreso']=date("d/m/Y",strtotime(consulta_pgsql_val1("fecha_ingreso", "constancias", $_POST['codigo'])));
$_SESSION['gerencia']=consulta_pgsql_val1("gerencia", "constancias", $_POST['codigo']);
$_SESSION['sueldobase']=consulta_pgsql_val1("sueldo_base", "constancias", $_POST['codigo']);
$_SESSION['sueldototal']=consulta_pgsql_val1("sueldo_total", "constancias", $_POST['codigo']);
$_SESSION['bonoalimentacion']=consulta_pgsql_val1("bono_alimentacion", "constancias", $_POST['codigo']);
$_SESSION['primatransporte']=consulta_pgsql_val1("primatransporte", "constancias", $_POST['codigo']);
$_SESSION['hash']=consulta_pgsql_val1("hash", "constancias", $_POST['codigo']);
$_SESSION['nomina']=consulta_pgsql_val1("nomina", "constancias", $_POST['codigo']);
$fecha_solicitud =consulta_pgsql_val1("fecha_solicitud", "constancias", $_POST['codigo']);
$fecha = explode("-",$fecha_solicitud);
$fecha[0]=$año;
switch($mes2=$fecha[1]){
    case '01': $mes2='Enero'; break;
    case '02': $mes2='Febrero'; break;
    case '03': $mes2='Marzo'; break;
    case '04': $mes2='Abril'; break;
    case '05': $mes2='Mayo'; break;
    case '06': $mes2='Junio'; break;
    case '07': $mes2='Julio'; break;
    case '08': $mes2='Agosto'; break;
    case '09': $mes2='Septiembre'; break;
    case '10': $mes2='Octubre'; break;
    case '11': $mes2='Noviembre'; break;
    case '12': $mes2='Diciembre'; break;
}
$dia=$fecha[2];
$_SESSION['fechasolicitud']=$dia." de ".$mes2." de ".$año;
$_SESSION['lugar']=$lugar; // CONSTANTE 
$_SESSION['institucion']=$institucion; // CONSTANTE
$_SESSION['nacgerente']=$nacgerente; // CONSTANTE
$_SESSION['nyagerente']=$nyagerente; // CONSTANTE
$_SESSION['correlativo2']=$correlativo2; // CONSTANTE
$_SESSION['lema']=$lema; // CONSTANTE
$_SESSION['rif']=$rif; // CONSTANTE
$_SESSION['institucion2']=$institucion2; // CONSTANTE
$_SESSION['direccioninstitucion']=$direccioninstitucion; // CONSTANTE
$_SESSION['contacto']=$contacto; // CONSTANTE
echo '<META HTTP-EQUIV="Refresh" Content="0; URL=constancia_valida_pdf.php">';
?>